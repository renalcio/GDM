<?php

/**
 * Model
 * @author: Gerador de Classe
 * @date: 20/04/2015 12:10:37
 */

namespace Model\ClassHub;

use Libs\UnitofWork;

class CanalSocial
{
    /**
     * @PrimaryKey
     * @Name: CanalSocialId
     * @DisplayName: CanalSocialId
     * @Type: int(11)
     */
    var $CanalSocialId = 0;

    /**
     * @Name: EscolaId
     * @DisplayName: Escola
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
     * @Name: CursoId
     * @DisplayName: Curso
     * @Type: int(11)
     */
    var $CursoId = 0;

    /**
     * @Name: Tipo
     * @DisplayName: Tipo
     * @Type: varchar(255)
     */
    var $Tipo;

    /**
     * @Name: Login
     * @DisplayName: Login
     * @Type: varchar(255)
     */
    var $Login;

    /**
     * @Name: Senha
     * @DisplayName: Senha
     * @Type: varchar(255)
     */
    var $Senha;

    /**
     * @Name: Url
     * @DisplayName: Url
     * @Type: varchar(255)
     */
    var $Url;

    /**
     * @NotMapped
     */
    var $Escola;

    /**
     * @NotMapped
     */
    var $Turma;

    /**
     * @NotMapped
     */
    var $Curso;




    function __construct($CanalSocialId = "",$TurmaId = "",$Tipo = "",$Url = "", $EscolaId = "", $Login = "",
                         $Senha = "", $CursoId = ""){


        $unitofwork = new UnitofWork();

        if(!empty($TurmaId)){

            $this->CanalSocialId = $CanalSocialId;
            $this->TurmaId = $TurmaId;
            $this->EscolaId = $EscolaId;
            $this->Tipo = $Tipo;
            $this->Url = $Url;
            $this->Login = $Login;
            $this->Senha = $Senha;
            $this->CursoId = $CursoId;

        }

        if(!empty($this->CanalSocialId)){

            //Virtuais e Referencias
            if($this->EscolaId > 0)
                $this->Escola = $unitofwork->GetById(new Escola(), $this->EscolaId);

            if($this->TurmaId > 0)
                $this->Turma = $unitofwork->GetById(new Turma(), $this->TurmaId);

            if($this->CursoId > 0)
                $this->Curso = $unitofwork->GetById(new Curso(), $this->CursoId);

        }

    }
}
