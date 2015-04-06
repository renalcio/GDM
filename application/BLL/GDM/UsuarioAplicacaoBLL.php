<?php
namespace BLL\GDM;
use BLL\BLL;
use DAL\UsuarioPerfil;
use Libs\Database;
use DAL\UsuarioAplicacao;
use Libs\Helper;
use Libs\CookieHelper;
use Libs\ModelState;
use Libs\SessionHelper;
use Libs\UsuarioHelper;
use DAL\Pessoa;
use Libs\Debug;
use Libs\ArrayHelper;
class UsuarioAplicacaoBLL extends BLL
{
    public function GetToEdit(UsuarioAplicacao $model)
    {
        if($model->UsuarioAplicacaoId > 0)
        {
            $model = $this->unitofwork->GetById(new UsuarioAplicacao(), $model->UsuarioAplicacaoId);
        }else{
            $model = new \DAL\UsuarioAplicacao();
        }
        return $model;
    }

    public function GetToIndex($model)
    {
        if(APP_ID == ROOTAPP)
            $model->ListUsuario = $this->unitofwork->Get(new UsuarioAplicacao())->ToArray();
        else {
            $model->ListUsuario = $this->unitofwork->Get(new UsuarioAplicacao(), "AplicacaoId = " . APP_ID)->ToArray();
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
                    $this->unitofwork->Delete(new UsuarioPerfil(), "UsuarioId = '" . $model->UsuarioId . "' AND PerfilId NOT IN (" . $model->ListPerfil . ") And PerfilId IN (SELECT PerfilId FROM ".DB_NAME.".Perfil WHERE AplicacaoId = '".$model->AplicacaoId."')
                    ");

                    $this->unitofwork->Update($model);
                } else {
                    $this->unitofwork->Insert($model);
                }


                foreach ($listaPerfil as $PerfilId) {
                    $check = $this->unitofwork->Get(new UsuarioPerfil(), "WHERE PerfilId = " . $PerfilId . " AND UsuarioId = " . $model->UsuarioId)->ToArray();
                    if (empty($check)) {
                        $objAdd = new UsuarioPerfil();
                        $objAdd->PerfilId = $PerfilId;
                        $objAdd->UsuarioId = $model->UsuarioId;

                        $this->unitofwork->Insert($objAdd);
                    }
                }

        }
        return $model;
    }

    public function Deletar($id){
        if($id > 0){
            $this->unitofwork->Delete(new UsuarioAplicacao(), $id);
        }
    }

    public function Validar(UsuarioAplicacao $model)
    {

        //Validar Usuario e Aplicacao
        $check = $this->unitofwork->Get(new UsuarioAplicacao(), "UsuarioId = '".$model->UsuarioId."' AND
        AplicacaoId = '".$model->AplicacaoId."'")->ToList();

        if($check->Count() > 0 && empty($model->UsuarioAplicacaoId))
            ModelState::addError("Este usuário já possui um vínculo nesta aplicação", "Documento");

    }
}
