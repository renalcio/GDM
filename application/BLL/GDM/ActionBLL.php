<?php
/**
 * Model
 * Titulo: Actions
 * Autor: Renalcio
 * Data: 18/03/2015
 */
namespace BLL;
use DAL\Action;
use Libs\Database;
use Libs\Helper;
use Libs\Cookie;
use Libs\ModelState;
use Libs\Session;
use Libs\Usuario;
use Libs\Debug;

class ActionBLL extends BLL
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

    public function GetToEdit(Action $model)
    {
        if($model->ActionId > 0)
        {
            $model = $this->unitofwork->GetById(new Action(), $model->ActionId);
        }else{
            $model = new Action();
        }
        return $model;
    }

    public function GetToIndex($model)
    {

        $model->Lista = $this->unitofwork->Get(new Action())->ToList();

        return $model;
    }

    public function Save(Action $model){

        if($model!=null) {

                if ($model->ActionId > 0){

                    $this->unitofwork->Update($model);
                } else {
                    $this->unitofwork->Insert($model);
                }
        }
        return $model;
    }

    public function Deletar($id){
        if($id > 0){
            $this->unitofwork->Delete(new Action(), $id);
        }
    }

    public function Validar(Action $model)
    {

    }
}
