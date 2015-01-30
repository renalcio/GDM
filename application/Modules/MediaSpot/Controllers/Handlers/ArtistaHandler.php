<?php
/**
 * Handler
 * Titulo: Artistas Handler
 * Autor: renalcio.freitas
 * Data: 30/01/2015
 */
namespace Controllers\Handlers;
use Core\Controller;
use DAL\Artista;
use Libs\Database;
use Libs\Helper;

class ArtistaHandler extends Controller
{
    function Select2($AplicacaoId = APPID)
    {
        $retorno = "";
        $pdo = new Database();
        $sql = $pdo->select("SELECT * FROM Artista WHERE AplicacaoId = '".$AplicacaoId."'", new Artista(), true);
        if (count($sql) > 0) {
            foreach ($sql as $item) {
                $retorno .= "<option value='" . $item->ArtistaId . "'>" . $item->Titulo . "</option>";
            }
        }

        echo $retorno;
    }
}