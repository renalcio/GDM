/**
 * Created by Renalcio Junior on 23/12/2014.
 */


/**
 IMAGE UPLOAD AND CROP
 */


(function($){
    $.fn.UploadCrop64 = function(options){
        // configurações padrão
        var config = {
            preview: ".imagePreviewArea",       // Selector do previewArea
            crop: ".imageCropArea",             // Selctor do CropArea
            hidden: ".hiddenImgArea",           // HiddenField para Base64
            width: '40%',                       // CropArea Width
            height: null ,                      // CropArea Height
            funcao: function(){

            }                                   //Callback function
        };
        options = $.extend(config,options);
        return this.each(function(){

            //VARIAVEIS
            var dropZoneId = $(this).attr("id");
            var buttonId = $(">div", this).attr("id");
            var mouseOverClass = "mouse-over";
            var fileInputId = $("input[type=file]", this).attr("id");

            //CSS FIX
            $(this).addClass("dropZone");

            //CHAMA DROPZONE
            DropZone(dropZoneId, buttonId, mouseOverClass);

            //CHAMA CROPPER
            $(options.crop).cropper({
                aspectRatio: "auto",
                done: function(data) {
                    // Output the result data for cropping image.
                    $(options.preview).css("background-image",
                        "url("+$(options.crop).cropper("getDataURL")+")");
                    //console.log($(".imageCropArea").cropper("getDataURL"));
                }
            });

            //UPLOAD
            $("#"+fileInputId).change(function(){
                console.log($(this).attr("id"));
                var b64 = null;

                var filesSelected = document.getElementById(fileInputId).files;
                if (filesSelected.length > 0)
                {
                    var fileToLoad = filesSelected[0];

                    var fileReader = new FileReader();

                    var retorno = null;

                    fileReader.readAsDataURL(fileToLoad);

                    fileReader.onload = function(fileLoadedEvent)
                    {
                        b64 = fileLoadedEvent.target.result;

                        $(options.preview).css("background-image", "url("+b64+")");

                        $(options.crop).cropper("reset", true).cropper("replace", b64);

                        $(options.hidden).val(b64);

                        options.funcao();
                    };
                }
            });


        });
    };
})(jQuery);

function DropZone(dropZoneId, buttonId, mouseOverClass){

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




}

