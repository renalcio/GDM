<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 15/06/2015 16:53:14
*/

namespace Model\ClassHub;

use Libs\UnitofWork;

class Materia
{
    /**
                     * @PrimaryKey
                     * @Name: MateriaId
                     * @DisplayName: MateriaId
                     * @Type: int(11)
                     */
 var $MateriaId = 0;

/**
                 * @Name: Titulo
                 * @DisplayName: Titulo
                 * @Type: varchar(255)
                 */
 var $Titulo;


    function __construct($MateriaId = "",$Titulo = ""){
        

            $unitofwork = new UnitofWork();

            if(!empty($Titulo)){
            
  $this->MateriaId = $MateriaId;
  $this->Titulo = $Titulo;

        }
        
 if(!empty($this->MateriaId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
