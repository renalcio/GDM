<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 03/02/2015 14:52:07
*/

namespace DAL;

class MenuSite
{
    /**
                     * @PrimaryKey
                     * @Name: MenuSiteId
                     * @Type: int(11)
                     */
 var $MenuSiteId = 0;

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
                 * @Name: Icone
                 * @Type: varchar(255)
                 */
 var $Icone;

/**
                 * @Name: Pai
                 * @Type: int(11)
                 */
 var $Pai = 0;

/**
                 * @Name: AplicacaoId
                 * @Type: int(11)
                 */
 var $AplicacaoId = 0;

/**
                 * @Name: Posicao
                 * @Type: int(11)
                 */
 var $Posicao = 0;


    function __construct($MenuSiteId = "",$Titulo = "",$Url = "",$Icone = "",$Pai = "",$AplicacaoId = "",$Posicao = ""){
        

        if(!empty($Titulo)){
        
  $this->MenuSiteId = $MenuSiteId;
  $this->Titulo = $Titulo;
  $this->Url = $Url;
  $this->Icone = $Icone;
  $this->Pai = $Pai;
  $this->AplicacaoId = $AplicacaoId;
  $this->Posicao = $Posicao;

        }
        
 if(!empty($this->MenuSiteId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
