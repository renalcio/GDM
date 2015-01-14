<?php
namespace Libs;
use Classe\Database;
use DAL\UsuarioAplicacao;

class Usuario
{

    public static function GetNivel($UsuarioId = '0', $AplicacaoId = APPID)
    {
        $pdo = new Database();

        //Verifica UsuarioId
        if($UsuarioId == '0') {
            $sessao = new Session("GDMAuth");

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

    public static function getAplicacoes($UsuarioId = '0'){
        $pdo = new Database();

        //Verifica UsuarioId
        if($UsuarioId == '0' || empty($UsuarioId)){
            $sessao = new Session("GDMAuth");
            $UsuarioId = $sessao->Ver("UsuarioId");
        }

        $UsuarioAplicacao = $pdo->select("SELECT * FROM UsuarioAplicacao WHERE UsuarioId = '" . $UsuarioId . "'", "DAL\\UsuarioAplicacao", true);

        if(empty($UsuarioAplicacao))
            $UsuarioAplicacao = Array();

        return $UsuarioAplicacao;

    }

    public static function setAplicacao($AplicacaoId){

        $sessao = new Session("GDMAuth");
        $cookie = new Cookie("GDMAuth");

        $sessao->Definir("AplicacaoId", $AplicacaoId);
        $cookie->Definir("AplicacaoId", $AplicacaoId);

    }


}