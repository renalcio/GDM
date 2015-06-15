<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 15/06/2015 16:53:14
*/

namespace Model\ClassHub;

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

/**
                 * @Name: EscolaId
                 * @DisplayName: EscolaId
                 * @Type: int(11)
                 */
 var $EscolaId = 0;


    function __construct($MateriaCursoId = "",$MateriaId = "",$CursoId = "",$DiaSemana = "",$HoraDe = "",$HoraAte = "",$EscolaId = ""){
        

            $unitofwork = new UnitofWork();

            if(!empty($MateriaId)){
            
  $this->MateriaCursoId = $MateriaCursoId;
  $this->MateriaId = $MateriaId;
  $this->CursoId = $CursoId;
  $this->DiaSemana = $DiaSemana;
  $this->HoraDe = $HoraDe;
  $this->HoraAte = $HoraAte;
  $this->EscolaId = $EscolaId;

        }
        
 if(!empty($this->MateriaCursoId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
