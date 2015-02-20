<?php

include_once ("mysql.class.php");
class Erro
{
    // Coloque aqui as Informações do Banco de Dados
    var $Codigo;
    var $Mensagem; #Tipo de dado requisitado

    public function __construct($Codigo, $Mensagem)
    {
        $this->Codigo = $Codigo;
        $this->Mensagem = htmlentities($Mensagem);
    }
    
    public function json(){
        return json_encode($this);
    }
}

?>