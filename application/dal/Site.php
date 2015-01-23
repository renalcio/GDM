<?php
/**
 * DAL
 * Titulo: Site
 * Autor: renalcio.freitas
 * Data: 22/01/2015
 */
namespace DAL;

use Classe\Database;

class Site
{
    var $SiteId;
    /**
     * @Required
     * @DisplayName: Aplicação
     */
    var $AplicacaoId;
    /**
     * @Required
     * @DisplayName: Título do Site
     */
    var $Titulo;
    /**
     * @DisplayName: Url do Site
     */
    var $Url;
    /**
     * @Required
     * @DisplayName: Nível de Acesso do Perfil de Usuários
     */
    var $NivelAcesso;
    /**
     * @DisplayName: Descrição do Site
     */
    var $Descricao;
    /**
     * @DisplayName: Metatags de Busca
     */
    var $Metatags;

    /**
     * @NotMapped
     */
    var $Aplicacao;


    public function __construct($SiteId = 0, $AplicacaoId = 0, $Titulo = "", $Url="", $NivelAcesso=0, $Descricao="",
                                $Metatags="")
    {
        if(!empty($AplicacaoId)){
            $this->AplicacaoId = $AplicacaoId;
            $this->Titulo = $Titulo;
            $this->Url = $Url;
            $this->NivelAcesso = $NivelAcesso;
            $this->Descricao = $Descricao;
            $this->Metatags = $Metatags;
        }

        $pdo = new Database();

        if ($this->AplicacaoId > 0) {
            $this->Aplicacao = $pdo->GetById("Aplicacao", "AplicacaoId", $this->AplicacaoId, "DAL\\Aplicacao");
        }

        return $this;
    }

}
