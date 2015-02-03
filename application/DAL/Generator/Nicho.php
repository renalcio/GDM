<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 03/02/2015 14:52:07
*/

namespace DAL;

class Nicho
{
    /**
                     * @PrimaryKey
                     * @Name: NichoId
                     * @Type: int(11)
                     */
 var $NichoId = 0;

/**
                 * @Name: Titulo
                 * @Type: varchar(255)
                 */
 var $Titulo;


    function __construct($NichoId = "",$Titulo = ""){
        

        if(!empty($Titulo)){
        
  $this->NichoId = $NichoId;
  $this->Titulo = $Titulo;

        }
        
 if(!empty($this->NichoId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
