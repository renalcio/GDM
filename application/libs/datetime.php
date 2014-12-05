<?php
namespace Libs;
class Datetime
{
    static public function ToTime($Data){
        $retorno = "";
        if(strpos($Data, '-') !== false){
            $retorno = strtotime($Data);
        }else if(strpos($Data, "/") !== false){
            $Dia = explode("/", $Data)[0];
            $Mes = explode("/", $Data)[1];
            $Ano = explode("/", $Data)[2];

            $retorno = mktime(0,0,0,$Mes,$Dia,$Ano);
        }else {
            $retorno = $Data;
        }

        return $retorno;
    }

    static public function Formatar($Data, $Formato = "d/m/Y"){

        $retorno = Self::ToTime($Data);
        $retorno = date($Formato, $retorno);

        return $retorno;
    }

}