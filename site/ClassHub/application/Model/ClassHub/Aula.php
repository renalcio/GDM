<?php

/**
 * Model
 * @author: Gerador de Classe
 * @date: 20/04/2015 12:10:36
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
     * @DisplayName: Matéria
     * @Type: int(11)
     * @Required
     */
    var $MateriaId = 0;

    /**
     * @Name: TurmaId
     * @DisplayName: Turma
     * @Type: int(11)
     * @Required
     */
    var $TurmaId = 0;

    /**
     * @Name: ProfessorId
     * @DisplayName: Professor
     * @Type: int(11)
     */
    var $ProfessorId = 0;

    /**
     * @Name: Data
     * @DisplayName: Data
     * @Type: varchar(100)
     * @Required
     */
    var $Data;

    /**
     * @Name: HoraDe
     * @DisplayName: Início
     * @Type: varchar(50)
     * @Required
     */
    var $HoraDe;

    /**
     * @Name: HoraAte
     * @DisplayName: Fim
     * @Type: varchar(50)
     * @Required
     */
    var $HoraAte;

    /**
     * @Name: Titulo
     * @DisplayName: Titulo
     * @Type: varchar(255)
     * @Required
     */
    var $Titulo;

    /**
     * @Name: Conteudo
     * @DisplayName: Conteúdo
     * @Type: text
     */
    var $Conteudo;

    /**
     * @Name: Sala
     * @DisplayName: Sala
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
     * @DisplayName: Escola
     * @Type: int(11)
     */
    var $EscolaId = 0;

    /**
     * @Name: CursoId
     * @DisplayName: Curso
     * @Type: int(11)
     */
    var $CursoId = 0;

    /**
     * @Name: Compartilhado
     * @DisplayName: Compartilhar com a turma (+10 pontos)
     * @Type: tiny(1)
     */
    var $Compartilhado = 0;

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

    /**
     * @NotMapped
     */
    var $Curso;

    /**
     * @NotMapped
     */
    var $Escola;

    /**
     * @NotMapped
     */
    var $arquivo;

    /**
     * @NotMapped
     */
    var $ListAulaArquivo;

    /**
     * @NotMapped
     */
    var $Turma;


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
        }

        if(empty($this->Data))
            $this->Data = date("d/m/Y", time());

        $this->Aluno = new Aluno();
        $this->Materia = new Materia();
        $this->Professor = new Professor();
        $this->Escola = new Escola();
        $this->Curso = new Curso();
        $this->Turma = new Turma();

        if(!empty($this->AulaId)){

            //Virtuais e Referencias

            if(!empty($this->AlunoId))
                $this->Aluno = $unitofwork->GetById(new Aluno(), $this->AlunoId);

            if(!empty($this->ProfessorId))
                $this->Professor = $unitofwork->GetById(new Professor(), $this->ProfessorId);

            if(!empty($this->MateriaId))
                $this->Materia = $unitofwork->GetById(new Materia(), $this->MateriaId);


            if(!empty($this->CursoId))
                $this->Curso = $unitofwork->GetById(new Curso(), $this->CursoId);

            if(!empty($this->EscolaId))
                $this->Escola = $unitofwork->GetById(new Escola(), $this->EscolaId);

            if(!empty($this->TurmaId))
                $this->Turma = $unitofwork->GetById(new Turma(), $this->TurmaId);

        }

    }
}
