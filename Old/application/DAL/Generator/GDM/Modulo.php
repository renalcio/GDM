<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 19/03/2015 20:42:52
*/

namespace DAL;

use Libs\UnitofWork;

class Modulo
{
    /**
                     * @PrimaryKey
                     * @Name: ModuloId
                     * @DisplayName: ModuloId
                     * @Type: int(11)
                     */
 var $ModuloId = 0;

/**
                 * @Name: Titulo
                 * @DisplayName: Titulo
                 * @Type: varchar(255)
                 */
 var $Titulo;

/**
                 * @Name: Descricao
                 * @DisplayName: Descricao
                 * @Type: varchar(255)
                 */
 var $Descricao;


    function __construct($ModuloId = "",$Titulo = "",$Descricao = ""){
        

            $unitofwork = new UnitofWork();

            if(!empty($Titulo)){
            
  $this->ModuloId = $ModuloId;
  $this->Titulo = $Titulo;
  $this->Descricao = $Descricao;

        }
        
 if(!empty($this->ModuloId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
