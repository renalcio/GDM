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
     * @DisplayName: Matéria
     * @Type: int(11)
     */
    var $MateriaId = 0;

    /**
     * @Name: CursoId
     * @DisplayName: Curso
     * @Type: int(11)
     */
    var $CursoId = 0;

    /**
     * @Name: EscolaId
     * @DisplayName: Escola
     * @Type: int(11)
     */
    var $EscolaId = 0;

    /**
     * @Name: DiaSemana
     * @DisplayName: Dia da Semana
     * @Type: varchar(255)
     */
    var $DiaSemana;

    /**
     * @Name: HoraDe
     * @DisplayName: De
     * @Type: varchar(50)
     */
    var $HoraDe;

    /**
     * @Name: HoraAte
     * @DisplayName: Até
     * @Type: varchar(50)
     */
    var $HoraAte;

    /**
     * @NotMapped
     */
    var $Escola;

    /**
     * @NotMapped
     */
    var $Curso;

    /**
     * @NotMapped
     */
    var $Materia;



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
            if(!empty($this->EscolaId))
                $this->Escola = $unitofwork->GetById(new Escola(), $this->EscolaId);

            if(!empty($this->CursoId))
                $this->Curso = $unitofwork->GetById(new Curso(), $this->CursoId);

            if(!empty($this->MateriaId))
                $this->Materia = $unitofwork->GetById(new Materia(), $this->MateriaId);

        }

    }
}
