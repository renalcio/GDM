<?php

/**
 * Model
 * @author: Gerador de Classe
 * @date: 20/04/2015 12:10:37
 */

namespace Model\ClassHub;

use Libs\UnitofWork;

class Avaliacao
{
    /**
     * @PrimaryKey
     * @Name: AvaliacaoId
     * @DisplayName: AvaliacaoId
     * @Type: int(11)
     */
    var $AvaliacaoId = 0;

    /**
     * @Name: MateriaId
     * @DisplayName: Matéria
     * @Type: int(11)
     */
    var $MateriaId = 0;

    /**
     * @Name: TurmaId
     * @DisplayName: Turma
     * @Type: int(11)
     */
    var $TurmaId = 0;

    /**
     * @Name: EscolaId
     * @DisplayName: Escola
     * @Type: int(11)
     */
    var $EscolaId = 0;

    /**
     * @Name: Titulo
     * @DisplayName: Título
     * @Type: varchar(255)
     */
    var $Titulo;

    /**
     * @Name: Data
     * @DisplayName: Data de Entrega
     * @Type: varchar(255)
     */
    var $Data;

    /**
     * @Name: DataCadastro
     * @DisplayName: Data de Cadastro
     * @Type: bigint(20)
     */
    var $DataCadastro = 0;

    /**
     * @Name: Peso
     * @DisplayName: Peso
     * @Type: int(11)
     */
    var $Peso = 0;

    /**
     * @Name: Descricao
     * @DisplayName: Descrição
     * @Type: text
     */
    var $Descricao;

    /**
     * @Name: Trabalho
     * @DisplayName: Tipo de avaliação
     * @Type: tinyint(1)
     */
    var $Trabalho = 0;

    /**
     * @Name: CursoId
     * @DisplayName: Curso
     * @Type: int(11)
     */
    var $CursoId = 0;

    /**
     * @Name: AlunoId
     * @DisplayName: Autor
     * @Type: int(11)
     */
    var $AlunoId = 0;

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
    var $Aluno;

    /**
     * @NotMapped
     */
    var $arquivo;

    /**
     * @NotMapped
     */
    var $ListArquivo;


    function __construct($AvaliacaoId = "",$MateriaId = "",$TurmaId = "",$Titulo = "",$Data = "",$DataCadastro = "",$Peso = "",$Descricao = "",$Trabalho = ""){


        $unitofwork = new UnitofWork();

        if(!empty($MateriaId)){

            $this->AvaliacaoId = $AvaliacaoId;
            $this->MateriaId = $MateriaId;
            $this->TurmaId = $TurmaId;
            $this->Titulo = $Titulo;
            $this->Data = $Data;
            $this->DataCadastro = $DataCadastro;
            $this->Peso = $Peso;
            $this->Descricao = $Descricao;
            $this->Trabalho = $Trabalho;

        }else{
            $this->Data = date("d/m/Y", time());
            $this->DataCadastro = date("d/m/Y", time());
        }

        $this->Aluno = new Aluno();
        $this->Materia = new Materia();
        $this->Professor = new Professor();
        $this->Escola = new Escola();
        $this->Curso = new Curso();

        if(!empty($this->AvaliacaoId)){

            //Virtuais e Referencias

            if(!empty($this->ProfessorId))
                $this->Professor = $unitofwork->GetById(new Professor(), $this->ProfessorId);

            if(!empty($this->MateriaId))
                $this->Materia = $unitofwork->GetById(new Materia(), $this->MateriaId);

            if(!empty($this->CursoId))
                $this->Curso = $unitofwork->GetById(new Curso(), $this->CursoId);

            if(!empty($this->EscolaId))
                $this->Escola = $unitofwork->GetById(new Escola(), $this->EscolaId);

            if(!empty($this->AlunoId))
                $this->Aluno = $unitofwork->GetById(new Aluno(), $this->AlunoId);

        }

    }
}
