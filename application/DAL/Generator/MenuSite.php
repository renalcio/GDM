<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 05/02/2015 14:07:02
*/

namespace DAL;

use Libs\Database;

class MenuSite
{
    /**
                     * @PrimaryKey
                     * @Name: MenuSiteId
                     * @DisplayName: MenuSiteId
                     * @Type: int(11)
                     */
 var $MenuSiteId = 0;

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
                 * @Name: AplicacaoId
                 * @DisplayName: AplicacaoId
                 * @Type: int(11)
                 */
 var $AplicacaoId = 0;

/**
                 * @Name: Posicao
                 * @DisplayName: Posicao
                 * @Type: int(11)
                 */
 var $Posicao = 0;


    function __construct($MenuSiteId = "",$Titulo = "",$Url = "",$Icone = "",$Pai = "",$AplicacaoId = "",$Posicao = ""){
        

            $pdo = new Database();

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
