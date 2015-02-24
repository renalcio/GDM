<?php
/**
 * DAL
 * Titulo: Player
 * Autor: renalcio.freitas
 * Data: 24/02/2015
 */
namespace DAL\MediaSpot;

use Libs\Database;
use Libs\ListHelper;
use Libs\UnitofWork;

class Player
{
    var $ArtistaId;
    var $MusicaId;
    var $Artista;
    var $ListMusica;

    public function __construct($ArtistaId = 0, $MusicaId = 0)
    {
       $uow = new UnitofWork();
        if(!empty($ArtistaId))
            $this->ArtistaId = $ArtistaId;

        if(!empty($MusicaId))
            $this->MusicaId = $MusicaId;

        $this->Artista = new Artista();
        $this->ListMusica = new ListHelper();

        if ($this->ArtistaId > 0) {
            $this->Artista = $uow->GetById(new Artista(), $this->ArtistaId);
            $this->ListMusica = $uow->Get(new Musica(), "ArtistaId = '".$this->ArtistaId."'")->ToList();
        }

        return $this;
    }

}
