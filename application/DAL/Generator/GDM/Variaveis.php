<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 10/02/2015 15:04:14
*/

namespace DAL;

use Libs\Database;

class Variaveis
{
    /**
                     * @PrimaryKey
                     * @Name: VariavelId
                     * @DisplayName: VariavelId
                     * @Type: int(255)
                     */
 var $VariavelId = 0;

/**
                 * @Name: AplicacaoId
                 * @DisplayName: AplicacaoId
                 * @Type: int(255)
                 */
 var $AplicacaoId = 0;

/**
                 * @Name: Titulo
                 * @DisplayName: Titulo
                 * @Type: varchar(255)
                 */
 var $Titulo;

/**
                 * @Name: Valor
                 * @DisplayName: Valor
                 * @Type: text
                 */
 var $Valor;


    function __construct($VariavelId = "",$AplicacaoId = "",$Titulo = "",$Valor = ""){
        

            $pdo = new Database();

            if(!empty($AplicacaoId)){
            
  $this->VariavelId = $VariavelId;
  $this->AplicacaoId = $AplicacaoId;
  $this->Titulo = $Titulo;
  $this->Valor = $Valor;

        }
        
 if(!empty($this->VariavelId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}