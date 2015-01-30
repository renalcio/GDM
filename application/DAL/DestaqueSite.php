<?php
/**
 * DAL
 * Titulo: Destaques do Site
 * Autor: renalcio.freitas
 * Data: 30/01/2015
 */
namespace DAL;

use Libs\Database;

class DestaqueSite
{
    var $DestaqueSiteId;

    public function __construct($DestaqueSiteId = 0)
    {
        $pdo = new Database();

        if ($this->DestaqueSiteId > 0) {

        }

        return $this;
    }

}
