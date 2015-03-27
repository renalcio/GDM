<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 27/03/2015 15:44:09
*/

namespace DAL;

use Libs\UnitofWork;

class Asset
{
    /**
                     * @PrimaryKey
                     * @Name: AssetId
                     * @DisplayName: AssetId
                     * @Type: int(11)
                     */
 var $AssetId = 0;

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


    function __construct($AssetId = "",$Titulo = "",$Descricao = ""){
        

            $unitofwork = new UnitofWork();

            if(!empty($Titulo)){
            
  $this->AssetId = $AssetId;
  $this->Titulo = $Titulo;
  $this->Descricao = $Descricao;

        }
        
 if(!empty($this->AssetId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
