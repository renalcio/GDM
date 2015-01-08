<?php
namespace Libs;
use Classe\Database;

class Usuario
{

    public static function GetNivel($UsuarioId = '0')
    {
        $pdo = new Database();

        //Verifica UsuarioId
        if($UsuarioId == '0') {
            $sessao = new Session("GDMAuth");

            $Usuario = $pdo->select("SELECT * FROM Usuario WHERE PessoaId = '" . $sessao->Ver("PessoaId") . "' AND AplicacaoId = '" . $sessao->Ver("AplicacaoId") . "'", "DAL\\Usuario");

        }else {
            $Usuario = $pdo->select("SELECT * FROM Usuario WHERE UsuarioId = '" . $UsuarioId . "'", "DAL\\Usuario");

        }


        if($Usuario == null || empty($Usuario))
            return 0;

        $Perfil = $pdo->select("SELECT p.* FROM UsuarioPerfil up, Perfil p WHERE up.UsuarioId = ".$Usuario->UsuarioId." AND p.PerfilId = up.PerfilId ORDER BY p.Nivel DESC
 LIMIT 1");

        if($Perfil == null || empty($Perfil))
            return 0;

        return $Perfil->Nivel;
    }


}