<?php
namespace BLL;
use Core\BLL;
use DAL\Aplicacao;
use DAL\MediaSpot\Artista;
use Libs\AlunoHelper;
use Libs\Database;
use Libs\Helper;
use Libs\CookieHelper;
use Libs\SessionHelper;
use Libs\UnitofWork;
use Model\ClassHub\Avaliacao;

class HomeBLL extends BLL
{
    /**
     * @param object $db A PDO database connection
     */
    function __construct($db)
    {
       parent::__construct();
    }

    public function GetToIndex(\stdClass $model){

        $TurmaId = AlunoHelper::GetUsuarioAluno()->TurmaId;
        $AlunoId = AlunoHelper::GetAlunoId();

        $model->ListAvaliacao = $this->unitofwork->Get(new Avaliacao(), "TurmaId = '".$TurmaId."' AND (Compartilhado = 1 OR
        AlunoId = '".$AlunoId."')")->OrderBy("STR_TO_DATE(Data, '%d/%m/%Y')")->Take(5)->ToList();

        return $model;
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
