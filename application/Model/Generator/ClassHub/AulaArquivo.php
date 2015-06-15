<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 15/06/2015 16:53:14
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
                 * @Type: varchar(255)
                 */
 var $Tamanho;

/**
                 * @Name: Tipo
                 * @DisplayName: Tipo
                 * @Type: varchar(50)
                 */
 var $Tipo;


    function __construct($AulaArquivoId = "",$AulaId = "",$Titulo = "",$Url = "",$PessoaId = "",$Tamanho = "",$Tipo = ""){
        

            $unitofwork = new UnitofWork();

            if(!empty($AulaId)){
            
  $this->AulaArquivoId = $AulaArquivoId;
  $this->AulaId = $AulaId;
  $this->Titulo = $Titulo;
  $this->Url = $Url;
  $this->PessoaId = $PessoaId;
  $this->Tamanho = $Tamanho;
  $this->Tipo = $Tipo;

        }
        
 if(!empty($this->AulaArquivoId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
