<?php
	class categoriasController extends controller {

		public function __construct() {
			$admin = new Admins();

			if ($admin->isLogged() == false) {
				header("Location: ".BASE_URL."login");
			}
		}

		public function index() {

			$dados = array();

			$categorias = new Categorias();
			$dados['categorias'] = $categorias->getCategorias();

			$this->loadTemplate('categorias', $dados);
		}

		public function add() {

			$dados = array();

			if(isset($_POST['titulo']) && !empty($_POST['titulo'])){
				$titulo_categoria = addslashes($_POST['titulo']);
			
				$categorias = new Categorias();
				$categorias->addCategorias($titulo_categoria);

				header("Location: ".BASE_URL."categorias");
			}

			$this->loadTemplate('categorias_add', $dados);
		}

		public function editar($id_categoria){

			$dados = array();

			$categorias = new Categorias();

			$id_categoria = addslashes($id_categoria);

			if(isset($_POST['titulo']) && !empty($_POST['titulo'])){
				$titulo_categoria = addslashes($_POST['titulo']);
			
				$categorias->editarCategorias($id_categoria, $titulo_categoria);

				header("Location: ".BASE_URL."categorias");
			}

			$dados['categoria'] = $categorias->getCategoria($id_categoria);

			$this->loadTemplate('categorias_edit', $dados);
		}

		public function excluir($id_categoria){

			if(!empty($id_categoria)){
				$id_categoria = addslashes($id_categoria);

				$categorias = new Categorias();
				$categorias->excluirCategorias($id_categoria);

				header("Location: ".BASE_URL."categorias");
			}
		}
	}
?>