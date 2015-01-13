<?php
namespace Model;
use Classe\Database;
use DAL\UsuarioAplicacao;
use Libs\Helper;
use Libs\Cookie;
use Libs\ModelState;
use Libs\Session;
use Libs\Usuario;
use DAL\Pessoa;
use Libs\Debug;
class UsuarioModel
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

    public function GetToEdit(UsuarioAplicacao $model)
    {
        if($model->UsuarioId > 0)
        {
            $model = $this->pdo->GetById("UsuarioAplicacao", "UsuarioAplicacaoId", $Model->UsuarioId, "DAL\\UsuarioAplicacao");
        }else{
            $model = new \DAL\Usuario();
        }
        return $model;
    }

    public function GetToIndex($model)
    {
        if(APP_ID == ROOTAPP)
            $model->ListUsuario = $this->pdo->select("SELECT * FROM UsuarioAplicacao", "DAL\\UsuarioAplicacao", true);
        else {
            $model->ListUsuario = $this->pdo->select("SELECT UsuarioAplicacao WHERE AplicacaoId = " . APP_ID, "DAL\\UsuarioAplicacao", true);
        }

        for($i = 0; $i < count($model->ListUsuario); $i++){
            $NivelItem = Usuario::GetNivel($model->ListUsuario[$i]->UsuarioId);
            $NivelUser = Usuario::GetNivel();

            if($NivelItem < $NivelUser && $model->ListUsuario[$i]->AplicacaoId == APPID){
                unset($model->ListUsuario[$i]);
            }
        }

        return $Model;
    }
    public function Save(UsuarioAplicacao $model){
        if($model!=null) {

                $listaPerfil = explode(",", $model->ListPerfil);
                if ($model->UsuarioAplicacaoId > 0)
                    $this->pdo->delete("UsuarioPerfil", "UsuarioId = '" . $model->UsuarioId . "' AND PerfilId NOT IN
                (" . $model->ListPerfil . ") And AplicacaoId = '".$model->AplicacaoId."'", 0);

                if ($model->UsuarioAplicacaoId > 0) {
                    $this->pdo->update("UsuarioAplicacao", $model, "UsuarioAplicacaoId = " . $model->UsuarioAplicacaoId);
                } else {
                    $model->UsuarioAplicacaoId = $this->pdo->insert("UsuarioAplicacao", $model);
                }


                foreach ($listaPerfil as $PerfilId) {

                    $check = $this->pdo->select("SELECT * FROM usuarioperfil WHERE PerfilId = " . $PerfilId . " AND UsuarioId = " . $model->UsuarioId);
                    if (empty($check)) {
                        $this->pdo->insert("UsuarioPerfil", Array("PerfilId" => $PerfilId, "UsuarioId" =>
                            $model->UsuarioId));
                    }
                }

        }
        return $model;
    }

    public function Deletar($id){
        if($id > 0){
            $this->pdo->delete("UsuarioAplicacao", "UsuarioAplicacaoId = '".$id."'");
        }
    }

    public function Validar($model)
    {

    }
}
