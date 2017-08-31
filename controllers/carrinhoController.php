<?php 
	class carrinhoController extends controller{

		public function index(){

			$dados = array();

			if(isset($_SESSION['carrinho'])){
				$carrinho = $_SESSION['carrinho'];
			}

			$categorias = new Categorias();
			$produtos = new Produtos();

			$dados['menu'] = $categorias->getCategorias();
			$dados['carrinho'] = $produtos->produtosDoCarrinho($carrinho);

			$this->loadTemplate('carrinho', $dados);
		}

		public function add($id_produto = ''){

			if(!empty($id_produto)){

				$id_produto = addslashes($id_produto);

				if(!isset($_SESSION['carrinho'])){
					$_SESSION['carrinho'] = array();
				}

				$_SESSION['carrinho'][] = $id_produto;

				header("Location: ".BASE_URL."carrinho");
			}
		}
	}
 ?>