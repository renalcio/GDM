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

    static public function Porcentagem($dataAte, $dataDe = ''){


        $hoje = self::Hoje("d/m/Y");
        $begin = !empty($dataDe) ? self::ToTime($dataDe) : 0;
        $now = self::ToTime($hoje);
        $end = self::ToTime($dataAte);

        $begin = $begin / (60*60*24); // EM DIAS
        $now = $now / (60*60*24); // EM DIAS
        $end = $end / (60*60*24); // EM DIAS


        $difTotal = $end - $begin;
        $difToday = $now - $begin;

        $percent = round(($difToday/$difTotal)*100,2);

        return $percent;
    }

    static public function Intervalo($dataDe, $dataAte){

        $begin = self::ToTime($dataDe);
        $end = self::ToTime($dataAte);

        $intervalo = $end - $begin;

        return $intervalo;
    }

    static public function IntervaloMeses($dataDe, $dataAte){
        return (self::Intervalo($dataDe, $dataAte) / (60*60*24*30));
    }

    static public function IntervaloDias($dataDe, $dataAte){
        return (self::Intervalo($dataDe, $dataAte) / (60*60*24));
    }

    static public function IntervaloHoras($dataDe, $dataAte){
        return (self::Intervalo($dataDe, $dataAte) / (60*60));
    }

    static public function IntervaloMinutos($dataDe, $dataAte){
        return (self::Intervalo($dataDe, $dataAte) / (60));
    }

    public static function Add($data, $valor, $tipo="horas", $formato="d/m/Y H:i:s"){

        $data = self::Formatar($data, "Y-m-d H:i:s");

        switch($tipo){
            case "horas":
                $type = "hours";
                break;
            case "minutos":
                $type = "minutes";
                break;
            case "segundos":
                $type = "seconds";
                break;
            case "dias":
                $type = "days";
                break;
            case "semanas":
                $type = "weeks";
                break;
            case "meses":
                $type = "months";
                break;
            case "anos":
                $type = "years";
                break;
            default:
                $type = $tipo;
                break;
        }
        return date($formato, strtotime("$data + $valor $type"));

    }

}