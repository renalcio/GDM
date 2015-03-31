<?php
/**
 * Model
 * Titulo: Modulos
 * Autor: renalcio.freitas
 * Data: 18/03/2015
 */
namespace BLL;
use DAL\Action;
use DAL\ActionModulo;
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

        $model->ListAction = $this->unitofwork->Get(new Action())->ToList();

        $model->ListActionModulo = $this->unitofwork->Get(new ActionModulo(), "ModuloId = ".$model->ModuloId)->ToList();


        return $model;
    }

    public function GetToIndex($model)
    {

        $model->Lista = $this->unitofwork->Get(new Modulo())->ToList();

        return $model;
    }

    public function Save(Modulo $model){

        //var_dump($model);
        if($model!=null) {

            $Actions = $model->Actions;
                if ($model->ModuloId > 0){
                    $this->unitofwork->Update($model);
                } else {
                    $this->unitofwork->Insert($model);
                }

            if(!empty($Actions) && is_array($Actions)){
                foreach($Actions as $i=>$item) {
                    if(isset($item->Check) && $item->Check > 0){
                        //Checkado
                        $save = new ActionModulo();
                        $save->ActionModuloId = (isset($item->ActionModuloId) ? $item->ActionModuloId : 0);
                        $save->ActionId = $item->ActionId;
                        $save->Publico = $item->Publico;
                        $save->ModuloId = $model->ModuloId;


                        if($save->ActionModuloId > 0){
                            $this->unitofwork->Update($save);
                        }else{
                            $this->unitofwork->Insert($save);
                        }

                    }else{
                        if(isset($item->ActionModuloId) &&$item->ActionModuloId > 0){
                            //Exclui Vinculo Atual
                            $this->unitofwork->Delete(new ActionModulo(), $item->ActionModuloId);
                        }
                    }
                }
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
