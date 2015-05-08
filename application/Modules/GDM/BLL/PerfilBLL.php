<?php
namespace Modules\GDM\BLL;
use Core\BLL;
use BLL\Generic\MenuBLL;
use Libs\Database;
use DAL\Perfil;
use Libs\Helper;
class PerfilBLL extends BLL
{

    public function GetToEdit($Model)
    {
        if($Model->PerfilId > 0)
        {
            $Model = $this->unitofwork->GetById(new Perfil(), $Model->PerfilId);
        }else{
            $Model = new Perfil();
        }
        return $Model;
    }

    public function GetToIndex($Model)
    {

        $Model = $this->unitofwork->Get(new Perfil(), "AplicacaoId = ".APPID." OR ".APPID." = ".ROOTAPP)->ToArray();
        return $Model;
    }

    public function Save($model){
        if($model!=null) {
            $model = (object)$model;
            Helper::cast($model, "DAL\\Perfil");

            if($model->PerfilId > 0)
                $this->unitofwork->Update($model);
            else {
                $model->Ativo = 1;
                $this->unitofwork->Insert($model);
            }
        }
        return $model;
    }

    public function Acesso($model){
        if($model->PerfilId > 0) {
            $model = $this->unitofwork->GetById(new Perfil(), $model->PerfilId);

            //Menu
            $menumodel = new \Modules\Generic\BLL\MenuBLL();

            $model->Menu = $menumodel->GetMenu(0, $model->AplicacaoId);
        }
        return $model;
    }

    public function Deletar($id){
        if($id > 0){
            $this->unitofwork->Delete(new Perfil(), $id);
        }
    }
}
