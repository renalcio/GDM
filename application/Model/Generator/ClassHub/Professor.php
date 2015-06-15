<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 15/06/2015 16:53:14
*/

namespace Model\ClassHub;

use Libs\UnitofWork;

class Professor
{
    /**
                     * @PrimaryKey
                     * @Name: ProfessorId
                     * @DisplayName: ProfessorId
                     * @Type: int(11)
                     */
 var $ProfessorId = 0;

/**
                 * @Name: PessoaId
                 * @DisplayName: PessoaId
                 * @Type: int(11)
                 */
 var $PessoaId = 0;

/**
                 * @Name: ChaveRegistro
                 * @DisplayName: ChaveRegistro
                 * @Type: varchar(255)
                 */
 var $ChaveRegistro;

/**
                 * @Name: Registrado
                 * @DisplayName: Registrado
                 * @Type: tinyint(4)
                 */
 var $Registrado = 0;

/**
                 * @Name: EscolaId
                 * @DisplayName: EscolaId
                 * @Type: int(11)
                 */
 var $EscolaId = 0;


    function __construct($ProfessorId = "",$PessoaId = "",$ChaveRegistro = "",$Registrado = "",$EscolaId = ""){
        

            $unitofwork = new UnitofWork();

            if(!empty($PessoaId)){
            
  $this->ProfessorId = $ProfessorId;
  $this->PessoaId = $PessoaId;
  $this->ChaveRegistro = $ChaveRegistro;
  $this->Registrado = $Registrado;
  $this->EscolaId = $EscolaId;

        }
        
 if(!empty($this->ProfessorId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
