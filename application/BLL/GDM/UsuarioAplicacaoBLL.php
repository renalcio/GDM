<?php
namespace BLL;
use Libs\Database;
use DAL\UsuarioAplicacao;
use Libs\Helper;
use Libs\CookieHelper;
use Libs\ModelState;
use Libs\SessionHelper;
use Libs\UsuarioHelper;
use DAL\Pessoa;
use Libs\Debug;
class UsuarioAplicacaoBLL
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
        if($model->UsuarioAplicacaoId > 0)
        {
            $model = $this->pdo->GetById("UsuarioAplicacao", "UsuarioAplicacaoId", $model->UsuarioAplicacaoId, "DAL\\UsuarioAplicacao");
        }else{
            $model = new \DAL\UsuarioAplicacao();
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
            $NivelItem = UsuarioHelper::GetNivel($model->ListUsuario[$i]->UsuarioId);
            $NivelUser = UsuarioHelper::GetNivel();

            if($NivelItem < $NivelUser && $model->ListUsuario[$i]->AplicacaoId == APPID){
                unset($model->ListUsuario[$i]);
            }
        }

        return $model;
    }
    public function Save(UsuarioAplicacao $model){
        if($model!=null) {

                $listaPerfil = explode(",", $model->ListPerfil);

                if ($model->UsuarioAplicacaoId > 0){
                    $this->pdo->delete("UsuarioPerfil", "UsuarioId = '" . $model->UsuarioId . "' AND PerfilId NOT IN (" . $model->ListPerfil . ") And PerfilId IN (SELECT PerfilId FROM Perfil WHERE AplicacaoId = '".$model->AplicacaoId."')
                    ", 0);

                    $this->pdo->update("UsuarioAplicacao", $model, "UsuarioAplicacaoId = " . $model->UsuarioAplicacaoId);
                } else {
                    $model->UsuarioAplicacaoId = $this->pdo->insert("UsuarioAplicacao", $model);
                }


                foreach ($listaPerfil as $PerfilId) {
                    $check = $this->pdo->select("SELECT * FROM UsuarioPerfil WHERE PerfilId = " . $PerfilId . " AND UsuarioId = " . $model->UsuarioId);
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

    public function Validar(UsuarioAplicacao $model)
    {

        //Validar Usuario e Aplicacao
        $check = $this->pdo->select("SELECT * FROM UsuarioAplicacao WHERE UsuarioId = '".$model->UsuarioId."' AND
        AplicacaoId = '".$model->AplicacaoId."'", "", true);

        if(count($check) > 0 && empty($model->UsuarioAplicacaoId))
            ModelState::addError("Este usuário já possui um vínculo nesta aplicação", "Documento");

    }
}
