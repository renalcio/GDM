<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 03/02/2015 14:52:08
*/

namespace DAL;

class UsuarioPerfil
{
    /**
                     * @PrimaryKey
                     * @Name: UsuarioPerfilId
                     * @Type: int(255)
                     */
 var $UsuarioPerfilId = 0;

/**
                 * @Name: PerfilId
                 * @Type: int(255)
                 */
 var $PerfilId = 0;

/**
                 * @Name: UsuarioId
                 * @Type: int(255)
                 */
 var $UsuarioId = 0;


    function __construct($UsuarioPerfilId = "",$PerfilId = "",$UsuarioId = ""){
        

        if(!empty($PerfilId)){
        
  $this->UsuarioPerfilId = $UsuarioPerfilId;
  $this->PerfilId = $PerfilId;
  $this->UsuarioId = $UsuarioId;

        }
        
 if(!empty($this->UsuarioPerfilId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
