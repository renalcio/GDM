<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 15/06/2015 16:53:14
*/

namespace Model\ClassHub;

use Libs\UnitofWork;

class AlunoNota
{
    /**
                     * @PrimaryKey
                     * @Name: AlunoId
                     * @DisplayName: AlunoId
                     * @Type: int(11)
                     */
 var $AlunoId = 0;

/**
                 * @Name: AvaliacaoId
                 * @DisplayName: AvaliacaoId
                 * @Type: int(11)
                 */
 var $AvaliacaoId = 0;

/**
                 * @Name: Nota
                 * @DisplayName: Nota
                 * @Type: float
                 */
 var $Nota;

/**
                 * @Name: AlunoNotaId
                 * @DisplayName: AlunoNotaId
                 * @Type: int(11)
                 */
 var $AlunoNotaId = 0;


    function __construct($AlunoId = "",$AvaliacaoId = "",$Nota = "",$AlunoNotaId = ""){
        

            $unitofwork = new UnitofWork();

            if(!empty($AvaliacaoId)){
            
  $this->AlunoId = $AlunoId;
  $this->AvaliacaoId = $AvaliacaoId;
  $this->Nota = $Nota;
  $this->AlunoNotaId = $AlunoNotaId;

        }
        
 if(!empty($this->AlunoId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
