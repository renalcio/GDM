<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 05/02/2015 14:07:02
*/

namespace DAL;

use Libs\Database;

class Nicho
{
    /**
                     * @PrimaryKey
                     * @Name: NichoId
                     * @DisplayName: NichoId
                     * @Type: int(11)
                     */
 var $NichoId = 0;

/**
                 * @Name: Titulo
                 * @DisplayName: Titulo
                 * @Type: varchar(255)
                 */
 var $Titulo;


    function __construct($NichoId = "",$Titulo = ""){
        

            $pdo = new Database();

            if(!empty($Titulo)){
            
  $this->NichoId = $NichoId;
  $this->Titulo = $Titulo;

        }
        
 if(!empty($this->NichoId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
