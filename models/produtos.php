<?php 
	class Produtos extends model{

		public function getProdutos($qtdProdutos = 0){

			$array = array();

			$sql = "SELECT * FROM produtos ORDER BY RAND()";
			if ($qtdProdutos > 0) {
				$sql .= " LIMIT ".$qtdProdutos;
			}

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

		public function getProdutosDaCategoria($id_categoria){

			$array = array();

			$sql = "SELECT * FROM produtos WHERE id_categoria = :id_categoria";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_categoria", $id_categoria);
			$sql->execute();

			if($sql->rowCount() > 0){
				$array = $sql->fetchAll();
			}

			return $array;			
		}

		public function produtosDoCarrinho($carrinho = array()){

			$array = array();

			if(is_array($carrinho) && count($carrinho) > 0){
				$sql = "SELECT * FROM produtos WHERE id IN (".implode(",", $carrinho).")";
				$sql = $this->db->prepare($sql);
				$sql->execute();

				if($sql->rowCount() > 0){
					$array = $sql->fetchAll();
				}
			}

			return $array;			
		}

		public function valorTotalProdutosDoCarrinho($carrinho = array()){

			$array = 0;

			if(is_array($carrinho) && count($carrinho) > 0){
				$sql = "SELECT SUM(preco) as valor_total FROM produtos WHERE id IN (".implode(",", $carrinho).")";
				$sql = $this->db->prepare($sql);
				$sql->execute();

				if($sql->rowCount() > 0){
					$array = $sql->fetch();
				}
			}

			return $array;	
		}
	}
 ?>