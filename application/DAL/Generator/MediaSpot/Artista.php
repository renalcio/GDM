<?php

/**
 * DAL
 * @author: Gerador de Classe
 * @date: 09/02/2015 18:51:58
 */

namespace DAL\MediaSpot;

use Libs\Database;

class Artista
{
    /**
     * @PrimaryKey
     * @Name: ArtistaId
     * @DisplayName: ArtistaId
     * @Type: int(255)
     */
    var $ArtistaId = 0;

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
     * @Name: Imagem
     * @DisplayName: Imagem
     * @Type: varchar(255)
     */
    var $Imagem;

    /**
     * @Name: Ativo
     * @DisplayName: Ativo
     * @Type: tinyint(1)
     */
    var $Ativo = 0;

    /**
     * @Name: md5
     * @DisplayName: md5
     * @Type: varchar(32)
     */
    var $md5;

    /**
     * @Name: Visitas
     * @DisplayName: Visitas
     * @Type: int(255)
     */
    var $Visitas = 0;

    /**
     * @Name: mbid
     * @DisplayName: mbid
     * @Type: varchar(255)
     */
    var $mbid;

    /**
     * @Name: AplicacaoId
     * @DisplayName: AplicacaoId
     * @Type: int(255)
     */
    var $AplicacaoId = 0;

    /**
     * @Name: Relacionados
     * @DisplayName: Relacionados
     * @Type: varchar(255)
     */
    var $Relacionados;


    function __construct($ArtistaId = "",$Titulo = "",$Descricao = "",$Imagem = "",$Ativo = "",$md5 = "",$Visitas = "",$mbid = "",$AplicacaoId = "",$Relacionados = ""){


        $pdo = new Database();

        if(!empty($Titulo)){

            $this->ArtistaId = $ArtistaId;
            $this->Titulo = $Titulo;
            $this->Descricao = $Descricao;
            $this->Imagem = $Imagem;
            $this->Ativo = $Ativo;
            $this->md5 = $md5;
            $this->Visitas = $Visitas;
            $this->mbid = $mbid;
            $this->AplicacaoId = $AplicacaoId;
            $this->Relacionados = $Relacionados;

        }

        if(!empty($this->ArtistaId)){

            //Virtuais e Referencias



        }

    }
}
