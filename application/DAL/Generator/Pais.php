<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 03/02/2015 14:52:07
*/

namespace DAL;

class Pais
{
    /**
                     * @PrimaryKey
                     * @Name: PaisId
                     * @Type: tinyint(3) unsigned
                     */
 var $PaisId = 0;

/**
                 * @Name: Nome
                 * @Type: varchar(50)
                 */
 var $Nome;

/**
                 * @Name: Name
                 * @Type: varchar(50)
                 */
 var $Name;


    function __construct($PaisId = "",$Nome = "",$Name = ""){
        

        if(!empty($Nome)){
        
  $this->PaisId = $PaisId;
  $this->Nome = $Nome;
  $this->Name = $Name;

        }
        
 if(!empty($this->PaisId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
