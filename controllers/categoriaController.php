<?php 
	class categoriaController extends controller{

		public function ver($id_categoria){

			if(!empty($id_categoria)){
				$dados = array(
					"categoria" => '',
					'produtos' => array()
				);

				$id_categoria = addslashes($id_categoria);

				$categorias = new Categorias();
				$produtos = new Produtos();

				$dados['menu'] = $categorias->getCategorias();
				$dados['categoria'] = $categorias->getCategoria($id_categoria);
				$dados['produtos'] = $produtos->getProdutosDaCategoria($id_categoria);

				if(empty($dados['categoria'])){
					header("Location: ".BASE_URL);
				}

				$this->loadTemplate('categoria', $dados);
			}else{
				echo "id de categoria não existente!";
			}
		}
	}
 ?>