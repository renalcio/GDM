<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 15/06/2015 16:53:14
*/

namespace Model\ClassHub;

use Libs\UnitofWork;

class CanalSocial
{
    /**
                     * @PrimaryKey
                     * @Name: CanalSocialId
                     * @DisplayName: CanalSocialId
                     * @Type: int(11)
                     */
 var $CanalSocialId = 0;

/**
                 * @Name: TurmaId
                 * @DisplayName: TurmaId
                 * @Type: int(11)
                 */
 var $TurmaId = 0;

/**
                 * @Name: Tipo
                 * @DisplayName: Tipo
                 * @Type: varchar(255)
                 */
 var $Tipo;

/**
                 * @Name: Url
                 * @DisplayName: Url
                 * @Type: varchar(255)
                 */
 var $Url;

/**
                 * @Name: EscolaId
                 * @DisplayName: EscolaId
                 * @Type: int(11)
                 */
 var $EscolaId = 0;

/**
                 * @Name: Login
                 * @DisplayName: Login
                 * @Type: varchar(255)
                 */
 var $Login;

/**
                 * @Name: Senha
                 * @DisplayName: Senha
                 * @Type: varchar(255)
                 */
 var $Senha;

/**
                 * @Name: CursoId
                 * @DisplayName: CursoId
                 * @Type: int(11)
                 */
 var $CursoId = 0;


    function __construct($CanalSocialId = "",$TurmaId = "",$Tipo = "",$Url = "",$EscolaId = "",$Login = "",$Senha = "",$CursoId = ""){
        

            $unitofwork = new UnitofWork();

            if(!empty($TurmaId)){
            
  $this->CanalSocialId = $CanalSocialId;
  $this->TurmaId = $TurmaId;
  $this->Tipo = $Tipo;
  $this->Url = $Url;
  $this->EscolaId = $EscolaId;
  $this->Login = $Login;
  $this->Senha = $Senha;
  $this->CursoId = $CursoId;

        }
        
 if(!empty($this->CanalSocialId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
