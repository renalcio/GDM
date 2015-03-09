<?php
/**
 * Handler
 * Titulo: Musicas
 * Autor: renalcio.freitas
 * Data: 28/01/2015
 */
namespace Controllers\Handlers;
use BLL\MediaSpot\BuscaBLL;
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

    public function DataTable($ArtistaId = 0){
        //print_r($ArtistaId);

        header('Content-Type: application/json; Charset=UTF-8');
        $pdo = new Database();

        $inicio = $_REQUEST["start"];
        $total = $_REQUEST["length"];
        $pinicio = $inicio * $total;
        $titulo = strtolower($_REQUEST["search"]["value"]);

        $orderby = "";
        $orders = isset($_REQUEST["order"]) ? $_REQUEST["order"] : "";
        if(!empty($orders)) {
            $colunas = $_REQUEST{"columns"};
            $iColuna = $orders[0]["column"];
            $nomeColuna = $colunas[$iColuna]["data"];
            $direcao = $orders[0]["dir"];

            //print_r($colunas[$iColuna]["data"]);
            $orderby = $nomeColuna . " " . strtoupper($direcao);
        }

        //echo $orderby;
        $retorno = $this->unitofwork->Get(new \DAL\MediaSpot\Musica())->Join($this->unitofwork->Get(new Artista()), "m.ArtistaId", "a.ArtistaId");

        if($ArtistaId > 0) {
            $retorno = $retorno->Where(" m.ArtistaId = '" . $ArtistaId . "' AND ((LOWER(m.Titulo) LIKE '%" . $titulo . "%' OR LOWER(a.Titulo) LIKE '%" . $titulo . "%' ) OR'" . $titulo . "' = '')");
        }else{
            $retorno = $retorno->Where("(LOWER(m.Titulo) LIKE '%" . $titulo . "%' OR LOWER(a.Titulo) LIKE '%" . $titulo . "%' ) OR'" . $titulo . "' = ''");
        }

        if(!empty($orderby))
            $retorno = $retorno->OrderBy($orderby)->Select("m.*");
        else
            $retorno = $retorno->Select("m.*");



        //$retorno->BuildQuery();
        //echo $retorno->query;

        $retornoTotal = $retorno->ToArray();

        $array = Array();

        $retorno = $retorno->Skip($inicio)->Take($total);

        $retorno = $retorno->ToArray();

        if($retorno != null) {
            for ($i = 0; $i < count($retorno); $i++) {
                $retorno[$i]->OptionsMenu = '<div class="btn-group">
                                                <i class= "fa fa-bars" class="dropdown-toggle"
                                                data-toggle="dropdown"></i>
                                                <ul class="dropdown-menu pull-right" role="menu">
                                                    <li>
                                                        <a href="' . \Libs\Helper::getUrl("cadastro", "musica",
                        $retorno[$i]->MusicaId) . '">
                                                            <i class="fa fa-edit"></i> Editar
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a onclick="Excluir(' . $retorno[$i]->MusicaId . ')">
                                                            <i class="fa fa-trash-o"></i> Excluir
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>';
                $retorno[$i]->a = $this->unitofwork->GetById(new Artista(), $retorno[$i]->ArtistaId);
            }
        }else{
            $retorno = Array();
        }

        $array["data"] = $retorno;
        //print_r($array);
        $array["draw"] = $_REQUEST["draw"];

        $array["recordsTotal"] = count($retornoTotal);
        $array["recordsFiltered"] = count($retornoTotal);

        echo json_encode($array);

    }

    public function Consulta($ArtistaId = 0){
        //print_r($ArtistaId);

        header('Content-Type: application/json; Charset=UTF-8');
        $pdo = new Database();
        //print_r($_REQUEST);
        $inicio = $_REQUEST["start"];
        $total = $_REQUEST["length"];
        $pinicio = $inicio * $total;
        $titulo = strtolower($_REQUEST["search"]["value"]);
        $pagina = ($inicio > 0) ? ($inicio / $total) + 1 : 1;
        //echo "<br>";
        //echo $pagina;
        $orderby = "";
        $orders = isset($_REQUEST["order"]) ? $_REQUEST["order"] : "";
        if(!empty($orders)) {
            $colunas = $_REQUEST{"columns"};
            $iColuna = $orders[0]["column"];
            $nomeColuna = $colunas[$iColuna]["data"];
            $direcao = $orders[0]["dir"];

            //print_r($colunas[$iColuna]["data"]);
            $orderby = $nomeColuna . " " . strtoupper($direcao);
        }

        //echo $orderby;
        $retorno = $this->unitofwork->Get(new \DAL\MediaSpot\Musica())->Join($this->unitofwork->Get(new Artista()), "m.ArtistaId", "a.ArtistaId");

        if($ArtistaId > 0) {
            $retorno = $retorno->Where(" m.ArtistaId = '" . $ArtistaId . "' AND ((LOWER(m.Titulo) LIKE '%" . $titulo . "%' OR LOWER(a.Titulo) LIKE '%" . $titulo . "%' ) OR'" . $titulo . "' = '')");
        }else{
            $retorno = $retorno->Where("(LOWER(m.Titulo) LIKE '%" . $titulo . "%' OR LOWER(a.Titulo) LIKE '%" . $titulo . "%' ) OR'" . $titulo . "' = ''");
        }

        if(!empty($orderby))
            $retorno = $retorno->OrderBy($orderby)->Select("m.*");
        else
            $retorno = $retorno->Select("m.*");



        //$retorno->BuildQuery();
        //echo $retorno->query;

        $retornoTotal = $retorno->ToArray();

        $array = Array();

        $retorno = $retorno->Skip($inicio)->Take($total);

        $retorno = $retorno->ToArray();

        if(empty($retorno) || count($retorno) == 0){
            $bll = new BuscaBLL();
            $Artista = new Artista();
            $Artista = $this->unitofwork->GetById(new Artista(), $ArtistaId);
            $bll->GetMusicasLFM($Artista, $pagina, $total);
        }
        $retorno = $this->unitofwork->Get(new \DAL\MediaSpot\Musica())->Join($this->unitofwork->Get(new Artista()), "m.ArtistaId", "a.ArtistaId");

        if($ArtistaId > 0) {
            $retorno = $retorno->Where(" m.ArtistaId = '" . $ArtistaId . "' AND ((LOWER(m.Titulo) LIKE '%" . $titulo . "%' OR LOWER(a.Titulo) LIKE '%" . $titulo . "%' ) OR'" . $titulo . "' = '')");
        }else{
            $retorno = $retorno->Where("(LOWER(m.Titulo) LIKE '%" . $titulo . "%' OR LOWER(a.Titulo) LIKE '%" . $titulo . "%' ) OR'" . $titulo . "' = ''");
        }

        if(!empty($orderby))
            $retorno = $retorno->OrderBy($orderby)->Select("m.*");
        else
            $retorno = $retorno->Select("m.*");



        //$retorno->BuildQuery();
        //echo $retorno->query;

        $retornoTotal = $retorno->ToArray();

        $array = Array();

        $retorno = $retorno->Skip($inicio)->Take($total);

        $retorno = $retorno->ToArray();

        if(!empty($retorno)) {
            for ($i = 0; $i < count($retorno); $i++) {
                $retorno[$i]->OptionsMenu = '<div class="btn-group">
                                                <i class= "fa fa-play" class="dropdown-toggle"
                                                data-toggle="dropdown"></i>
                                                <ul class="dropdown-menu pull-right" role="menu">
                                                    <li>
                                                        <a href="' . \Libs\Helper::getUrl("cadastro", "musica",
                        $retorno[$i]->MusicaId) . '">
                                                            <i class="fa fa-edit"></i> Editar
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a onclick="Excluir(' . $retorno[$i]->MusicaId . ')">
                                                            <i class="fa fa-trash-o"></i> Excluir
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>';

                $retorno[$i]->a = new \stdClass();
                $retorno[$i]->a->Titulo = $this->unitofwork->GetById(new Artista(), $retorno[$i]->ArtistaId)->Titulo;

                $retorno[$i]->PlayButtom = '<button onclick="BuscaMusica('.$i.', \''.addslashes($retorno[$i]->a->Titulo).' - '.addslashes($retorno[$i]->Titulo).'\')" class="btn btn-default btnPlay"><i class= "fa fa-play" class="dropdown-toggle" data-toggle="dropdown"></i></button>';

            }
        }else{
            $retorno = Array();
        }

        $array["data"] = $retorno;
        $array["draw"] = $_REQUEST["draw"];


        echo json_encode($array);

    }
}