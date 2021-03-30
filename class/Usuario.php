<?php

	class Usuario{

		private $idusuario;
		private $deslogin;
		private $dessenha;
		private $dtcadastro;

		public function getIdusuario(){
			return $this->idusuario;
		}

		public function setIdusuario($value){
			$this->idusuario = $value;
		}

		public function getDeslogin(){
			return $this->deslogin;
		}

		public function setDeslogin($value){
			$this->deslogin = $value;
		}

		public function getDessenha(){
			return $this->dessenha;
		}

		public function setuDessenha($value){
			$this->dessenha = $value;
		}

		public function getDtcadastro(){
			return $this->dtcadastro;
		}

		public function setDtcadastro($value){
			$this->dtcadastro = $value;
		}

		// função para carregar as informações do banco de dados
		public function loadById($id){

			$sql = new Sql(); //criando uma instância da classe SQL

			$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
				":ID"=>$id
			));

			// Valida se o array tem mais de 0 registros
			if (count($results) > 0){

				$row = $results[0];

				$this->setIdusuario($row['idusuario']);
				$this->setDeslogin($row['deslogin']);
				$this->setuDessenha($row['dessenha']);
				$this->setDtcadastro(new DateTime ($row['dtcadastro'])); //new DateTime = instância uma classe datetime e trata os dados dentro dessa classe
				
			}

		}

		// função para mostrar os dados 
		public function __toString(){

			// coloca todos os dados dentro de um JSON
			return json_encode(array(
				"idusuario"=>$this->getIdusuario(),
				"deslogin"=>$this->getDeslogin(),
				"dessenha"=>$this->getDessenha(),
				"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")// forma o dado para dia, mes, ano, hora, minuto e segundo
			));
		}


	}

?>