<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 15/06/2015 16:53:14
*/

namespace Model\ClassHub;

use Libs\UnitofWork;

class Aula
{
    /**
                     * @PrimaryKey
                     * @Name: AulaId
                     * @DisplayName: AulaId
                     * @Type: int(11)
                     */
 var $AulaId = 0;

/**
                 * @Name: MateriaId
                 * @DisplayName: MateriaId
                 * @Type: int(11)
                 */
 var $MateriaId = 0;

/**
                 * @Name: TurmaId
                 * @DisplayName: TurmaId
                 * @Type: int(11)
                 */
 var $TurmaId = 0;

/**
                 * @Name: ProfessorId
                 * @DisplayName: ProfessorId
                 * @Type: int(11)
                 */
 var $ProfessorId = 0;

/**
                 * @Name: Data
                 * @DisplayName: Data
                 * @Type: varchar(100)
                 */
 var $Data;

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
                 * @Name: Titulo
                 * @DisplayName: Titulo
                 * @Type: varchar(255)
                 */
 var $Titulo;

/**
                 * @Name: Conteudo
                 * @DisplayName: Conteudo
                 * @Type: text
                 */
 var $Conteudo;

/**
                 * @Name: Sala
                 * @DisplayName: Sala
                 * @Type: varchar(30)
                 */
 var $Sala;

/**
                 * @Name: AlunoId
                 * @DisplayName: AlunoId
                 * @Type: int(11)
                 */
 var $AlunoId = 0;

/**
                 * @Name: EscolaId
                 * @DisplayName: EscolaId
                 * @Type: int(11)
                 */
 var $EscolaId = 0;

/**
                 * @Name: CursoId
                 * @DisplayName: CursoId
                 * @Type: int(11)
                 */
 var $CursoId = 0;


    function __construct($AulaId = "",$MateriaId = "",$TurmaId = "",$ProfessorId = "",$Data = "",$HoraDe = "",$HoraAte = "",$Titulo = "",$Conteudo = "",$Sala = "",$AlunoId = "",$EscolaId = "",$CursoId = ""){
        

            $unitofwork = new UnitofWork();

            if(!empty($MateriaId)){
            
  $this->AulaId = $AulaId;
  $this->MateriaId = $MateriaId;
  $this->TurmaId = $TurmaId;
  $this->ProfessorId = $ProfessorId;
  $this->Data = $Data;
  $this->HoraDe = $HoraDe;
  $this->HoraAte = $HoraAte;
  $this->Titulo = $Titulo;
  $this->Conteudo = $Conteudo;
  $this->Sala = $Sala;
  $this->AlunoId = $AlunoId;
  $this->EscolaId = $EscolaId;
  $this->CursoId = $CursoId;

        }
        
 if(!empty($this->AulaId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
