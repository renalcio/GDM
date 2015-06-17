<?php
/**
 * Model
 * Titulo: Matérias
 * Autor: renalcio.freitas
 * Data: 29/04/2015
 */
namespace Modules\ClassHub\BLL;
use Core\BLL;
use Model\ClassHub\Materia;
use Libs\Database;
use Libs\Helper;
use Libs\Cookie;
use Libs\ModelState;
use Libs\Session;
use Libs\Usuario;
use Libs\Debug;

class MateriaBLL extends BLL
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

    public function GetToEdit(Materia $model)
    {
        if($model->MateriaId > 0)
        {
            $model = $this->unitofwork->GetById(new Materia(), $model->MateriaId);
        }else{
            $model = new Materia();
        }
        return $model;
    }

    public function GetToIndex($model)
    {

        $model->Lista = $this->unitofwork->Get(new Materia())->ToList();

        return $model;
    }

    public function Save(Materia $model){

        if($model!=null) {

                if ($model->MateriaId > 0){

                    $this->unitofwork->Update($model);
                } else {
                    $this->unitofwork->Insert($model);
                }
        }
        return $model;
    }

    public function Deletar($id){
        if($id > 0){
            $this->unitofwork->Delete(new Materia(), $id);
        }
    }

    public function Validar(Materia $model)
    {

    }
}
