<?php
use Classe\Database;
function GetAll()
{
    header('Content-Type: application/json; Charset=UTF-8');
    $pdo = new Database();
    $retorno = $pdo->select("SELECT * FROM Pais");

    $retorno = json_encode($retorno);

    echo $retorno;
}

function FixName(){
    $pdo = new Database();
    $retorno = $pdo->select("SELECT * FROM Pais");
    foreach($retorno as $pais){
        $pais->Nome = ucfirst(mb_strtolower($pais->Nome, "UTF-8"));
        $pais->Name = ucfirst(mb_strtolower($pais->Name, "UTF-8"));
        $pdo->update("Pais",(Array)$pais,"PaisId = '".$pais->PaisId."'");
    }
    $retorno = $pdo->select("SELECT * FROM Pais");
    $retorno = json_encode($retorno);

    echo $retorno;
}