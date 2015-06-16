<?php

/**
 * DAL
 * @author: Gerador de Classe
 * @date: 16/06/2015 17:15:19
 */

namespace Model;

use Libs\UnitofWork;

class SiteMenu
{
    /**
     * @PrimaryKey
     * @Name: SiteMenuId
     * @DisplayName: SiteMenuId
     * @Type: int(11)
     */
    var $SiteMenuId = 0;

    /**
     * @Name: AplicacaoId
     * @DisplayName: AplicacaoId
     * @Type: int(11)
     */
    var $AplicacaoId = 0;

    /**
     * @Name: SiteId
     * @DisplayName: SiteId
     * @Type: int(11)
     */
    var $SiteId = 0;

    /**
     * @Name: Titulo
     * @DisplayName: Titulo
     * @Type: varchar(255)
     */
    var $Titulo;

    /**
     * @Name: Url
     * @DisplayName: Url
     * @Type: varchar(255)
     */
    var $Url;

    /**
     * @Name: Icone
     * @DisplayName: Icone
     * @Type: varchar(255)
     */
    var $Icone;

    /**
     * @Name: Pai
     * @DisplayName: Pai
     * @Type: int(11)
     */
    var $Pai = 0;

    /**
     * @Name: Posicao
     * @DisplayName: Posicao
     * @Type: int(11)
     */
    var $Posicao = 0;


    function __construct($SiteMenuId = "",$AplicacaoId = "",$SiteId = "",$Titulo = "",$Url = "",$Icone = "",$Pai = "",$Posicao = ""){


        $unitofwork = new UnitofWork();

        if(!empty($AplicacaoId)){

            $this->SiteMenuId = $SiteMenuId;
            $this->AplicacaoId = $AplicacaoId;
            $this->SiteId = $SiteId;
            $this->Titulo = $Titulo;
            $this->Url = $Url;
            $this->Icone = $Icone;
            $this->Pai = $Pai;
            $this->Posicao = $Posicao;

        }

        if(!empty($this->SiteMenuId)){

            //Virtuais e Referencias



        }

    }
}
