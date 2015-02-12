<?php
namespace Libs;
use DAL\Aplicacao;
use DAL\Site;
use DAL\Usuario;
use Libs\ArrayHelper;
use Libs\Database;
use DAL\UsuarioAplicacao;

class UsuarioHelper
{
    public static function GetSite($UsuarioId = 0, $AplicacaoId = APPID)
    {
        $pdo = new Database();
        $uow = new Database();
        $sessao = new SessionHelper("GDMAuth");
        $UsuarioId = empty($UsuarioId) ?  $sessao->Ver("UsuarioId") : $UsuarioId;

        $site = new Site();
        $site = $uow->Get(new Site(), "AplicacaoId = '".$AplicacaoId."'")->First();
        if(empty($site))
            $site = new Site();

        return $site;
    }

    public static function GetNivel($UsuarioId = '0', $AplicacaoId = APPID)
    {
        $pdo = new Database();

        //Verifica UsuarioId
        if($UsuarioId == '0') {
            $sessao = new SessionHelper("GDMAuth");

            $Usuario = $pdo->select("
                          SELECT u.*
                          FROM Usuario u,
                          UsuarioAplicacao ua
                          WHERE u.UsuarioId = ua.UsuarioId
                          AND u.UsuarioId = '" . $sessao->Ver("UsuarioId") . "'
                          AND ua.AplicacaoId = '" . $sessao->Ver("AplicacaoId") . "'
                          ", "DAL\\Usuario");

        }else {
            $Usuario = $pdo->select("SELECT * FROM Usuario WHERE UsuarioId = '" . $UsuarioId . "'", "DAL\\Usuario");

        }


        if($Usuario == null || empty($Usuario))
            return 0;

        //var_dump($Usuario);

        $Perfil = $pdo->select("
                                SELECT p.*
                                FROM UsuarioPerfil up,
                                Perfil p
                                WHERE p.AplicacaoId = '".$AplicacaoId."'
                                AND up.UsuarioId = '".$Usuario->UsuarioId."'
                                AND p.PerfilId = up.PerfilId
                                ORDER BY p.Nivel DESC LIMIT 1
                                ", "DAL\\Perfil");

        if($Perfil == null || empty($Perfil))
            return 0;


        return $Perfil->Nivel;
    }

    public static function GetPasta($UsuarioId = '0', $AplicacaoId = 0){
        $retorno = "";
        if($UsuarioId == '0') {
            $sessao = new SessionHelper("GDMAuth");
            $retorno = $sessao->Ver("Pasta");
        }
        else {
            $apps = new ArrayHelper(self::getAplicacoes($UsuarioId));

            if ($apps->Count() == 1)
                return $apps->First()->Aplicacao->Pasta;
            else if($apps->Count() > 0 && !empty($AplicacaoId)) {
                return $apps->Where(function($x) use ($AplicacaoId){
                    return ($x->AplicacaoId == $AplicacaoId);
                })->First()->Aplicacao->Pasta;
            }else
                return "";

        }

        return $retorno;

    }

    public static function getAplicacoes($UsuarioId = '0'){
        $unitofwork = new UnitofWork();

        //Verifica UsuarioId
        if($UsuarioId == '0' || empty($UsuarioId)){
            $sessao = new SessionHelper("GDMAuth");
            $UsuarioId = $sessao->Ver("UsuarioId");
        }

        $UsuarioAplicacao = $unitofwork->Get(new UsuarioAplicacao(), "UsuarioId = '" . $UsuarioId . "'")->ToArray();

        //var_dump($UsuarioAplicacao);

        if(empty($UsuarioAplicacao))
            $UsuarioAplicacao = Array();

        return $UsuarioAplicacao;

    }

    public static function setAplicacao($AplicacaoId){

        $sessao = new SessionHelper("GDMAuth");
        $cookie = new CookieHelper("GDMAuth");

        $unitofwork = new UnitofWork();

        $Aplicacao = $unitofwork->GetById(new Aplicacao(), $AplicacaoId);

        $Pasta = empty($Aplicacao->Pasta) ? "" : $Aplicacao->Pasta;

        $sessao->Definir("AplicacaoId", $AplicacaoId);
        $cookie->Definir("AplicacaoId", $AplicacaoId);

        $sessao->Definir("Pasta", $Pasta);
        $cookie->Definir("Pasta", $Pasta);

    }

    public static function GetAcessoByPerfil($MenuId, $PerfilId = 0){
        $unitofwork = new UnitofWork();

        if(empty($MenuId) || empty($PerfilId))
            return false;

        $Permissao = $unitofwork->pdo->select("SELECT * FROM ".DB_PREFIX.ROOTDB.".Permissao WHERE Menuid='".$MenuId."' AND PerfilId='"
            .$PerfilId."' LIMIT 1");
        if(!empty($Permissao))
            return true;

        return false;
    }

    public static function GetAcessoByUsuarioId($MenuId, $UsuarioId = 0){
        $unitofwork = new UnitofWork();

        //Verifica UsuarioId
        if($UsuarioId == '0' || empty($UsuarioId)){
            $sessao = new SessionHelper("GDMAuth");
            $UsuarioId = $sessao->Ver("UsuarioId");
            $Usuario = $unitofwork->GetById(new Usuario(), $UsuarioId);
        }

        if($Usuario == null || empty($Usuario) || empty($MenuId))
            return false;

        $Menu = $unitofwork->pdo->GetById(DB_PREFIX.ROOTDB.".Menu", "MenuId", $MenuId);

        $Perfis = $unitofwork->pdo->select("
                                SELECT p.*
                                FROM ".DB_PREFIX.ROOTDB.".UsuarioPerfil up,
                                ".DB_PREFIX.ROOTDB.".Perfil p
                                WHERE p.AplicacaoId = '".$Menu->AplicacaoId."'
                                AND up.UsuarioId = '".$Usuario->UsuarioId."'
                                AND p.PerfilId = up.PerfilId
                                ORDER BY p.Nivel DESC
                                ", "DAL\\Perfil", true);

        if($Perfis == null || empty($Perfis))
            return false;

        foreach($Perfis as $perfil){
            $Permissao = $unitofwork->pdo->select("SELECT * FROM ".DB_PREFIX.ROOTDB.".Permissao WHERE Menuid='".$Menu->MenuId."' AND PerfilId='".$perfil->PerfilId."' LIMIT 1");
            if(!empty($Permissao))
                return true;
        }

        return false;
    }

}