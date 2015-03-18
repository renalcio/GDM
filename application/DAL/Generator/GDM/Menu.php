<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 18/03/2015 16:18:50
*/

namespace DAL;

use Libs\Database;

class Menu
{
    /**
                     * @PrimaryKey
                     * @Name: MenuId
                     * @DisplayName: MenuId
                     * @Type: int(11)
                     */
 var $MenuId = 0;

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
                 * @Type: varchar(70)
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
                 * @Type: int(255)
                 */
 var $AplicacaoId = 0;

/**
                 * @Name: Posicao
                 * @DisplayName: Posicao
                 * @Type: int(255)
                 */
 var $Posicao = 0;


    function __construct($MenuId = "",$Titulo = "",$Url = "",$Icone = "",$Pai = "",$AplicacaoId = "",$Posicao = ""){
        

            $pdo = new Database();

            if(!empty($Titulo)){
            
  $this->MenuId = $MenuId;
  $this->Titulo = $Titulo;
  $this->Url = $Url;
  $this->Icone = $Icone;
  $this->Pai = $Pai;
  $this->AplicacaoId = $AplicacaoId;
  $this->Posicao = $Posicao;

        }
        
 if(!empty($this->MenuId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
