<?php
/**
 * Handler
 * Titulo: Calendario
 * Autor: TANDA
 * Data: 19/06/2015
 */
namespace Controllers\Handlers;
use Core\Controller;
use Libs\AlunoHelper;
use Libs\Database;
use Libs\Datetime;
use Libs\Helper;
use Model\ClassHub\Avaliacao;

class CalendarioHandler extends Controller
{
    function GetAll($TurmaId = 0){
        header('Content-Type: application/json; Charset=UTF-8');
        if(empty($TurmaId))
            $TurmaId = AlunoHelper::GetUsuarioAluno()->TurmaId;

        $AlunoId = AlunoHelper::GetUsuarioAluno()->AlunoId;

        $retorno = Array();

        //Provas e Trabalhos
        $ListAvaliacao = $this->unitofwork->Get(new Avaliacao(), "TurmaId = '".$TurmaId."' AND (Compartilhado = 1 OR
        AlunoId = '".$AlunoId."')")->ToArray();

        //var_dump($ListAvaliacao);

        foreach($ListAvaliacao as $k => $valor){

            $ItemAdd = new \stdClass();
            $ItemAdd->id = $valor->AvaliacaoId;
            $ItemAdd->title = $valor->Titulo;
            $ItemAdd->allDay = false;
            $ItemAdd->start = Datetime::Formatar($valor->Data, "Y-m-d")." ".$valor->HoraInicio;
            $ItemAdd->end = Datetime::Formatar($valor->Data, "Y-m-d")." ".$valor->HoraFim;
            //$ItemAdd->url = $valor->Titulo;
            if($valor->Trabalho > 0){
                $ItemAdd->backgroundColor = "#f39c12";
                $ItemAdd->borderColor = "#f39c12";
            }else {
                $ItemAdd->backgroundColor = "#f56954";
                $ItemAdd->borderColor = "#f56954";
            }

            $retorno[] = $ItemAdd;
        }

        echo json_encode($retorno);

    }

    function UpdateEvent($event){
        var_dump($event);
        $avaliacao = new Avaliacao();
        $avaliacao = $this->unitofwork->GetById(new Avaliacao(), $event["id"]);

        if(!empty($avaliacao) && isset($avaliacao->AvaliacaoId) && !empty($avaliacao->AvaliacaoId)){
            $avaliacao->Data = Datetime::Formatar($event["start"], "d/m/Y");
            $avaliacao->HoraInicio = Datetime::Formatar($event["start"], "H:i");
            $avaliacao->HoraFim = Datetime::Formatar($event["end"], "H:i");

            var_dump($avaliacao);


            $this->unitofwork->Update($avaliacao);
        }
    }
}