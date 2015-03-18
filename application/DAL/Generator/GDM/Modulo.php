<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 18/03/2015 16:18:50
*/

namespace DAL;

use Libs\Database;

class Modulo
{
    /**
                     * @PrimaryKey
                     * @Name: ModuloId
                     * @DisplayName: ModuloId
                     * @Type: int(11)
                     */
 var $ModuloId = 0;

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
                 * @Name: Descricao
                 * @DisplayName: Descricao
                 * @Type: varchar(255)
                 */
 var $Descricao;

/**
                 * @Name: Url
                 * @DisplayName: Url
                 * @Type: varchar(255)
                 */
 var $Url;


    function __construct($ModuloId = "",$AplicacaoId = "",$Titulo = "",$Descricao = "",$Url = ""){
        

            $pdo = new Database();

            if(!empty($AplicacaoId)){
            
  $this->ModuloId = $ModuloId;
  $this->AplicacaoId = $AplicacaoId;
  $this->Titulo = $Titulo;
  $this->Descricao = $Descricao;
  $this->Url = $Url;

        }
        
 if(!empty($this->ModuloId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
