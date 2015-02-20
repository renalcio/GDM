<?php

include_once ("mysql.class.php");
class Cliente
{
    // Coloque aqui as Informações do Banco de Dados
    var $id;
    var $dado; #Tipo de dado requisitado
    var $valor; # Valor a ser retornado

    public function definirId($id)
    {
        $this->id = $id;
    }

    function dado($campo)
    {
        $mysqlf = new MysqlHelper;
        $this->dado = $campo;
        $sqlmy = $mysqlf->query("select * from cliente where id='{$this->id}'");
        $my = $mysqlf->associar($sqlmy);
        $this->valor = $my[$this->dado];
        return $this->valor;
    }

    function bloquearArea($cargo)
    {
        $level = $this->dado("cargo");
        if ($level < $cargo)
        {
            return true;
        } else
        {
            return false;
        }
    }
}

?>