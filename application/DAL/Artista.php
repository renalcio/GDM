<?php
/**
 * DAL
 * Titulo: Artista
 * Autor: renalcio.freitas
 * Data: 26/01/2015
 */
namespace DAL;

use Libs\Database;

class Artista
{
    var $ArtistaId;

    /**
     * @Required
     * @DisplayName: Nome
     */
    var $Titulo;

    /**
     * @DisplayName: Descrição
     */
    var $Descricao;

    /**
     * @DisplayName: Imagem
     */
    var $Imagem;

    var $Ativo;
    var $md5;

    /**
     * @DisplayName: Visitas
     */
    var $Visitas;
    
    /**
     * @DisplayName: Music Brainz Id (MBID)
     */
    var $mbid;

    /**
     * @Required
     * @DisplayName: Aplicação
     */
    var $AplicacaoId;
    /**
     * @NotMapped
     */
    var $Aplicacao;

    /**
     * @DisplayName: Artistas Relacionados
     */
    var $Relacionados;
    
    public function __construct($ArtistaId = 0, $Titulo = "", $Descricao="", $Imagem="", $Ativo=0, $md5="",
                                $Visitas=0, $mbid=0, $AplicacaoId=0, $Relacionados="")
    {
        $pdo = new Database();
        if(!empty($Titulo)){
            $this->ArtistaId = $ArtistaId;
            $this->Titulo = $Titulo;
            $this->Descricao = $Descricao;
            $this->Imagem = $Imagem;
            $this->Ativo = $Ativo;
            $this->md5 = $md5;
            $this->Visitas = $Visitas;
            $this->mbid = $mbid;
            $this->AplicacaoId = $AplicacaoId;
            $this->Relacionados = $Relacionados;
        }

        if ($this->ArtistaId > 0) {
            if(!empty($this->AplicacaoId))
                $this->Aplicacao = $pdo->GetById("Aplicacao", "AplicacaoId", $this->AplicacaoId, "DAL\\Aplicacao");
        }

        return $this;
    }

}
