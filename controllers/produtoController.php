<?php 
	class produtoController extends controller{

		public function ver($id_produto){

			if(!empty($id_produto)){
				$dados = array(
					'produtos' => array()
				);

				$id_produto = addslashes($id_produto);

				$categorias = new Categorias();
				$produtos = new Produtos();

				$dados['menu'] = $categorias->getCategorias();
				$dados['produto'] = $produtos->getProduto($id_produto);

				if(empty($dados['produto'])){
					header("Location: ".BASE_URL);
				}

				$this->loadTemplate('produto', $dados);
			}else{
				echo "id do produto não existente!";
			}
		}
	}
 ?>