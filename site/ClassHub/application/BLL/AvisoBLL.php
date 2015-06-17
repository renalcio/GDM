<?php
/**
 * Model
 * Titulo: Avisos
 * Autor: TANDA
 * Data: 15/06/2015
 */
namespace Modules\ClassHub\BLL;
use Core\BLL;
use Libs\Database;
use Libs\Helper;
use Libs\Cookie;
use Libs\ModelState;
use Libs\Session;
use Libs\Usuario;
use Libs\Debug;
use Model\ClassHub\Aviso;

class AvisoBLL extends BLL
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

    public function GetToEdit(Aviso $model)
    {
        if($model->AvisoId > 0)
        {
            $model = $this->unitofwork->GetById(new Aviso(), $model->AvisoId);
        }else{
            $model = new Aviso();
        }
        return $model;
    }

    public function GetToIndex($model)
    {

        $model->Lista = $this->unitofwork->Get(new Aviso())->ToList();

        return $model;
    }

    public function Save(Aviso $model){

        if($model!=null) {

            if(!empty($model->txDataDe)){
                $arrDataDe = explode("/", $model->txDataDe);
                $model->DataDe = mktime(0, 0, 0, $arrDataDe[1], $arrDataDe[0], $arrDataDe[2]);
            }

            if(!empty($model->txDataAte)){
                $arrDataAte = explode("/", $model->txDataAte);
                $model->DataAte = mktime(0, 0, 0, $arrDataAte[1], $arrDataAte[0], $arrDataAte[2]);
            }

                if ($model->AvisoId > 0){
                    $this->unitofwork->Update($model);
                } else {
                    $this->unitofwork->Insert($model);
                }
        }
        return $model;
    }

    public function Deletar($id){
        if($id > 0){
            $this->unitofwork->Delete(new Aviso(), $id);
        }
    }

    public function Validar(Aviso $model)
    {

    }
}
