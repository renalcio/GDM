<?php
/**
 * DAL
 * Titulo: Musica
 * Autor: renalcio.freitas
 * Data: 26/01/2015
 */
namespace DAL\MediaSpot;

use DAL\Aplicacao;
use Libs\Database;
use Libs\UnitofWork;

class Musica
{
    /**
     * @PrimaryKey
     */
    var $MusicaId;

    /**
     * @Required
     * @DisplayName: Artista
     */
    var $ArtistaId;

    /**
     * @NotMapped
     */
    var $Artista;

    /**
     * @Required
     * @DisplayName: Titulo
     */
    var $Titulo;

    /**
     * @Required
     * @DisplayName: Aplicação
     */
    var $AplicacaoId;

    /**
     * @NotMapped
     */
    var $Aplicacao;


    public function __construct($MusicaId = 0, $Titulo="", $ArtistaId=0, $AplicacaoId=0)
    {
        $pdo = new UnitofWork();
        if(!empty($Titulo)){
            $this->MusicaId = $MusicaId;
            $this->Titulo = $Titulo;
            $this->ArtistaId = $ArtistaId;
            $this->AplicacaoId = $AplicacaoId;
        }
        if (!empty($this->MusicaId)) {

            if(!empty($this->AplicacaoId))
                $this->Aplicacao = $pdo->GetById(new Aplicacao(), $this->AplicacaoId);

            if(!empty($this->ArtistaId))
                $this->Artista = $pdo->GetById(new Artista(), $this->ArtistaId);

        }
        if($this->Aplicacao == null)
            $this->Aplicacao = new Aplicacao();

        if($this->Artista == null)
            $this->Artista = new Artista();

        return $this;
    }

}
