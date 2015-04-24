<?php

/**
 * DAL
 * @author: Gerador de Classe
 * @date: 20/04/2015 12:10:36
 */

namespace DAL\ClassHub;

use DAL\Pessoa;
use Libs\UnitofWork;

class Aluno
{
    /**
     * @PrimaryKey
     * @Name: AlunoId
     * @DisplayName: AlunoId
     * @Type: int(11)
     */
    var $AlunoId = 0;

    /**
     * @Name: PessoaId
     * @DisplayName: PessoaId
     * @Type: int(11)
     */
    var $PessoaId = 0;

    /**
     * @Name: PessoaId
     * @DisplayName: PessoaId
     * @Type: int(11)
     */
    var $EscolaId = 0;

    /**
     * @Name: TurmaId
     * @DisplayName: Turma
     * @Type: int(11)
     */
    var $TurmaId = 0;

    /**
     * @Name: ChaveRegistro
     * @DisplayName: Chave de Registro
     * @Type: varchar(255)
     */
    var $ChaveRegistro;

    /**
     * @Name: Registrado
     * @DisplayName: Usuário Registrado?
     * @Type: tinyint(4)
     */
    var $Registrado = 0;

    /**
     * @Name: Representante
     * @DisplayName: Representante de sala
     * @Type: tinyint(4)
     */
    var $Representante = 0;

    /**
     * @NotMapped
     */
    var $Pessoa;
    /**
     * @NotMapped
     */
    var $Turma;
    /**
     * @NotMapped
     */
    var $Escola;


    function __construct($AlunoId = "",$PessoaId = "",$TurmaId = "",$ChaveRegistro = "",$Registrado = "",$Representante = ""){


        $unitofwork = new UnitofWork();

        if(!empty($PessoaId)){

            $this->AlunoId = $AlunoId;
            $this->PessoaId = $PessoaId;
            $this->TurmaId = $TurmaId;
            $this->ChaveRegistro = $ChaveRegistro;
            $this->Registrado = $Registrado;
            $this->Representante = $Representante;

        }

        if(!empty($this->AlunoId)){

            //Virtuais e Referencias
            if(!empty($this->PessoaId))
                $this->Pessoa = $unitofwork->GetById(new Pessoa(), $this->PessoaId);
            else
                $this->Pessoa = new Pessoa();

            if(!empty($this->TurmaId)) {
                $this->Turma = $unitofwork->GetById(new Turma(), $this->TurmaId);
                $this->Escola = $unitofwork->GetById(new Escola(), $this->Turma->Curso->EscolaId);
            }
            else {
                $this->Turma = new Turma();
                $this->Escola = new Escola();
            }

        }

    }
}
