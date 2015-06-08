<?php
/**
 * Model
 * Titulo: Permissão Model
 * Autor: renalcio.freitas
 * Data: 16/01/2015
 */
namespace DAL;

use Libs\Database;
use Libs\UnitofWork;

class Permissao
{
    /**
     * @PrimaryKey
     */
    var $PermissaoId;
    var $MenuId;
    var $AplicacaoId;
    var $PerfilId;
    public function __construct($PermissaoId = 0)
    {
        $pdo = new UnitofWork();

        if ($this->PermissaoId > 0) {

        }

        return $this;
    }

}
