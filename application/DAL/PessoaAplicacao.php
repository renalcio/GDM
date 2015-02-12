<?php

/**
 * DAL
 * @author: Gerador de Classe
 * @date: 12/02/2015 14:27:15
 */

namespace DAL;

use Libs\Database;

class PessoaAplicacao
{
    /**
     * @PrimaryKey
     * @Name: PessoaAplicacaoId
     * @DisplayName: PessoaAplicacaoId
     * @Type: int(11)
     */
    var $PessoaAplicacaoId = 0;

    /**
     * @Name: PessoaId
     * @DisplayName: PessoaId
     * @Type: int(11)
     */
    var $PessoaId = 0;

    /**
     * @Name: AplicacaoId
     * @DisplayName: AplicacaoId
     * @Type: int(11)
     */
    var $AplicacaoId = 0;

    /**
     * @Name: Apagado
     * @DisplayName: Apagado
     * @Type: tinyint(4)
     */
    var $Apagado = 0;


    function __construct($PessoaAplicacaoId = "",$PessoaId = "",$AplicacaoId = "",$Apagado = ""){


        $pdo = new Database();

        if(!empty($PessoaId)){

            $this->PessoaAplicacaoId = $PessoaAplicacaoId;
            $this->PessoaId = $PessoaId;
            $this->AplicacaoId = $AplicacaoId;
            $this->Apagado = $Apagado;

        }

        if(!empty($this->PessoaAplicacaoId)){

            //Virtuais e Referencias



        }

    }
}
