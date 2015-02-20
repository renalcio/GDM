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
        console.log(data);
        var retorno = JSON.parse(data); 
        retorno.ArtistaId = retorno.ArtistaId ? retorno.ArtistaId : 0;
        if(parseInt(retorno.ArtistaId) > 0 && parseInt(retorno.TotalMusicas) > 0){ //Achou no banco
            setDados("artista", retorno, true);
            setDados("musicas", retorno, true);
        }else{
           $.ajax({
            	type: 'GET',
            	url: "<?= LastFM::getUrl($q, 'track.search', 'track') ?>&page=<?= $np ?>",
            	contentType: 'application/json; charset=utf-8',
            	dataType: 'json',
            	success: function(data) {
            		//console.log(data.results); // resultados
            		var artistaNome = data.results.trackmatches.track[0].artist; // Artista
                    var musicas = data.results.trackmatches;
            		
                    setDados("musicas", musicas);
                    
            		$.ajax({
            			type: 'GET',
            			url: '<?= LastFM::getUrlSemTermo("artist.getInfo", "artist", true) ?>' + artistaNome,
            			contentType: 'application/json; charset=utf-8',
            			dataType: 'json',
            			success: function(data) {
            				console.log(data); // Artista
            				var artista = data.artist;
            				setDados("artista", artista);
                            
                            objSend.Musicas = arrMusicas;
                            
                            //console.log(objSend);
                                
                                //SALVAR VIA AJAX
                             $.post("consulta.php?a=salvar", {obj: objSend}, function(data){
                                    //console.log(JSON.parse(data)); 
                                    console.log(data);
                             }); 
            			},
            			error: function(data) {
            				console.log(data);
            			}
            		});
            		//$.each(data.results.trackmatches.track, function (i, item) {
            		//                                console.log(item.artist);
            		//                                console.log(item.name);
            		//                            });
            	},
            	error: function(data) {
            		//console.log(data);
            	}
            });
        }
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

function setDados(tipo, dados, interno) {
	if (tipo == "artista") {
	   //console.log(dados);
       
       if(interno==true){
            $("#imgCapa").attr("src", dados.Imagem);
            
            $("#hArtistName").html(dados.Titulo);
            $("#infoBanda").html(dados.Descricao);
            
             $.each(dados.Relacionados, function(i, item){
               $("#divSimialres").append('<a href="javascript:void()" onclick="enviaForm(\''+item.Titulo+'\')" class="btn btn-primary btn-sm btnRelacionados" style="margin-bottom:3px; text-transform:capitalize">'+item.Titulo+'</a> '); 
               });
            
            
       }else{
    		$("#imgCapa").attr("src", dados.image[4]["#text"]);
            
            var re = /<(.*)>(.*)<\/a>/; 
            var str = dados.bio.summary;
            var subst = '$2'; 
             
            //var strInfoBanca = str.replace(re, subst);
            var strInfoBanca = $("<div/>").html(str).text().split("Read more")[0];
            
            $("#infoBanda").html(strInfoBanca);
            
            var arrSimilares = dados.similar.artist;
            $.each(arrSimilares, function(i, item){
               $("#divSimialres").append('<a href="javascript:void()" onclick="enviaForm(\''+item.name+'\')" class="btn btn-primary btn-sm btnRelacionados" style="margin-bottom:3px; text-transform:capitalize">'+item.name+'</a> '); 
               
            //Cria Obj para ajax
                        var objRelacionado = {
                                "ArtistaRelacionadoId":0,
                                "ArtistaId":0,
                                "Titulo":item.name
                        }
                        arrRelacionados.push(objRelacionado);
            });
            
            
            $("#hArtistName").html(dados.name);
            
            //AJAX
           objSend = {
                "Musicas":[],
                "Relacionados": arrRelacionados,
                "Titulo": dados.name,
                "Descricao": strInfoBanca,
                "Imagem": dados.image[4]["#text"],
                "ArtistaId": 0,
                "Metatag": {
                    "MetatagId": 0,
                    "ArtistaId": 0,
                    "Tags": "<?= $q ?>"
                    }
                };
           }
	}
    if(tipo == "musicas"){
        z= 0;
        if(interno==true){
            $.each(dados.Musicas, function (i, item) {
                var termo_busca = dados.Titulo.split('"').join('')+" - "+item.Titulo.split('"').join('');
                $("#playlist").append('<li class="list-group-item" style="text-transform:capitalize;padding: 8px; position:relative"><table border="0" cellspacing="0" cellpadding="0" width="100%"><tr><td> <span class="musicNome_'+z+'">'+item.Titulo+'</span></td><td width="120px" align="right" valign="top"><div id="playerControl'+z+'" style="float:right;"><div class="btn btn-default btn-sm startplay startplay'+z+'" rel="#playerControl'+z+'" value="'+termo_busca+'" indexId="'+z+'" ><i class="fa fa-play" style="font-size: 16px;""></i></div></div></td></tr></table></li>');
                         z++;
                });
        }else{
            
        
            arrMista = dados.track;
        //console.log(dados);
        $.each(arrMista, function (i, item) {
            //console.log(item.name);
            item.name = item.name.toLowerCase();
            });
        
        var array = uniqueBy(arrMista, function(x){return x;});
        
        //console.log(array);
        $.each(array, function (i, item) {
            var	album;
            var termo_busca = arrMista[0].artist.split('"').join('')+" - "+item.name.split('"').join('');
            //console.log(termo_busca);
                        $("#playlist").append('<li class="list-group-item" style="text-transform:capitalize;padding: 8px; position:relative"><table border="0" cellspacing="0" cellpadding="0" width="100%"><tr><td> <span class="musicNome_'+z+'">'+item.name+'</span></td><td width="120px" align="right" valign="top"><div id="playerControl'+z+'" style="float:right;"><div class="btn btn-default btn-sm startplay startplay'+z+'" rel="#playerControl'+z+'" value="'+termo_busca+'" indexId="'+z+'" ><i class="fa fa-play" style="font-size: 16px;""></i></div></div></td></tr></table></li>');
                         z++;
                         
                         
                        
                     //}
                     
                     //Cria Obj para ajax
                        var objMusica = {
                                "MusicaId":0,
                                "ArtistaId":0,
                                "Titulo":item.name,
                                "Pagina":"<?= $np ?>"
                        }
                        arrMusicas.push(objMusica);
                    //console.log(objMusica);
                     
                     
//             
//    			}
//    		});              
    	}); 
        
        
        }
        
        
        
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
                            $(".startplay").show();
                            $("#totalItens").html($(".startplay").size()+" Resultados");
                            
    }
}
   </script>
   <script>

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
        var pag = parseInt("<?= $np ?>") + 1;
        $("#formNP").val(pag);
        $("#formBusca").submit();
    });
    $("#antPg").click(function(){
        var pag = parseInt("<?= $np ?>") - 1;
        $("#formNP").val(pag);
        $("#formBusca").submit();
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
            <li class="active"><a><?= $np ?></a></li>
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