<?
use Libs\Form;
?>
    <?Form::Hidden("Avatar", @$Model->Avatar, Array("class" => "hiddenImgArea"));?>


<script type='text/javascript'>
    $(function(){
        $("#drop-avatar").UploadCrop64({
            funcao: function(){
                $("#wellPreview").show();
            }
        });
    });
</script>

<div class="row">
    <div class="col-lg-12">
        <div id="drop-avatar">
            Arraste e solte uma imagem aqui...<br />
            <div id="clickHere" class="btn btn-sm btn-primary">
                ou clique para escolher...
                <input type="file" name="file" id="inputFileToLoad" />
            </div>
        </div>
    </div>
</div>
<br />

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="imagePreviewArea image64PreviewArea img-circle"></div>
    </div>
</div>
<br/>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="well" id="wellPreview" style="display: none">
            <img class="imageCropArea image64CropArea" src="">
        </div>
    </div>
</div>

