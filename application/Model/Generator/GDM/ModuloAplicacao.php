<?php

/**
* Model
* @author: Gerador de Classe
* @date: 19/03/2015 20:42:53
*/

namespace Model;

use Libs\UnitofWork;

class ModuloAplicacao
{
    /**
                     * @PrimaryKey
                     * @Name: ModuloAplicacaoId
                     * @DisplayName: ModuloAplicacaoId
                     * @Type: int(11)
                     */
 var $ModuloAplicacaoId = 0;

/**
                 * @Name: AplicacaoId
                 * @DisplayName: AplicacaoId
                 * @Type: int(11)
                 */
 var $AplicacaoId = 0;

/**
                 * @Name: ModuloId
                 * @DisplayName: ModuloId
                 * @Type: int(11)
                 */
 var $ModuloId = 0;


    function __construct($ModuloAplicacaoId = "",$AplicacaoId = "",$ModuloId = ""){
        

            $unitofwork = new UnitofWork();

            if(!empty($AplicacaoId)){
            
  $this->ModuloAplicacaoId = $ModuloAplicacaoId;
  $this->AplicacaoId = $AplicacaoId;
  $this->ModuloId = $ModuloId;

        }
        
 if(!empty($this->ModuloAplicacaoId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
