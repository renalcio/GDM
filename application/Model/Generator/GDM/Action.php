<?php

/**
* Model
* @author: Gerador de Classe
* @date: 19/03/2015 20:42:52
*/

namespace Model;

use Libs\UnitofWork;

class Action
{
    /**
                     * @PrimaryKey
                     * @Name: ActionId
                     * @DisplayName: ActionId
                     * @Type: int(11)
                     */
 var $ActionId = 0;

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
                 * @Name: Handler
                 * @DisplayName: Handler
                 * @Type: tinyint(1)
                 */
 var $Handler = 0;


    function __construct($ActionId = "",$Titulo = "",$Descricao = "",$Handler = ""){
        

            $unitofwork = new UnitofWork();

            if(!empty($Titulo)){
            
  $this->ActionId = $ActionId;
  $this->Titulo = $Titulo;
  $this->Descricao = $Descricao;
  $this->Handler = $Handler;

        }
        
 if(!empty($this->ActionId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
