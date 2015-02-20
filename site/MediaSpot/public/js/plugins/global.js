//GET LETRA
$.cookie("AjaxLoad", "sim");

String.prototype.Capitalize = function() {
    var tx = this;
    return tx.replace(/\w\S*/g, function(txt) {
        return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
    });
}

function confirmaLogin(){
    var dados = $("#loginForm").serialize();
 
			jQuery.ajax({
				type: "POST",
				url: "usuario.php?a=login",
				data: dados,
				success: function( data )
				{
				    data = JSON.parse(data);
					console.log(data);
                    if(data.Status == true) {
                        $("#loginDiv").html('<div class="alert alert-success" role="alert">Login efetuado com sucesso!</div>');
                        setTimeout(function(){
                            location.reload();
                        }, 1000);
                    }else{
                        $("#loginErros").html("");
                        $.each(data.Erros, function (i, item) {
                            $("#loginErros").append('<div class="alert alert-danger" role="alert">'+item.Mensagem+'</div>');
                        });
                    }
				}
			});
}

function confirmaCadastro(){
    var dados = $("#cadastroForm").serialize();
 
			jQuery.ajax({
				type: "POST",
				url: "usuario.php?a=cadastro",
				data: dados,
				success: function( data )
				{
				    data = JSON.parse(data);
					console.log(data);
                    if(data.Status == true) {
                        $("#cadastroDiv").html('<div class="alert alert-success" role="alert">Cadastro efetuado com sucesso!</div>');
                        $("#btnCadastro").hide();
                        $("#btnCancelaCadastro").hide();
                        $("#btnLoginCadastro").show();
                    }else{
                        $("#cadastroErros").html("");
                        $.each(data.Erros, function (i, item) {
                            $("#cadastroErros").append('<div class="alert alert-danger" role="alert">'+item.Mensagem+'</div><br>');
                        });
                    }
				}
			});
}

function getLetra(){
    $.cookie("AjaxLoad", "nao");
    var index = ($.cookie("tocandoAgora") && parseInt($.cookie("tocandoAgora")) >= 0) ? parseInt($.cookie("tocandoAgora")) : 0,
    artista = $("#hArtistName").html(), 
    musica = $(".musicNome_"+index).html();
    
    //console.log(artista);
    //console.log(musica);
    
    jQuery.getJSON(
        "http://api.vagalume.com.br/search.php"
            + "?art=" + artista
            + "&mus=" + musica,
        function (data) {
            // Letra da música
            console.log(data);
            //console.log(data.mus[0].text);
            if(data.type != "song_notfound"){
                if(Boolean(data.mus[0].text)){
                    var strLetra = data.mus[0].text.replace(/(?:\r\n|\r|\n)/g, '<br />');
                    $("#letraOriginal p").html(strLetra);
                    $("#letraTitulo").html(artista+" - "+musica);
                    $(".liTraducao").addClass("disabled");
                    $(".liTraducao a").attr("href", "javascript:void()").attr("data-toggle", "");
                    
                    if(Boolean(data.mus[0].translate)){
                    strLetra = data.mus[0].translate[0].text.replace(/(?:\r\n|\r|\n)/g, '<br />');
                    $("#letraTraducao p").html(strLetra);
                    $(".liTraducao").removeClass("disabled");
                    $(".liTraducao a").attr("href", "#letraTraducao").attr("data-toggle", "tab");
                    }
                }
            }else{
                $("#letraOriginal p").html("M&uacute;sica n&atilde;o encontrada.");
                $("#letraTraducao p").html("M&uacute;sica n&atilde;o encontrada.");
                $("#letraTitulo").html("Ops...");
                $(".liTraducao").addClass("disabled");
                $(".liTraducao a").attr("href", "javascript:void()").attr("data-toggle", "");
            }
            
            $('#tabLetras a:first').tab('show');
            
            $('#letraModal').modal('show');
        }
    );
}



//Envia Formulario principal
function enviaForm(termo){
    $("#buscaQ").val(termo);
    $("#formNP").val(1);
    $("#formBusca").submit();
}
/**
 * @function isMobile
 * detecta se o useragent e um dispositivo mobile
 */
function isMobile()
{
	var userAgent = navigator.userAgent.toLowerCase();
	if( userAgent.search(/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i)!= -1 )
		return true;
}
//Notificações - Parametros: {mensagem: "", imagem: "", tempo:3500}
function notificar(parametros) {
    if (typeof parametros === 'undefined') {
        var parametros = {
            mensagem: "",
            tempo: 3500,
            imagem: ""
        }
    }
    
    var mensagem = (typeof parametros.mensagem === 'undefined') ? "" : parametros.mensagem;
        tempo = parseFloat(parametros.tempo) > 0 ? parametros.tempo : 3500,
        imagem = (typeof parametros.imagem === 'undefined') ? "" : parametros.imagem;
    
    
  // Let's check if the browser supports notifications
  if (!("Notification" in window)) {
    if(isMobile()){
    $("#noNotify").show().find("span").html("Seu navegador não suporta notificações, para desfrutar de uma melhor experiencia no Mediaspot atualize seu navegador");
    }
  }

  // Let's check if the user is okay to get some notification
  else if (Notification.permission === "granted") {
    $("#noNotify").hide().find("span").html("");
    // If it's okay let's create a notification
    var notificacao = new Notification(mensagem, {icon: imagem});
    setTimeout(function(){
        notificacao.close();
    },tempo);
  }

  // Otherwise, we need to ask the user for permission
  // Note, Chrome does not implement the permission static property
  // So we have to check for NOT 'denied' instead of 'default'
  else if (Notification.permission !== 'denied') {
    $("#noNotify").show().find("span").html("Por favor, habilite as notifica&ccedil;&atilde;es para este site para uma melhor experiencia com o MediaSpot!");
    Notification.requestPermission(function (permission) {
      // Whatever the user answers, we make sure we store the information
      if(!('permission' in Notification)) {
        Notification.permission = permission;
      }

      // If the user is okay, let's create a notification
      if (permission === "granted") {
        $("#noNotify").hide().find("span").html("");
        var notificacao = new Notification(mensagem, {icon: imagem});
        setTimeout(function(){
            notificacao.close();
        },tempo);
      }
    });
  }

  // At last, if the user already denied any notification, and you 
  // want to be respectful there is no need to bother him any more.
  
  
}

String.prototype.toCapitalize = function()
{ 
   return this.toLowerCase().replace(/^.|\s\S/g, function(a) { return a.toUpperCase(); });
}

//Controle
$(function(){
    $("#proxMusica").click(function(){
        var musicaAtual = ($.cookie("tocandoAgora") && $.cookie("tocandoAgora") >= 0) ? $.cookie("tocandoAgora") : 0,
            novaMusica = parseInt(musicaAtual) + 1,
            totalMusica = parseInt($(".startplay").size());
            
        if(novaMusica <= totalMusica){
            $(".startplay:Eq("+novaMusica+")").click();
            $.cookie("tocandoAgora", novaMusica);
        }
    });
    $("#antMusica").click(function(){
        var musicaAtual = ($.cookie("tocandoAgora") && $.cookie("tocandoAgora") >= 0) ? $.cookie("tocandoAgora") : 0,
            novaMusica = parseInt(musicaAtual) - 1;
        if(musicaAtual >0){   
            $(".startplay:Eq("+novaMusica+")").click();
            $.cookie("tocandoAgora", novaMusica);
        }
    });
});

//LOADING
$(function(){
  $(document).ajaxStart(function(){
    var reload = $.cookie("AjaxLoad");
    if(reload == "sim"){
        $(".backload").show();
        setTimeout(function(){
            $(".backload").hide();
        }, 6000);
    }
   });
   $(document).ajaxStop(function(){
    var reload = $.cookie("AjaxLoad");
    if(reload == "sim"){
        setTimeout(function(){
            $(".backload").hide();
            var autoplay = $.cookie("autoplay");
            var replay = $.cookie("replay");
        	if(replay == "true"){
        		$(".apRepetirbtn").parent("li").toggleClass("active");
        	}
            if(autoplay == "true"){
        		$(".apAutoplaybtn").parent("li").toggleClass("active");
                $(".startplay:first").click();
        	}
        	$(".switchBtn").click(function(){
        			$(this).parent("li").toggleClass("active");
        	});
            //DOUBLE CLICK
            $("#playlist li").dblclick(function(){
                    console.log("clickou");
                    var $obj = $(".startplay", this).click();
            });
        }, 3000);
        $.cookie("AjaxLoad", "nao");
    }
   });
});

//AUTOPLAY
function autoplay(){
	var cookie = $.cookie("autoplay");
	if(cookie && cookie != null && cookie == "true"){
		$.cookie("autoplay", null);
	}else{
		$.cookie("autoplay", "true");
	}
}

function replay(){
	var cookie = $.cookie("replay");
	if(cookie && cookie != null && cookie == "true"){
		$.cookie("replay", null);
	}else{
		$.cookie("replay", "true");
	}
}

function switcher(cookieNome){
	var cookie = $.cookie(cookieNome);
	if(cookie && cookie != null && cookie == "true"){
		$.cookie(cookieNome, null);
	}else{
		$.cookie(cookieNome, "true");
	}
}

// TOOLTIP
$(function(){
$(".tooltip").style_my_tooltips({ 
		tip_follows_cursor: "on", //on/off
		tip_delay_time: 0 //milliseconds
	});  

    $('.tooltipf').tooltip();
});

/*$(function(){
	var autoplay = $.cookie("autoplay");
    var replay = $.cookie("replay");
	if(replay == "true"){
		$(".apRepetirbtn").parent("li").addClass("active");
	}
    if(autoplay == "true"){
		$(".apAutoplaybtn").parent("li").addClass("active");
	}
	$(".switchBtn").click(function(){
			$(this).parent("li").toggleClass("active");
	});
});*/


////FIX TOPBAR
//$(function(){
//    $(window).scroll(function(e){
//        //console.log("chegou!");
//        $el = $('.divBuscaBox');
//        $bar = $('.sideBarBox');
//        //console.log($(this).scrollTop());
//            if ($(this).scrollTop() > 99) {
//                $el.addClass('fixedTop');
//                $bar.addClass('fixedBar');
//            }else{
//                $el.removeClass('fixedTop');
//                $bar.removeClass('fixedBar');
//            }
//    });
//});