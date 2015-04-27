<?php
namespace BLL\GDM;
use Core\BLL;
use DAL\Nicho;
use Libs\Database;
use Libs\Helper;
use Libs\UnitofWork;

class NichoBLL extends BLL
{
    public function GetToEdit($Model)
    {
        if($Model->NichoId > 0)
        {
            $Model = $this->unitofwork->GetById(new Nicho(), $Model->NichoId);
        }
        return $Model;
    }

    public function GetToIndex($Model)
    {

        $Model = $this->unitofwork->Get(new Nicho())->ToArray();

        return $Model;
    }
    public function Save($model){
        if($model!=null) {
            $model = (object)$model;
            Helper::cast($model, "DAL\\Nicho");


            /* print_r($model);
             print_r($PessoaFisica);
             print_r($PessoaJuridica);*/

            if($model->NichoId > 0)
                $this->unitofwork->Update($model);
            else
                $this->unitofwork->Insert($model);

        }
    }

    public function Deletar($id){
        if($id > 0){
            $this->unitofwork->Delete(new Nicho(), $id);
        }
    }
}
