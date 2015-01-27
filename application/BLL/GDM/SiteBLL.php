<?php
/**
 * Model
 * Titulo: Site de Aplicação
 * Autor: renalcio.freitas
 * Data: 22/01/2015
 */
namespace BLL;
use Libs\Database;
use DAL\Site;
use Libs\Helper;
use Libs\CookieHelper;
use Libs\ModelState;
use Libs\SessionHelper;
use Libs\UsuarioHelper;
use Libs\Debug;

class SiteBLL
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

    public function GetToEdit(Site $model)
    {
        if($model->SiteId > 0)
        {
            $model = $this->pdo->GetById("Site", "SiteId", $model->SiteId, "DAL\\Site");
        }else{
            $model = new Site();
        }
        return $model;
    }

    public function GetToIndex($model)
    {

        $model->Lista = $this->pdo->select("SELECT * FROM Site", "DAL\\Site", true);

        return $model;
    }

    public function Save(Site $model){

        if($model!=null) {
            
                if ($model->SiteId > 0){
                    $this->pdo->update("Site", $model, "SiteId = " . $model->SiteId);
                } else {
                    $model->SiteId = $this->pdo->insert("Site", $model);
                }
        }
        return $model;
    }

    public function Deletar($id){
        if($id > 0){
            $this->pdo->delete("Site", "SiteId = '".$id."'");
        }
    }

    public function Validar(Site $model)
    {

    }
}
