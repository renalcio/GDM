<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 15/06/2015 16:53:14
*/

namespace Model\ClassHub;

use Libs\UnitofWork;

class Turma
{
    /**
                     * @PrimaryKey
                     * @Name: TurmaId
                     * @DisplayName: TurmaId
                     * @Type: int(11)
                     */
 var $TurmaId = 0;

/**
                 * @Name: CursoId
                 * @DisplayName: CursoId
                 * @Type: int(11)
                 */
 var $CursoId = 0;

/**
                 * @Name: Ano
                 * @DisplayName: Ano
                 * @Type: int(11)
                 */
 var $Ano = 0;

/**
                 * @Name: Semestre
                 * @DisplayName: Semestre
                 * @Type: int(11)
                 */
 var $Semestre = 0;

/**
                 * @Name: Turno
                 * @DisplayName: Turno
                 * @Type: varchar(255)
                 */
 var $Turno;


    function __construct($TurmaId = "",$CursoId = "",$Ano = "",$Semestre = "",$Turno = ""){
        

            $unitofwork = new UnitofWork();

            if(!empty($CursoId)){
            
  $this->TurmaId = $TurmaId;
  $this->CursoId = $CursoId;
  $this->Ano = $Ano;
  $this->Semestre = $Semestre;
  $this->Turno = $Turno;

        }
        
 if(!empty($this->TurmaId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
