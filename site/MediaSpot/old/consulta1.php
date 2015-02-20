<?
include_once ("inc/class/artista.class.php");

include_once ("inc/config.php");

$q = $_GET["termo"] ? $_GET["termo"] : $_POST["termo"]; // termo de busca
$p = $_GET["p"] ? $_GET["p"] : $_POST["p"]; // pagina
$a = $_GET["a"] ? $_GET["a"] : $_POST["a"]; // acao
$t = $_GET["t"] ? $_GET["t"] : $_POST["t"]; // tipo

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
                //$Artista->Salvar();
            }
       }else
       {
                $Artista = new Artista($obj["ArtistaId"], $Titulo, $Descricao, $obj["Imagem"]);
                $Artista->Metatag = $Metatags = new Metatag($obj["Metatag"]["MetatagId"], $obj["Metatag"]["ArtistaId"], $Tags);
                $Artista->Musicas = $Musicas;
                $Artista->Relacionados = $Relacionados;
                
                $Artista->getTotalMusicas();
                $Artista->Pagina = $Pagina; 
       
                //$Artista->Salvar();
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
        //$Artista->Salvar();
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


