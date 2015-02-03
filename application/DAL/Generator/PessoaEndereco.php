<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 03/02/2015 14:52:07
*/

namespace DAL;

class PessoaEndereco
{
    /**
                     * @PrimaryKey
                     * @Name: PessoaId
                     * @Type: int(11)
                     */
 var $PessoaId = 0;

/**
                 * @Name: Rua
                 * @Type: varchar(255)
                 */
 var $Rua;

/**
                 * @Name: Numero
                 * @Type: varchar(20)
                 */
 var $Numero;

/**
                 * @Name: Bairro
                 * @Type: varchar(100)
                 */
 var $Bairro;

/**
                 * @Name: Cidade
                 * @Type: varchar(200)
                 */
 var $Cidade;

/**
                 * @Name: EstadoId
                 * @Type: int(11)
                 */
 var $EstadoId = 0;

/**
                 * @Name: PaisId
                 * @Type: int(11)
                 */
 var $PaisId = 0;

/**
                 * @Name: Titulo
                 * @Type: varchar(255)
                 */
 var $Titulo;

/**
                 * @Name: Apagado
                 * @Type: tinyint(4)
                 */
 var $Apagado = 0;


    function __construct($PessoaId = "",$Rua = "",$Numero = "",$Bairro = "",$Cidade = "",$EstadoId = "",$PaisId = "",$Titulo = "",$Apagado = ""){
        

        if(!empty($Rua)){
        
  $this->PessoaId = $PessoaId;
  $this->Rua = $Rua;
  $this->Numero = $Numero;
  $this->Bairro = $Bairro;
  $this->Cidade = $Cidade;
  $this->EstadoId = $EstadoId;
  $this->PaisId = $PaisId;
  $this->Titulo = $Titulo;
  $this->Apagado = $Apagado;

        }
        
 if(!empty($this->PessoaId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
