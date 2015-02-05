<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 05/02/2015 14:07:03
*/

namespace DAL;

use Libs\Database;

class SiteDestaque
{
    /**
                     * @PrimaryKey
                     * @Name: SiteId
                     * @DisplayName: SiteId
                     * @Type: int(11)
                     */
 var $SiteId = 0;

/**
                 * @Name: Url
                 * @DisplayName: Url
                 * @Type: varchar(255)
                 */
 var $Url;

/**
                 * @Name: Imagem
                 * @DisplayName: Imagem
                 * @Type: varchar(255)
                 */
 var $Imagem;

/**
                 * @Name: Posicao
                 * @DisplayName: Posicao
                 * @Type: int(11)
                 */
 var $Posicao = 0;

/**
                 * @Name: Titulo
                 * @DisplayName: Titulo
                 * @Type: varchar(255)
                 */
 var $Titulo;

/**
                 * @Name: Descricao
                 * @DisplayName: Descricao
                 * @Type: varchar(255)
                 */
 var $Descricao;

/**
                 * @Name: ReferenciaId
                 * @DisplayName: ReferenciaId
                 * @Type: int(11)
                 */
 var $ReferenciaId = 0;

/**
                 * @Name: SiteDestaqueId
                 * @DisplayName: SiteDestaqueId
                 * @Type: int(11)
                 */
 var $SiteDestaqueId = 0;


    function __construct($SiteId = "",$Url = "",$Imagem = "",$Posicao = "",$Titulo = "",$Descricao = "",$ReferenciaId = "",$SiteDestaqueId = ""){
        

            $pdo = new Database();

            if(!empty($Url)){
            
  $this->SiteId = $SiteId;
  $this->Url = $Url;
  $this->Imagem = $Imagem;
  $this->Posicao = $Posicao;
  $this->Titulo = $Titulo;
  $this->Descricao = $Descricao;
  $this->ReferenciaId = $ReferenciaId;
  $this->SiteDestaqueId = $SiteDestaqueId;

        }
        
 if(!empty($this->SiteId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
