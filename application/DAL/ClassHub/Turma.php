<?php

/**
 * DAL
 * @author: Gerador de Classe
 * @date: 20/04/2015 12:10:38
 */

namespace DAL\ClassHub;

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
     * @DisplayName: Curso
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

    /**
     * @NotMapped
     */
    var $Curso;


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
            if(!empty($this->CursoId))
                $this->Curso = $unitofwork->GetById(new Curso(), $this->CursoId);


        }

    }
}
