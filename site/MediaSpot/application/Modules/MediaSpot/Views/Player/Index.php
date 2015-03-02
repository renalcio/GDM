<?php
//var_dump($Model);
//$Model = new \DAL\MediaSpot\Player();
if(isset($Model)&& !empty($Model)){
    ?>
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
                    <div id="yt_player"></div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
        <div class="col-md-9">
            <div class="box box-solid">
                <div class="box-header">
                    <h3 class="box-title"><?=$Model->Artista->Titulo;?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <?=$Model->Artista->Descricao;?>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header">
                    <h3 class="box-title">Músicas - Datatables</h3>
                </div><!-- /.box-header -->
                <div class="box-body">


                    <table id="listagem" class="table table-bordered table-hover">
                        <thead style="display:none">
                        <tr>
                            <th></th>
                            <th width="30"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?
                        if($Model->ListMusica->Count() > 0) {
                            $Model->ListMusica->For_Each(function ($Item) {
                                //$Item = new \DAL\Musica();
                                //var_dump($Item);
                                ?>
                                <tr>
                                    <td></td>
                                    <td align="center">
                                    </td>
                                </tr>
                            <?
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
            }else{
                playing = false;
                $("#player_play>span").attr("class", "glyphicon glyphicon-play");
            }
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
                //console.log(TempoCorrido);
                var slider = $("#player_timeline").data("ionRangeSlider");
                slider.update({
                    max: TempoTotal,
                    from: TempoCorrido
                });
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
    </script>

    <script type="text/javascript">
        $(function() {
            /* ION SLIDER */
            $("#player_timeline").ionRangeSlider({
                min: 0,
                max: 198,
                prettify: function (num) {
                    var minutos = parseInt(num / 60);
                    var segundos = parseInt(num - (minutos * 60));
                    if(segundos < 10) segundos = "0"+segundos;
                    if(minutos < 10) minutos = "0"+minutos;
                    return minutos + ":" + segundos;
                    //return moment().set({'minute': minutos, 'second': segundos}).format("mm:ss");
                },
                onChange: function (data) {
                    var Segundos = data.from;
                    console.log(Segundos);
                    seekTo(Segundos, true);
                }
            });
            $("#player_volume").ionRangeSlider({
                min: 0,
                max: 100,
                from: 0,
                hide_min_max: true,
                prettify: function (num) {
                    return "Volume: " + num;
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
    <div class="row" style="min-height: 200px; display: none;" id="player_row">
        <div class="box box-solid" style="margin-bottom: 0; position: fixed; bottom: 0; z-index: 999">
            <div class="box-body bg-primary">
                <div class="row">
                    <div class="col-md-2">
                        <div class="row">
                            <div class="col-md-12">
                            <div class="btn-group btn-group-lg center-block" role="group" aria-label="...">
                            <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-backward" aria-hidden="true"></span></button>
                            <button id="player_play" type="button" class="btn btn-default"><span class="glyphicon glyphicon-play" aria-hidden="true"></span></button>
                            <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-forward" aria-hidden="true"></span></button>
                        </div>
                                </div>
                            </div>
                    </div>
                    <div class="col-md-8">
                        <input id="player_timeline" type="text" name="player_timeline" value="" />
                    </div>
                    <div class="col-md-2">
                        <input id="player_volume" type="text" name="player_volume" value="" />
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
<? } ?>