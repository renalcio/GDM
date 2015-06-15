<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 15/06/2015 16:53:14
*/

namespace Model\ClassHub;

use Libs\UnitofWork;

class Curso
{
    /**
                     * @PrimaryKey
                     * @Name: CursoId
                     * @DisplayName: CursoId
                     * @Type: int(11)
                     */
 var $CursoId = 0;

/**
                 * @Name: EscolaId
                 * @DisplayName: EscolaId
                 * @Type: int(11)
                 */
 var $EscolaId = 0;

/**
                 * @Name: Titulo
                 * @DisplayName: Titulo
                 * @Type: varchar(255)
                 */
 var $Titulo;


    function __construct($CursoId = "",$EscolaId = "",$Titulo = ""){
        

            $unitofwork = new UnitofWork();

            if(!empty($EscolaId)){
            
  $this->CursoId = $CursoId;
  $this->EscolaId = $EscolaId;
  $this->Titulo = $Titulo;

        }
        
 if(!empty($this->CursoId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
