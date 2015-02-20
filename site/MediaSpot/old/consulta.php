<?
date_default_timezone_set('America/Sao_Paulo');
header('Content-Type: text/html; charset=UTF-8');
?>
<?
include_once ("inc/class/lastfm/lastfm.api.php");
include_once ("inc/config.php");

CallerFactory::getDefaultCaller()->setApiKey("53b09495de54c998614b6d350a5c2d3e");

$q = $_GET["termo"] ? $_GET["termo"] : $_POST["termo"]; // termo de busca
$p = $_GET["p"] ? $_GET["p"] : $_POST["p"]; // pagina
$a = $_GET["a"] ? $_GET["a"] : $_POST["a"]; // acao
$t = $_GET["t"] ? $_GET["t"] : $_POST["t"]; // tipo

$artista = new stdClass;
$retorno = Array();

function BuscaMusicas($Artista, $limite = 30, $pagina = 1){
            $pdof = new Database;
            CallerFactory::getDefaultCaller()->setApiKey("53b09495de54c998614b6d350a5c2d3e");
            //Musicas
            $retorno = Array();
            
            $inicio = $limite * ($pagina-1);
            
            $id = $Artista->ArtistaId;
            
            $musicasSQL = $pdof->select("SELECT * FROM Musica WHERE ArtistaId = '$id' LIMIT $inicio,$limite");
            
            if(count($musicasSQL)> 0){
                
                foreach($musicasSQL as $musica) {
                    $retorno[] = $musica->Titulo;
                }
                //echo "SQL";
            }else{
                
                $musicas = Artist::getTopTracks($Artista->Titulo, $Artista->mbid, $limite, $pagina);
                foreach($musicas as $key => $musica) {
                    $retorno[] = FormataTexto($musica->getName());
                    
                    //Adiciona ao banco de dados
                    $mAdd = new stdClass;
                    $mAdd->ArtistaId = $Artista->ArtistaId;
                    $mAdd->Titulo = FormataTexto($musica->getName());
                    $mAdd->MusicaId = $pdof->insert("Musica", (Array)$mAdd);
                    
                }
                //echo "LASTFM";
            }
            return $retorno;
}

function BuscaRelacionados($Artista){
            $pdof = new Database;
            CallerFactory::getDefaultCaller()->setApiKey("53b09495de54c998614b6d350a5c2d3e");
            //Musicas
            $retorno = Array();
            
            $id = $Artista->ArtistaId;
            
            $relacionadoSQL = $pdof->select("SELECT * FROM ArtistaRelacionado WHERE ArtistaId = '$id'");
            
            if(count($relacionadoSQL)> 0){
                
                foreach($relacionadoSQL as $relacionado) {
                    $retorno[] = $relacionado->Titulo;
                }
                
                foreach($retorno as $element){
                    $hash = $element;
                    $retornoFiltrado[$hash] = $element;
                }
                $retorno = Array();
                $retorno = $retornoFiltrado;
                
                //echo "SQL";
            }else{
                
                $relacionados = Artist::getInfo($Artista->Titulo, $Artista->mbid, "pt")->getSimilarArtists();
                $i = 0;
                foreach($relacionados as $key => $relacionado) {
                    if($i < 5){
                    $retorno[] = $relacionado->getName();
                    }
                    $i++;
                    
                }
                
                foreach($retorno as $element){
                    $hash = $element;
                    $retornoFiltrado[$hash] = $element;
                }
                $retorno = Array();
                $retorno = $retornoFiltrado;
                
                foreach($retorno as $itemadd){
                    //Adiciona ao banco de dados
                    $rAdd = new stdClass;
                    $rAdd->ArtistaId = $Artista->ArtistaId;
                    $rAdd->Titulo = FormataTexto($itemadd);
                    $rAdd->ArtistaRelacionadoId = $pdof->insert("ArtistaRelacionado", (Array)$rAdd);
                }
                
                //echo "LASTFM";
            }
            return $retorno;
}

function BuscaArtista($q){
    $mysqlf = new MysqlHelper;
    $pdof = new Database;
    CallerFactory::getDefaultCaller()->setApiKey("53b09495de54c998614b6d350a5c2d3e");
    # --------------- Busca por Artista ------------------ #
    $bdtermo = mysql_real_escape_string(strtolower($q), $mysqlf->getLink());
    # Passo 1: Buscar no banco de dados
    $bdQuery = $pdof->select("SELECT * FROM Artista WHERE LOWER(Titulo) LIKE '%$bdtermo%' OR ArtistaId = '$bdtermo'");
    if(count($bdQuery) > 0){
        # Achou no banco, Passo 2: Enviar dados
        foreach($bdQuery as $Artista){
            $Artista->Musicas = BuscaMusicas($Artista);
            $Artista->Similar = BuscaRelacionados($Artista);
            $retorno[] = $Artista;
        }
        
        
        //print_r($retorno);
    }else{
        #Não achou no banco, Passo 2: Buscar no WebService
        /*$WsUrl = LastFM::getUrl($q, 'artist.search', 'artist');
        echo $WsUrl."<br><Br>";*/
        
        // set api key
        
         
        // search for the Coldplay band
        $limit = 2;
        $results = Artist::search($q, $limit);
        
         //print_r($results);
        while ($artist = $results->current()) { 
            $artista = new stdClass;
            
            //Busca Biografia
            $lfArtist = Artist::getInfo($artist->getName(), $artist->getMbid(), "pt");
            
            $biografia = preg_replace("/<(.*)>(.*)<\/a>/i", "$2", $lfArtist->getBiography());
            
            $biografia = explode("Read more about", $biografia);
            
            $biografia = $biografia[0];
            
            $artista->Descricao = FormataTexto($biografia);
            
            //Popula objeto Artista
            $artista->Titulo =  FormataTexto($artist->getName());
            $artista->mbid =  $artist->getMbid();
            $artista->Imagem = $artist->getImage();
            $artista->Ativo = 1;
            $artista->md5 = md5(strtolower($artista->Titulo));
            $retorno[] = $artista; 
            
            $artist = $results->next();
            
            
        }
        
        foreach($retorno as $element){
                    $hash = $element->Titulo;
                    $retornoFiltrado[$hash] = $element;
        }
        
        $retorno = Array();
        
        foreach($retornoFiltrado as $itemAdd){
            
            //Salvar Objeto Artista
            $bdQuery = $pdof->select("SELECT * FROM Artista WHERE md5 = '".$itemAdd->md5."'");
            
            if(count($bdQuery)==0){
                $itemAdd->ArtistaId = $pdof->insert("Artista", (Array)$itemAdd);               
            }else{
                $itemAdd->ArtistaId = $bdQuery[0]->ArtistaId;
            }
            
            $itemAdd->Musicas = BuscaMusicas($itemAdd);
            $itemAdd->Similar = BuscaRelacionados($itemAdd);
            
            $retorno[] = $itemAdd;
        }
        //print_r($retorno);
          
    }
    return $retorno;
}
if(empty($a) || $a == "busca"){
    if($t == "json") $q = $_GET["query"] ? $_GET["query"] : $_POST["query"]; // termo de busca
    
    $retorno = BuscaArtista($q);
    
    if($t=="json"){
        $results = Array();
        foreach($retorno as $item){
            $obj = new stdClass();
            $obj->id = $obj->name = $item->Titulo;
            $results[] = $obj;
        }
        echo json_encode($results);
    }else{
        echo json_encode($retorno);
    }
    
}
if($a == "artista")
{
     # --------------- Busca por Artista ------------------ #
    $bdtermo = strtolower($q);
    $md5 = md5($bdtermo);
    # Passo 1: Buscar no banco de dados
    $bdQuery = $pdo->select("SELECT * FROM Artista WHERE md5 = '$md5'");
    if(count($bdQuery) > 0){
        # Achou no banco, Passo 2: Enviar dados
            $Artista = $bdQuery [0];
            if($p > 1)
                $Artista->Musicas = BuscaMusicas($Artista, 30, $p);
            else
                $Artista->Musicas = BuscaMusicas($Artista);
                
            $Artista->Similar = BuscaRelacionados($Artista);
            $Artista->TotalMusicas = count($Artista->Musicas);
        
        echo json_encode($Artista);
    }else{
        $retorno = BuscaArtista($q);
        echo json_encode($retorno[0]);
    }
}













/*
if ($a == "salvar") {
    //echo "Salvou<br><br>";
    $obj = $_POST["obj"];
    if(isset($obj)){
        $arrMusicas = $obj["Musicas"];
        $arrRelacionados = $obj["Relacionados"];
        $Musicas = Array();
        
        $Relacionados = Array();
        
        $Pagina = 1;
        
        foreach($arrMusicas as $musica){
            $mTitulo = $musica["Titulo"];
            $MusicaAdd = new Musica($musica["MusicaId"], $musica["ArtistaId"], $mTitulo, $musica["Pagina"]);
            $Musicas[] = $MusicaAdd;
            $Pagina = $musica["Pagina"];
        }
        
        foreach($arrRelacionados as $relacionado){
            $rTitulo = $relacionado["Titulo"];
            $RelacionadoAdd = new ArtistaRelacionado($relacionado["ArtistaRelacionadoId"], $relacionado["ArtistaId"], $rTitulo);
            $Relacionados[] = $RelacionadoAdd;
        }
        
        
        $Descricao =  trim($obj["Descricao"]);
        
       // $Descricao =  str_replace('"', ' ', $Descricao);
        
        
        $Titulo = $obj["Titulo"];
        $Tags = $obj["Metatag"]["Tags"];
        
        
        $Artista = new Artista();
        $Artista = $Artista->buscar($Titulo, $Pagina, true, true);
        
        
       if($Artista->ArtistaId > 0){
            $Artista->Metatag->Tags = str_replace(strtolower($Tags), "", strtolower($Artista->Metatag->Tags));
            
            $Artista->Metatag->Tags .= $Tags;
            
            
            $Artista->getTotalMusicas();
            $Artista->Pagina = $Pagina; 
            
            if(count($Artista->Musicas) == 0 || count($Artista->Musicas) < count($Musicas)){
                $Artista->Musicas = $Musicas;
                $Artista->Relacionados = $Relacionados;
                $Artista->Salvar();
            }
       }else
       {
                $Artista = new Artista($obj["ArtistaId"], $Titulo, $Descricao, $obj["Imagem"]);
                $Artista->Metatag = $Metatags = new Metatag($obj["Metatag"]["MetatagId"], $obj["Metatag"]["ArtistaId"], $Tags);
                $Artista->Musicas = $Musicas;
                $Artista->Relacionados = $Relacionados;
                
                $Artista->getTotalMusicas();
                $Artista->Pagina = $Pagina; 
       
                $Artista->Salvar();
       }
        
        echo json_encode($Artista);
       // print_r($Relacionados);
        //print_r($Artista);
       // 
    }
    
}else if($a == "buscar"){
    $Artista = new Artista();
    
    switch($t){
        case '1': { //Busca por ID
                $sql = $mysql->query("SELECT * FROM Artista where ArtistaId = '$q' LIMIT 1");
                $sqlA = $mysql->associar($sql);
                $Artista = new Artista();
                $Artista = $Artista->buscar($sqlA["md5"], $p, true);
            }
            break;
       case '2' : { // Busca por Nome
                $Artista = new Artista();
                $Artista = $Artista->buscar($q, $p, true, true);
       }
       break;
       case '3': { // Busca por md5
                $Artista = new Artista();
                $Artista = $Artista->buscar($q, $p, true);
       }
       default : { // Busca por Nome
                $Artista = new Artista();
                $Artista = $Artista->buscar($q, $p);
       }
       break;  
            
        
    }
    if($Artista->ArtistaId > 0 && $Artista->TotalMusicas > 0){
        $Artista->Metatag->Tags = $q;                               
        $Artista->Salvar();
    }
    $Artista->decode();
    echo json_encode($Artista);
    
}else if($a=="json"){
    
    $q = $_GET["query"] ? $_GET["query"] : $_POST["query"]; // termo de busca
    $sql = $mysql->query("
                    SELECT
                        DISTINCT a.Titulo
                        FROM Metatag as m, 
                        	Artista as a
                        WHERE (m.Tags LIKE LOWER('%".$q."%') AND a.ArtistaId = m.ArtistaId) OR (a.Titulo LIKE LOWER('%".$q."%'))");
                        $results = Array();
                        while($item = $mysql->listar($sql)){
                            $obj = new stdClass();
                            $obj->id = $obj->name = $item["Titulo"];
                            $results[] = $obj;
                        }; 
                        echo json_encode($results);
}
?>
*/

?>