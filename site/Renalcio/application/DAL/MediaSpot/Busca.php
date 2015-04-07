<?php
/**
 * DAL
 * Titulo: Busca DAL
 * Autor: renalcio.freitas
 * Data: 24/02/2015
 */
namespace DAL\MediaSpot;

use Libs\Database;
use Libs\ListHelper;

class Busca
{
    var $Termo;
    var $ListMusica;
    var $ListArtista;

    public function __construct($Termo = "")
    {
        $this->ListArtista = new ListHelper();
        $this->ListMusica = new ListHelper();
        if(!empty($Termo))
            $this->Termo = $Termo;
        return $this;
    }

}
