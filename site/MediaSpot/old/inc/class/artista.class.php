<?php

include_once ("dom.class.php");
include_once ("getid3/getid3.php");
include_once ("getid3/getid3.lib.php");
include_once ("array.class.php");
include_once ("mysql.class.php");


include_once ("musica.class.php");
include_once ("metatag.class.php");
include_once ("artistarelacionado.class.php");

class Artista
{
    
    // Array Musicas
    public $Musicas;
    
    // Artista
    public $Titulo;
    public $Descricao;
    public $Imagem;
    public $ArtistaId;
    public $Metatag;
    public $TotalMusicas;
    public $md5;
    public $Pagina;
    public $Relacionados;
    public $Visitas;
    
    private $retorno;


    public function __construct($ArtistaId = 0, $Titulo="", $Descricao="", $Imagem="", $Tags = "", $Pagina = 1)
    {
        $mysqlf = new MysqlHelper;
        $this->ArtistaId = $ArtistaId;
        $this->Titulo = mysql_real_escape_string($Titulo, $mysqlf->getLink());
        $this->Descricao = mysql_real_escape_string($Descricao, $mysqlf->getLink());
        $this->Imagem = $Imagem;
        $this->Metatag = new Metatag(0,$this->ArtistaId,$Tags);
        $this->md5 = md5($this->Titulo);
        $this->Pagina = $Pagina;
        $this->Visitas = $Visitas;
        
        return $this;
    }
    
    function decode(){
        $this->Titulo = stripslashes($this->Titulo);
        $this->Descricao = stripslashes($this->Descricao);
        
        $this->Metatag = $this->Metatag->decode();
        
        for($i = 0; $i < count($this->Musicas); $i++){
            if($this->Musicas[$i] instanceof Musica){
                $this->Musicas[$i] = $this->Musicas[$i]->decode();
            }
        }
        
        for($i = 0; $i < count($this->Retorno); $i++){
            $this->Retorno[$i] = $this->Retorno[$i]->decode();
        }
        
        return $this;
    }

    public function getTotalMusicas()
    {
        $this->TotalMusicas = count($this->Musicas);
        return $this;
    }
    
    /**
     * Adiciona um objeto da classe Musica a um array do Artista
     * @param Musica $Musica Musica
     * */
    public function addMusica(Musica $Musica)
    {
        $Musica->ArtistaId = $this->ArtistaId;
        $this->Musicas[] = $Musica;
        return $this;
    }
    
    /**
     * Adiciona um objeto da classe ArtistaRelacionado a um array do Artista
     * @param ArtistaRelacionado $ArtistaRelacionado Artista Relacionado
     * */
    public function addRelacionado(ArtistaRelacionado $ArtistaRelacionado)
    {
        $ArtistaRelacionado->ArtistaId = $this->ArtistaId;
        $this->Relacionados[] = $ArtistaRelacionado;
        return $this;
    }
    
    public function getMusica($valor)
    {
        return $this->Musicas[$valor];
    }

    public function buscar($termo, $pagina=1, $porMd5 = false, $convert = false)
    {
        //echo $termo."<br>";
        //Dados Artista
        $mysqlf = new MysqlHelper;
        if(!$porMd5){
        $sql = $mysqlf->query("
                    SELECT
                        a.ArtistaId,
                        a.Titulo,
                        a.Descricao,
                        a.Imagem,
                        a.Ativo,
                        a.md5,
                        m.MetatagId,
                        m.Tags,
                        a.Visitas
                        FROM Metatag as m, 
                        	Artista as a
                        WHERE m.Tags LIKE LOWER('%".$termo."%') AND a.ArtistaId = m.ArtistaId 
                                LIMIT 1");
          }else{
            if($convert){ 
                $termo = mysql_real_escape_string($termo, $mysqlf->getLink());
                $termo = md5($termo);
                }
            
                         $sql = $mysqlf->query("
                                SELECT
                                    a.ArtistaId,
                                    a.Titulo,
                                    a.Descricao,
                                    a.Imagem,
                                    a.Ativo,
                                    a.md5,
                                    m.MetatagId,
                                    m.Tags,
                                    a.Visitas
                                    FROM Metatag as m, 
                                    	Artista as a
                                    WHERE a.md5 = '".$termo."' AND a.ArtistaId = m.ArtistaId 
                                            LIMIT 1");
                    }
        
        $sqlResultado = mysql_fetch_assoc($sql);
        
        $this->Descricao = mysql_real_escape_string($sqlResultado["Descricao"], $mysqlf->getLink());
        
        $this->Titulo = mysql_real_escape_string($sqlResultado["Titulo"], $mysqlf->getLink());
        
        $this->Imagem = $sqlResultado["Imagem"];
        
        $this->ArtistaId = $sqlResultado["ArtistaId"];
        
        $this->md5 = $sqlResultado["md5"];
        
        $this->Visitas = $sqlResultado["Visitas"];
        
        $this->Metatag = new Metatag($sqlResultado["MetatagId"], $sqlResultado["ArtistaId"], $sqlResultado["Tags"]);
        //$this-> = $sqlResultado[""];
        //Musicas
        $sqlM = $mysqlf->query("SELECT * FROM Musica WHERE ArtistaId = '".$sqlResultado["ArtistaId"]."' AND Pagina = '$pagina'");
        
        //$sqlMusicas = $mysqlf->listar($sqlM);
        
       /* echo "sqlMusicas: <pre>"; 
        print_r($sqlMusicas);
        echo "</pre>"; */
        
        while($sqlMusicas = $mysqlf->listar($sqlM)){
            
            //echo "TEste: ".$sqlMusicas["MusicaId"]." <br>";
            
            $addMusica = new Musica( $sqlMusicas["MusicaId"], $sqlMusicas["ArtistaId"], $sqlMusicas["Titulo"], $sqlMusicas["Pagina"]);
            
            $this->addMusica($addMusica);
        
        /*echo "Teste<pre>"; 
        print_r($addMusica);
        echo "</pre>";*/
        
        }
        
       // foreach($this->Musicas as $musica){
//            $musica->ArtistaId = $sqlResultado["ArtistaId"];
//        }
        
        $this->TotalMusicas = count($this->Musicas);
        
        //echo "<pre>sfsdf<br>";
//        print_r($this);
//        echo $termo;
//        echo $sqlResultado["ArtistaId"];
//        echo "</pre><br>";



        $sqlR = $mysqlf->query("SELECT * FROM ArtistaRelacionado WHERE ArtistaId = '".$sqlResultado["ArtistaId"]."'");
        
        //$sqlMusicas = $mysqlf->listar($sqlM);
        
       /* echo "sqlMusicas: <pre>"; 
        print_r($sqlMusicas);
        echo "</pre>"; */
        
        while($sqlRelacionados = $mysqlf->listar($sqlR)){
            
            //echo "TEste: ".$sqlMusicas["MusicaId"]." <br>";
            
            $addRelacionado = new ArtistaRelacionado( $sqlRelacionados["ArtistaRelacionadoId"], $sqlRelacionados["ArtistaId"], $sqlRelacionados["Titulo"]);
            
            $this->addRelacionado($addRelacionado);
        
        /*echo "Teste<pre>"; 
        print_r($addMusica);
        echo "</pre>";*/
        
        }
        
        return $this;
    }
    
    /**
     * Adicionar Artista
     * Adiciona um artista no banco de dados ou inclui musicas a um j? existente
     * @param string $titulo TItulo do artista ou banda
     * @param string $imagem Url da imagem do artista ou banda
     * @param string $metatag Termo de busca do artista ou banda
     * @param array $musicas Lista de musicas a serem adicionadas
     * @param int $Pagina Numero da pagina das musicas (opcional) (padr?o: 1)
     */
    public function Salvar($ArtistaId="", $Titulo="", $Descricao="", $Imagem="", $Metatag="", array $Musicas = null, array $Relacionados = null, $Pagina = 1)
    {
        $mysqlf = new MysqlHelper;

        /*echo "<Br><Br>Artista<br><pre>";
        print_r($this);
        echo "--<pre>";
        echo "<br><br><br>";*/

        $this->ArtistaId = !empty($ArtistaId) ? $ArtistaId : $this->ArtistaId;
        $this->Titulo = !empty($Titulo) ? $Titulo : $this->Titulo;
        $this->Pagina = !empty($Pagina) ? $Pagina : $this->Pagina;
        $this->Musicas = count($Musicas) > 0 ? $Musicas : $this->Musicas;
        $this->Metatag = !empty($Metatag) ? new Metatag(0,0, $Metatag) : $this->Metatag;
        $this->Descricao = !empty($Descricao) ? $Descricao : $this->Descricao;
        $this->Imagem = !empty($Imagem) ? $Imagem : $this->Imagem;
        $this->md5 = !empty($Titulo) ? md5($Titulo) : $this->md5;
        $this->Visitas = !empty($Visitas) ? $Visitas : $this->Visitas;
        
        $this->Relacionados = count($Relacionados) > 0 ? $Relacionados : $this->Relacionados;
        
        
        $busca = new Artista();
        
        if($this->ArtistaId > 0){
            $busca = $busca->buscar($this->md5, $this->Pagina, true);
        }else{
            $busca = $busca->buscar($this->Metatag->Tags, $this->Pagina);
        }
        
        //consolelog($this);
        
        //consolelog($busca);
        
        if($busca->ArtistaId > 0){
            if(!empty($busca->Titulo) && $busca->TotalMusicas > 0 && count($this->Musicas) > 0){ //Filtra atuais da pagina se ja existirem para serem renovadas
            $todasMusicas = array_merge($busca->Musicas,$this->Musicas);
            
                foreach($todasMusicas as $element){
                    $hash = $element->Titulo;
                    $musicasUnicas[$hash] = $element;
                }
                
                    /*echo "<Br><Br>Musicas<br><pre>";
                    print_r($musicasUnicas);
                    echo "--<pre>";
                    echo "<br><br><br>"; */
            
                foreach($musicasUnicas as $musica)
                {
                    $musicaAdd = new Musica;
                    $musicaAdd = $musica;
                    $musicaAdd->Pagina = empty($musicaAdd->Pagina) ? $this->Pagina : $musicaAdd->Pagina;
                    $musicaAdd->ArtistaId = $this->ArtistaId;
                    $musica->Salvar();
                    //consolelog("salvou");
                }
                
                $this->Musicas = $musicasUnicas;
                
            }else{
                if(isset($busca->totalMusicas) && $busca->totalMusicas > 0) $this->Pagina++; // Add pagina se necessario
            
                foreach($this->Musicas as $musica)
                {
                    $musicaAdd = new Musica;
                    $musicaAdd = $musica;
                    $musicaAdd->Pagina = empty($musicaAdd->Pagina) ? $this->Pagina : $musicaAdd->Pagina;
                    $musicaAdd->ArtistaId = $this->ArtistaId;
                    $musicaAdd->Salvar();
                    
                }
            }
            
            $sqlTag = $mysqlf->query("SELECT * FROM Metatag WHERE ArtistaId='".$busca->ArtistaId."'");
            
            $bdMetatag = $mysqlf->associar($sqlTag);
            
            $bdMetatag["Tags"] = str_replace(strtolower($this->Metatag->Tags), "", strtolower($bdMetatag["Tags"]));
            
            $bdMetatag["Tags"] .= $this->Metatag->Tags;
            
            //$frase = "Hello World DFSADFFAD Hello World";
            
            $MetatagSave = new Metatag($bdMetatag["MetatagId"], $this->ArtistaId, $bdMetatag["Tags"]);
            $MetatagSave->Salvar();
            
            //echo "<br><br>Metatag: ".$bdMetatag["Tags"];
            //UPDATE
            $this->Visitas++;
            $sqlAdd = $mysqlf->query("
                            UPDATE Artista SET
                            Titulo = '".$this->Titulo."',
                            Descricao = '".$this->Descricao."',
                            Imagem = '".$this->Imagem."',
                            Ativo = '1',
                            Visitas = (Visitas+1)
                            WHERE ArtistaId = '".$busca->ArtistaId."'
                            ");
            
        }else{ // Nao achou
            $this->Visitas = 1;
            $sqlAdd = $mysqlf->query("
                            INSERT INTO Artista (
                            Titulo,
                            Descricao,
                            Imagem,
                            md5,
                            Visitas,
                            Ativo
                            )
                            VALUES (
                            '".$this->Titulo."',
                            '".$this->Descricao."',
                            '".$this->Imagem."',
                            '".$this->md5."',
                            '".$this->Visitas."',
                            1);
                            ") or die(mysql_error());
            echo $sqlAdd;
                                                        
            $sqlGet = $mysqlf->query("SELECT * FROM Artista WHERE ArtistaId=(select MAX(ArtistaId) from Artista)");
            $Artista = $mysqlf->associar($sqlGet);
            
            $this->ArtistaId = $Artista["ArtistaId"]; 
            $this->Metatag->ArtistaId = $this->ArtistaId;
            
            
            $this->Metatag->Salvar();
            
            // consolelog($this);
                
            foreach($this->Musicas as $musica)
                {
                    $musicaAdd = new Musica;
                    $musicaAdd = $musica;
                    $musicaAdd->ArtistaId = $Artista["ArtistaId"];
                    $musicaAdd->Pagina = $this->Pagina;
                    $musicaAdd->Salvar();
                    
                }
                foreach($this->Relacionados as $relacionado)
                {
                    $relacionadoAdd = new ArtistaRelacionado;
                    $relacionadoAdd = $relacionado;
                    $relacionadoAdd->ArtistaId = $Artista["ArtistaId"];
                    $relacionadoAdd->Salvar();
                    
                }
                
        
        }
            //consolelog("Salvou!");
            //consolelog($this);
            
        return $this;
    }
    

    
}

?>