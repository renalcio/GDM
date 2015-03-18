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
     * @Name: Handler
     * @DisplayName: Handler
     * @Type: tinyint(1)
     */
    var $Handler;

    /** NOTMAPED */

    /**
     * @NotMapped
     */
    var $ListAction;

    function __construct($ModuloId = "",$Titulo = "",$Descricao = "",$Handler = 0){


        $unitofwork = new UnitofWork();

        if(!empty($AplicacaoId)){

            $this->ModuloId = $ModuloId;
            $this->Titulo = $Titulo;
            $this->Descricao = $Descricao;
            $this->Handler = $Handler;

        }else{
            $this->Handler = 0;
            $this->ListAction = new ListHelper();
        }

        if(!empty($this->ModuloId)){

            //Virtuais e Referencias
            $this->ListAction = $unitofwork->Get(new Action(), "ModuloId = '".$this->ModuloId."'")->ToList();


        }

    }
}
