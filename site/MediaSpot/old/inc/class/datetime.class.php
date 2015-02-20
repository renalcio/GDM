<?php

class DateTimeHelper
{

    public function IntervaloPorcentagem($dataInicial, $horasAdicionais, $casasDecimais=0)
    {
        $horaInicio = date("Y-m-d H:i:s", $dataInicial);
        $estimativa = explode(":", $horasAdicionais);
        $horaFinal = date( "Y-m-d H:i:s", strtotime("$horaInicio + $estimativa[0] hours + $estimativa[1] minutes" ));
        $timeInicio = strtotime($horaInicio);
        $timeFinal = strtotime($horaFinal);
        $timeAtual = time(); 
        //echo date( "Y-m-d H:i:s", strtotime("$date " ) );
        /*?><br /><br />
        Hora Incial: <?=$horaInicio?><br />
        Hora Final: <?=$horaFinal?><br />
        <br /><br />
        Time Inicio: <?=$timeInicio?><br />
        Time Final: <?=$timeFinal?><br />
        Time Atual: <?=$timeAtual?><br />
        
        Porcentagem: <br /><br />
        <?*/
        $intervalo = $timeFinal-$timeInicio;
        $executado = $timeFinal-time();
        $calculo = 100-(($executado/$intervalo)*100);
        return  round($calculo,$casasDecimais);
    }
    
    public function Invervalo($dataInicial, $dataFinal=""){
        if($dataFinal=="") $dataFinal = time();
        //$data_login = $tarefa["dataAbertura"];
        //$data_logout = time();
        $tempo_con = mktime(date('H', $dataFinal) - date('H', $dataInicial), date('i', $dataFinal) - date('i', $dataInicial), date('s', $dataFinal) - date('s', $dataInicial));
        return $tempo_con;
    }
    
    public function Add($data, $valor, $tipo="horas", $formato="d/m/Y H:i:s"){
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
    
    public function CalculaHoras($hora1, $hora2, $op="+"){
         $pos = strpos($hora2,":");
         if($pos!==false){
         $hora2 = explode(":",$hora2);
         $horas = $hora2[0];
         $minutos = $hora2[1];
         }else{
            $horas = $hora2;
            $minutos=0;
         }
         return date("H:i", strtotime("$hora1 $op $horas hours $op $minutos minutes"));
    }
    
}

?>