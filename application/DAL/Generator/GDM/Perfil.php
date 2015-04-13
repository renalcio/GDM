<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 13/04/2015 11:47:07
*/

namespace DAL;

use Libs\UnitofWork;

class Perfil
{
    /**
                     * @PrimaryKey
                     * @Name: PerfilId
                     * @DisplayName: PerfilId
                     * @Type: int(255)
                     */
 var $PerfilId = 0;

/**
                 * @Name: AplicacaoId
                 * @DisplayName: AplicacaoId
                 * @Type: int(255)
                 */
 var $AplicacaoId = 0;

/**
                 * @Name: Titulo
                 * @DisplayName: Titulo
                 * @Type: varchar(255)
                 */
 var $Titulo;

/**
                 * @Name: Ativo
                 * @DisplayName: Ativo
                 * @Type: tinyint(1)
                 */
 var $Ativo = 0;

/**
                 * @Name: Nivel
                 * @DisplayName: Nivel
                 * @Type: int(11)
                 */
 var $Nivel = 0;


    function __construct($PerfilId = "",$AplicacaoId = "",$Titulo = "",$Ativo = "",$Nivel = ""){
        

            $unitofwork = new UnitofWork();

            if(!empty($AplicacaoId)){
            
  $this->PerfilId = $PerfilId;
  $this->AplicacaoId = $AplicacaoId;
  $this->Titulo = $Titulo;
  $this->Ativo = $Ativo;
  $this->Nivel = $Nivel;

        }
        
 if(!empty($this->PerfilId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
