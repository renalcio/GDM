<?
use Libs\ArrayHelper;
use DAL\Site;
?>

    <h2>You are in the View: application/views/home/index.php (everything in the box comes from this file)</h2>
    <p>
    <form method="post">
        Grupo 0 -> Titulo
        <input type="text" id="Grupo__1_Titulo" name="Grupo[0]_Titulo">
        Grupo 1 -> Titulo
        <input type="text" id="Grupo__1_Titulo" name="Grupo[1]_Titulo">
        <button type="submit">Vai</button>
    </form>
<pre>
    <?

    $time = microtime(1);
    $mem = memory_get_usage();

    /*function dirToArray($dir, $sub = false) {

        $result = array();

        $cdir = scandir($dir);
        foreach ($cdir as $key => $value)
        {
            if (!in_array($value,array(".","..")))
            {
                if (is_dir($dir . DIRECTORY_SEPARATOR . $value))
                {
                    if($sub == false)
                        $result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value, true);
                }
                else
                {
                    $filetype = pathinfo($dir . DIRECTORY_SEPARATOR . $value, PATHINFO_EXTENSION);
                    $result[$filetype][] = $value;
                }
            }
        }

        return $result;
    }

    $path    = ROOT.'public\\plugins';
    $arr = dirToArray($path);
    print_r($arr);

    $jsonFile = ROOT."public\\assets.json";
    $fh = fopen($jsonFile, 'w');

    $json = json_encode($arr);

    fwrite($fh, $json);*/

    /*echo URL.'assets.json';
    $str = file_get_contents(URL.'assets.json');
    $json = json_decode($str, true);
    //var_dump($json);

    $assetsJSON = $json;
    $assets = Array(
        "css" => Array(),
        "js" => Array(
            "header" => Array(),
            "footer" => Array()
        )
    );

    foreach($assetsJSON as $i=>$assetJ){
        var_dump($assetJ);
        if(isset($assetJ["css"])) {
            //var_dump($asset["css"]);
            foreach($assetJ["css"] as $css){
                $assets["css"][] = $css;
            }
        }
        if(isset($assetJ["js"]["header"])) {
            //var_dump($asset["css"]);
            foreach($assetJ["js"]["header"] as $js){
                $assets["js"]["header"][] = $js;
            }
        }
        if(isset($assetJ["js"]["footer"])) {
            //var_dump($asset["css"]);
            foreach($assetJ["js"]["footer"] as $js){
                $assets["js"]["footer"][] = $js;
            }
        }
    }
    var_dump($assets);*/
    /**
    SELECT p.*
    FROM
    GDM.Pessoa p,
    GDM.PessoaAplicacao pa,
    GDM.Aplicacao a
    WHERE a.AplicacaoId = '3'
    AND pa.AplicacaoId = a.AplicacaoId
    AND p.PessoaId = pa.PessoaId

    SELECT GDM.Pessoa.* FROM GDM.Pessoa
    INNER JOIN GDM.Aplicacao
    INNER JOIN GDM.PessoaAplicacao ON GDM.PessoaAplicacao.PessoaId = GDM.Pessoa.PessoaId AND GDM.PessoaAplicacao
    .AplicacaoId = GDM.Aplicacao.AplicacaoId
    WHERE GDM.Aplicacao.AplicacaoId = '3'


    Ideias:
    Criar um Objeto de Retorno como stdClass e nele adicionar objetos com os tipos especificados no JOIN
    ex:
    Sem join: $retorno->Get = Objeto do GET
    Joins:
    $retorno->Get = Objeto do GET
    $retorno->Join1 = Objeto do Join1
    $retorno->Join2 = Objeto do Join2

    no Select deixar padrão o Objeto do GET e permitir que ele identifique quais quer retornar em uma logica parecida com
    a do WHERE do ArrayHelper
    Ex:
    Select(function($x){$x->Join1; })->....
     */
    ?>
    </pre>
    </p>
