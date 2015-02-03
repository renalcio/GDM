<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 03/02/2015 14:52:07
*/

namespace DAL;

class PessoaFisica
{
    /**
                     * @PrimaryKey
                     * @Name: CPF
                     * @Type: varchar(50)
                     */
 var $CPF = 0;

/**
                 * @Name: Nascimento
                 * @Type: varchar(50)
                 */
 var $Nascimento;

/**
                 * @Name: RG
                 * @Type: varchar(255)
                 */
 var $RG;

/**
                 * @Name: EstadoCivil
                 * @Type: varchar(50)
                 */
 var $EstadoCivil;

/**
                 * @Name: Nacionalidade
                 * @Type: varchar(100)
                 */
 var $Nacionalidade;

/**
                 * @Name: Sexo
                 * @Type: varchar(50)
                 */
 var $Sexo;

/**
                 * @Name: PessoaId
                 * @Type: int(11)
                 */
 var $PessoaId = 0;


    function __construct($CPF = "",$Nascimento = "",$RG = "",$EstadoCivil = "",$Nacionalidade = "",$Sexo = "",$PessoaId = ""){
        

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
