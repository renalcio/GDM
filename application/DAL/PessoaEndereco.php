<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 10/02/2015 15:04:13
*/

namespace DAL;

use Libs\Database;

class PessoaEndereco
{
    /**
                     * @PrimaryKey
                     * @Name: PessoaId
                     * @DisplayName: PessoaId
                     * @Type: int(11)
                     */
 var $PessoaId = 0;

/**
                 * @Name: Rua
                 * @DisplayName: Rua
                 * @Type: varchar(255)
                 */
 var $Rua;

/**
                 * @Name: Numero
                 * @DisplayName: Numero
                 * @Type: varchar(20)
                 */
 var $Numero;

/**
                 * @Name: Bairro
                 * @DisplayName: Bairro
                 * @Type: varchar(100)
                 */
 var $Bairro;

/**
                 * @Name: Cidade
                 * @DisplayName: Cidade
                 * @Type: varchar(200)
                 */
 var $Cidade;

/**
                 * @Name: EstadoId
                 * @DisplayName: EstadoId
                 * @Type: int(11)
                 */
 var $EstadoId = 0;

/**
                 * @Name: PaisId
                 * @DisplayName: PaisId
                 * @Type: int(11)
                 */
 var $PaisId = 0;

/**
                 * @Name: Titulo
                 * @DisplayName: Titulo
                 * @Type: varchar(255)
                 */
 var $Titulo;

/**
                 * @Name: Apagado
                 * @DisplayName: Apagado
                 * @Type: tinyint(4)
                 */
 var $Apagado = 0;


    function __construct($PessoaId = "",$Rua = "",$Numero = "",$Bairro = "",$Cidade = "",$EstadoId = "",$PaisId = "",$Titulo = "",$Apagado = ""){
        

            $pdo = new Database();

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
