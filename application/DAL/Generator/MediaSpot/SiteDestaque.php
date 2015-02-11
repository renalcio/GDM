<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 09/02/2015 18:51:58
*/

namespace DAL\MediaSpot;

use Libs\Database;

class SiteDestaque
{
    /**
                     * @PrimaryKey
                     * @Name: SiteDestaqueId
                     * @DisplayName: SiteDestaqueId
                     * @Type: int(11)
                     */
 var $SiteDestaqueId = 0;

/**
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


    function __construct($SiteDestaqueId = "",$SiteId = "",$Url = "",$Imagem = "",$Posicao = "",$Titulo = "",$Descricao = "",$ReferenciaId = ""){
        

            $pdo = new Database();

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
