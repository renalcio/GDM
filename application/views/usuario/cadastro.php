<form method="post">
    <h3 class="page-header">Cadastro de Usuário</h3>
    <div id="row">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">
                    Avatar
                </h3>

            </div>

            <div class="box-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="drop-zone">
                            Arraste e solte um arquivo aqui...<br />
                            <div id="clickHere" class="btn btn-sm btn-primary">
                                ou clique para escolher...
                                <input type="file" name="file" id="inputFileToLoad" onchange="loadImageFileAsURL();" />
                            </div>
                        </div>
                    </div>
                </div>
                <br />
                <style>
                    .imagePreviewArea {
                        background-repeat: no-repeat;
                        -moz-background-size: 100% 100%;
                        -webkit-background-size: 100% 100%;
                        background-size: 100% 100%;
                        height: 150px;
                        width: 150px;
                        border: 8px solid;
                        border-color: transparent;
                        border-color: #63A4C9;
                        margin: 0 auto;
                    }

                    .imageCropArea {
                        display:none;
                    }

                    #drop-zone {
                        /*Sort of important*/
                        width: 100%;
                        /*Sort of important*/
                        padding: 50px 0;
                        border: 2px dashed rgba(0,0,0,.3);
                        border-radius: 5px;
                        text-align: center;
                        position: relative;
                        font-size: 20px;
                        color: rgba(0,0,0,.3);
                        margin: 0 auto;
                    }

                    #drop-zone input {
                        /*Important*/
                        position: absolute;
                        /*Important*/
                        cursor: pointer;
                        left: 0px;
                        top: 0px;
                        /*Important This is only comment out for demonstration purpeses.*/
                        opacity:0;
                    }

                    /*Important*/
                    #drop-zone.mouse-over {
                        border: 2px dashed rgba(0,0,0,.5);
                        color: rgba(0,0,0,.5);
                    }

                </style>
                <div class="row">
                    <div class="col-lg-12">
                <div class="imagePreviewArea img-circle">
                </div>
                        </div>
                    </div>
                        <br/>
                <div class="row">
                    <div class="col-lg-12">
                        <img class="imageCropArea" src="picture.jpg" style="width: 50%; margin: 0 auto;">
                    </div>
                </div>

                <script type='text/javascript'>

                    $(function () {
                        var dropZoneId = "drop-zone";
                        var buttonId = "clickHere";
                        var mouseOverClass = "mouse-over";

                        var dropZone = $("#" + dropZoneId);
                        var ooleft = dropZone.offset().left;
                        var ooright = dropZone.outerWidth() + ooleft;
                        var ootop = dropZone.offset().top;
                        var oobottom = dropZone.outerHeight() + ootop;
                        var inputFile = dropZone.find("input");
                        document.getElementById(dropZoneId).addEventListener("dragover", function (e) {
                            e.preventDefault();
                            e.stopPropagation();
                            dropZone.addClass(mouseOverClass);
                            var x = e.pageX;
                            var y = e.pageY;

                            if (!(x < ooleft || x > ooright || y < ootop || y > oobottom)) {
                                inputFile.offset({ top: y - 15, left: x - 100 });
                            } else {
                                inputFile.offset({ top: -400, left: -400 });
                            }

                        }, true);

                        if (buttonId != "") {
                            var clickZone = $("#" + buttonId);

                            var oleft = clickZone.offset().left;
                            var oright = clickZone.outerWidth() + oleft;
                            var otop = clickZone.offset().top;
                            var obottom = clickZone.outerHeight() + otop;

                            $("#" + buttonId).mousemove(function (e) {
                                var x = e.pageX;
                                var y = e.pageY;
                                if (!(x < oleft || x > oright || y < otop || y > obottom)) {
                                    inputFile.offset({ top: y - 15, left: x - 160 });
                                } else {
                                    inputFile.offset({ top: -400, left: -400 });
                                }
                            });
                        }

                        document.getElementById(dropZoneId).addEventListener("drop", function (e) {
                            $("#" + dropZoneId).removeClass(mouseOverClass);
                        }, true);

                    });



                    function loadImageFileAsURL()
                    {
                        var filesSelected = document.getElementById("inputFileToLoad").files;
                        if (filesSelected.length > 0)
                        {
                            var fileToLoad = filesSelected[0];

                            var fileReader = new FileReader();

                            fileReader.onload = function(fileLoadedEvent)
                            {
                                var textAreaFileContents = document.getElementById
                                (
                                    "textAreaFileContents"
                                );


                                $(".imagePreviewArea").css("background-image", "url("+fileLoadedEvent.target.result+")");
                                $(".imageCropArea").fadeIn().attr("src",fileLoadedEvent.target.result);

                                $(".imageCropArea").cropper({
                                    aspectRatio: "auto",
                                    done: function(data) {
                                        // Output the result data for cropping image.
                                        $(".imagePreviewArea").css("background-image",
                                            "url("+$(".imageCropArea").cropper("getDataURL")+")");
                                        //console.log($(".imageCropArea").cropper("getDataURL"));
                                    }
                                });

                            };

                            fileReader.readAsDataURL(fileToLoad);
                        }
                    }

                </script>
            </div>
        </div>
    </div>

    <?  \Libs\Helper::LoadModelView($Model, "formulario", "usuario");?>
    <div class="row">
        <div class="col-lg-12">
            <a type="submit" class="btn btn-danger btn-sm" href="<?=URL?>pessoas/" >Cancelar</a>   <button type="submit" class="btn btn-primary btn-sm pull-right">Salvar</button></div>
    </div>
</form>

