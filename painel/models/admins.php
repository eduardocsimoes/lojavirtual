<?php 
	class Admins extends model{

		public function isLogged(){

			if(isset($_SESSION['lgadmin']) && !empty($_SESSION['lgadmin'])){
				return true;
			}else{
				return false;
			}
		}

		public function getUsuario($nome_usuario){

			$id_usuario = 0;

			$sql = "SELECT id FROM admins WHERE usuario = :nome_usuario";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":nome_usuario", $nome_usuario);
			$sql->execute();

			if($sql->rowCount() > 0){
				$id_usuario = $sql->fetch();
			}

			return $id_usuario['id'];
		}

		public function usuarioExiste($nome_usuario){

			$sql = "SELECT * FROM admins WHERE usuario = :nome_usuario";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":nome_usuario", $nome_usuario);
			$sql->execute();

			if($sql->rowCount() > 0){
				return true;
			}else{
				return false;
			}
		}

		public function verificarLogin($nome_usuario, $senha){

			$sql = "SELECT * FROM admins WHERE usuario = :nome_usuario AND senha = :senha";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":nome_usuario", $nome_usuario);
			$sql->bindValue(":senha", $senha);
			$sql->execute();

			if($sql->rowCount() > 0){
				return true;
			}else{
				return false;
			}
		}		
	}
 ?>	