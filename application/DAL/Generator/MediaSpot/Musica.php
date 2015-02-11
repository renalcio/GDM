<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 09/02/2015 18:51:58
*/

namespace DAL\MediaSpot;

use Libs\Database;

class Musica
{
    /**
                     * @PrimaryKey
                     * @Name: MusicaId
                     * @DisplayName: MusicaId
                     * @Type: int(255)
                     */
 var $MusicaId = 0;

/**
                 * @Name: ArtistaId
                 * @DisplayName: ArtistaId
                 * @Type: int(255)
                 */
 var $ArtistaId = 0;

/**
                 * @Name: Titulo
                 * @DisplayName: Titulo
                 * @Type: varchar(255)
                 */
 var $Titulo;

/**
                 * @Name: AplicacaoId
                 * @DisplayName: AplicacaoId
                 * @Type: int(255)
                 */
 var $AplicacaoId = 0;


    function __construct($MusicaId = "",$ArtistaId = "",$Titulo = "",$AplicacaoId = ""){
        

            $pdo = new Database();

            if(!empty($ArtistaId)){
            
  $this->MusicaId = $MusicaId;
  $this->ArtistaId = $ArtistaId;
  $this->Titulo = $Titulo;
  $this->AplicacaoId = $AplicacaoId;

        }
        
 if(!empty($this->MusicaId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
