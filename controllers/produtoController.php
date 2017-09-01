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

				if(is_array($dados['produto']) && count($dados['produto'] > 0)){
					$this->loadTemplate('produto', $dados);	
				}else{
					header("Location: ".BASE_URL);
				}
			}else{
				echo "id do produto não existente!";
			}
		}
	}
 ?>