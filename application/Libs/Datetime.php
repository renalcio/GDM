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

    static public function Hoje($formato){
        return date($formato, time());
    }

    static public function Agora($formato){
        return date($formato, time());
    }

    static public function Porcentagem($dataDe, $dataAte){
        $hoje = self::Hoje("d/m/Y");
        $begin= self::ToTime($dataDe);
        $now = self::ToTime($hoje);
        $end = self::ToTime($dataAte);

        $percent = ($now-$begin) / ($end-$begin) * 100;

        return $percent;
    }

}