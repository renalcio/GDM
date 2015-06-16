<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 16/06/2015 17:15:19
*/

namespace Model;

use Libs\UnitofWork;

class PessoaFisica
{
    /**
                     * @PrimaryKey
                     * @Name: CPF
                     * @DisplayName: CPF
                     * @Type: varchar(50)
                     */
 var $CPF = 0;

/**
                 * @Name: Nascimento
                 * @DisplayName: Nascimento
                 * @Type: varchar(50)
                 */
 var $Nascimento;

/**
                 * @Name: RG
                 * @DisplayName: RG
                 * @Type: varchar(255)
                 */
 var $RG;

/**
                 * @Name: EstadoCivil
                 * @DisplayName: EstadoCivil
                 * @Type: varchar(50)
                 */
 var $EstadoCivil;

/**
                 * @Name: Nacionalidade
                 * @DisplayName: Nacionalidade
                 * @Type: varchar(100)
                 */
 var $Nacionalidade;

/**
                 * @Name: Sexo
                 * @DisplayName: Sexo
                 * @Type: varchar(50)
                 */
 var $Sexo;

/**
                 * @Name: PessoaId
                 * @DisplayName: PessoaId
                 * @Type: int(11)
                 */
 var $PessoaId = 0;


    function __construct($CPF = "",$Nascimento = "",$RG = "",$EstadoCivil = "",$Nacionalidade = "",$Sexo = "",$PessoaId = ""){
        

            $unitofwork = new UnitofWork();

            if(!empty($Nascimento)){
            
  $this->CPF = $CPF;
  $this->Nascimento = $Nascimento;
  $this->RG = $RG;
  $this->EstadoCivil = $EstadoCivil;
  $this->Nacionalidade = $Nacionalidade;
  $this->Sexo = $Sexo;
  $this->PessoaId = $PessoaId;

        }
        
 if(!empty($this->CPF)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
