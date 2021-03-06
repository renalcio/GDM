<?php
namespace Modules\Generic\BLL;
use Core\BLL;
use Model\Aplicacao;
use Model\MediaSpot\Artista;
use Libs\Database;
use Libs\Helper;
use Libs\CookieHelper;
use Libs\SessionHelper;
use Libs\UnitofWork;

class HomeBLL extends BLL
{
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
