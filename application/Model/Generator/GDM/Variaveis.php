<?php

/**
* Model
* @author: Gerador de Classe
* @date: 13/04/2015 11:47:09
*/

namespace Model;

use Libs\UnitofWork;

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
        

            $unitofwork = new UnitofWork();

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