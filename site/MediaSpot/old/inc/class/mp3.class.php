<?php

include_once ("dom.class.php");
include_once ("getid3/getid3.php");
include_once ("getid3/getid3.lib.php");
include_once ("array.class.php");
class MP3
{
    // Coloque aqui as Informações do Banco de Dados
    public $lista;
    private $retorno;


    public function __construct()
    {

    }

    public function __get($valor)
    {
        return $this->lista[$valor];
    }

    public function add($valor)
    {
        $this->lista[] = $valor;
        return $this;
    }

    public function buscar($termo)
    {
        

        //MP3SKULL
        $i = 0;
        $html = file_get_html('http://mp3skull.com/search.php?q=' . $termo);
        //var_dump($html);
        foreach ($html->find('div#song_html') as $element)
        {
            if ($i <= 1)
            {
                foreach ($element->find('a[href*=.mp3]') as $links)
                {
                    $mp3 = Array();
                    $id3v2 = Array();
                try{
                    if (!$resultado = $this->getFileInfo($links->href))
                    {

                    } else
                    {
                        $id3v2 = ArrayHelper::buscar($resultado, "id3v2");
                        if (count($id3v2) > 0)
                        {
                            $id3v2 = $id3v2[0];
                            $mp3 = array(
                                "titulo"    => ArrayHelper::primeiro_valor($id3v2["title"]),

                                "genero"    => ArrayHelper::primeiro_valor($id3v2["genre"]),

                                "album"     => ArrayHelper::primeiro_valor($id3v2["album"]),

                                "artista"   => ArrayHelper::primeiro_valor($id3v2["artist"]),
                                
                                "url"       =>  $links->href,
                                
                                "local"     =>  "MP3 Skull"
                                
                                );
                                

                            $this->add($mp3);

                            $i++;
                        }
                    }
                    } catch (Exception $e) {
            echo "ERRO<BR><BR>";
            var_dump($e->getMessage());
            
        }
                }
            }
        }


        //MP3 JUICE
        $i = 0;
        $html = file_get_html('http://mp3juices.com/search/' . $termo);
        foreach ($html->find('td.controls') as $element)
        {
            if ($i <= 10)
            {
                foreach ($element->find('[name$="][url]"]') as $links)
                {
                    $mp3 = Array();
                    $id3v2 = Array();
                    
                    if (!$resultado = $this->getFileInfo($links->value))
                    {
                    } else
                    {
                        $id3v2 = ArrayHelper::buscar($resultado, "id3v2");
                        if (count($id3v2) > 0)
                        {
                            $id3v2 = $id3v2[0];
                            $mp3 = array(
                                "titulo" => ArrayHelper::primeiro_valor($id3v2["title"]),

                                "genero" => ArrayHelper::primeiro_valor($id3v2["genre"]),

                                "album" => ArrayHelper::primeiro_valor($id3v2["album"]),

                                "artista" => ArrayHelper::primeiro_valor($id3v2["artist"]),
                                
                                "local" =>  "MP3 Juice"
                                );
                            $this->add($mp3);

                            $i++;
                        }
                    }

                }

            }
        }

        return $this;
    }

    private static function getFileInfo($remoteFile)
    {
        $url = $remoteFile;
        $uuid = uniqid("mediaspot_", true);
        $file = "temp/" . $uuid . ".mp3";
        $size = 0;
        $ch = curl_init($remoteFile);
        //==============================Get Size==========================//
        $contentLength = 'unknown';
        $ch1 = curl_init($remoteFile);
        curl_setopt($ch1, CURLOPT_NOBODY, true);
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch1, CURLOPT_HEADER, true);
        curl_setopt($ch1, CURLOPT_FOLLOWLOCATION, true); //not necessary unless the file redirects (like the PHP example we're using here)
        $data = curl_exec($ch1);
        curl_close($ch1);
        if (preg_match('/Content-Length: (\d+)/', $data, $matches))
        {
            $contentLength = (int)$matches[1];
            $size = $contentLength;
        }
        //==============================Get Size==========================//

        if (!$fp = fopen($file, "wb"))
        {
            echo 'Error opening temp file for binary writing';
            return false;
        } else
            if (!$urlp = fopen($url, "r"))
            {

                //echo 'Error opening URL for reading';

                return false;
            }
        try
        {
            $to_get = 65536; // 64 KB
            $chunk_size = 4096; // Haven't bothered to tune this, maybe other values would work better??
            $got = 0;
            $data = null;

            // Grab the first 64 KB of the file
            while (!feof($urlp) && $got < $to_get)
            {
                $data = $data . fgets($urlp, $chunk_size);
                $got += $chunk_size;
            }
            fwrite($fp, $data); // Grab the last 64 KB of the file, if we know how big it is.  if ($size > 0) {
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RESUME_FROM, $size - $to_get);
            curl_exec($ch);


            // Now $fp should be the first and last 64KB of the file!!

            @fclose($fp);
            @fclose($urlp);
        }
        catch (exception $e)
        {
            @fclose($fp);
            @fclose($urlp);

            //echo 'Error transfering file using fopen and cURL !!';

            return false;
        }
        $getID3 = new getID3;
        $filename = $file;
        $ThisFileInfo = $getID3->analyze($filename);
        getid3_lib::CopyTagsToComments($ThisFileInfo);
        unlink($file);
        return $ThisFileInfo;
    }


}

?>