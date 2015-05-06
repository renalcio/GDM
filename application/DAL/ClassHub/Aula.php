<?php

/**
 * DAL
 * @author: Gerador de Classe
 * @date: 20/04/2015 12:10:36
 */

namespace DAL\ClassHub;

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
    * @NotMapped
    */
    var $Aluno;

    /**
    * @NotMapped
    */
    var $Materia;

    /**
    * @NotMapped
    */
    var $Professor;



    function __construct($AulaId = "",$MateriaId = "",$TurmaId = "",$ProfessorId = "",$Data = "",$HoraDe = "",$HoraAte = "",$Titulo = "",$Conteudo = "",$Sala = "",$PessoaId = ""){


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
            $this->PessoaId = $PessoaId;
            $this->Aluno = new Aluno();
            $this->Materia = new Materia();
            $this->Professor = new Professor();

        }

        if(!empty($this->AulaId)){

            //Virtuais e Referencias

            if(!empty($this->AlunoId))
                $this->Aluno = $unitofwork->GetById(new Aluno(), $this->AlunoId);

            if(!empty($this->ProfessorId))
                $this->Professor = $unitofwork->GetById(new Professor(), $this->ProfessorId);

            if(!empty($this->MateriaId))
                $this->Materia = $unitofwork->GetById(new Materia(), $this->MateriaId);

        }

    }
}
