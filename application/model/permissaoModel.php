<?php
/**
 * Model
 * Titulo: Permissões Model
 * Autor: renalcio.freitas
 * Data: 16/01/2015
 */
namespace Model;
use Classe\Database;
use Libs\Helper;
use Libs\Cookie;
use Libs\ModelState;
use Libs\Session;
use Libs\Usuario;
use Libs\Debug;

class permissaoModel
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

    public function GetToEdit(\DAL\Permissao $model)
    {
        if($model->UsuarioAplicacaoId > 0)
        {
            $model = $this->pdo->GetById("Permissao", "PermissaoId", $model->PermissaoId, "DAL\\Permissao");
        }else{
            $model = new \DAL\Permissao();
        }
        return $model;
    }

    public function GetToIndex($model)
    {

        $model->Lista = $this->pdo->select("SELECT Permissao WHERE ", "DAL\\Permissao", true);

        return $model;
    }

    public function Save(\DAL\Permissao $model){

        if($model!=null) {

                if ($model->PermissaoId > 0){

                    $this->pdo->update("Permissao", $model, "PermissaoId = " . $model->PermissaoId);
                } else {
                    $model->PermissaoId = $this->pdo->insert("Permissao", $model);
                }
        }
        return $model;
    }

    public function Deletar($id){
        if($id > 0){
            $this->pdo->delete("Permissao", "PermissaoId = '".$id."'");
        }
    }

    public function Validar(\DAL\Permissao $model)
    {

    }
}
