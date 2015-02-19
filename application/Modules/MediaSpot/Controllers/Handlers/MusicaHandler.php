<?php
/**
 * Handler
 * Titulo: Musicas
 * Autor: renalcio.freitas
 * Data: 28/01/2015
 */
namespace Controllers\Handlers;
use Core\Controller;
use DAL\MediaSpot\Artista;
use DAL\Musica;
use Libs\Database;
use Libs\Helper;

class MusicaHandler extends Controller
{
    public function Get($pagina = 1, $total = 20, $titulo = ""){
        header('Content-Type: application/json; Charset=UTF-8');
        $pdo = new Database();
        $pinicio = ($pagina - 1) * $total;
        $titulo = strtolower($titulo);

        /*echo "\nPagina: ".$pagina;
        echo "\nTotal por pagina: ".$total;
        echo "\nLIMIT: ".$pinicio;
        echo "\nTermo de Busca: ".$titulo."\n";*/

        $retorno = $this->unitofwork->Get(new \DAL\MediaSpot\Musica(), "LOWER(Titulo) LIKE '%".$titulo."%' OR '".$titulo."' = '' LIMIT ".$pinicio.", ".$total)->ToArray();

        $retorno = json_encode($retorno);

        echo $retorno;
    }

    public function GetTable($pagina = 1, $total = 20, $titulo = ""){
        $pdo = new Database();
        $pinicio = ($pagina - 1) * $total;
        $titulo = strtolower($titulo);

        /*echo "\nPagina: ".$pagina;
        echo "\nTotal por pagina: ".$total;
        echo "\nLIMIT: ".$pinicio;
        echo "\nTermo de Busca: ".$titulo."\n";*/
        $retorno = "";
        $query = $this->unitofwork->Get(new \DAL\MediaSpot\Musica(), "LOWER(Titulo) LIKE '%".$titulo."%' OR '".$titulo."' = '' LIMIT ".$pinicio.", ".$total)->ToArray();
        //var_dump($query);
        foreach($query as $item){
            $retorno .= '<tr>
                           <td>'.$item->Titulo.'</td>
                           <td>'.$item->Artista->Titulo.'</td>
                           <td align="center">
                                <div class="btn-group">
                                    <i class="fa fa-bars" class="dropdown-toggle" data-toggle="dropdown"></i>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li>
                                            <a href="'.\Libs\Helper::getUrl("cadastro","", $item->MusicaId).'">
                                                <i class="fa fa-edit"></i> Editar
                                            </a>
                                        </li>
                                        <li>
                                            <a onclick="Excluir('.$item->MusicaId.')">
                                                <i class="fa fa-trash-o"></i> Excluir
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                         </tr>';
        }

        echo $retorno;
    }

    public function DataTable(){
        //print_r($_REQUEST);

        header('Content-Type: application/json; Charset=UTF-8');
        $pdo = new Database();

        $inicio = $_REQUEST["start"];
        $total = $_REQUEST["length"];
        $pinicio = $inicio * $total;
        $titulo = strtolower($_REQUEST["search"]["value"]);

        $orderby = "";
        $orders = $_REQUEST["order"];
        $colunas = $_REQUEST{"columns"};
            $iColuna = $orders[0]["column"];
            $nomeColuna = isset($colunas[$iColuna]["data"]["sort"]) && !empty(
$colunas[$iColuna]["data"]["sort"]) ? $colunas[$iColuna]["data"]["sort"] : $colunas[$iColuna]["data"];
            $direcao = $orders[0]["dir"];

        //print_r($colunas[$iColuna]["data"]);
        $orderby = $nomeColuna." ".strtoupper($direcao);

        //echo $orderby;

        $retorno = $this->unitofwork->Get(new \DAL\MediaSpot\Musica())->Join($this->unitofwork->Get(new Artista()), "m.ArtistaId", "a.ArtistaId")->Where("(LOWER(m.Titulo) LIKE '%" . $titulo . "%' OR LOWER(a.Titulo) LIKE '%" . $titulo . "%' ) OR'".$titulo."' = ''")->OrderBy($orderby)->Select("m.*");


        //$retorno->BuildQuery();
        //echo $retorno->query;

        $retornoTotal = $retorno->ToArray();

        $array = Array();

        $retorno = $retorno->Skip($inicio)->Take($total);

        $retorno = $retorno->ToArray();

        for($i = 0; $i < count($retorno); $i++){
            $retorno[$i]->OptionsMenu = '<div class="btn-group">
                                                <i class= "fa fa-bars" class="dropdown-toggle"
                                                data-toggle="dropdown"></i>
                                                <ul class="dropdown-menu pull-right" role="menu">
                                                    <li>
                                                        <a href="'.\Libs\Helper::getUrl("cadastro","musica",
                    $retorno[$i]->MusicaId).'">
                                                            <i class="fa fa-edit"></i> Editar
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a onclick="Excluir('.$retorno[$i]->MusicaId.')">
                                                            <i class="fa fa-trash-o"></i> Excluir
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>';
            $retorno[$i]->a = $this->unitofwork->GetById(new Artista(), $retorno[$i]->ArtistaId);
        }

        $array["data"] = $retorno;
        //print_r($array);
        $array["draw"] = $_REQUEST["draw"];

        $array["recordsTotal"] = count($retornoTotal);
        $array["recordsFiltered"] = count($retornoTotal);

        echo json_encode($array);

    }
}