<?
$q = $_GET["q"] ? $_GET["q"] : $_POST["q"];
$t = $_GET["t"] ? $_GET["t"] : $_POST["t"] ? $_POST["t"] : "geral";
$np = ($_GET["np"]) ? $_GET["np"] : ($_POST["np"]) ? $_POST["np"] : 1;
//$q = acentos($q);
if ($t == "geral") {
include_once("media/js/player.js.php");
?>
<script>
    var arrMusicas = [],
        arrRelacionados = [],
        objSend = null;
$(function(){
    //OBJ AJAX
   //Busca no banco
   var q = "<?= $q ?>";
   var pg = "<?= $np ?>";
   if(q!=""){
    $.post("consulta.php?a=artista", {termo: q, p: pg, t: 2}, function(data){
        var retorno = JSON.parse(data); 
        console.log(retorno);
        retorno.ArtistaId = retorno.ArtistaId ? retorno.ArtistaId : 0;
        //if(parseInt(retorno.ArtistaId) > 0 && parseInt(retorno.TotalMusicas) > 0){ //Achou no banco
            setDados("artista", retorno);
            setDados("musicas", retorno);
        //}
    });
    }
});

function uniqueBy(arr, fn) {
  var unique = {};
  var distinct = [];
  arr.forEach(function (x) {
    var key = fn(x.name);
    if (!unique[key]) {
      distinct.push(x);
      unique[key] = true;
    }
  });
  return distinct;
}

function setDados(tipo, dados) {
    
	if (tipo == "artista") {
            $("#imgCapa").attr("src", dados.Imagem);
            
            $("#hArtistName").html(dados.Titulo);
            $("#infoBanda").html(dados.Descricao);
            
             $.each(dados.Similar, function(i, item){
               $("#divSimialres").append('<a href="javascript:void()" onclick="enviaForm(\''+item+'\')" class="btn btn-primary btn-sm btnRelacionados" style="margin-bottom:3px; text-transform:capitalize">'+item+'</a> '); 
               });
            
            
       
	}
    if(tipo == "musicas"){
        z= 0;
        console.log(dados.Musicas);
        $.each(dados.Musicas, function (i, item) {
                var termo_busca = dados.Titulo.split('"').join('')+" - "+item.split('"').join('');
                $("#playlist").append('<li class="list-group-item" style="text-transform:capitalize;padding: 8px; position:relative">\
                <table border="0" cellspacing="0" cellpadding="0" width="100%">\
                <tr>\
                <td width="60px">\
                <div class="btn-group">\
                  <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown">\
                    <i class="fa fa-plus"></i>\
                  </button>\
                  <ul class="dropdown-menu" role="menu">\
                   <li><a href="#" style="text-decoration:none;">Adicionar aos Favoritos</a></li>\
                    <li><a href="#" style="text-decoration:none;">Adicionar a lista de reprodu&ccedil;&atilde;o...</a></li>\
                  </ul>\
                </div>\
                </td>\
                <td>\
                <span class="musicNome_'+z+'">'+item+'</span>\
                </td>\
                <td width="120px" align="right" valign="top">\
                <div id="playerControl'+z+'" style="float:right;">\
                <div class="btn btn-default btn-sm startplay startplay'+z+'" rel="#playerControl'+z+'" value="'+termo_busca+'" indexId="'+z+'" >\
                <i class="fa fa-play" style="font-size: 16px;""></i>\
                </div>\
                </div>\
                </td>\
                </tr>\
                </table>\
                </li>');
                         z++;
        });
        
        
        
        
        $("[class*='startplay']").click(function(){
                             console.log("chegou");
                            $(".startplay").show();
                               var termoBusca = $(this).attr("value");
                               var indexId = $(this).attr("indexId");
                               //console.log(termoBusca);
                               var player = $($(this).attr("rel")); 
                               //console.log(player);
                               BuscaMusica(player, termoBusca);
                               $.cookie("tocandoAgora", indexId);
                               $("#navPlayer").slideDown();
                               $("#PlayerBase").slideDown();
                                $(this).hide();
                            });
                            
                            //DOUBLE CLICK
            $("#playlist li").dblclick(function(){
                    console.log("clickou");
                    var $obj = $(".startplay", this).click();
            });
                            $(".startplay").show();
                            $("#totalItens").html($(".startplay").size()+" Resultados");
                            
    }
}
   </script>
   <script>
function MudaPagina(pg){
   //Busca no banco
   var query = "<?= $q ?>";
   if(query!=""){
    $.post("consulta.php?a=artista", {termo: query, p: pg, t: 2}, function(data){
        var retorno = JSON.parse(data); 
        console.log(retorno);
        retorno.ArtistaId = retorno.ArtistaId ? retorno.ArtistaId : 0;
        //if(parseInt(retorno.ArtistaId) > 0 && parseInt(retorno.TotalMusicas) > 0){ //Achou no banco
            setDados("musicas", retorno);
        //}
    });
    }
}
$(function(){
    //var autoplayCookie = $.cookie("autoplay");
//    if(autoplayCookie && autoplayCookie!= null && autoplayCookie=="true"){
//        setTimeout(function(){
//            $(".startplay0").click();
//        },3000);
//        // $(".startplay").show();
////         var obj = $(".startplay1")
////            obj.hide();
////               var termoBusca = obj.attr("value");
////               var indexId = obj.attr("indexId");
////               console.log(termoBusca);
////               var player = $(obj.attr("rel")); 
////               console.log(player);
////               BuscaMusica(player, termoBusca);
////               $.cookie("tocandoAgora", indexId);
////               $("#PlayerBase").slideDown();
//    }
    $("#proxPg").click(function(){
        var pag = parseInt($("#numPg").html()) + 1;
        $("#playlist").html("");
        MudaPagina(pag);
        
        $("#numPg").html(pag);
    });
    $("#antPg").click(function(){
        var pag = parseInt($("#numPg").html()) - 1;
        $("#playlist").html("");
        MudaPagina(pag);
        
        $("#numPg").html(pag);
    });
    
    
});
</script>
<div id="playerDiv"></div>
<div class="sideBarBox">
                    <img id="imgCapa" src="media/img/icones/music-earth.png"  />
<!--                    <ul id="itemMenu">-->
<!--                        <li>-->
<!--                            <a href="#"><i class="fa fa-star" style="float: right;margin-top:2px;"></i> Favoritas</a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="javascript:void(0)" class="apAutoplaybtn switchBtn" onclick="switcher('autoplay');"><i class="fa fa-play-circle" style="float: right;margin-top:2px;"></i> AutoPlay</a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="javascript:void(0)" class="apRepetirbtn switchBtn" onclick="switcher('replay');"><i class="fa fa-repeat" style="float: right;margin-top:2px;"></i> Repetir</a>-->
<!--                        </li>-->
<!--                    </ul>-->
                </div>
    <div class="row" style="position:relative; margin-right: 0; min-height:316px;">
        <style>
            .infoBOX{
                width: -webkit-calc(100% - 320);  /* para Chrome */
                width: -moz-calc(100% - 320px);     /* para Firefox */
                width: calc(100% - 320px);          /* para suporte nativo */
                
                float:right;
            }
            .list-group-item{
                position:relative;
            }
            .list-group-item:hover{
                background:#F5F5F5;
            }
        </style>

        <div class="col-lg-3 imgContent" style="float: left; position:absolute; padding-right:0;">
            <div class="bs-component">
                <div class="backload" style="display: none;">
                    <div id="loading"><i class="fa fa-circle-o-notch fa-spin"></i></div>
                </div>
                
            </div>
        </div>

        <div class="infoBOX">
            <div class="bs-component">
                <div class="panel panel-default" style=";min-height:295px;position:relative">
                    <div class="panel-heading" id="hArtistName">Nome do Artista</div>
                    <div class="panel-body" style="min-height: 169px;">
                        <div id="infoBanda"></div>
                        
                    </div>
                    <div class="panel-footer" style="bottom: 0; width: 100%;">
                            <h4 style="margin: 0; margin-bottom: 11px;">Similares</h4>
                            <div id="divSimialres"></div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="toolbar" style="margin-right: 0;margin-left: 0;">
        <ul class="pagination" style="float:right">
            <li><a id="antPg">&laquo;</a></li>
            <li class="active"><a id="numPg"><?= $np ?></a></li>
            <li><a id="proxPg">&raquo;</a></li>
        </ul>
        <ul class="pagination" style="float:left">
            <li><a class="tooltipf apAutoplaybtn switchBtn" title="AutoPlay"  onclick="switcher('autoplay');"><i class="fa fa-play-circle" style="line-height: 1.4;"></i></a></li>
            <li><a class="tooltipf apRepetirbtn switchBtn" title="Repetir"  onclick="switcher('replay');"><i class="fa fa-refresh" style="line-height: 1.4;"></i></a></li>
            <li><a class="tooltipf" title="Letra da M&uacute;sica Atual" onclick="getLetra()"><i class="fa fa-file-text-o" style="line-height: 1.4;"></i></a></li>
        </ul>
    </div>
   <ul id="playlist" class="list-group"></ul>

<!-- Modal -->
<div class="modal fade" id="letraModal" tabindex="-1" role="dialog" aria-labelledby="letraTitulo" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
        <h4 class="modal-title" id="letraTitulo" style="text-transform:capitalize">Letra da Musica</h4>
      </div>
      <div class="modal-body" id="tabLetras" >
      <ul class="nav nav-tabs">
  <li class="active"><a href="#letraOriginal" data-toggle="tab">Original</a></li>
  <li class="liTraducao" ><a href="#letraTraducao" data-toggle="tab">Tradu&ccedil;&atilde;o</a></li>
</ul>
<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade active in" id="letraOriginal">
    <p></p>
  </div>
  <div class="tab-pane fade" id="letraTraducao">
    <p></p>
  </div>
</div>
      </div>
      
    </div>
  </div>
</div>

<!-- Lista de Reproducao -->
<div class="modal fade" id="listaModal" tabindex="-1" role="dialog" aria-labelledby="listaTitulo" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
        <h4 class="modal-title" id="listaTitulo" style="text-transform:capitalize">Adicionar a Lista de Reproducao</h4>
      </div>
      <div class="modal-body" >
      <form id="addItemLista">
      Lista de Reproducao<br />
     <select class="form-control" id="select">
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
        </select> <button id="addNovaLista" class="btn btn-primary"><i class="fa fa-plus"></i></button><br />
     
     <b></b>
     </form>
      </div>
       <div class="modal-footer">
        <button type="button" id="btnCancelaLogin" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" onclick="confirmaItemLista()" id="btnLogin" class="btn btn-primary">Adicionar</button>
      </div>
    </div>
  </div>
</div>

   <?
} else
    if ($t == "musica") {
?>
    <script type="text/javascript" src="media/js/player.js"></script>
    <script>
$(function(){
   BuscaMusica("#player", "<?= $q ?>") 
});
</script>
<div id="result">
</div>

<iframe style="" id="video" type="text/html" width="640" height="50" src="" frameborder="0" allowfullscreen></iframe>


<br /><br />
<div id="player"></div>
    <?
        /*$mp3 = new MP3;
        $buscaCache = $cache->ler("busca_".strtolower($q));
        if($buscaCache!=null){
        $mp3->lista = unserialize($buscaCache);
        }
        else{
        $mp3->buscar($q);
        
        $cache->salvar("busca_".strtolower($q), serialize($mp3->lista));
        }
        
        //setcookie("busca_".$q, serialize($mp3->lista), strtotime('+365 days'), "/");
        //$_COOKIE["busca_$q"] = serialize($mp3->lista);
        ?>
        
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
        <?
        foreach($mp3->lista as $item){
        ?>
        
        <tr>
        <td style="padding: 10px;"><?=$item["titulo"]?>
        </td>
        <td>
        <a href="<?=$item["url"]?>" target="_blank" class="botao azul">Baixar</a>
        </td>
        </tr>
        
        <?
        }
        ?>
        </table>
        <?
        
        //print_r($mp3->lista);
        */

    }
?>