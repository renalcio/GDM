<?php

/**
 * DAL
 * @author: Gerador de Classe
 * @date: 10/02/2015 15:04:12
 */

namespace DAL;

use Libs\Database;

class Pais
{
    /**
     * @PrimaryKey
     * @Name: PaisId
     * @DisplayName: PaisId
     * @Type: tinyint(3) unsigned
     */
    var $PaisId = 0;

    /**
     * @Name: Nome
     * @DisplayName: Nome
     * @Type: varchar(50)
     */
    var $Nome;

    /**
     * @Name: Name
     * @DisplayName: Name
     * @Type: varchar(50)
     */
    var $Name;


    function __construct($PaisId = "",$Nome = "",$Name = ""){


        $pdo = new Database();

        if(!empty($Nome)){

            $this->PaisId = $PaisId;
            $this->Nome = $Nome;
            $this->Name = $Name;

        }

        if(!empty($this->PaisId)){

            //Virtuais e Referencias



        }

    }
}
