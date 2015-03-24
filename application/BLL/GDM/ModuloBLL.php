<?php
/**
 * Model
 * Titulo: Modulos
 * Autor: renalcio.freitas
 * Data: 18/03/2015
 */
namespace BLL;
use DAL\Modulo;
use Libs\Database;
use Libs\Helper;
use Libs\Cookie;
use Libs\ModelState;
use Libs\Session;
use Libs\Usuario;
use Libs\Debug;

class ModuloBLL extends BLL
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

    public function GetToEdit(Modulo $model)
    {
        if($model->ModuloId > 0)
        {
            $model = $this->unitofwork->GetById(new Modulo(), $model->ModuloId);
        }else{
            $model = new Modulo();
        }


        return $model;
    }

    public function GetToIndex($model)
    {

        $model->Lista = $this->unitofwork->Get(new Modulo())->ToList();

        return $model;
    }

    public function Save(Modulo $model){

        if($model!=null) {

                if ($model->ModuloId > 0){

                    $this->unitofwork->Update($model);
                } else {
                    $this->unitofwork->Insert($model);
                }
        }
        return $model;
    }

    public function Deletar($id){
        if($id > 0){
            $this->unitofwork->Delete(new Modulo, $id);
        }
    }

    public function Validar(Modulo $model)
    {

    }
}
