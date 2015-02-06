<?php
/**
 * DAL
 * Titulo: Destaques do Site
 * Autor: renalcio.freitas
 * Data: 30/01/2015
 */
namespace DAL\MediaSpot;

use Libs\Database;

class SiteDestaque
{
    var $SiteDestaqueId;
    var $SiteId;

    /**
     * @DisplayName: Url do Destaque
     */
    var $Url;

    /**
     * @Required
     * @DisplayName: Imagem
     */
    var $Imagem;

    var $Posicao;

    /**
     * @DisplayName: Título
     */
    var $Titulo;

    /**
     * @DisplayName: Descrição
     */
    var $Descricao;

    var $ReferenciaId;

    /**
     * @NotMapped
     */
    var $Site;

    public function __construct($DestaqueSiteId = 0, $SiteId=0, $Titulo="", $Descricao="", $Url="", $Imagem="",
                                $Posicao=0, $ReferenciaId=0)
    {
        $pdo = new Database();
        if(!empty($Titulo)){
            $this->SiteDestaqueId = $DestaqueSiteId;
            $this->SiteId = $SiteId;
            $this->Url = $Url;
            $this->Imagem = $Imagem;
            $this->Posicao = $Posicao;
            $this->Titulo = $Titulo;
            $this->Descricao = $Descricao;
            $this->ReferenciaId = $ReferenciaId;
        }

        if ($this->SiteDestaqueId > 0) {
            if(!empty($this->SiteId))
                $this->Site = $pdo->GetById("Site", "SiteId", $this->SiteId, "DAL\\Site");
        }

        return $this;
    }

}
