<?php
namespace Modules\GDM\BLL;
use Core\BLL;
use Modules\Generic\BLL\PessoaBLL;
use Model\Usuario;
use Model\UsuarioPerfil;
use Libs\Database;
use Model\UsuarioAplicacao;
use Libs\Helper;
use Libs\CookieHelper;
use Libs\ModelState;
use Libs\SessionHelper;
use Libs\UnitofWork;
use Libs\UsuarioHelper;
use Model\Pessoa;
use Libs\Debug;
class UsuarioBLL extends BLL
{

    public function GetToEdit(\Model\Usuario $model)
    {
        if($model->UsuarioId > 0)
        {
            $model = $this->unitofwork->GetById(new Usuario(), $model->UsuarioId);
        }else{
            $model = new \Model\Usuario();
        }
        return $model;
    }

    public function GetToIndex($model)
    {
        if(defined('APP_ID') && APP_ID == ROOTAPP)
            $model->ListUsuario = $this->unitofwork->Get(new Usuario())->ToArray();
        else {
            //$model->ListUsuario = $this->pdo->select("SELECT u.*, ua.Ativo FROM ".DB_NAME.".Usuario u, ".DB_NAME.".UsuarioAplicacao ua WHERE ua.UsuarioId = u.UsuarioId AND ua.AplicacaoId = " . APP_ID, "Model\\Usuario", true);
            $model->ListUsuario = $this->unitofwork->Get(new Usuario())->Join(
                $this->unitofwork->Get(new UsuarioAplicacao(), "ua.AplicacaoId = ".APPID),
                "u.UsuarioId",
                "ua.UsuarioId")->Select("u.*, ua.Ativo", new Usuario())->ToArray();
        }

        for($i = 0; $i < count($model->ListUsuario); $i++){
            $NivelItem = UsuarioHelper::GetNivel($model->ListUsuario[$i]->UsuarioId);
            $NivelUser = UsuarioHelper::GetNivel();

            if($NivelItem < $NivelUser){
                unset($model->ListUsuario[$i]);
            }
        }

        return $model;
    }

    public function Save(\Model\Usuario $model){
        if($model!=null) {

                $listaPerfil = explode(",", $model->ListPerfil);

                if ($model->UsuarioId > 0 && APP_ID != ROOTAPP) {
                    $this->unitofwork->Delete(new UsuarioPerfil(), "UsuarioId = '" . $model->UsuarioId . "' AND PerfilId NOT IN (" . $model->ListPerfil . ") AND PerfilId IN (SELECT ".DB_NAME.".PerfilId FROM Perfil Where AplicacaoId = '" . APP_ID . "')");
                }

                $ModelPessoa = new PessoaBLL($this->db);

                $model->Pessoa = $ModelPessoa->Save($model->Pessoa);

                $model->PessoaId = $model->Pessoa->PessoaId;

                if ($model->UsuarioId > 0) {
                    $usuario = $this->unitofwork->GetById(new Usuario(), $model->UsuarioId);

                    if (!empty($model->NovaSenha) && !empty($model->ConfirmarNovaSenha) && $model->NovaSenha == $model->ConfirmarNovaSenha) {
                        $model->Senha = md5($model->NovaSenha);
                    } else {
                        $model->Senha = $usuario->Senha;
                    }

                    $this->unitofwork->Update($model);
                } else {
                    $model->Senha = md5($model->Senha);
                    $model->Ativo = 1;
                    $this->unitofwork->Insert($model);
                }


                foreach ($listaPerfil as $PerfilId) {

                    $check = $this->unitofwork->Get(new UsuarioPerfil(), "PerfilId = ".$PerfilId." AND UsuarioId = " . $model->UsuarioId)->ToList();
                    if ($check->Count() <= 0) {
                        $objAdd = new UsuarioPerfil();
                        $objAdd->PerfilId = $PerfilId;
                        $objAdd->UsuarioId = $model->UsuarioId;
                        $this->unitofwork->Insert($objAdd);
                    }
                }

            //UsuarioAplicacao
            if(APP_ID != ROOTAPP) {
                $UAcheck = $this->unitofwork->Get(new UsuarioAplicacao(), "UsuarioId = '".$model->UsuarioId."' AND AplicacaoId = '".APP_ID."'")->ToList();
                if($UAcheck->Count() <= 0){

                    $addUA = new UsuarioAplicacao();
                    $addUA->AplicacaoId = APPID;
                    $addUA->UsuarioId = $model->UsuarioId;
                    $this->unitofwork->Insert($addUA);
                }
            }

        }
        return $model;
    }

    public function Deletar($id){
        if($id > 0){
            $this->pdo->delete(new Usuario(), $id);
        }
    }

    public function Validar(\Model\Usuario $model)
    {
        $retorno = Array();
        if($model != null) {
            //verifica usuario
            $usuarios = $this->unitofwork->Get(new Usuario(), "Login = '" . $model->Login . "' AND (PessoaId != '" . $model->Pessoa->PessoaId . "' OR
'" . $model->Pessoa->PessoaId . "' = '')")->ToList();
            if ($usuarios->Count() > 0)
                ModelState::addError("Este nome de usuário já está sendo utilizado por outra pessoa", "Login", ModelState::DisplayName($model, "Login"));

            //Senha
            if (!empty($model->NovaSenha) && $model->NovaSenha != $model->ConfirmarNovaSenha)
                ModelState::addError("Senhas diferentes", "ConfirmarNovaSenha", ModelState::DisplayName($model, "ConfirmarNovaSenha"));

        }

        return $retorno;
    }
}
