<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 03/02/2015 14:52:07
*/

namespace DAL;

class Perfil
{
    /**
                     * @PrimaryKey
                     * @Name: PerfilId
                     * @Type: int(255)
                     */
 var $PerfilId = 0;

/**
                 * @Name: AplicacaoId
                 * @Type: int(255)
                 */
 var $AplicacaoId = 0;

/**
                 * @Name: Titulo
                 * @Type: varchar(255)
                 */
 var $Titulo;

/**
                 * @Name: Ativo
                 * @Type: tinyint(1)
                 */
 var $Ativo = 0;

/**
                 * @Name: Nivel
                 * @Type: int(11)
                 */
 var $Nivel = 0;


    function __construct($PerfilId = "",$AplicacaoId = "",$Titulo = "",$Ativo = "",$Nivel = ""){
        

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
