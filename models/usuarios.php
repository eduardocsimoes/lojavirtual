<?php 
	class Usuarios extends model{

		public function getUsuario($email){

			$id_usuario = 0;

			$sql = "SELECT id FROM usuarios WHERE email = :email";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":email", $email);
			$sql->execute();

			if($sql->rowCount() > 0){
				$id_usuario = $sql->fetch();
			}

			return $id_usuario['id'];
		}

		public function usuarioExiste($email){

			$sql = "SELECT * FROM usuarios WHERE email = :email";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":email", $email);
			$sql->execute();

			if($sql->rowCount() > 0){
				return true;
			}else{
				return false;
			}
		}

		public function verificarLogin($email, $senha){

			$sql = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":email", $email);
			$sql->bindValue(":senha", $senha);
			$sql->execute();

			if($sql->rowCount() > 0){
				return true;
			}else{
				return false;
			}
		}			

		public function criarUsuario($nome, $email, $senha){

			$sql = "INSERT INTO usuarios SET nome = :nome, email = :email, senha = :senha";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":nome", $nome);
			$sql->bindValue(":email", $email);
			$sql->bindValue(":senha", $senha);
			$sql->execute();

			return $this->db->lastInsertId();
		}
	}
 ?>