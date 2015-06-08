<?php
/**
 * Model
 * Titulo: Musica
 * Autor: renalcio.freitas
 * Data: 26/01/2015
 */
namespace Modules\MediaSpot\BLL;
use Core\BLL;
use Libs\Database;
use Model\MediaSpot\Musica;
use Libs\Helper;
use Libs\CookieHelper;
use Libs\ModelState;
use Libs\SessionHelper;
use Libs\UsuarioHelper;

class MusicaBLL extends BLL
{

    public function GetToEdit(Musica $model)
    {
        if($model->MusicaId > 0)
        {
            $model = $this->unitofwork->GetById(new Musica(), $model->MusicaId);
        }else{
            $model = new Musica();
        }
        return $model;
    }

    public function GetToIndex($model)
    {
        $model->Lista = array();

        return $model;
    }

    public function Save(Musica $model){

        if($model!=null) {

                if ($model->MusicaId > 0){
                    $this->unitofwork->Update($model);
                } else {
                    $this->unitofwork->Insert($model);
                }
        }
        return $model;
    }

    public function Deletar($id){
        if($id > 0){
            $this->unitofwork->Delete(new Musica(), "MusicaId = '".$id."'");
        }
    }

    public function Validar(Musica $model)
    {

    }
}
