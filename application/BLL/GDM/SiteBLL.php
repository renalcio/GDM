<?php
/**
 * Model
 * Titulo: Site de Aplicação
 * Autor: renalcio.freitas
 * Data: 22/01/2015
 */
namespace BLL\GDM;
use BLL\BLL;
use Libs\Database;
use DAL\Site;
use Libs\Helper;
use Libs\CookieHelper;
use Libs\ModelState;
use Libs\SessionHelper;
use Libs\UsuarioHelper;
use Libs\Debug;

class SiteBLL extends BLL
{

    public function GetToEdit(Site $model)
    {
        if($model->SiteId > 0)
        {
            $model = $this->unitofwork->GetById(new Site(), $model->SiteId);
        }else{
            $model = new Site();
        }
        return $model;
    }

    public function GetToIndex($model)
    {

        $model->Lista = $this->unitofwork->Get(new Site())->ToArray();
        return $model;
    }

    public function Save(Site $model){

        if($model!=null) {
            
                if ($model->SiteId > 0){
                    $this->unitofwork->Update($model);
                } else {
                    $this->unitofwork->Insert($model);
                }
        }
        return $model;
    }

    public function Deletar($id){
        if($id > 0){
            $this->unitofwork->Delete(new Site(), $id);
        }
    }

    public function Validar(Site $model)
    {

    }
}
