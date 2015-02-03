<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 03/02/2015 14:52:07
*/

namespace DAL;

class Site
{
    /**
                     * @PrimaryKey
                     * @Name: SiteId
                     * @Type: int(11)
                     */
 var $SiteId = 0;

/**
                 * @Name: AplicacaoId
                 * @Type: int(11)
                 */
 var $AplicacaoId = 0;

/**
                 * @Name: Titulo
                 * @Type: varchar(255)
                 */
 var $Titulo;

/**
                 * @Name: Url
                 * @Type: varchar(255)
                 */
 var $Url;

/**
                 * @Name: NivelAcesso
                 * @Type: int(11)
                 */
 var $NivelAcesso = 0;

/**
                 * @Name: Descricao
                 * @Type: varchar(255)
                 */
 var $Descricao;

/**
                 * @Name: Metatags
                 * @Type: varchar(255)
                 */
 var $Metatags;


    function __construct($SiteId = "",$AplicacaoId = "",$Titulo = "",$Url = "",$NivelAcesso = "",$Descricao = "",$Metatags = ""){
        

        if(!empty($AplicacaoId)){
        
  $this->SiteId = $SiteId;
  $this->AplicacaoId = $AplicacaoId;
  $this->Titulo = $Titulo;
  $this->Url = $Url;
  $this->NivelAcesso = $NivelAcesso;
  $this->Descricao = $Descricao;
  $this->Metatags = $Metatags;

        }
        
 if(!empty($this->SiteId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
