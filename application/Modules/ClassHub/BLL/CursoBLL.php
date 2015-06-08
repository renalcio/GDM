<?php
/**
 * Model
 * Titulo: Cursos
 * Autor: renalcio.freitas
 * Data: 23/04/2015
 */
namespace Modules\ClassHub\BLL;
use Core\BLL;
use Model\ClassHub\Curso;
use Libs\Database;
use Libs\Helper;
use Libs\Cookie;
use Libs\ModelState;
use Libs\Session;
use Libs\Usuario;
use Libs\Debug;

class CursoBLL extends BLL
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

    public function GetToEdit(Curso $model)
    {
        if($model->CursoId > 0)
        {
            $model = $this->unitofwork->GetById(new Curso(), $model->CursoId);
        }else{
            $model = new Curso();
        }
        return $model;
    }

    public function GetToIndex($model)
    {

        $model->Lista = $this->unitofwork->Get(new Curso())->ToList();

        return $model;
    }

    public function Save(Curso $model){

        if($model!=null) {

                if ($model->CursoId > 0){

                    $this->unitofwork->Update($model);
                } else {
                    $this->unitofwork->Insert($model);
                }
        }
        return $model;
    }

    public function Deletar($id){
        if($id > 0){
            $this->unitofwork->Delete(new Curso(), $id);
        }
    }

    public function Validar(Curso $model)
    {

    }
}
