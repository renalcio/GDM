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

    public function GetToEdit(\DAL\Usuario $model)
    {
        if($model->UsuarioId > 0)
        {
            $model = $this->pdo->GetById("Usuario", "UsuarioId", $model->UsuarioId, "DAL\\Usuario");
        }else{
            $model = new \DAL\Usuario();
        }
        return $model;
    }

    public function GetToIndex($model)
    {
        if(defined('APP_ID') && APP_ID == ROOTAPP)
            $model->ListUsuario = $this->pdo->select("SELECT * FROM Usuario", "DAL\\Usuario", true);
        else {
            $model->ListUsuario = $this->pdo->select("SELECT Usuario WHERE AplicacaoId = " . APP_ID, "DAL\\Usuario", true);
        }

        for($i = 0; $i < count($model->ListUsuario); $i++){
            $NivelItem = Usuario::GetNivel($model->ListUsuario[$i]->UsuarioId);
            $NivelUser = Usuario::GetNivel();

            if($NivelItem < $NivelUser && $model->ListUsuario[$i]->AplicacaoId == APPID){
                unset($model->ListUsuario[$i]);
            }
        }

        return $model;
    }
    public function Save(\DAL\Usuario $model){
        if($model!=null) {

                $listaPerfil = explode(",", $model->ListPerfil);

                if ($model->UsuarioId > 0 && APP_ID != ROOTAPP)
                    $this->pdo->delete("UsuarioPerfil", "UsuarioId = '" . $model->UsuarioId . "' AND PerfilId NOT IN
                (" . $model->ListPerfil . ") AND AplicacaoId = '".APP_ID."'", 0);

                $ModelPessoa = new PessoaModel($this->db);

                $model->Pessoa = $ModelPessoa->Save($model->Pessoa);

                $model->PessoaId = $model->Pessoa->PessoaId;

                if ($model->UsuarioId > 0) {
                    $usuario = $this->pdo->GetById("Usuario", "UsuarioId", $model->UsuarioId, "DAL\\Usuario");

                    if (!empty($model->NovaSenha) && !empty($model->ConfirmarNovaSenha) && $model->NovaSenha == $model->ConfirmarNovaSenha) {
                        $model->Senha = md5($model->NovaSenha);
                    } else {
                        $model->Senha = $usuario->Senha;
                    }

                    $this->pdo->update("Usuario", $model, "UsuarioId = " . $model->UsuarioId);
                } else {
                    $model->Senha = md5($model->Senha);
                    $model->Ativo = 1;
                    $model->UsuarioId = $this->pdo->insert("Usuario", $model);
                }


                foreach ($listaPerfil as $PerfilId) {

                    $check = $this->pdo->select("SELECT * FROM usuarioperfil WHERE PerfilId = " . $PerfilId . " AND UsuarioId = " . $model->UsuarioId);
                    if (empty($check)) {
                        $this->pdo->insert("UsuarioPerfil", Array("PerfilId" => $PerfilId, "UsuarioId" =>
                            $model->UsuarioId));
                    }
                }

            //UsuarioAplicacao
            if(APP_ID != ROOTAPP) {
                $UAcheck = $this->pdo->select("SELECT * FROM UsuarioAplicacao WHERE UsuarioId = '".$model->UsuarioId."' AND AplicacaoId = '".APP_ID."'", "", true);
                if(count($UAcheck) <= 0){
                    $addUA = new UsuarioAplicacao();
                    $addUA->AplicacaoId = APPID;
                    $addUA->UsuarioId = $model->UsuarioId;

                    $this->pdo->insert("UsuarioAplicacao", $addUA);
                }
            }

        }
        return $model;
    }

    public function Deletar($id){
        if($id > 0){
            $this->pdo->delete("Usuario", "UsuarioId = '".$id."'");
        }
    }

    public function Validar(\DAL\Usuario $model)
    {
        $retorno = Array();
        if($model != null) {
            //verifica usuario
            $usuarios = $this->pdo->select("SELECT * FROM Usuario WHERE Login = '" . $model->Login . "' AND (PessoaId != '" . $model->Pessoa->PessoaId . "' OR
'" . $model->Pessoa->PessoaId . "' = '') AND AplicacaoId = '".$model->AplicacaoId."' ", "", true);
            if (count($usuarios) > 0)
                ModelState::addError("Este nome de usuário já está sendo utilizado por outra pessoa", "Login", ModelState::DisplayName($model, "Login"));

            //Senha
            if (!empty($model->NovaSenha) && $model->NovaSenha != $model->ConfirmarNovaSenha)
                ModelState::addError("Senhas diferentes", "ConfirmarNovaSenha", ModelState::DisplayName($model, "ConfirmarNovaSenha"));

        }

        return $retorno;
    }
}
