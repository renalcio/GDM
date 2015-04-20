<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 20/04/2015 12:10:37
*/

namespace DAL\ClassHub;

use Libs\UnitofWork;

class MateriaCurso
{
    /**
                     * @PrimaryKey
                     * @Name: MateriaCursoId
                     * @DisplayName: MateriaCursoId
                     * @Type: int(11)
                     */
 var $MateriaCursoId = 0;

/**
                 * @Name: MateriaId
                 * @DisplayName: MateriaId
                 * @Type: int(11)
                 */
 var $MateriaId = 0;

/**
                 * @Name: CursoId
                 * @DisplayName: CursoId
                 * @Type: int(11)
                 */
 var $CursoId = 0;

/**
                 * @Name: DiaSemana
                 * @DisplayName: DiaSemana
                 * @Type: varchar(255)
                 */
 var $DiaSemana;

/**
                 * @Name: HoraDe
                 * @DisplayName: HoraDe
                 * @Type: varchar(50)
                 */
 var $HoraDe;

/**
                 * @Name: HoraAte
                 * @DisplayName: HoraAte
                 * @Type: varchar(50)
                 */
 var $HoraAte;


    function __construct($MateriaCursoId = "",$MateriaId = "",$CursoId = "",$DiaSemana = "",$HoraDe = "",$HoraAte = ""){
        

            $unitofwork = new UnitofWork();

            if(!empty($MateriaId)){
            
  $this->MateriaCursoId = $MateriaCursoId;
  $this->MateriaId = $MateriaId;
  $this->CursoId = $CursoId;
  $this->DiaSemana = $DiaSemana;
  $this->HoraDe = $HoraDe;
  $this->HoraAte = $HoraAte;

        }
        
 if(!empty($this->MateriaCursoId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
