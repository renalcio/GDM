<?php

/**
 * DAL
 * @author: Gerador de Classe
 * @date: 15/06/2015 16:53:14
 */

namespace Model\ClassHub;

use Libs\UnitofWork;

class Aviso
{
    /**
     * @PrimaryKey
     * @Name: AvisoId
     * @DisplayName: AvisoId
     * @Type: int(11)
     */
    var $AvisoId = 0;

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

    /**
     * @Name: DataAte
     * @DisplayName: DataAte
     * @Type: int(11)
     */
    var $DataAte = 0;

    /**
     * @Name: DataDe
     * @DisplayName: DataDe
     * @Type: int(11)
     */
    var $DataDe = 0;

    /**
     * @Name: TurmaId
     * @DisplayName: TurmaId
     * @Type: int(11)
     */
    var $TurmaId = 0;

    /**
     * @Name: Titulo
     * @DisplayName: Titulo
     * @Type: varchar(255)
     */
    var $Titulo;

    /**
     * @Name: Descricao
     * @DisplayName: Descricao
     * @Type: text
     */
    var $Descricao;

    /**
     * @Name: Tipo
     * @DisplayName: Tipo de Notificação
     * @Type: text
     */
    var $Tipo;

    /**
     * @Name: Alerta
     * @DisplayName: Alerta
     * @Type: tinyint(4)
     */
    var $Alerta = 0;

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

    /**
     * @DisplayName: Data Inicial
     * @NotMapped
     */
    var $txDataDe;

    /**
     * @DisplayName: Data Final
     * @NotMapped
     */
    var $txDataAte;


    function __construct($AvisoId = "",$EscolaId = "",$CursoId = "",$TurmaId = "",$Titulo = "",$Descricao = "",$Alerta = ""){


        $unitofwork = new UnitofWork();

        if(!empty($EscolaId)){

            $this->AvisoId = $AvisoId;
            $this->EscolaId = $EscolaId;
            $this->CursoId = $CursoId;
            $this->TurmaId = $TurmaId;
            $this->Titulo = $Titulo;
            $this->Descricao = $Descricao;
            $this->Alerta = $Alerta;

        }

        if(!empty($this->AvisoId)){

            //Virtuais e Referencias
            if($this->EscolaId > 0)
                $this->Escola = $unitofwork->GetById(new Escola(), $this->EscolaId);

            if($this->TurmaId > 0)
                $this->Turma = $unitofwork->GetById(new Turma(), $this->TurmaId);

            if($this->CursoId > 0)
                $this->Curso = $unitofwork->GetById(new Curso(), $this->CursoId);
        }

        if(!empty($this->DataAte)){
            $this->txDataAte = date("d/m/Y", $this->DataAte);
        }else{
            $this->txDataAte = date("d/m/Y", time());
        }

        if(!empty($this->DataDe)){
            $this->txDataDe = date("d/m/Y", $this->DataDe);
        }else{
            $this->txDataDe = date("d/m/Y", time());
        }

    }
}
