<?
/**
 * Model
 * Titulo: Artista
 * Autor: renalcio.freitas
 * Data: 26/01/2015
 */
namespace BLL\MediaSpot;
use Core\BLL;
use DAL\MediaSpot\Musica;
use Libs\ArrayHelper;
use Libs\Database;
use DAL\MediaSpot\Artista;
use Libs\Helper;
use Libs\CookieHelper;
use Libs\ModelState;
use Libs\SessionHelper;
use Libs\UnitofWork;
use Libs\UsuarioHelper;
use Libs\Debug;

class ArtistaBLL extends BLL
{
    public function GetToEdit(Artista $model)
    {
        if($model->ArtistaId > 0)
        {
            $model = $this->unitofwork->GetById(new Artista(), $model->ArtistaId);
        }else{
            $model = new Artista();
        }
        return $model;
    }

    public function GetToIndex($model)
    {

        $model->Lista = $this->unitofwork->Get(new Artista())->ToArray();

        return $model;
    }

    public function Save(Artista $model){

        if($model!=null) {
            $this->md5 = md5(strtolower($this->Titulo));

            if(empty($this->AplicacaoId))
                $this->AplicacaoId = APPID;

            if ($model->ArtistaId > 0){
                $this->unitofwork->Update($model);
            } else {
                $this->unitofwork->Insert($model);
            }
        }
        return $model;
    }

    public function Deletar($id){
        echo $id;
        if($id > 0){
            //Apaga Musicas
            $this->unitofwork->Delete(new Musica(), "ArtistaId = '".$id."'", 0);
            //Apaga item principal
            $this->unitofwork->Delete(new Artista(), "ArtistaId = '".$id."'");
        }
    }

    public function Validar(Artista $model)
    {

    }
}
