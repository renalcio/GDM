<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 16/06/2015 17:15:19
*/

namespace Model;

use Libs\UnitofWork;

class Pais
{
    /**
                     * @PrimaryKey
                     * @Name: PaisId
                     * @DisplayName: PaisId
                     * @Type: tinyint(3) unsigned
                     */
 var $PaisId = 0;

/**
                 * @Name: Nome
                 * @DisplayName: Nome
                 * @Type: varchar(50)
                 */
 var $Nome;

/**
                 * @Name: Name
                 * @DisplayName: Name
                 * @Type: varchar(50)
                 */
 var $Name;


    function __construct($PaisId = "",$Nome = "",$Name = ""){
        

            $unitofwork = new UnitofWork();

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
