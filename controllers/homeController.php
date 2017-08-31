<?php 
	class homeController extends controller{

		public function index(){

			$dados = array();

			$categorias = new Categorias();
			$produtos = new Produtos();

			$dados['menu'] = $categorias->getCategorias();
			$dados['produtos'] = $produtos->getProdutos(8);

			$this->loadTemplate('home', $dados);
		}
	}
 ?>