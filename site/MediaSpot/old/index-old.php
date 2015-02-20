<?
//ob_start();
include_once ("inc/config.php");
$pg = $_GET["pg"] ? $_GET["pg"] : $_POST["pg"];
$q = $_GET["q"] ? $_GET["q"] : $_POST["q"];
$pg = $pg.".php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MediaSpot</title>
<!-- CSS -->
<link rel="stylesheet" href="media/css/global.css" />


<link rel="stylesheet" href="media/font-awesome/css/font-awesome.min.css" />

<!-- JS -->
<script src="media/js/jquery.js"></script>
<script src="media/js/tooltip.js"></script>


<!--
<script src="http://www.youtube.com/iframe_api"></script>
-->
<script src="media/js/jquery.cookie.js"></script>
<script src="media/js/global.js"></script>

</head>
<body>
<section id="topo">
<ul id="menuTopo">
    <li>
        <a href="#" class="ativo">Música</a>
    </li>
    <li>
        <a href="#">Vídeo</a>
    </li>
    <li>
        <a href="#">Imagem</a>
    </li>
</ul>
<div class="divBuscaBox">
<form method="post" action="?pg=modulos/busca" id="formBusca">
<table cellspacing="0" cellpadding="0" width="100%" align="center">
<tr>
<td style="position: relative;padding-right:10px;" width="90%">
<input type="text" name="q" placeholder="Buscar..." value="<?=$q?>" /> 
</td>
<td style="position: relative;">
<button type="submit" style="float: right;"><i class="fa fa-search"></i></button>
</td>
</tr>
</table>
 
<input type="hidden" name="t" value="geral"/>
<input type="hidden" id="formNP" name="np" value="1"/>
<!--
<select name="t">
<option value="musica">Musica</option>
<option value="artista">Artista ou Banda</option>
<option value="album">Album</option>
</select>
-->
</form>
</div>
</section>
<section id="corpo">
<table id="tabelaCorpo" border="0" cellspacing="0" cellpadding="0" width="100%">
<!--
<tr>
<td class="tdItemInfo" valign="top" colspan="2">
<form method="post" action="?pg=modulos/busca" id="formBusca">
<button type="submit" style="float: right;">Procurar</button> <input type="text" name="q" placeholder="Buscar..." value="<?=$q?>" /> 
<input type="hidden" name="t" value="geral"/>

<select name="t">
<option value="musica">Musica</option>
<option value="artista">Artista ou Banda</option>
<option value="album">Album</option>
</select>

</form>
</td>
</tr>
-->
<tr>
<!--
<td class="tdItemArt" width="190px" valign="top">

</td>

<table id="itemMenu" border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td><a href="#"><i class="fa fa-star"></i></a></td>
<td>
<a href="javascript:void(0)" class="apRepetirbtn switchBtn" onclick="autoplay('auto');"><i class="fa fa-play-circle"></i></a>
</td>
<td>
<a href="javascript:void(0)" class="apRepetirbtn switchBtn" onclick="autoplay('replay');"><i class="fa fa-repeat"></i></a>
</td>
</tr>
</table>
-->
<td class="tdItemMenu" width="180px" valign="top">
<div class="backload" style="display: none;">
<div id="loading"><i class="fa fa-circle-o-notch fa-spin"></i></div>
</div>
<div class="sideBarBox">
<img id="imgCapa" src="media/img/icones/music-earth.png"  />

<ul id="itemMenu">
<li>
<a href="#"><i class="fa fa-star" style="float: right;margin-top:2px;"></i> Favoritas</a>
</li>
<li>
<a href="javascript:void(0)" class="apAutoplaybtn switchBtn" onclick="switcher('autoplay');"><i class="fa fa-play-circle" style="float: right;margin-top:2px;"></i> AutoPlay</a>
</li>
<li>
<a href="javascript:void(0)" class="apRepetirbtn switchBtn" onclick="switcher('replay');"><i class="fa fa-repeat" style="float: right;margin-top:2px;"></i> Repetir</a>
</li>
</ul>
</div>

</td>
<td class="tdItemConteudo" valign="top">

<?
//var_dump($cache->ler("busca_raimundos"));
//print_r(unserialize($cache->read("busca_2")));
?>

 <? 
	if(file_exists($pg)){
		include($pg);
	}else{
	?>
        <h1>404</h1>
        Esta página não existe

        <? } ?>

</td>
</tr>
</table>
<div id="PlayerBase">
<table class="playerControlsGroupBase" border="0" cellspacing="0" cellpadding="0" width="100%">
  <tr>
  <td width="250px"> 
  <i class="fa fa-backward" id="antMusica" style="margin-top:2px;"></i> 
    <div class="PlayerPlayPause" style="vertical-align: middle; display:inline-block;width:12px; height: 14px; margin-top:-3px; margin-right:3px; margin-left:3px; color:#fff"> 
    <i class="fa fa-circle-o-notch fa-spin"></i> 
    </div>  
    <i class="fa fa-forward" id="proxMusica" style="margin-top:2px;"></i> 
    <div class="PlayerTime" style="margin-top: 1px; vertical-align: middle; display:inline-block;"> </div> 
    </td>
    <td> 
    <input type="range" value="0" min="0" max="100"  style="width: 95%;" class="PlayerProgresso" />  
    </td>
    <td width="110px"><i class="fa fa-volume-up" style=" color:#fff; margin-top:2px;"></i> 
    <input type="range" min="0" max="100" class="PlayerVol PlayerVolume" style="margin-top: 0px; vertical-align: middle; display:inline-block;" />
    </td>
    </tr>
    </table>
</div>
</section>

</body>
</html>
<? //ob_end_flush(); ?>