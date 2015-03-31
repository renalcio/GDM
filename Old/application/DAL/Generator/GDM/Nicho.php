<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 27/03/2015 15:44:10
*/

namespace DAL;

use Libs\UnitofWork;

class Nicho
{
    /**
                     * @PrimaryKey
                     * @Name: NichoId
                     * @DisplayName: NichoId
                     * @Type: int(11)
                     */
 var $NichoId = 0;

/**
                 * @Name: Titulo
                 * @DisplayName: Titulo
                 * @Type: varchar(255)
                 */
 var $Titulo;


    function __construct($NichoId = "",$Titulo = ""){
        

            $unitofwork = new UnitofWork();

            if(!empty($Titulo)){
            
  $this->NichoId = $NichoId;
  $this->Titulo = $Titulo;

        }
        
 if(!empty($this->NichoId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
