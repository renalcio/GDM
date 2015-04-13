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
use Libs\Database;
use Libs\Helper;
use Libs\Cookie;
use Libs\ModelState;
use Libs\Session;
use Libs\Usuario;
use Libs\Debug;

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

    public function GetToEdit(Mensagem $model)
    {
        if($model->MensagemId > 0)
        {
            $model = $this->unitofwork->GetById(new Mensagem(), $model->MensagemId);
        }else{
            $model = new Mensagem();
        }
        return $model;
    }

    public function GetToIndex($model)
    {

        $model->Lista = $this->unitofwork->Get(new Mensagem())->ToList();

        return $model;
    }

    public function Save(Mensagem $model){

        if($model!=null) {

                if ($model->MensagemId > 0){

                    $this->unitofwork->Update($model);
                } else {
                    $this->unitofwork->Insert($model);
                }
        }
        return $model;
    }

    public function Deletar($id){
        if($id > 0){
            $this->unitofwork->Delete(new Mensagem(), $id);
        }
    }

    public function Validar(Mensagem $model)
    {

    }
}
