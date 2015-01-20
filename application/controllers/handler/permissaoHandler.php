<?php
/**
 * Handler
 * Titulo: Permissão Handler
 * Autor: renalcio.freitas
 * Data: 20/01/2015
 */
namespace Controllers\Handler;
use Core\Controller;
use Classe\Database;
use Libs\Helper;

class permissaoHandler extends Controller
{
    function acesso($MenuId, $PerfilId, $Acesso){
        if(!empty($MenuId) && !empty($PerfilId) && !empty($Acesso)) {
            $pdo = new Database();

            if($Acesso == "true")
                $status = 1;
            else
                $status = 0;

            echo $pdo->update("Perfil", Array("Ativo" => $status), "PerfilId = ".$id);
        }
    }
}