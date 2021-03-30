<?php

// função de autoload 
spl_autoload_register(function($class_name){

    /* verifica se existe algum arquivo
    * "class". DIRECTORY_SEPARATOR = usado para colocar "\" automaticamente
    */
    //$filename = "class". DIRECTORY_SEPARATOR.$class_name.".php";
    $filename = "class".DIRECTORY_SEPARATOR.$class_name.".php";
    
    if(file_exists(($filename))){
        // se o arquivo existir faz um require dele
        require_once($filename);
    }
});

?>