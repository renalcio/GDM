<?php
/**
 * DAL
 * Titulo: Musica
 * Autor: renalcio.freitas
 * Data: 26/01/2015
 */
namespace DAL;

use Classe\Database;

class Musica
{
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
        $pdo = new Database();
        if(!empty($Titulo)){
            $this->MusicaId = $MusicaId;
            $this->Titulo = $Titulo;
            $this->ArtistaId = $ArtistaId;
            $this->AplicacaoId = $AplicacaoId;
            $this->Aplicacao = new Aplicacao();
            $this->Artista = new Artista();
        }

        if ($this->MusicaId > 0) {

            if(!empty($this->AplicacaoId))
                $this->Aplicacao = $pdo->GetById("Aplicacao". "AplicacaoId", $this->AplicacaoId, "DAL\\Aplicacao");

            if(!empty($this->ArtistaId))
                $this->Artista = $pdo->GetById("Artista". "ArtistaId", $this->ArtistaId, "DAL\\Artista");

        }

        return $this;
    }

}
