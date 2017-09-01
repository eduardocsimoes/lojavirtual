<?php 
	class Pagamentos extends model{

		public function getPagamentos(){

			$array = array();

			$sql = "SELECT * FROM pagamentos";
			$sql = $this->db->prepare($sql);
			$sql->execute();

			if($sql->rowCount() > 0){
				$array = $sql->fetchAll();
			}

			return $array;
		}

		public function getCategoria($id_pagamento){

			$array = array();

			$sql = "SELECT * FROM pagamentos WHERE id = :id_pagamento";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_pagamento", $id_categoria);
			$sql->execute();

			if($sql->rowCount() > 0){
				$array = $sql->fetch();
			}

			return $array;
		}
	}
 ?>