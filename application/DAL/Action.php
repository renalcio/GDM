<?php

/**
 * DAL
 * @author: Gerador de Classe
 * @date: 18/03/2015 16:18:49
 */

namespace DAL;

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
     * @Name: ModuloId
     * @DisplayName: Módulo
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
     * @Name: Publico
     * @DisplayName: Público
     * @Type: tinyint(4)
     */
    var $Publico = 0;

    /**
     * @Name: Descricao
     * @DisplayName: Descrição
     * @Type: varchar(255)
     */
    var $Descricao;



    function __construct($ActionId = "",$ModuloId = "",$Titulo = "",$Publico = "",$Descricao = ""){


        $unitofwork = new UnitofWork();

        if(!empty($ModuloId)){

            $this->ActionId = $ActionId;
            $this->ModuloId = $ModuloId;
            $this->Titulo = $Titulo;
            $this->Publico = $Publico;
            $this->Descricao = $Descricao;

        }

        if(!empty($this->ActionId)){

            //Virtuais e Referencias

        }

    }
}
