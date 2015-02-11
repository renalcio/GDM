<?php
namespace BLL;
use DAL\Aplicacao;
use DAL\MediaSpot\Artista;
use Libs\Database;
use Libs\Helper;
use Libs\CookieHelper;
use Libs\SessionHelper;
use Libs\UnitofWork;

class HomeBLL
{
    var $pdo;
    var $unitofwork;
    /**
     * @param object $db A PDO database connection
     */
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
        $this->pdo = new Database;
        $this->unitofwork = new UnitofWork();
    }

    public function Generator($AplicacaoId = APPID){
        $Aplicacao = new Aplicacao();
        $Aplicacao = $this->unitofwork->GetById(new Aplicacao(), $AplicacaoId);
        $gerador = null;
        if($Aplicacao!=null) {
            $gerador = new \Libs\ClassGenerator\ClassGenerator($Aplicacao->Pasta);
            $gerador->run();
        }

        return $gerador;
    }
}
