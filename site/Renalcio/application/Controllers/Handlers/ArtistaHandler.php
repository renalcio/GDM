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
        $sql = $this->unitofwork->Get(new \DAL\MediaSpot\Artista(), "AplicacaoId = '".$AplicacaoId."'")->ToArray();
        if (count($sql) > 0) {
            foreach ($sql as $item) {
                $retorno .= "<option value='" . $item->ArtistaId . "'>" . $item->Titulo . "</option>";
            }
        }

        echo $retorno;
    }

    function Consulta(){
        header('Content-Type: application/json; Charset=UTF-8');
        $query = $_REQUEST["query"];
        $resultados = $this->unitofwork->Get(new \DAL\MediaSpot\Artista(), "LOWER(Titulo) LIKE '%".strtolower($query)
            ."%'")->ToArray();

        //var_dump($resultados);

        $retorno = Array();

        $obj = new \stdClass();

        foreach($resultados as $item){
            $obj = new \stdClass();

            $obj->id = $item->ArtistaId;
            $obj->name = $item->Titulo;
            $obj->value = $item->ArtistaId;
            //echo $obj->name;
            $retorno[] = $obj;
            //var_dump($retorno);
        };
        //var_dump($retorno);

        echo json_encode($retorno);
    }
}