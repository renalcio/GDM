<?php
/**
 * Model
 * Titulo: Mensagens
 * Autor: renalcio.freitas
 * Data: 13/04/2015
 */
namespace BLL\Generic;
use BLL\BLL;
use DAL\Mensagem;
use DAL\MensagemPessoa;
use Libs\Database;
use Libs\Helper;
use Libs\Cookie;
use Libs\ModelState;
use Libs\Session;
use Libs\Usuario;
use Libs\Debug;
use Libs\UsuarioHelper;

class MensagemBLL extends BLL
{
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
        parent::__construct();
    }

    public function GetToEdit(MensagemPessoa $model)
    {
        if($model->MensagemPessoaId > 0)
        {
            $model = $this->unitofwork->GetById(new MensagemPessoa(), $model->MensagemPessoaId);
            if($model->MensagemPessoaId > 0){
                $model->Lida = 1;
                $model->DataLeitura = time();
                $this->unitofwork->Update($model);
            }
            $model = $this->unitofwork->GetById(new MensagemPessoa(), $model->MensagemPessoaId);
        }else{
            $model = new MensagemPessoa();
        }
        return $model;
    }

    public function GetToIndex($model)
    {
        $model->Lista = $this->unitofwork->Get(new Mensagem())->ToList();

        return $model;
    }

    public function Enviar(Mensagem $model){


        if($model!=null) {

            $model->PessoaId = UsuarioHelper::GetUsuarioPessoaId();
            $model->DataEnvio = time();
            $ArrPara = explode(",",$model->Para);
            $ArrCopia = explode(",",$model->Copia);
            $Encaminhamento = $model->Encaminhamento;
            $RespostaId = $model->RespostaId;

            $this->unitofwork->Insert($model);

            foreach($ArrPara as $x=>$para){
                if(!empty($para)) {
                    $clsRem = new MensagemPessoa();
                    $clsRem->MensagemId = $model->MensagemId;
                    $clsRem->PessoaId = $para;
                    $clsRem->Copia = 0;
                    $clsRem->Encaminhamento = $Encaminhamento;
                    $clsRem->RespostaId = ($Encaminhamento > 0) ? 0 : $RespostaId;

                    $this->unitofwork->Insert($clsRem);
                }
            }
            foreach($ArrCopia as $x=>$copia){
                if(!empty($copia)) {
                    $clsRem = new MensagemPessoa();
                    $clsRem->MensagemId = $model->MensagemId;
                    $clsRem->PessoaId = $copia;
                    $clsRem->Copia = 1;
                    $clsRem->Encaminhamento = $Encaminhamento;
                    $clsRem->RespostaId = ($Encaminhamento > 0) ? 0 : $RespostaId;

                    $this->unitofwork->Insert($clsRem);
                }
            }
        }
        return $model;
    }

    public function Deletar($id){
        if($id > 0){
            $obj = $this->unitofwork->GetById(new MensagemPessoa(), $id);
            $obj->Apagada = 1;
            $this->unitofwork->Update($obj);
        }
    }

    public function Validar(Mensagem $model)
    {

    }
}
