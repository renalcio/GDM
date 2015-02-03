<?php
/**
 * Model
 * Titulo: Destaques do Site (MediaSpot)
 * Autor: renalcio.freitas
 * Data: 02/02/2015
 */
namespace BLL;
use Libs\Database;
use Libs\Helper;
use Libs\Cookie;
use Libs\ModelState;
use Libs\Session;
use Libs\Usuario;
use Libs\Debug;
use DAL\SiteDestaque;

class SiteDestaqueBLL
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
            $model = $this->pdo->GetById("SiteDestaque", "SiteDestaqueId", $model->SiteDestaqueId, "DAL\\SiteDestaque");
        }else{
            $model = new SiteDestaque();
        }
        return $model;
    }

    public function GetToIndex($model)
    {

        $model->Lista = $this->pdo->select("SELECT * FROM SiteDestaque", "DAL\\SiteDestaque", true);

        return $model;
    }

    public function Save(SiteDestaque $model){

        if($model!=null) {

                if ($model->SiteDestaqueId > 0){

                    $this->pdo->update("SiteDestaque", $model, "SiteDestaqueId = " . $model->SiteDestaqueId);
                } else {
                    $model->SiteDestaqueId = $this->pdo->insert("SiteDestaque", $model);
                }
        }
        return $model;
    }

    public function Deletar($id){
        if($id > 0){
            $this->pdo->delete("SiteDestaque", "SiteDestaqueId = '".$id."'");
        }
    }

    public function Validar(SiteDestaque $model)
    {

    }
}
