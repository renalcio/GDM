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

    function dirToArray($dir, $sub = false) {

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
                    $url = preg_replace("/(.*public\\\\)/mi","",$dir);
                    $url = URL.$url.DIRECTORY_SEPARATOR.$value;
                    $url = preg_replace("/(\\\\)+/", "/", $url);
                    $result[$filetype][] = $url;
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

    fwrite($fh, $json);

    ?>
    </pre>
    </p>
