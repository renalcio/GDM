<?php
/**
 * Model
 * Titulo: Turmas
 * Autor: renalcio.freitas
 * Data: 23/04/2015
 */
namespace Modules\ClassHub\BLL;
use Core\BLL;
use Model\ClassHub\Turma;
use Libs\Database;
use Libs\Helper;
use Libs\Cookie;
use Libs\ModelState;
use Libs\Session;
use Libs\Usuario;
use Libs\Debug;

class TurmaBLL extends BLL
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

    public function GetToEdit(Turma $model)
    {
        if($model->TurmaId > 0)
        {
            $model = $this->unitofwork->GetById(new Turma(), $model->TurmaId);
        }else{
            $model = new Turma();
        }
        return $model;
    }

    public function GetToIndex($model)
    {

        $model->Lista = $this->unitofwork->Get(new Turma())->ToList();

        return $model;
    }

    public function Save(Turma $model){

        if($model!=null) {

                if ($model->TurmaId > 0){

                    $this->unitofwork->Update($model);
                } else {
                    $this->unitofwork->Insert($model);
                }
        }
        return $model;
    }

    public function Deletar($id){
        if($id > 0){
            $this->unitofwork->Delete(new Turma(), $id);
        }
    }

    public function Validar(Turma $model)
    {

    }
}