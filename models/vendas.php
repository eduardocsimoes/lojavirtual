<?php 
	class Vendas extends model{

		public function getPedidosDoUsuario($id_usuario){

			$array = array();
			if(!empty($id_usuario)){
				$sql = "SELECT 
								*,
								(SELECT 
										nome 
								 FROM 
								 		pagamentos 
								 WHERE 
								 		pagamentos.id = vendas.forma_pg
								 ) as desc_forma_pgto
						FROM 
								vendas 
						WHERE 
								id_usuario = :id_usuario";
				$sql = $this->db->prepare($sql);
				$sql->bindValue(":id_usuario", $id_usuario);
				$sql->execute();

				if($sql->rowCount() > 0){
					$array = $sql->fetchAll();
				}		
			}

			return $array;
		}

		public function getPedidoDoUsuario($id_pedido){

			$array = array();
			if(!empty($id_pedido)){
				$sql = "SELECT 
								*,
								(SELECT 
										nome 
								 FROM 
								 		pagamentos 
								 WHERE 
								 		pagamentos.id = vendas.forma_pg
								 ) as desc_forma_pgto
						FROM 
								vendas 
						WHERE 
								id = :id_pedido";
				$sql = $this->db->prepare($sql);
				$sql->bindValue(":id_pedido", $id_pedido);
				$sql->execute();

				if($sql->rowCount() > 0){
					$array = $sql->fetch();

					$array['produtos'] = $this->getProdutosDoPedido($id_pedido);
				}		
			}

			return $array;
		}

		public function getProdutosDoPedido($id_pedido){

			$sql = "SELECT 
							vendas_produtos.quantidade,
							vendas_produtos.id_produto,
							produtos.nome,
							produtos.imagem,
							produtos.preco
					FROM 
							vendas_produtos
					LEFT JOIN	produtos
					  ON	produtos.id = vendas_produtos.id_produto
					WHERE 
							id_venda = :id_pedido";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_pedido", $id_pedido);
			$sql->execute();

			if($sql->rowCount() > 0){
				$array = $sql->fetchAll();
			}

			return $array;
		}

		public function isPedidoDoUsuario($id_pedido, $id_usuario){

			$sql = "SELECT * FROM vendas WHERE id = :id_pedido AND id_usuario = :id_usuario";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_pedido", $id_pedido);
			$sql->bindValue(":id_usuario", $id_usuario);
			$sql->execute();

			if($sql->rowCount() > 0){
				return true;
			}else{
				return false;
			}
		}

		public function verificarVendas(){

			require "libraries/PagSeguroLibrary/PagSeguroLibrary.php";

			$code = '';
			$type = '';

			if(isset($_POST['notificationCode']) && isset($_POST['notificationType'])){
				$code = trim($_POST['notificationCode']);
				$type = trim($_POST['notificationType']);

				$notificationType = PagSeguroNotificationType($type);
				$valueType = $notificationType->getTypeFromValue();

				$credentials = PagseguroConfig::getAccountCredentials();

				try{
					$transaction = PagSeguroNotificationService::checkTransaction($credentials, $code);
					$reference = $transaction->getReference();
					$status = $transaction->getStatus()->getValue();

					$novoStatus = 0;
					switch($status){
						case '1': //Aguadando Pgto.
						case '2': //Em análise
							$novoStatus = '1';
							break;
						case '3': //Pago
						case '4': //Disponível
							$novoStatus = '2';
							break;
						case '6': //Devolvido
						case '7': //Cancelado
							$novoStatus = '3';
							break;		
					}

					$sql = "UPDATE vendas SET status_pg = :status WHERE id = :id_venda";
					$sql = $this->db->prepare($sql);
					$sql->bindValue(":status", $status);
					$sql->bindValue(":id_venda", $reference);
					$sql->execute();					

				}catch(PagSeguroServiceException $e){
					echo "Erro: ".$e->getMessage();
				}
			}
		}

		public function setVenda($id_usuario, $endereco, $valor, $tipo_pagamento, $produtos){

			/*
			1 => Aguardando Pagamento
			2 => Aprovado
			3 => Cancelado
			*/
			$status = 1;
			$link = '';

			$sql = "INSERT INTO vendas SET id_usuario = :id_usuario, endereco = :endereco, valor = :valor, forma_pg = :tipo_pagamento, status_pg = :status, pg_link = :link";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_usuario", $id_usuario);
			$sql->bindValue(":endereco", $endereco);
			$sql->bindValue(":valor", $valor['valor_total']);
			$sql->bindValue(":tipo_pagamento", $tipo_pagamento);
			$sql->bindValue(":status", $status);
			$sql->bindValue(":link", $link);
			$sql->execute();

			$id_venda = $this->db->lastInsertId();

			if($tipo_pagamento == 1){
				$status = 2;
				$link = BASE_URL."carrinho/obrigado";

				$sql = "UPDATE vendas SET status_pg = :status, pg_link = :link";
				$sql = $this->db->prepare($sql);
				$sql->bindValue(":status", $status);
				$sql->bindValue(":link", $link);
				$sql->execute();	

			}elseif($tipo_pagamento == 2){
				require "libraries/PagSeguroLibrary/PagSeguroLibrary.php";

				$paymentRequest = new PagSeguroPaymentRequest();

				foreach($produtos as $produto){
					$paymentRequest->addItem($produto['id'], $produto['nome'], 1, $produto['preco']);
				}

				$paymentRequest->setCurrency("BRL");
				$paymentRequest->setReference($id_venda);
				$paymentRequest->setRedirectUrl(BASE_URL."carrinho/obrigado");
				$paymentRequest->addParameter("notificationURL", BASE_URL."carrinho/notificacao");

				try{
					$cred = PagSeguroConfig::getAccountCredentials();
					$link = $paymentRequest->register($cred);

				}catch(PagSeguroServiceException $e){
					echo $e->getMessage();
				}
			}

			foreach($produtos as $produto){

				$sql = "INSERT INTO vendas_produtos SET id_venda = :id_venda, id_produto = :id_produto, quantidade = :quantidade";
				$sql = $this->db->prepare($sql);
				$sql->bindValue(":id_venda", $id_venda);
				$sql->bindValue(":id_produto", $produto['id']);
				$sql->bindValue(":quantidade", 1);
				$sql->execute();
			}

			unset($_SESSION['carrinho']);

			return $link;
		}

		public function setVendaCKTransparente($params, $id_usuario, $sessionId, $produtos, $subtotal){

			require 'Libraries/PagSeguroLibrary/PagSeguroLibrary.php';

			/*
			1 => Aguardando Pagamento
			2 => Aprovado
			3 => Cancelado
			*/
			$status = 1;
			$link = '';

			$end = implode(', ',$params['endereco']);

			$sql = "INSERT INTO vendas SET id_usuario = :id_usuario, endereco = :endereco, valor = :valor, forma_pg = '6', status_pg = :status, pg_link = :link";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_usuario", $id_usuario);
			$sql->bindValue(":endereco", $endereco);
			$sql->bindValue(":valor", $valor['valor_total']);
			$sql->bindValue(":tipo_pagamento", $tipo_pagamento);
			$sql->bindValue(":status", $status);
			$sql->bindValue(":link", $sessionId);
			$sql->execute();

			$id_venda = $this->db->lastInsertId();

			foreach($produtos as $produto){

				$sql = "INSERT INTO vendas_produtos SET id_venda = :id_venda, id_produto = :id_produto, quantidade = :quantidade";
				$sql = $this->db->prepare($sql);
				$sql->bindValue(":id_venda", $id_venda);
				$sql->bindValue(":id_produto", $produto['id']);
				$sql->bindValue(":quantidade", 1);
				$sql->execute();
			}

			unset($_SESSION['carrinho']);

			$directPaymentRequest = new PagSeguroDirectPaymentRequest();
			$directPaymentRequest->setPaymentMode('DEFAULT');
			$directPaymentRequest->setPaymentMethod($params['pg_form']);
			$directPaymentRequest->setReference($id_venda);
			$directPaymentRequest->setCurrency('BRL');
			$paymentRequest->addParameter("notificationURL", BASE_URL."carrinho/notificacao");

			foreach($produtos as $produto){
				$directPaymentRequest->addItem($produto['id'], $produto['nome'], 1, $produto['preco']);
			}

			$directPaymentRequest->setSender(
				$params['nome'],
				$params['email'],
				$params['ddd'],
				$params['telefone'],
				'CPF',
				$params['c_cpf']
			);

			$directPaymentRequest->setSenderHash($params['shash']);

			$directPaymentRequest->setShippingType(3);
			$directPaymentRequest->setShippingCost(0);
			$directPaymentRequest->setShippingAddress(
				$params['endereco']['cep'],
				$params['endereco']['rua'],
				$params['endereco']['numero'],
				$params['endereco']['comp'],
				$params['endereco']['bairro'],
				$params['endereco']['cidade'],
				$params['endereco']['estado'],
				'BRA'
			);

			$billingAddress = new PagSeguroBilling(
				array(
					'postalCode' => $params['endereco']['cep'],
					'street' => $params['endereco']['rua'],
					'number' => $params['endereco']['numero'],
					'complement' => $params['endereco']['comp'],
					'district' => $params['endereco']['bairro'],
					'city' => $params['endereco']['cidade'],
					'state' => $params['endereco']['estado'],
					'country' => 'BRA'
				)
			);

			if($params['pg_form'] == 'CREDIT_CARD'){
				$parc = explode(';', $params['parc']);

				$installments = new PagSeguroInstallment(
					'',
					$parc[0],
					$parc[1],
					'',
					''
				);

				$creditCardData = new PagSeguroCreditCardCheckout(
					array(
						'token' => $params['ctoken'],
						'installment' => $installments,
						'billing' => $billingAddress,
						'holder' => new PagSeguroCreditCardHolder(
							array(
								'name' => $params['c_titular'],
								'birthDate' => date('01/10/1979'),
								'areaCode' => $params['ddd'],
								'number' => $params['telefone'],
								'documents' => array(
									'type' => 'CPF',
									'value' => $params['c_cpf']
								)
							)
						)
					)
				);

				$directPaymentRequest->setCreditCard($creditCardData);
			}

			try{
				$credentials = PagSeguroConfig::getAccountCredentials();
				$r = $directPaymentRequest->register($credentials);

				return $r;
			}catch(PagSeguroServiceException $e){
				die($e->getMessage());
			}
		}

		public function setLinkBySession($link, $sessionId){

			$this->db->query("UPDATE vendas SET pg_link = '$link' WHERE pg_link = '$sessionId'");
		}
	}
?>