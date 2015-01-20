<?php
/**
 * DAL
 * Titulo: Permissão DAL
 * Autor: renalcio.freitas
 * Data: 16/01/2015
 */
namespace DAL;

use Classe\Database;

class Permissao
{
    var $PermissaoId;
    var $MenuId;
    var $AplicacaoId;
    var $PerfilId;
    public function __construct($PermissaoId = 0)
    {
        $pdo = new Database();

        if ($this->PermissaoId > 0) {

        }

        return $this;
    }

}
