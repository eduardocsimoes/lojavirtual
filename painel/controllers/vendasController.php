<?php
	class vendasController extends controller {

		public function __construct() {
			$admin = new Admins();

			if ($admin->isLogged() == false) {
				header("Location: ".BASE_URL."login");
			}
		}

		public function index() {

			$dados = array(
				'vendas' => array()
			);

			$offset = 0; 
			$limit = 10;

			$vendas = new Vendas();
			$dados['vendas'] = $vendas->getVendas($offset, $limit);

			$this->loadTemplate('vendas', $dados);
		}

		public function ver($id_venda){

			if(!empty($id_venda)){
				$dados = array(
					'venda' => array(),
					'produtos' => array()
				);

				$vendas = new Vendas();

				$dados['venda'] = $vendas->getVenda($id_venda);			
				$dados['produtos'] = $vendas->produtosDaVenda($id_venda);
			}

			$this->loadTemplate('vendas_ver', $dados);
		}
	}
?>