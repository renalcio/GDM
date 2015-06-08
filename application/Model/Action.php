<?php

/**
 * Model
 * @author: Gerador de Classe
 * @date: 18/03/2015 16:18:49
 */

namespace Model;

use Libs\Database;
use Libs\UnitofWork;

class Action
{
    /**
     * @PrimaryKey
     * @Name: ActionId
     * @DisplayName: ActionId
     * @Type: int(11)
     */
    var $ActionId = 0;

    /**
     * @Name: Titulo
     * @DisplayName: Título
     * @Type: varchar(255)
     */
    var $Titulo;

    /**
     * @Name: Action
     * @DisplayName: Action
     * @Type: tinyint(4)
     */
    var $Handler = 0;

    /**
     * @Name: Descricao
     * @DisplayName: Descrição
     * @Type: varchar(255)
     */
    var $Descricao;



    function __construct($ActionId = "",$ModuloId = "",$Titulo = "",$Handler = 0,$Descricao = ""){


        $unitofwork = new UnitofWork();

        if(!empty($ModuloId)){

            $this->ActionId = $ActionId;
            $this->ModuloId = $ModuloId;
            $this->Titulo = $Titulo;
            $this->Handler = $Handler;
            $this->Descricao = $Descricao;

        }

        if(!empty($this->ActionId)){

            //Virtuais e Referencias

        }

    }
}
