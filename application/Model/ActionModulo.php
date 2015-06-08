<?php

/**
 * Model
 * @author: Gerador de Classe
 * @date: 19/03/2015 20:42:52
 */

namespace Model;

use Libs\UnitofWork;

class ActionModulo
{
    /**
     * @PrimaryKey
     * @Name: ActionModuloId
     * @DisplayName: ActionModuloId
     * @Type: int(11)
     */
    var $ActionModuloId = 0;

    /**
     * @Name: ActionId
     * @DisplayName: ActionId
     * @Type: int(11)
     */
    var $ActionId = 0;

    /**
     * @Name: ModuloId
     * @DisplayName: ModuloId
     * @Type: int(11)
     */
    var $ModuloId = 0;

    /**
     * @Name: Publico
     * @DisplayName: Publico
     * @Type: tinyint(4)
     */
    var $Publico = 0;

    /** NotMapped */

    /**
     * @NotMapped
     */
    var $Action;

    /**
     * @NotMapped
     */
    var $Modulo;


    function __construct($ActionModuloId = 0,$ActionId = "",$ModuloId = "",$Publico = ""){


        $unitofwork = new UnitofWork();

        if(!empty($ActionId)){

            $this->ActionModuloId = $ActionModuloId;
            $this->ActionId = $ActionId;
            $this->ModuloId = $ModuloId;
            $this->Publico = $Publico;

        }

        if(!empty($this->ActionModuloId)){

            //Virtuais e Referencias
            if(!empty($this->ActionId))
                $this->Action = $unitofwork->GetById(new Action(), $this->ActionId);

            if(!empty($this->ModuloId))
                $this->Modulo = $unitofwork->GetById(new Modulo(), $this->ModuloId);


        }

    }
}
