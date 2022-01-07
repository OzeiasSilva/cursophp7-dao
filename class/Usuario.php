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

		public function setDessenha($value){
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

				$this->setData($results[0]);
				
			}

		}

		// função para mostrar todos os usuários que estão na tabela
		public static function getList(){

			$sql = new Sql();

			return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin;");
		}

		// função para buscar um usuário na tabela
		public static function search($login){

			$sql = new Sql();

			return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
				':SEARCH'=>"%".$login."%"
			));

		}

		//função para trazer o dados se autenticados com login se senha
		public function login($login, $password){

			$sql = new Sql(); //criando uma instância da classe SQL

			$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
				":LOGIN"=>$login,
				":PASSWORD"=>$password
			));

			// Valida se o array tem mais de 0 registros
			if (count($results) > 0){

				$this->setData($results[0]);
				
			}else{

				throw new Exception("Login e/ou senha iválidos");
				
			}
		}


		//função para manipular dados
		public function setData($data){

			$this->setIdusuario($data['idusuario']);
			$this->setDeslogin($data['deslogin']);
			$this->setDessenha($data['dessenha']);
			$this->setDtcadastro(new DateTime ($data['dtcadastro'])); //new DateTime = instância uma classe datetime e trata os dados dentro dessa classe

		}

		// função para inserir dados no banco
		public function insert(){

			$sql = new Sql();

			$results = $sql->select("CALL  sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
				':LOGIN'=>$this->getDeslogin(),
				':PASSWORD'=>$this->getDessenha()
			));

			if(count($results) > 0){
				$this->setData($results[0]);
			}
		}

		//função para atualizar dados no banco
		public function apdate($login, $password){

			$this->setDeslogin($login);
			$this->setDessenha($password);

			// Comandos para verificar se os dados estão vindo do index.php
			//echo $this->getIdusuario();
			//echo $this->getDeslogin();
			//echo $this->getDessenha();

			$sql = new Sql();

			$sql->executeQuery("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
				':LOGIN'=>$this->getDeslogin(),
				':PASSWORD'=>$this->getDessenha(),
				':ID'=>$this->getIdusuario()
		));

		}

		//função para deletar dados no banco
		public function delete(){

			$sql = new Sql();

			$sql->executeQuery("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
				':ID'=>$this->getIdusuario()
			));

			$this->setIdusuario(0);
			$this->setDeslogin("");
			$this->setDessenha("");
			$this->setDtcadastro(new DateTime());
			
		}

		//métedo construtor para criar usuários no banco
		public function __construct($login = "", $password = ""){

			$this->setDeslogin($login);
			$this->setDessenha($password);

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