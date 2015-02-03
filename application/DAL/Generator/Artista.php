<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 03/02/2015 14:52:07
*/

namespace DAL;

class Artista
{
    /**
                     * @PrimaryKey
                     * @Name: ArtistaId
                     * @Type: int(255)
                     */
 var $ArtistaId = 0;

/**
                 * @Name: Titulo
                 * @Type: varchar(255)
                 */
 var $Titulo;

/**
                 * @Name: Descricao
                 * @Type: text
                 */
 var $Descricao;

/**
                 * @Name: Imagem
                 * @Type: varchar(255)
                 */
 var $Imagem;

/**
                 * @Name: Ativo
                 * @Type: tinyint(1)
                 */
 var $Ativo = 0;

/**
                 * @Name: md5
                 * @Type: varchar(32)
                 */
 var $md5;

/**
                 * @Name: Visitas
                 * @Type: int(255)
                 */
 var $Visitas = 0;

/**
                 * @Name: mbid
                 * @Type: varchar(255)
                 */
 var $mbid;

/**
                 * @Name: AplicacaoId
                 * @Type: int(255)
                 */
 var $AplicacaoId = 0;

/**
                 * @Name: Relacionados
                 * @Type: varchar(255)
                 */
 var $Relacionados;


    function __construct($ArtistaId = "",$Titulo = "",$Descricao = "",$Imagem = "",$Ativo = "",$md5 = "",$Visitas = "",$mbid = "",$AplicacaoId = "",$Relacionados = ""){
        

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
