<?php
/**
 * Model
 * Titulo: Vinculos de Materias
 * Autor: renalcio.freitas
 * Data: 30/04/2015
 */
namespace Modules\ClassHub\BLL;
use Core\BLL;
use DAL\ClassHub\MateriaCurso;
use Libs\Database;
use Libs\Helper;
use Libs\Cookie;
use Libs\ListHelper;
use Libs\ModelState;
use Libs\Session;
use Libs\Usuario;
use Libs\Debug;

class MateriaCursoBLL extends BLL
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

    public function GetToEdit(\stdClass $model)
    {
        if($model->Materia->MateriaId > 0)
        {
            $model->Materia = $this->unitofwork->GetById(new Materia(), $model->MateriaId);
            $model->Lista = $this->unitofwork->Get(new MateriaCurso(), "MateriaId = '".$model->MateriaId."'")->ToList();
        }else{
            $model->Materia = new Materia();
            $model->Lista = new ListHelper();
        }
        return $model;
    }

    public function GetToIndex($model)
    {

        $model->Lista = $this->unitofwork->Get(new MateriaCurso())->ToList();

        return $model;
    }

    public function Save(MateriaCurso $model){

        if($model!=null) {

                if ($model->MateriaCursoId > 0){

                    $this->unitofwork->Update($model);
                } else {
                    $this->unitofwork->Insert($model);
                }
        }
        return $model;
    }

    public function Deletar($id){
        if($id > 0){
            $this->unitofwork->Delete(new MateriaCurso(), $id);
        }
    }

    public function Validar(MateriaCurso $model)
    {

    }
}
