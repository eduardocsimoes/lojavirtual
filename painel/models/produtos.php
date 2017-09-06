<?php 
	class Produtos extends model{

		public function getProdutos($offset, $limit){

			$array = array();

			$sql = "SELECT
							 *,
							(SELECT
									categorias.titulo
							 FROM
							 		categorias
							 WHERE
									categorias.id = produtos.id_categoria
							) as titulo_categoria
					FROM 
							produtos
					LIMIT 
							$offset, $limit";
			$sql = $this->db->prepare($sql);
			$sql->execute();

			if($sql->rowCount() > 0){
				$array = $sql->fetchAll();
			}

			return $array;
		}

		public function getProduto($id_produto){

			$array = array();

			$sql = "SELECT * FROM produtos WHERE id = :id_produto";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_produto", $id_produto);
			$sql->execute();

			if($sql->rowCount() > 0){
				$array = $sql->fetch();
			}

			return $array;
		}

		public function getQuantidadeTotalProdutos(){

			$array['qtdTotal'] = 0;

			$sql = "SELECT COUNT(*) as qtdTotal FROM produtos";
			$sql = $this->db->prepare($sql);
			$sql->execute();

			if($sql->rowCount() > 0){
				$array = $sql->fetch();
			}

			return $array['qtdTotal'];			
		}

		public function addProdutos($nome, $descricao, $categoria, $preco, $quantidade, $imagem){

			$sql = "INSERT INTO produtos SET nome = :nome, descricao = :descricao, id_categoria = :categoria, preco = :preco, quantidade = :quantidade, imagem = :imagem";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":nome", $nome);
			$sql->bindValue(":descricao", $descricao);
			$sql->bindValue(":categoria", $categoria);
			$sql->bindValue(":preco", $preco);
			$sql->bindValue(":quantidade", $quantidade);
			$sql->bindValue(":imagem", $imagem);
			$sql->execute();				
		}

		public function editarProduto($id_produto, $nome, $descricao, $categoria, $preco, $quantidade){

			$sql = "UPDATE produtos SET nome = :nome, descricao = :descricao, id_categoria = :categoria, preco = :preco, quantidade = :quantidade WHERE id = :id_produto";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_produto", $id_produto);
			$sql->bindValue(":nome", $nome);
			$sql->bindValue(":descricao", $descricao);
			$sql->bindValue(":categoria", $categoria);
			$sql->bindValue(":preco", $preco);
			$sql->bindValue(":quantidade", $quantidade);
			$sql->execute();				
		}

		public function editarImagem($id_produto, $imagem){

			$sql = "UPDATE produtos SET imagem = :imagem WHERE id = :id_produto";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_produto", $id_produto);
			$sql->bindValue(":imagem", $imagem);
			$sql->execute();
		}

		public function excluirProdutos($id_produto){

			$sql = "SELECT imagem FROM produtos WHERE id = :id_produto";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_produto", $id_produto);
			$sql->execute();

			if($sql->rowCount() > 0){
				$imagem = $sql->fetch();
				$imagem = $imagem['imagem'];

				unlink("../assets/images/".$imagem);
			}			

			$sql = "DELETE FROM produtos WHERE id = :id_produto";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_produto", $id_produto);
			$sql->execute();		
		}
	}
?>