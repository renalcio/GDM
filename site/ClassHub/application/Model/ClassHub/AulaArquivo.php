<?php

/**
 * Model
 * @author: Gerador de Classe
 * @date: 20/04/2015 12:10:36
 */

namespace Model\ClassHub;

use Libs\UnitofWork;

class AulaArquivo
{
    /**
     * @PrimaryKey
     * @Name: AulaArquivoId
     * @DisplayName: AulaArquivoId
     * @Type: int(11)
     */
    var $AulaArquivoId = 0;

    /**
     * @Name: AulaId
     * @DisplayName: AulaId
     * @Type: int(11)
     */
    var $AulaId = 0;

    /**
     * @Name: Titulo
     * @DisplayName: Titulo
     * @Type: varchar(255)
     */
    var $Titulo;

    /**
     * @Name: Url
     * @DisplayName: Url
     * @Type: varchar(255)
     */
    var $Url;

    /**
     * @Name: PessoaId
     * @DisplayName: PessoaId
     * @Type: int(11)
     */
    var $PessoaId = 0;

    /**
     * @Name: Tamanho
     * @DisplayName: Tamanho
     * @Type: float
     */
    var $Tamanho = 0;

    /**
     * @Name: Tipo
     * @DisplayName: Tipo de Arquivo
     * @Type: float
     */
    var $Tipo = null;

    /**
     * @notMapped
     */
    var $Pessoa;

    /**
     * @notMapped
     */
    var $img;


    function __construct($AulaArquivoId = "",$AulaId = "",$Titulo = "",$Url = "",$PessoaId = ""){


        $unitofwork = new UnitofWork();

        if(!empty($AulaId)){

            $this->AulaArquivoId = $AulaArquivoId;
            $this->AulaId = $AulaId;
            $this->Titulo = $Titulo;
            $this->Url = $Url;
            $this->PessoaId = $PessoaId;

        }

        if(!empty($this->AulaArquivoId)){

            //Virtuais e Referencias



        }

    }
}
