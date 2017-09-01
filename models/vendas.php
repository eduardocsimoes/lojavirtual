<?php 
	class Vendas extends model{

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
	}
?>