<?php
namespace Libs;
use DAL\Site;
use Libs\ArrayHelper;
use Libs\Database;
use DAL\UsuarioAplicacao;

class UsuarioHelper
{
    public static function GetSite($UsuarioId = 0, $AplicacaoId = APPID)
    {
        $pdo = new Database();
        $sessao = new SessionHelper("GDMAuth");
        $UsuarioId = empty($UsuarioId) ?  $sessao->Ver("UsuarioId") : $UsuarioId;

        $site = new Site();
        $site = $pdo->select("SELECT * FROM Site WHERE AplicacaoId = '".$AplicacaoId."' LIMIT 1", new Site());
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
        $pdo = new Database();

        //Verifica UsuarioId
        if($UsuarioId == '0' || empty($UsuarioId)){
            $sessao = new SessionHelper("GDMAuth");
            $UsuarioId = $sessao->Ver("UsuarioId");
        }

        $UsuarioAplicacao = $pdo->select("SELECT * FROM UsuarioAplicacao WHERE UsuarioId = '" . $UsuarioId . "'", "DAL\\UsuarioAplicacao", true);

        if(empty($UsuarioAplicacao))
            $UsuarioAplicacao = Array();

        return $UsuarioAplicacao;

    }

    public static function setAplicacao($AplicacaoId){

        $sessao = new SessionHelper("GDMAuth");
        $cookie = new CookieHelper("GDMAuth");

        $pdo = new Database();

        $Aplicacao = $pdo->GetById("Aplicacao", "AplicacaoId", $AplicacaoId, "DAL\\Aplicacao");

        $Pasta = empty($Aplicacao->Pasta) ? "" : $Aplicacao->Pasta;

        $sessao->Definir("AplicacaoId", $AplicacaoId);
        $cookie->Definir("AplicacaoId", $AplicacaoId);

        $sessao->Definir("Pasta", $Pasta);
        $cookie->Definir("Pasta", $Pasta);

    }

    public static function GetAcessoByPerfil($MenuId, $PerfilId = 0){
        $pdo = new Database();

        if(empty($MenuId) || empty($PerfilId))
            return false;

        $Permissao = $pdo->select("SELECT * FROM Permissao WHERE Menuid='".$MenuId."' AND PerfilId='"
            .$PerfilId."' LIMIT 1");
        if(!empty($Permissao))
            return true;

        return false;
    }

    public static function GetAcessoByUsuarioId($MenuId, $UsuarioId = 0){
        $pdo = new Database();

        //Verifica UsuarioId
        if($UsuarioId == '0' || empty($UsuarioId)){
            $sessao = new SessionHelper("GDMAuth");
            $UsuarioId = $sessao->Ver("UsuarioId");
            $Usuario = $pdo->GetById("Usuario", "UsuarioId", $UsuarioId, "DAL\\Usuario");
        }

        if($Usuario == null || empty($Usuario) || empty($MenuId))
            return false;

        $Menu = $pdo->GetById("Menu", "MenuId", $MenuId);

        $Perfis = $pdo->select("
                                SELECT p.*
                                FROM UsuarioPerfil up,
                                Perfil p
                                WHERE p.AplicacaoId = '".$Menu->AplicacaoId."'
                                AND up.UsuarioId = '".$Usuario->UsuarioId."'
                                AND p.PerfilId = up.PerfilId
                                ORDER BY p.Nivel DESC
                                ", "DAL\\Perfil", true);

        if($Perfis == null || empty($Perfis))
            return false;

        foreach($Perfis as $perfil){
            $Permissao = $pdo->select("SELECT * FROM Permissao WHERE Menuid='".$Menu->MenuId."' AND PerfilId='"
                .$perfil->PerfilId."' LIMIT 1");
            if(!empty($Permissao))
                return true;
        }

        return false;
    }

}