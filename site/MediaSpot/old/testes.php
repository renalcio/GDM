<?
include_once ("inc/class/artista.class.php");

include_once ("inc/config.php");

if ($a == "salvar") {
    
        $Artista = new Artista();
        $Artista = $Artista->buscar("Racionais MC's");
        
        print_r($Artista);
    
} else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//pt-BR" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MediaSpot</title>
<!-- CSS -->
<link rel="stylesheet" href="media/css/site.css" />

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="media/css/bootstrap.min.css">

<link rel="stylesheet" href="media/font-awesome/css/font-awesome.min.css" />

<!-- JS -->
<script charset="utf-8" src="media/js/jquery.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script charset="utf-8" src="media/js/bootstrap.min.js"></script>

<!--
<script src="http://www.youtube.com/iframe_api"></script>
-->
<script charset="utf-8" src="media/js/jquery.cookie.js"></script>
<script charset="utf-8" src="media/js/tooltip.js"></script>
<script charset="utf-8" src="media/js/global.js"></script>
</head>
<body>
JSON WORK<br />
<?

    //$artista = new Artista;
    //$artista->buscar("CBJ Teste HUDJLKBKJADBGOJ");
    //
    //echo "Test<pre>";
    ////print_r($artista);
    //echo "</pre>";

    // $artista = new Artista("CBJ Teste", "BJ Teste Desc", "http://userserve-ak.last.fm/serve/_/66235478/Charlie+Brown+JR+champingnonvoltou.jpg","CBJ");


    //$artista->buscar("Teste 01", 1);
    /*
    $artista = new Artista();
    $artista = $artista->buscar("CB",1,true);

    $artista->Metatag = new Metatag(0,$artista->ArtistaId, "BUSCA CBJ 2");

    $artista->addMusica(new Musica("0","0","CBJ Musica Teste 06","2"));

    $artista->addMusica( new Musica("0","0","CBJ Musica Teste 07","2"));

    $artista->addMusica( new Musica("0","0","CBJ Musica Teste 08","2"));

    $artista->addMusica( new Musica("0","0","CBJ Musica Teste 09","2"));
    $artista->addMusica( new Musica("0","0","CBJ Musica Teste 10","2"));

    if($artista->ArtistaId > 0)
    $artista->Salvar();
    else
    $artista->Salvar(0,"CBJ", "CBJ TESTE APENAS", "CBJ IMAGEM");

    */
?>

<form>
<input type="submit" value="Enviar" />
</form>
</body>
</html>
    <?php
}
?>

