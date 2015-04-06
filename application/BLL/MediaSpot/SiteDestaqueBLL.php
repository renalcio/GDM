<?php
/**
 * Model
 * Titulo: Destaques do Site (MediaSpot)
 * Autor: renalcio.freitas
 * Data: 02/02/2015
 */
namespace BLL\MediaSpot;
use DAL\MediaSpot\Artista;
use DAL\Site;
use Libs\Database;
use Libs\Helper;
use Libs\Cookie;
use Libs\ListHelper;
use Libs\ModelState;
use Libs\Session;
use Libs\Usuario;
use Libs\Debug;
use DAL\MediaSpot\SiteDestaque;
use Libs\UsuarioHelper;

class SiteDestaqueBLL extends BLL
{
    /**
     * @param object $db A PDO database connection
     */
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
        $this->pdo = new Database;
    }

    public function GetToEdit(SiteDestaque $model)
    {
        if($model->SiteDestaqueId > 0)
        {
            $model = $this->unitofwork->GetById(new SiteDestaque(), $model->SiteDestaqueId);
        }else{
            $model = new SiteDestaque();
        }
        return $model;
    }

    public function GetToIndex($model)
    {

        $model->Lista = $this->unitofwork->Get(new SiteDestaque())->OrderBy("Posicao")->ToArray();

        return $model;
    }

    public function Save(SiteDestaque $model){

        if($model!=null) {

            $Artista = new Artista();
            $Site = new Site();

            $Site = UsuarioHelper::GetSite();

            $Artista = $this->unitofwork->GetById(new Artista(), $model->ReferenciaId);
            if(empty($Artista)) $Artista = new Artista();

            $Destaques = $this->unitofwork->Get(new SiteDestaque(), "SiteId = '".$Site->SiteId."'")->ToList();

            //Seta dados do destaque
            $model->Titulo = $Artista->Titulo;
            $model->Url = $Site->Url . "/artista/" . $Artista->Titulo;
            $model->Imagem = $Artista->Imagem;
            $model->SiteId = $Site->SiteId;
            $model->Posicao = empty($model->Posicao) ? $Destaques->Count() + 1 : $model->Posicao;

                if ($model->SiteDestaqueId > 0){
                    $this->unitofwork->Update($model);
                } else {
                    $this->unitofwork->Insert($model);
                }
            //var_dump($model);
        }
        return $model;
    }

    public function Deletar($id){
        if($id > 0){
            $this->unitofwork->Delete(new SiteDestaque(), "SiteDestaqueId = '".$id."'");
        }
    }

    public function Validar(SiteDestaque $model)
    {

    }
}
