<?php
/**
 * Handler
 * Titulo: Artistas Handler
 * Autor: renalcio.freitas
 * Data: 30/01/2015
 */
namespace Modules\MediaSpot\Controllers\Handlers;
use Core\Controller;
use Model\Artista;
use Libs\Database;
use Libs\Helper;

class ArtistaHandler extends Controller
{
    function Select2($AplicacaoId = APPID)
    {
        $retorno = "";
        $pdo = new Database();
        $sql = $this->unitofwork->Get(new \Model\MediaSpot\Artista(), "AplicacaoId = '".$AplicacaoId."'")->ToArray();
        if (count($sql) > 0) {
            foreach ($sql as $item) {
                $retorno .= "<option value='" . $item->ArtistaId . "'>" . $item->Titulo . "</option>";
            }
        }

        echo $retorno;
    }
}