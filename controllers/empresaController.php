<?php 
	class empresaController extends controller{

		public function index(){

			$dados = array();

			$categorias = new Categorias();

			$dados['menu'] = $categorias->getCategorias();

			$this->loadTemplate('empresa', $dados);
		}
	}
 ?>