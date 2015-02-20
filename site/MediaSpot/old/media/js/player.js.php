<script>
//var player;
//function onYouTubePlayerAPIReady() {
//    player = new YT.Player('video', {
//      events: {
//        'onReady': onPlayerReady
//      }
//    });
//}
//
//function onYouTubePlayerAPIReadyNew() {
//    player = new YT.Player('video', {
//      events: {
//        'onReady': onPlayerReadyStart
//      }
//    });
//}
//
//function onPlayerReady(event){
//  //event.target.playVideo();
//    SetBotoes()
//  }
//  
//function onPlayerReadyStart(event){
//  event.target.playVideo();
//    SetBotoes()
//  }

// 2. This code loads the IFrame Player API code asynchronously.
      var tag = document.createElement('script');

      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 3. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      var player;
      function onYouTubeIframeAPIReady() {
        player = new YT.Player('playerDiv', {
          height: '360',
          width: '640',
          videoId: '',
          playerVars: {
            'enablejsapi': 1
          },
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });
      }
      
      function carregarVideoId(videoId){
        if(player){
        player.loadVideoById(videoId);
        }
      }

      // 4. The API will call this function when the video player is ready.
      function onPlayerReady(event) {
        event.target.playVideo();
      }

      // 5. The API calls this function when the player's state changes.
      //    The function indicates that when playing a video (state=1),
      //    the player should play for six seconds and then stop.
      var done = false;
      function onPlayerStateChange(event) {
        var videoStatus = player.getPlayerState();
        
        if(videoStatus == 0){
             var autoPlay = $.cookie("replay");
             if(autoPlay && autoPlay != null && autoPlay=="true"){
                        player.playVideo();
             }else{
                var indexId = $.cookie("tocandoAgora"),
                    proxId = parseInt(indexId)+1;
                    player.stopVideo();
                    $(".startplay:Eq("+proxId+")").click();
             }
        }
        //if (event.data == YT.PlayerState.PLAYING && !done) {
//          setTimeout(stopVideo, 6000);
//          done = true;
//        }else{
//            alert("terminou");
//        }
      }
      function stopVideo() {
        player.stopVideo();
      }

$(function(){
    SetBotoes();
})

function SetBotoes() {
    var videoStatus,
    	videoVolume,
        videoProgresso;
    	
    $(".PlayerPlayPause").on('click', function() {
      videoStatus = player.getPlayerState();
      
      if(videoStatus != 1){
        $(".PlayerPlayPause i").attr("class", 'fa fa-pause');
      	player.playVideo();
      }else{
        $(".PlayerPlayPause i").attr("class", 'fa fa-play');
      	player.stopVideo();
      }
      
    });
    $(".PlayerStart").on('click', function() {
      player.playVideo();
    });
    $(".PlayerPause").on('click', function() {
      player.stopVideo();
    });
    $(".PlayerMute").on('click', function() {
        if(player.isMuted()){
           player.unMute()
        }else{
            player.mute()
        }
      
    });
    
    
    //Volume
    $(".PlayerVolume").change(function(){
        
    });
    
    $(".PlayerVolume").slider().on('slide', function(val){
            //console.log()
            player.setVolume(val.value);
    });
    
    $(".PlayerVolMais").on('click', function() {
       videoVolume = player.getVolume();
       if(videoVolume <= 100){
       		player.setVolume(videoVolume+5);
       }else{
       		alert("Volume maximo");
       }
    });
    
    $(".PlayerVolMenos").on('click', function() {
       videoVolume = player.getVolume();
       if(videoVolume > 0){
       		player.setVolume(videoVolume-5);
       }else{
       		alert("Volume minimo");
       }
    });
    
    /*Tempo e progresso
    $(".PlayerProgresso").change(function(){
        
    });*/
    
    $(".PlayerProgresso").on('slide', function(val){
        //console.log(val.value)
        videoProgresso = player.getCurrentTime();
        novoPonto = val.value;
        player.seekTo(novoPonto, true);
    });
    
    
        setInterval(function() {
            if(player) {
            videoStatus = player.getPlayerState();
          
          if(videoStatus == 1){
            
                var timeAtual = player.getCurrentTime(),
                    timeTotal = player.getDuration(),
                    
                    timeAtualMinutos = Math.floor(parseFloat(timeAtual) / 60),
                    timeAtualSegundos = Math.floor(timeAtual - timeAtualMinutos * 60),
                    
                    timeTotalMinutos = Math.floor(parseFloat(timeTotal) / 60),
                    timeTotalSegundos = Math.floor(timeTotal - timeTotalMinutos * 60);
                    
                    timeAtualMinutos = (timeAtualMinutos < 10) ? "0"+timeAtualMinutos : timeAtualMinutos;
                    timeAtualSegundos = (timeAtualSegundos < 10) ? "0"+timeAtualSegundos : timeAtualSegundos;
                    
                    timeTotalMinutos = (timeTotalMinutos < 10) ? "0"+timeTotalMinutos : timeTotalMinutos;
                    timeTotalSegundos = (timeTotalSegundos < 10) ? "0"+timeTotalSegundos : timeTotalSegundos;
                    
                    timeFrase = timeAtualMinutos + ":"+timeAtualSegundos +" / "+timeTotalMinutos+":"+timeTotalSegundos; 
                    
                    $(".PlayerTime").html(timeFrase);
                    
                    $(".PlayerProgresso").slider("setAttribute", "max", timeTotal);
                    $(".PlayerProgresso").slider("setValue", timeAtual);
                    if(timeAtual == timeTotal){
                            var autoPlay = $.cookie("autoplay");
                            //if(autoPlay=="replay"){
            //                    $(".playerControlsGroup").html("Repetindo em 5 segundos...");
            //                }else{
            //                    $(".playerControlsGroup").html("Pr?xima m?sica em 5 segundos...");
            //                }
                    }
                }
        
        }
        }, 1000);
    
    //console.clear();
}

//setInterval(function() {
//    var  urlVideo = $("#video").attr("src");
//    if(urlVideo!= "" && urlVideo!= null){ 
//    var timeAtual = player.getCurrentTime(),
//        timeTotal = player.getDuration();
//        
//     videoStatus = player.getPlayerState();
//      
//      if(videoStatus != 1){    
//        if(timeAtual == timeTotal){
//             var autoPlay = $.cookie("replay");
//             if(autoPlay && autoPlay != null && autoPlay=="true"){
//                        player.playVideo();
//             }else{
//                var indexId = $.cookie("tocandoAgora"),
//                    proxId = parseInt(indexId)+1;
//                    player.stopVideo();
//                    $(".startplay"+proxId).click();
//             }
//        }
//      }
//   }
//}, 5000);

function limparDados(){
    $(".PlayerProgresso").attr("max", 100);
    $(".PlayerProgresso").val(0);
    $(".PlayerTime").html("00:00 / 00:00");
}



var tag = document.createElement('script');
tag.src = "//www.youtube.com/player_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

function BuscaMusica(playerArea, termo){
    
    $(".playerControlsGroup").remove();
    
    var objplayerArea;
    
    if(typeof(playerArea) !== 'object')
    objplayerArea = $(playerArea);
    else 
    objplayerArea = playerArea;
    
    objplayerArea.prepend('\
    <table class="playerControlsGroup" style="float:right;display:inline-block">\
    <tr><td> \
    <div class="PlayerTime" style="margin-top: 1px; vertical-align: middle; display:inline-block;"> </div> \
    </td></tr> \
    </table>');   
    
    
    var search_input = termo;
    var keyword= encodeURIComponent(search_input);
    console.clear();
    console.log(search_input);
    console.log(keyword);
    // Youtube API 
    var yt_url='http://gdata.youtube.com/feeds/api/videos?q='+keyword+'&format=5&max-results=1&v=2&alt=jsonc&start-index=1'; 
    
    $.ajax
    ({
    type: "GET",
    url: yt_url,
    dataType:"jsonp",
    success: function(response)
    {
    
    if(response.data.items)
    {
    $.each(response.data.items, function(i,data)
    {
    var video_id=data.id;
    var video_title=data.title;
    var video_viewCount=data.viewCount;
    // IFRAME Embed for YouTube
    
    var video_urlFinal = "http://www.youtube.com/embed/"+video_id+"?enablejsapi=1";
    carregarVideoId(video_id);
    limparDados();
//    
    setTimeout(function(){
        //player.stopVideo();
        $(".PlayerPlayPause i").attr("class", 'fa fa-pause');
        $(".PlayerVolume").val(player.getVolume());
        
        var timeAtual = player.getCurrentTime(),
            timeTotal = player.getDuration();
        
        $(".PlayerProgresso").attr("max", timeTotal);
        $(".PlayerProgresso").val(timeAtual);
        //player.playVideo();
        
        //Notificar
        notificar({mensagem:search_input.replace("- ", "\n").Capitalize(), tempo: 5000, imagem: $("#imgCapa").attr("src")});
    }, 3000);
    
});
}
}
});
}
</script>