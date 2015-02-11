<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 10/02/2015 15:04:14
*/

namespace DAL;

use Libs\Database;

class Site
{
    /**
                     * @PrimaryKey
                     * @Name: SiteId
                     * @DisplayName: SiteId
                     * @Type: int(11)
                     */
 var $SiteId = 0;

/**
                 * @Name: AplicacaoId
                 * @DisplayName: AplicacaoId
                 * @Type: int(11)
                 */
 var $AplicacaoId = 0;

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
                 * @Name: NivelAcesso
                 * @DisplayName: NivelAcesso
                 * @Type: int(11)
                 */
 var $NivelAcesso = 0;

/**
                 * @Name: Descricao
                 * @DisplayName: Descricao
                 * @Type: varchar(255)
                 */
 var $Descricao;

/**
                 * @Name: Metatags
                 * @DisplayName: Metatags
                 * @Type: varchar(255)
                 */
 var $Metatags;


    function __construct($SiteId = "",$AplicacaoId = "",$Titulo = "",$Url = "",$NivelAcesso = "",$Descricao = "",$Metatags = ""){
        

            $pdo = new Database();

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
