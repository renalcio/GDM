<?php

/**
 * DAL
 * @author: Gerador de Classe
 * @date: 18/03/2015 16:18:50
 */

namespace DAL;

use Libs\ListHelper;
use Libs\UnitofWork;

class Modulo
{
    /**
     * @PrimaryKey
     * @Name: ModuloId
     * @DisplayName: ModuloId
     * @Type: int(11)
     */
    var $ModuloId = 0;


    /**
     * @Name: Titulo
     * @DisplayName: Título
     * @Type: varchar(255)
     */
    var $Titulo;

    /**
     * @Name: Descricao
     * @DisplayName: Descrição
     * @Type: varchar(255)
     */
    var $Descricao;


    /**
     * @NotMapped
     */
    var $ListAction;

    /**
     * @NotMapped
     */
    var $ListActionModulo;


    function __construct($ModuloId = 0,$Titulo = "",$Descricao = ""){


        $unitofwork = new UnitofWork();

        if(!empty($Titulo)){

            $this->ModuloId = $ModuloId;
            $this->Titulo = $Titulo;
            $this->Descricao = $Descricao;

        }

        if(!empty($this->ModuloId)){

            //Virtuais e Referencias
           // $this->ListAction = $unitofwork->Get(new Action(), "ModuloId = ".$this->ModuloId)->ToList();

            //$this->ListActionModulo = $unitofwork->Get(new ActionModulo(), "ModuloId = ".$this->ModuloId)->ToList();


        }

    }
}
