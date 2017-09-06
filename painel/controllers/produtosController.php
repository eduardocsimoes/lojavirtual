<?php
	class produtosController extends controller {

		public function __construct() {
			$admin = new Admins();

			if ($admin->isLogged() == false) {
				header("Location: ".BASE_URL."login");
			}
		}

		public function index() {

			$dados = array();

			$produtos = new Produtos();

			$offset = 0;
			$limit = 10;

			$dados['quantidade_produtos_pagina'] = $limit;
			$dados['quantidade_total_produtos'] = $produtos->getQuantidadeTotalProdutos();
			$dados['quantidade_paginas'] = ceil($dados['quantidade_total_produtos'] / $dados['quantidade_produtos_pagina']);

			if(isset($_GET['p']) && !empty($_GET['p'])){
				$pagina = addslashes($_GET['p']);

				if($pagina <= $dados['quantidade_paginas']){
					$offset = ($limit * $pagina) - $limit;
				}
			}

			$dados['produtos'] = $produtos->getProdutos($offset, $limit);

			$this->loadTemplate('produtos', $dados);
		}

		public function add() {

			$dados = array(
				'categorias' => array()
			);

			$categorias = new Categorias();
			$dados['categorias'] = $categorias->getCategorias();

			if(isset($_POST['nome']) && !empty($_POST['nome']) && isset($_FILES['imagem']) && !empty($_FILES['imagem']['tmp_name'])){
				$nome = addslashes($_POST['nome']);
				$descricao = addslashes($_POST['descricao']);
				$categoria = addslashes($_POST['categoria']);
				$preco = addslashes($_POST['preco']);
				$quantidade = addslashes($_POST['quantidade']);
				$imagem = $_FILES['imagem'];
				
				if(in_array($imagem['type'], array('image/jpeg','image/jpg', 'image/png'))){
					if($imagem['type'] == 'image/png'){
						$md5imagem = md5(time().rand(0,9999)).'.png';
					}else{
						$md5imagem = md5(time().rand(0,9999)).'.jpg';
					}
					
					move_uploaded_file($imagem['tmp_name'], '../assets/images/'.$md5imagem);

					$produtos = new Produtos();
					$produtos->addProdutos($nome, $descricao, $categoria, $preco, $quantidade, $md5imagem);
				}

				header("Location: ".BASE_URL."produtos");
			}

			$this->loadTemplate('produtos_add', $dados);
		}

		public function editar($id_produto) {

			$dados = array(
				'categorias' => array()
			);

			$categorias = new Categorias();
			$dados['categorias'] = $categorias->getCategorias();

			$produtos = new Produtos();

			$id_produto = addslashes($id_produto);
			$dados['produto'] = $produtos->getProduto($id_produto);

			if(isset($_POST['nome']) && !empty($_POST['nome'])){
				$nome = addslashes($_POST['nome']);
				$descricao = addslashes($_POST['descricao']);
				$categoria = addslashes($_POST['categoria']);
				$preco = addslashes($_POST['preco']);
				$quantidade = addslashes($_POST['quantidade']);

				$produtos->editarProduto($id_produto, $nome, $descricao, $categoria, $preco, $quantidade);

				if(isset($_FILES['imagem']) && !empty($_FILES['imagem']['tmp_name'])){

					$imagem = $_FILES['imagem'];
					
					if(in_array($imagem['type'], array('image/jpeg','image/jpg', 'image/png'))){
						if($imagem['type'] == 'image/png'){
							$md5imagem = md5(time().rand(0,9999)).'.png';
						}else{
							$md5imagem = md5(time().rand(0,9999)).'.jpg';
						}
						
						move_uploaded_file($imagem['tmp_name'], '../assets/images/'.$md5imagem);

						$produtos->editarImagem($id_produto, $md5imagem);
					}
				}

				header("Location: ".BASE_URL."produtos");
			}

			$this->loadTemplate('produtos_edit', $dados);
		}

		public function excluir($id_produto){

			if(!empty($id_produto)){
				$id_produto = addslashes($id_produto);

				$produtos = new Produtos();
				$produtos->excluirProdutos($id_produto);

				header("Location: ".BASE_URL."produtos");
			}
		}
	}
?>