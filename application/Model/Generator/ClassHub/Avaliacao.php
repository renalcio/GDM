<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 15/06/2015 16:53:14
*/

namespace Model\ClassHub;

use Libs\UnitofWork;

class Avaliacao
{
    /**
                     * @PrimaryKey
                     * @Name: AvaliacaoId
                     * @DisplayName: AvaliacaoId
                     * @Type: int(11)
                     */
 var $AvaliacaoId = 0;

/**
                 * @Name: MateriaId
                 * @DisplayName: MateriaId
                 * @Type: int(11)
                 */
 var $MateriaId = 0;

/**
                 * @Name: TurmaId
                 * @DisplayName: TurmaId
                 * @Type: int(11)
                 */
 var $TurmaId = 0;

/**
                 * @Name: Titulo
                 * @DisplayName: Titulo
                 * @Type: varchar(255)
                 */
 var $Titulo;

/**
                 * @Name: Data
                 * @DisplayName: Data
                 * @Type: varchar(255)
                 */
 var $Data;

/**
                 * @Name: DataCadastro
                 * @DisplayName: DataCadastro
                 * @Type: bigint(20)
                 */
 var $DataCadastro = 0;

/**
                 * @Name: Peso
                 * @DisplayName: Peso
                 * @Type: int(11)
                 */
 var $Peso = 0;

/**
                 * @Name: Descricao
                 * @DisplayName: Descricao
                 * @Type: text
                 */
 var $Descricao;

/**
                 * @Name: Trabalho
                 * @DisplayName: Trabalho
                 * @Type: tinyint(1)
                 */
 var $Trabalho = 0;

/**
                 * @Name: EscolaId
                 * @DisplayName: EscolaId
                 * @Type: int(11)
                 */
 var $EscolaId = 0;

/**
                 * @Name: CursoId
                 * @DisplayName: CursoId
                 * @Type: int(11)
                 */
 var $CursoId = 0;

/**
                 * @Name: AlunoId
                 * @DisplayName: AlunoId
                 * @Type: int(11)
                 */
 var $AlunoId = 0;


    function __construct($AvaliacaoId = "",$MateriaId = "",$TurmaId = "",$Titulo = "",$Data = "",$DataCadastro = "",$Peso = "",$Descricao = "",$Trabalho = "",$EscolaId = "",$CursoId = "",$AlunoId = ""){
        

            $unitofwork = new UnitofWork();

            if(!empty($MateriaId)){
            
  $this->AvaliacaoId = $AvaliacaoId;
  $this->MateriaId = $MateriaId;
  $this->TurmaId = $TurmaId;
  $this->Titulo = $Titulo;
  $this->Data = $Data;
  $this->DataCadastro = $DataCadastro;
  $this->Peso = $Peso;
  $this->Descricao = $Descricao;
  $this->Trabalho = $Trabalho;
  $this->EscolaId = $EscolaId;
  $this->CursoId = $CursoId;
  $this->AlunoId = $AlunoId;

        }
        
 if(!empty($this->AvaliacaoId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
