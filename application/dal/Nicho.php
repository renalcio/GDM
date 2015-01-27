<?php
namespace DAL;
use Libs\Database;
class Nicho
{
    var $NichoId;
    var $Titulo;

    public function __construct($NichoId = 0, $Titulo="")
    {
        $pdo = new Database();
        if(!empty($Titulo)) {
            $this->NichoId = $NichoId;
            $this->Titulo = $Titulo;
        }

        if($this->NichoId > 0) {
            //$this->Pessoa = $this->pdo->GetById("Pessoa", "PessoaId", $this->PessoaId, "DAL\\Pessoa");
        }
        else {
           // $this->Pessoa = new Pessoa();
        }

        return $this;
    }

}