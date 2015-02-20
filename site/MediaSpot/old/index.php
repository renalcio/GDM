<?
include_once ("inc/config.php");
$pg = (isset($_GET["pg"])) ? $_GET["pg"] : $_POST["pg"];
$q = $_GET["q"] ? $_GET["q"] : $_POST["q"];
if(empty($pg))
	$pg = "modulos/home";
$pg = $pg.".php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//pt-BR" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<link rel="icon" type="image/png" href="media/img/iconeazulbranco.png" />
<title>MediaSpot</title>
<!-- CSS -->
<link rel="stylesheet" href="media/css/site.css" />

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="media/css/bootstrap.min.css" />
<link rel="stylesheet" href="media/css/bootstrap-slider.css">
<link rel="stylesheet" href="media/font-awesome/css/font-awesome.min.css" />

<!-- JS -->
<script charset="utf-8" src="media/js/jquery.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script charset="utf-8" src="media/js/bootstrap.js"></script>
<script src="media/js/bootstrap-typeahead.min.js"></script>
<script type='text/javascript' src="media/js/bootstrap-slider.js"></script>
<!--
<script src="http://www.youtube.com/iframe_api"></script>
-->
<script charset="utf-8" src="media/js/jquery.cookie.js"></script>
<script charset="utf-8" src="media/js/tooltip.js"></script>
<script charset="utf-8" src="media/js/global.js"></script>
<script>

$(function(){ 
    $('#buscaQ').typeahead({
        menu : '<ul class="typeahead dropdown-menu qMenu"></ul>',
        timeout: 1000,
        ajax : {
            url: "consulta.php?a=busca&t=json",
            triggerLength: 1
        },
        onSelect : function(item){
            $("#buscaQ").val(item.value);
            $("#formBusca").submit();
        }
    });
    
    $(".PlayerProgresso").slider({
    	formatter: function(value) {
    	   var timeAtual = value,
                    timeTotal = $(".PlayerProgresso").slider("getAttribute", "max"),
                    
                    timeAtualMinutos = Math.floor(parseFloat(timeAtual) / 60),
                    timeAtualSegundos = Math.floor(timeAtual - timeAtualMinutos * 60),
                    
                    timeTotalMinutos = Math.floor(parseFloat(timeTotal) / 60),
                    timeTotalSegundos = Math.floor(timeTotal - timeTotalMinutos * 60);
                    
                    timeAtualMinutos = (timeAtualMinutos < 10) ? "0"+timeAtualMinutos : timeAtualMinutos;
                    timeAtualSegundos = (timeAtualSegundos < 10) ? "0"+timeAtualSegundos : timeAtualSegundos;
                    
                    timeTotalMinutos = (timeTotalMinutos < 10) ? "0"+timeTotalMinutos : timeTotalMinutos;
                    timeTotalSegundos = (timeTotalSegundos < 10) ? "0"+timeTotalSegundos : timeTotalSegundos;
                    
                    timeFrase = timeAtualMinutos + ":"+timeAtualSegundos +" / "+timeTotalMinutos+":"+timeTotalSegundos;
           
    		return timeFrase;
    	}
    });
    
    /*$(".PlayerVolume").slider().on('slide', function(val){
            //console.log(val.value)
    });*/
});

</script>
<style>
.qMenu li a {
    padding: 15px 20px !important;
}
.slider-selection {
	background: #BABABA;
}
</style>
</head>
<body>
<section id="topo">
    <div class="navbar navbar-inverse">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" onclick="setTimeout(function(){$('#buscaQ').focus().select()}, 100);" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"><img src="media/img/logo.png" style="height: 41px;margin-top: -11px;"/></a>
        </div>
        <div class="navbar-collapse collapse navbar-inverse-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Música</a></li>
                <li><a href="#">Vídeo</a></li>
                <li><a href="#">Imagem</a></li>

            </ul>
            
            <form class="navbar-form navbar-left" method="post" action="?pg=modulos/busca" id="formBusca">
            <div class="input-group">
      <div class="input-group-btn">
        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">Artista <span class="caret"></span></button>
        <ul class="dropdown-menu" role="menu">
          <li><a href="#">Artista</a></li>
          <li><a href="#">Musica</a></li>
        </ul>
      </div>
                <input type="text" name="q" class="form-control col-lg-8" placeholder="Buscar" id="buscaQ" autocomplete="off" value="<?=$q?>" data-provide="typeahead" data-items="4" data-source="" />
                </div>
                <input type="hidden" name="t" value="geral"/>
                <input type="hidden" id="formNP" name="np" value="1"/>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <? if (!isset($_SESSION["Usuario"]) ){ ?>
                <li><a href="#">Cadastre-se</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Entrar <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#" data-toggle="modal" data-target="#loginModal">Entrar</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#cadastroModal">Cadastre-se</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </li>
               <? }else{ ?>
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=nome($session->ver("Usuario", "Nome"), 1)?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Favoritos</a></li>
                        <li><a href="#">Listas de Reproducão</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Sair</a></li>
                    </ul>
                </li>
               <?  } ?>
            </ul>
        </div>
    </div>
<!--<div class="divBuscaBox">
</div>--!>
</section>
<section id="corpo" style="padding:10px; padding-bottom: 60px; padding-top:0;"><? 	
    if(file_exists($pg)){
		include($pg);
	}else{
	?>
<div class="alert alert-dismissable alert-warning" style="display: none;" id="noNotify">
  <button type="button" class="close" data-dismiss="alert">x</button>
  <h4>Atenção!</h4>
  <span></span>
  </div>
 <div>
                <div class="panel panel-default">
                    <div class="panel-heading" id="hArtistName">Ops!</div>
                    <div class="panel-body">
                        Esta página non eqziste!
                    </div>
                </div>
    </div>

        <? } ?>
<br />
        <div class="well">
  2014 &copy; Copyright to de left to de top from behind in de midle. Site desenvolvido por <a href="mailto:r.carlos@live.com" target="_blank">Renalcio Carlos</a> 
</div>


<!-- CADASTRO -->
<div class="modal fade" id="cadastroModal" tabindex="-1" role="dialog" aria-labelledby="cadastroModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
        <h4 class="modal-title" id="cadastroModal" style="text-transform:capitalize">Cadastro</h4>
      </div>
      <div class="modal-body" id="cadastroDiv">
      <div id="cadastroErros">
      
      </div>
      <form id="cadastroForm">
      <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-users"></i></span>
        <input type="text" class="form-control" placeholder="Nome" name="nome" />
        </div><br />
      
        <div class="input-group">
        <span class="input-group-addon" style="padding: 10px 20px;"><i class="fa fa-user"></i></span>
        <input type="text" class="form-control" placeholder="Login" name="login" />
        </div>  <br />
        
        <div class="input-group">
        <span class="input-group-addon" style="padding: 10px 19px;"><i class="fa fa-key"></i></span>
        <input type="password" class="form-control" placeholder="Senha" name="senha" />
        </div><br />
        
        <div class="input-group">
        <span class="input-group-addon" style="padding: 10px 19px;"><i class="fa fa-envelope"></i></span>
        <input type="email" class="form-control" placeholder="Email" name="email" />
        </div>
      </form>
      </div>
       <div class="modal-footer">
        <button type="button" id="btnCancelaCadastro" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" onclick="confirmaCadastro()" id="btnCadastro" class="btn btn-primary">Cadastrar</button>
        <button type="button" id="btnLoginCadastro" class="btn btn-primary" style="display: none;"  data-toggle="modal" data-target="#loginModal">Continuar</button>
      </div>
    </div>
  </div>
</div>

<!-- LOGIN -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
        <h4 class="modal-title" id="loginModal" style="text-transform:capitalize">Login</h4>
      </div>
      <div class="modal-body" id="loginDiv">
      <div id="loginErros">
      
      </div>
      <form id="loginForm">     
        <div class="input-group">
        <span class="input-group-addon" style="padding: 10px 20px;"><i class="fa fa-user"></i></span>
        <input type="text" class="form-control" placeholder="Login ou Email" name="login" />
        </div>  <br />
        
        <div class="input-group">
        <span class="input-group-addon" style="padding: 10px 19px;"><i class="fa fa-key"></i></span>
        <input type="password" class="form-control" placeholder="Senha" name="senha" />
        </div><br />
        
        <label><input type="checkbox" value="true" name="salvar" /> Lembre-me</label><br />
        
        <a href="#">Esqueci a senha</a> | <a href="#" data-toggle="modal" data-target="#cadastroModal">Cadastre-se</a>
      </form>
      </div>
       <div class="modal-footer">
        <button type="button" id="btnCancelaLogin" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" onclick="confirmaLogin()" id="btnLogin" class="btn btn-primary">Entrar</button>
      </div>
    </div>
  </div>
</div>
</div>

<nav class="navbar navbar-default navbar-fixed-bottom" id="navPlayer" role="navigation">
  <div class="container" id="PlayerBase" style="padding: 0px; margin:0px; width:100%">
    <table border="0" class="playerControlsGroupBase" cellpadding="0" cellspacing="0" width="100%" style="border: 0px solid #fff;">
    <tbody><tr>
    <td colspan="2" style="padding: 0px 5px;padding-bottom: 0px;" class="tooltipf" id="PlayerTimeProgress" data-toggle="tooltip" data-placement="top" title="" data-original-title="">
    <input type="text" value="0" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="14" style="width: 100%;" class="PlayerProgresso" />  
    </td>
    </tr>
    <tr>
    <td style=" padding: 0px 5px; ">
     <i class="fa fa-backward" id="antMusica" style="margin-top:2px;font-size: 24px;"></i>
     
    <div class="PlayerPlayPause" style="vertical-align: middle; display:inline-block;width:auto; height: auto; margin-top:-3px; margin-right:3px; margin-left:3px; color:#fff"> 
    <i class="fa fa-cog fa-spin" style="font-size: 24px;margin-top: -7px;"></i> 
    </div>
    
    <i class="fa fa-forward" id="proxMusica" style="margin-top:2px;font-size: 24px;"></i> 
    <div class="PlayerTime PlayerTimeBar" style="margin-top: -11px; vertical-align: middle; display:inline-block;"> </div> 
    </td>
    <td style="max-width: 142px !important; padding: 0px 5px; width:142px !important;">
    <i class="fa fa-volume-up" style=" color:#fff; margin-top:2px;font-size: 24px;"></i> 
    <input type="text" class="PlayerVol PlayerVolume" style="margin-bottom: 6px !important; vertical-align: middle; display:inline-block; width:100px;" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="100" />
    </td>
    </tr>
    </tbody></table>
  </div>
</nav>
</section>
</body>
</html>
 
        