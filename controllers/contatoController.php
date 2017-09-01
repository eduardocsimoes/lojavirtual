<?php 
	class contatoController extends controller{

		public function index(){

			$dados = array(
				"msg" => ''
			);

			$categorias = new Categorias();

			if(isset($_POST['nome']) && !empty($_POST['nome'])){
				$nome = addslashes($_POST['nome']);
				$email = addslashes($_POST['email']);
				$msg = addslashes($_POST['mensagem']);

				$html = "Nome: ".$nome."<br>E-mail: ".$email."<br>Mensagem: ".$msg;

				$headers = "From: eduardocsimoes81@gmail.com"."\r\n";
				$headers .= "Replay-To: ".$email."\r\n";
				$headers .= "X-Mailer: PHP/".phpversion();

				//mail("eduardocsimoes81@gmail.com", "Contato pelo site em ".date("d/m/Y"), $html, $headers);

				$dados['msg'] = "E-mail enviado com sucesso!";
			}

			$dados['menu'] = $categorias->getCategorias();

			$this->loadTemplate('contato', $dados);
		}
	}
 ?>