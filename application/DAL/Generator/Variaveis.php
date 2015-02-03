<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 03/02/2015 14:52:08
*/

namespace DAL;

class Variaveis
{
    /**
                     * @PrimaryKey
                     * @Name: VariavelId
                     * @Type: int(255)
                     */
 var $VariavelId = 0;

/**
                 * @Name: AplicacaoId
                 * @Type: int(255)
                 */
 var $AplicacaoId = 0;

/**
                 * @Name: Titulo
                 * @Type: varchar(255)
                 */
 var $Titulo;

/**
                 * @Name: Valor
                 * @Type: text
                 */
 var $Valor;


    function __construct($VariavelId = "",$AplicacaoId = "",$Titulo = "",$Valor = ""){
        

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
