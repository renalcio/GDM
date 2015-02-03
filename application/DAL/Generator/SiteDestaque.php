<?php

/**
 * DAL
 * @author: Gerador de Classe
 * @date: 03/02/2015 14:52:07
 */

namespace DAL;

class SiteDestaque
{
    /**
     * @PrimaryKey
     * @Name: SiteDestaqueId
     * @Type: int(11)
     */
    var $SiteDestaqueId = 0;

    /**
     * @Name: SiteId
     * @Type: int(11)
     */
    var $SiteId = 0;

    /**
     * @Name: Url
     * @Type: varchar(255)
     */
    var $Url;

    /**
     * @Name: Imagem
     * @Type: varchar(255)
     */
    var $Imagem;

    /**
     * @Name: Posicao
     * @Type: int(11)
     */
    var $Posicao = 0;

    /**
     * @Name: Titulo
     * @Type: varchar(255)
     */
    var $Titulo;

    /**
     * @Name: Descricao
     * @Type: varchar(255)
     */
    var $Descricao;

    /**
     * @Name: ReferenciaId
     * @Type: int(11)
     */
    var $ReferenciaId = 0;


    function __construct($SiteDestaqueId = "",$SiteId = "",$Url = "",$Imagem = "",$Posicao = "",$Titulo = "",$Descricao = "",$ReferenciaId = ""){


        if(!empty($SiteId)){

            $this->SiteDestaqueId = $SiteDestaqueId;
            $this->SiteId = $SiteId;
            $this->Url = $Url;
            $this->Imagem = $Imagem;
            $this->Posicao = $Posicao;
            $this->Titulo = $Titulo;
            $this->Descricao = $Descricao;
            $this->ReferenciaId = $ReferenciaId;

        }

        if(!empty($this->SiteDestaqueId)){

            //Virtuais e Referencias



        }

    }
}
