<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 15/06/2015 16:53:14
*/

namespace Model\ClassHub;

use Libs\UnitofWork;

class Aluno
{
    /**
                     * @PrimaryKey
                     * @Name: AlunoId
                     * @DisplayName: AlunoId
                     * @Type: int(11)
                     */
 var $AlunoId = 0;

/**
                 * @Name: PessoaId
                 * @DisplayName: PessoaId
                 * @Type: int(11)
                 */
 var $PessoaId = 0;

/**
                 * @Name: TurmaId
                 * @DisplayName: TurmaId
                 * @Type: int(11)
                 */
 var $TurmaId = 0;

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
                 * @Name: Representante
                 * @DisplayName: Representante
                 * @Type: tinyint(4)
                 */
 var $Representante = 0;

/**
                 * @Name: EscolaId
                 * @DisplayName: EscolaId
                 * @Type: int(11)
                 */
 var $EscolaId = 0;


    function __construct($AlunoId = "",$PessoaId = "",$TurmaId = "",$ChaveRegistro = "",$Registrado = "",$Representante = "",$EscolaId = ""){
        

            $unitofwork = new UnitofWork();

            if(!empty($PessoaId)){
            
  $this->AlunoId = $AlunoId;
  $this->PessoaId = $PessoaId;
  $this->TurmaId = $TurmaId;
  $this->ChaveRegistro = $ChaveRegistro;
  $this->Registrado = $Registrado;
  $this->Representante = $Representante;
  $this->EscolaId = $EscolaId;

        }
        
 if(!empty($this->AlunoId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
