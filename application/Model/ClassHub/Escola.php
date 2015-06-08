<?php

/**
 * Model
 * @author: Gerador de Classe
 * @date: 20/04/2015 12:10:37
 */

namespace Model\ClassHub;

use Libs\UnitofWork;

class Escola
{
    /**
     * @PrimaryKey
     * @Name: EscolaId
     * @DisplayName: EscolaId
     * @Type: int(11)
     */
    var $EscolaId = 0;

    /**
     * @Name: Nome
     * @DisplayName: Nome
     * @Type: varchar(255)
     */
    var $Nome;

    /**
     * @Name: Endereco
     * @DisplayName: Endereço
     * @Type: varchar(255)
     */
    var $Endereco;

    /**
     * @Name: Telefone
     * @DisplayName: Telefone
     * @Type: varchar(255)
     */
    var $Telefone;

    /**
     * @Name: Email
     * @DisplayName: Email
     * @Type: varchar(255)
     */
    var $Email;

    /**
     * @Name: Site
     * @DisplayName: Site
     * @Type: varchar(255)
     */
    var $Site;


    function __construct($EscolaId = "",$Nome = "",$Endereco = "",$Telefone = "",$Email = "",$Site = ""){


        $unitofwork = new UnitofWork();

        if(!empty($Nome)){

            $this->EscolaId = $EscolaId;
            $this->Nome = $Nome;
            $this->Endereco = $Endereco;
            $this->Telefone = $Telefone;
            $this->Email = $Email;
            $this->Site = $Site;

        }

        if(!empty($this->EscolaId)){

            //Virtuais e Referencias



        }

    }
}
