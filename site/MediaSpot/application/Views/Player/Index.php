<?php
//var_dump($Model);
//$Model = new \DAL\MediaSpot\Player();
if(isset($Model)&& !empty($Model)){
    ?>
    <script type="text/javascript">
        $(function() {
            /* ION SLIDER */
            $("#player_timeline").ionRangeSlider({
                min: 0,
                max: 198,
                hide_from_to: true,
                hide_min_max: true,
                prettify: function (num) {
                    var minutos = parseInt(num / 60);
                    var segundos = parseInt(num - (minutos * 60));
                    if(segundos < 10) segundos = "0"+segundos;
                    if(minutos < 10) minutos = "0"+minutos;
                    //return minutos + ":" + segundos;
                    //return moment().set({'minute': minutos, 'second': segundos}).format("mm:ss");
                },
                onChange: function (data) {
                    var Segundos = data.from;
                    //console.log(Segundos);
                    seekTo(Segundos, true);
                }
            });
            $("#player_volume").ionRangeSlider({
                min: 0,
                max: 100,
                from: 0,
                hide_min_max: true,
                hide_from_to: true,
                prettify: function (num) {
                    //return num;
                }
            });

            $("#player_play").click(function(){
                togglePlayer();
            });
            /*$("#player_timeline").change(function(){
             var Segundos = $(this).val();
             seekTo(Segundos, false);
             });*/

            $("#player_volume").change(function(){
                var Volume = $(this).val();
                setVolume(Volume);
            });

        });
    </script>
    <script type="text/javascript">
        $(function(){
            $("#listagem").dataTable({
                "processing": true,
                "serverSide": true,
                "ordering":  false,
                "info": false,
                "ajax": {
                    "url": "<?=URL?>handler/musica/Consulta/<?=$Model->Artista->ArtistaId;?>",
                    "type": "POST"
                },
                "columns": [
                    {"data": "Titulo" },
                    {   "data": "PlayButtom",
                        "orderable":      false,
                        "className": "tdMenu"
                    }
                ]
                //"aoColumns": [ null, null, {"bSortable": false} ]
            });

            toogleBtns();
        });
    </script>
    <style>
        .tdMenu{
            width: 25px;
        }
    </style>

    <div class="row">
        <div class="col-md-3">
            <div class="box box-solid">
                <div class="box-body no-padding" style="background: url(<?=$Model->Artista->Imagem;?>) no-repeat;-webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; height: 200px;">
                    <div id="yt_content" class="invisible"><div id="yt_player"></div></div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
        <div class="col-md-9">
            <div class="box box-solid">
                <div class="box-header">
                    <h3 class="box-title" id="hArtista"><?=$Model->Artista->Titulo;?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <?=$Model->Artista->Descricao;?>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
            <?
            if(isset($Model->Artista->Relacionados) && !empty($Model->Artista->Relacionados)) {
                ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="btn-group" role="group" aria-label="...">
                        <?
                        $rels = explode(",", $Model->Artista->Relacionados);
                        $rels = new \Libs\ArrayHelper($rels);
                        if($rels->Count() > 0){
                            $rels->For_Each(function($item){
                                ?>
                                <button type="button" class="btn btn-default"><?=$item?></button>
                            <?
                            });
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?
            }
            ?>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box ">
                <div class="box-header">
                    <h3 class="box-title">Músicas</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-default btn-sm" onclick="getLetra()" data-toggle="tooltip" title="Letra da Música Atual" data-original-title="Collapse"><i class="fa fa-file-text-o"></i></button>
                        <button id="btnRepetir" onclick="replay()" class="btn btn-default btn-sm" data-toggle="tooltip" title="Repetir" data-original-title="Repetir"><i class="fa fa-refresh"></i></button>
                        <button id="btntoggleVideo" onclick="toggleVideo()" class="btn btn-default btn-sm" data-toggle="tooltip" title="Ocultar / Exibir Vídeo" data-original-title="Ocultar / Exibir Vídeo"><i class="fa fa-eye-slash"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="listagem" class="table table-bordered table-hover">
                        <thead style="display:none">
                        <tr>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?
                        if($Model->ListMusica->Count() > 0) {
                            $Model->ListMusica->For_Each(function ($Item) {
                                //$Item = new \DAL\Musica();
                                //var_dump($Item);
                                /*
                                 <tr>
                                     <td></td>
                                     <td align="center">
                                     </td>
                                 </tr>
                             */
                            });
                        }else
                        {
                            // echo "<tr><td colspan='2'>Nenhum Registro</td></tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>


    <script>
        // 2. This code loads the IFrame Player API code asynchronously.
        var tag = document.createElement('script');

        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        // 3. This function creates an <iframe> (and YouTube player)
        //    after the API code downloads.
        var player,
            playing = false,
            playerShow = false,
            playIndex = null,
            playTermo = "";

        function onYouTubeIframeAPIReady() {
            player = new YT.Player('yt_player', {
                height: '200',
                width: '100%',
                videoId: 'bHQqvYy5KYo',
                playerVars: { 'autoplay': 0, 'controls': 0, 'showinfo': 0, 'rel': 0 },
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });
        }

        // 4. The API will call this function when the video player is ready.
        function onPlayerReady(event) {
            //event.target.playVideo();
            setInterval(UpdatePlayer, 1000);
            //Define Volume
            var slider = $("#player_volume").data("ionRangeSlider");
            //console.log(getVolume());
            slider.update({
                from: getVolume()
            });
        }

        //https://developers.google.com/youtube/iframe_api_reference?hl=pt-br#loadVideoById
        // 5. The API calls this function when the player's state changes.
        //    The function indicates that when playing a video (state=1),
        //    the player should play for six seconds and then stop.
        var done = false;
        function onPlayerStateChange(event) {
            if (event.data == YT.PlayerState.PLAYING) {
                playing = true;
                $("#player_play>span").attr("class", "glyphicon glyphicon-pause");
                $("#yt_content").removeClass("invisible");
                var btn = $(".btnPlay:eq("+playIndex+")");
                btn.find("i").attr("class", "fa fa-pause");
            }else{
                playing = false;
                $("#player_play>span").attr("class", "glyphicon glyphicon-play");
                $(".btnPlay i").attr("class", "fa fa-play");
            }

            if(event.data == YT.PlayerState.ENDED){
                var replay = $.cookie("replay");
                if(replay == null || replay != "true") {
                    playNext();
                }else{
                    seekTo(0, true);
                    playVideo();
                }
            }

            //PAUSED
            //BUFFERING
            //CUED - FILA
        }
        function stopVideo() {
            playing = false;
            player.stopVideo();
            playIndex = null;
            $(".btnPlay i").attr("class", "fa fa-play");
        }
        function playVideo() {
            playing = true;
            player.playVideo();
            ShowPlayer();

            var btn = $(".btnPlay:eq("+playIndex+")");
            btn.find("i").attr("class", "fa fa-pause");
        }
        function pauseVideo(){
            playing = false;
            player.pauseVideo();
            $(".btnPlay i").attr("class", "fa fa-play");
        }
        function togglePlayer(){
            if(playing == true)
                pauseVideo();
            else
                playVideo();

            playing = !playing;

        }
        function LoadVideo(VID){
            player.loadVideoById(VID, 0, "small");
        }
        function seekTo(SEG, Refresh){
            player.seekTo(SEG, Refresh);
        }
        function getVolume(){
            return player.getVolume();
        }
        function setVolume(VOL){
            //pauseVideo();
            player.setVolume(VOL);
            //playVideo();
        }

        function LoadVideobyId(videoId){
            player.loadVideoById(videoId);
            ShowPlayer();
        }

        function UpdatePlayer(){
            console.log(playing);
            if(playing == true) {
                var TempoCorrido = player.getCurrentTime(),
                    TempoTotal = player.getDuration();
                //console.log(TempoCorrido.toString().toInt() + " de " + TempoTotal.toString().toInt());
                var slider = $("#player_timeline").data("ionRangeSlider");
                slider.update({
                    max: TempoTotal,
                    from: TempoCorrido
                });

                var minutosNow = parseInt(TempoCorrido / 60);
                var segundosNow = parseInt(TempoCorrido - (minutosNow * 60));
                if(segundosNow < 10) segundosNow = "0"+segundosNow;
                if(minutosNow < 10) minutosNow = "0"+minutosNow;
                $("#player-timeNow").html(minutosNow+":"+segundosNow);

                var minutosTotal = parseInt(TempoTotal / 60);
                var segundosTotal = parseInt(TempoTotal - (minutosTotal * 60));
                if(segundosTotal < 10) segundosTotal = "0"+segundosTotal;
                if(minutosTotal < 10) minutosTotal = "0"+minutosTotal;
                $("#player-timeTotal").html(minutosTotal+":"+segundosTotal);
            }
        }

        function ShowPlayer(){
            if(playerShow != true){
                $("#player_row").slideDown();
            }
        }


        function BuscaMusica(index, termo){
            if(index == playIndex && playTermo == termo){
                togglePlayer();
            }else{
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
                                var video_urlFinal = "http://www.youtube.com/embed/"+video_id+"?enablejsapi=1";
                                LoadVideobyId(video_id);
                                //Notificar
                                //notificar({mensagem:search_input.replace("- ", "\n").Capitalize(), tempo: 5000, imagem: $("#imgCapa").attr("src")});

                            });
                        }
                    }
                });

                console.log(index);
                var btn = $(".btnPlay:eq("+index+")");
                $(".btnPlay i").attr("class", "fa fa-play");
                btn.find("i").attr("class", "fa fa-pause");

                playIndex = index;
                playTermo = termo;

                console.log(playIndex);
            }
        }

        function playAt(index){
            var btn = $(".btnPlay:eq("+index+")");
            btn.click();
        }

        function playNext(){
            playIndex = playIndex >= 0 ? playIndex+1 : 0;
            playAt(playIndex);
        }

        function playPrev(){
            playIndex = playIndex > 0 ? playIndex-1 : 0;
            playAt(playIndex);
        }

        function replay(){
            var cookie = $.cookie("replay");
            if(cookie && cookie != null && cookie == "true"){
                $.cookie("replay", null);
            }else{
                $.cookie("replay", "true");
            }

            toogleBtns();
        }

        function toggleVideo(){
            var cookie = $.cookie("hideVideo");
            if(cookie && cookie != null && cookie == "true"){
                $.cookie("hideVideo", null);
            }else{
                $.cookie("hideVideo", "true");
            }

            toogleBtns();
        }

        function toogleBtns(){
            var replay = $.cookie("replay");
            if(replay && replay != null && replay == "true"){
                $("#btnRepetir").attr("class", "btn btn-primary btn-sm");
            }else{
                $("#btnRepetir").attr("class", "btn btn-default btn-sm");
            }

            var hideVideo = $.cookie("hideVideo");
            if(hideVideo && hideVideo != null && hideVideo == "true"){
                $("#btntoggleVideo").attr("class", "btn btn-primary btn-sm");
                $("#yt_content").css("opacity", "0");
            }else{
                $("#btntoggleVideo").attr("class", "btn btn-default btn-sm");
                $("#yt_content").css("opacity", "1");
            }
        }


        function getLetra(){
            var btn = $(".btnPlay:eq("+playIndex+")"),
                artista = $("#hArtista").html(),
                musica = btn.attr("musica");

            console.log(artista);
            console.log(musica);

            jQuery.getJSON(
                "http://api.vagalume.com.br/search.php"
                + "?art=" + artista
                + "&mus=" + musica,
                function (data) {
                    // Letra da m�sica
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
    </script>


    <!-- LETRA -->

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

    <!-- PLAYER -->
    <div class="row" style="min-height: 200px;" id="player_row">
        <div class="box box-solid" style="margin-bottom: 0; position: fixed; bottom: 0; z-index: 999">
            <div class="box-body bg-primary">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                        <div class="row">
                            <div class="col-xs-4 text-center">
                                    <a onclick="playPrev()" style="color:#fff;font-size: 18px; "><span class="glyphicon glyphicon-backward" aria-hidden="true"></span></a>
                                </div>
                            <div class="col-xs-4 text-center">
                                    <a id="player_play" style="color:#fff;font-size: 18px;"><span class="glyphicon glyphicon-play" aria-hidden="true"></span></a>
                            </div>
                            <div class="col-xs-4 text-center">
                                    <a onclick="playNext()" style="color:#fff;font-size: 18px;"><span class="glyphicon glyphicon-forward" aria-hidden="true"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-6 col-sm-6 col-xs-8">
                        <div class="row">
                            <div class="col-xs-1 text-center">
                                <span id="player-timeNow" style="font-size: 16px;"></span>
                            </div>
                            <div class="col-xs-10 text-center">
                        <input id="player_timeline" type="text" name="player_timeline" value="" />
                                </div>
                            <div class="col-xs-1 text-center">
                                <span id="player-timeTotal" style="font-size: 16px;"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-3 col-xs-4" data-toggle="tooltip" data-placement="top" title="Volume">
                        <input id="player_volume" type="text" name="player_volume" value="" />
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
<? } ?>