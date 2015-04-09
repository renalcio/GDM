<?php
/**
 * Model
 * Titulo: Notificações
 * Autor: renalcio.freitas
 * Data: 09/04/2015
 */
namespace BLL\Generic;
use BLL\BLL;
use DAL\Notificacao;
use Libs\Database;
use Libs\Helper;
use Libs\Cookie;
use Libs\ModelState;
use Libs\Session;
use Libs\Usuario;
use Libs\Debug;

class NotificacaoBLL extends BLL
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

    public function GetToEdit(Notificacao $model)
    {
        if($model->NotificacaoId > 0)
        {
            $model = $this->unitofwork->GetById(new Notificacao(), $model->NotificacaoId);
        }else{
            $model = new Notificacao();
        }
        return $model;
    }

    public function GetToIndex($model)
    {

        $model->Lista = $this->unitofwork->Get(new Notificacao())->ToList();

        return $model;
    }

    public function Save(Notificacao $model){

        if($model!=null) {

                if ($model->NotificacaoId > 0){

                    $this->unitofwork->Update($model);
                } else {
                    $this->unitofwork->Insert($model);
                }
        }
        return $model;
    }

    public function Deletar($id){
        if($id > 0){
            $this->unitofwork->Delete(new Notificacao(), $id);
        }
    }

    public function Validar(Notificacao $model)
    {

    }
}
