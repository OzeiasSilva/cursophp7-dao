<?php

	require_once("config.php");

	/*
	$sql = new Sql();

	$usuarios = $sql->select("SELECT * FROM tb_usuarios");

	echo json_encode($usuarios);
	*/

	// Carrega um usuário
	//$root = new Usuario();

	//$root->loadById(3);

	//echo $root;

	//Carrega todos os usuários
	//$lista = Usuario::getList();

	//echo json_encode($lista);

	//Carrega uma lista de usuários buscando pelo o login

	//$search = Usuario::search("s");
	//echo json_encode($search);

	//Carrega um usuário usando o login e senha
	//$usuario = new Usuario();
	//$usuario->login("ozeias", "1234567890");

	//echo $usuario;

	// Criando um novo usuário
	//$aluno = new Usuario("aluno", "@lun0");

	//$aluno->insert();

	//echo $aluno;

	//Atualizando usuário
	$usuario = new Usuario();

	$usuario->loadById(7);

	$usuario->apdate('professor','senha123');

	echo $usuario;




?>