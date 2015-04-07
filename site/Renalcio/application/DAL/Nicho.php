<?php
namespace DAL;
use Libs\Database;
use Libs\UnitofWork;

class Nicho
{
    /**
     * @PrimaryKey
     */
    var $NichoId;
    var $Titulo;

    public function __construct($NichoId = 0, $Titulo="")
    {
        $pdo = new UnitofWork();
        if(!empty($Titulo)) {
            $this->NichoId = $NichoId;
            $this->Titulo = $Titulo;
        }

        return $this;
    }

}