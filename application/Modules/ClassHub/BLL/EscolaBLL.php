<?php
/**
 * Model
 * Titulo: Escolas
 * Autor: renalcio.freitas
 * Data: 23/04/2015
 */
namespace Modules\ClassHub\BLL;
use Core\BLL;
use DAL\ClassHub\Escola;
use Libs\Database;
use Libs\Helper;
use Libs\Cookie;
use Libs\ModelState;
use Libs\Session;
use Libs\Usuario;
use Libs\Debug;

class EscolaBLL extends BLL
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

    public function GetToEdit(Escola $model)
    {
        if($model->EscolaId > 0)
        {
            $model = $this->unitofwork->GetById(new Escola(), $model->EscolaId);
        }else{
            $model = new Escola();
        }
        return $model;
    }

    public function GetToIndex($model)
    {

        $model->Lista = $this->unitofwork->Get(new Escola())->ToList();

        return $model;
    }

    public function Save(Escola $model){

        if($model!=null) {

                if ($model->EscolaId > 0){

                    $this->unitofwork->Update($model);
                } else {
                    $this->unitofwork->Insert($model);
                }
        }
        return $model;
    }

    public function Deletar($id){
        if($id > 0){
            $this->unitofwork->Delete(new Escola(), $id);
        }
    }

    public function Validar(Escola $model)
    {

    }
}
