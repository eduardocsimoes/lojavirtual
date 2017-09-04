<?php 
	class loginController extends controller{

		public function index(){

			$dados = array();

			$categorias = new Categorias();
			$dados['menu'] = $categorias->getCategorias();

			if(isset($_POST['email']) && !empty($_POST['email'])){
				$email = addslashes($_POST['email']);
				$senha = md5($_POST['senha']);

				$usuario = new Usuarios();

				if($usuario->usuarioExiste($email)){
					if($usuario->verificarLogin($email, $senha)){
						$id_usuario = $usuario->getUsuario($email);

						$_SESSION['lgcliente'] = $id_usuario;

						header("Location: ".BASE_URL."pedidos");
					}else{ 
						echo $dados['erro'] = "Usuário e/ou senha inválidos!";
					}
				}else{
					echo $dados['erro'] = "Usuário não cadastrado!";
				}
			}

			$this->loadTemplate('login', $dados);
		}

		public function logout(){

			unset($_SESSION['lgcliente']);

			header("Location: ".BASE_URL."login");
		}
	}
?>