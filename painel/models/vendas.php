<?php 
	class Vendas extends model{

		public function getVendas($offset, $limit){

			$array = array();

			$sql = "SELECT
							 vendas.id,
							 vendas.valor,
							 vendas.status_pg,
							(SELECT
									usuarios.nome
							 FROM
							 		usuarios
							 WHERE
									usuarios.id = vendas.id_usuario
							) as nome_cliente,
							(SELECT
									pagamentos.nome
							 FROM
							 		pagamentos
							 WHERE
									pagamentos.id = vendas.forma_pg
							) as forma_pgto
					FROM 
							vendas
					LIMIT 
							$offset, $limit";
			$sql = $this->db->prepare($sql);
			$sql->execute();

			if($sql->rowCount() > 0){
				$array = $sql->fetchAll();
			}

			return $array;
		}

		public function getvenda($id_venda){

			$array = array();

			$sql = "SELECT
							 vendas.id,
							 vendas.valor,
							 vendas.status_pg,
							 vendas.endereco,
							 vendas.pg_link,
							(SELECT
									usuarios.nome
							 FROM
							 		usuarios
							 WHERE
									usuarios.id = vendas.id_usuario
							) as nome_cliente,
							(SELECT
									pagamentos.nome
							 FROM
							 		pagamentos
							 WHERE
									pagamentos.id = vendas.forma_pg
							) as forma_pgto
					FROM 
							vendas
					WHERE	id = :id_venda";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_venda", $id_venda);
			$sql->execute();

			if($sql->rowCount() > 0){
				$array = $sql->fetch();
			}

			return $array;
		}

		public function produtosDaVenda($id_venda){

			$array = array();

			$sql = "SELECT
							vendas_produtos.id_produto,
							vendas_produtos.quantidade
					FROM 
							vendas_produtos
					WHERE
							vendas_produtos.id_venda = :id_venda";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_venda", $id_venda);
			$sql->execute();

			if($sql->rowCount() > 0){
				$vendas_produtos = $sql->fetchAll();

				$produtos = new Produtos();
				foreach($vendas_produtos as $venda_produto){
					$produto = $produtos->getProduto($venda_produto['id_produto']);

					$array[] = array(
						'id' => $produto['id'],
						'quantidade' => $venda_produto['quantidade'],
						'nome' => $produto['nome'],
						'imagem' => $produto['imagem'],
						'preco' => $produto['preco']
					);
				}
			}

			return $array;			
		}	
	}
 ?>