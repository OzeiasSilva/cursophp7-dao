<?php

// A classe Sql herda todas as funcionalidade da classe PDO
class Sql extends PDO{

    private $conn;

    //Metodo construtor para conectar automaticamente no banco de dados
    public function __construct(){

        $this->conn = new PDO("mysql:host=localhost;dbname=dbphp7", "root", "");

    }

    // Método onde recebe todos os paramentos passado pelo o usuario
    private function setParams($statement, $parameters = array()){

        foreach ($parameters as $key => $value) {
            
            $this->setParam($statement, $key, $value); // chama a função 'setParam que executa só uma linha'

        }

    }

    // Método para tratar só um dado
    private function setParam($statement, $key, $value){

        $statement->bindParam($key, $value);

    }


    // função para executação de comando no banco
    public function executeQuery($rawQuery, $params = array()){

        $stmt = $this->conn->prepare($rawQuery);

        $this->setParams($stmt, $params);

        $stmt->execute();

        return $stmt;

    }

    //Método para o select
    public function select($rawQuery, $params = array()):array{ // array = diz que a função retorna um array

        $stmt = $this->executeQuery($rawQuery, $params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC); // FETCH_ASSOC = para vim só os dados associativos
    }
}

?>