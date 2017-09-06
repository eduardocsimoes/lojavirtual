<?php 
	class loginController extends controller{

		public function index(){

			$dados = array();

			if(isset($_POST['usuario']) && !empty($_POST['usuario'])){

				$usuario = addslashes($_POST['usuario']);
				$senha = md5($_POST['senha']);

				$admin = new Admins();

				if($admin->usuarioExiste($usuario)){
					
					if($admin->verificarLogin($usuario, $senha)){
						$id_usuario = $admin->getUsuario($usuario);

						$_SESSION['lgadmin'] = $id_usuario;

						header("Location: ".BASE_URL);
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

			unset($_SESSION['lgadmin']);

			header("Location: ".BASE_URL."login");
		}
	}
?>