<?php

/**
* Model
* @author: Gerador de Classe
* @date: 20/04/2015 12:10:37
*/

namespace Model\ClassHub;

use Libs\UnitofWork;

class ProfessorMateria
{
    /**
                     * @PrimaryKey
                     * @Name: ProfessorMateriaId
                     * @DisplayName: ProfessorMateriaId
                     * @Type: int(11)
                     */
 var $ProfessorMateriaId = 0;

/**
                 * @Name: ProfessorId
                 * @DisplayName: ProfessorId
                 * @Type: int(11)
                 */
 var $ProfessorId = 0;

/**
                 * @Name: MateriaId
                 * @DisplayName: MateriaId
                 * @Type: int(11)
                 */
 var $MateriaId = 0;


    function __construct($ProfessorMateriaId = "",$ProfessorId = "",$MateriaId = ""){
        

            $unitofwork = new UnitofWork();

            if(!empty($ProfessorId)){
            
  $this->ProfessorMateriaId = $ProfessorMateriaId;
  $this->ProfessorId = $ProfessorId;
  $this->MateriaId = $MateriaId;

        }
        
 if(!empty($this->ProfessorMateriaId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
