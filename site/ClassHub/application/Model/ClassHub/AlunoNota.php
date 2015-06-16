<?php

/**
* Model
* @author: Gerador de Classe
* @date: 20/04/2015 12:10:36
*/

namespace Model\ClassHub;

use Libs\UnitofWork;

class AlunoNota
{
    
/**
                 * @Name: AlunoNotaId
                 * @DisplayName: AlunoNotaId
                 * @Type: int(11)
                 */
 var $AlunoNotaId = 0;

/**
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


    function __construct($AlunoNotaId = "",$AlunoId = "",$AvaliacaoId = "",$Nota = ""){
        

            $unitofwork = new UnitofWork();

            if(!empty($AlunoId)){
            
  $this->AlunoNotaId = $AlunoNotaId;
  $this->AlunoId = $AlunoId;
  $this->AvaliacaoId = $AvaliacaoId;
  $this->Nota = $Nota;

        }
        
 if(!empty($this->AlunoNotaId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
