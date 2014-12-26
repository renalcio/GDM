<form method="post">
    <h3 class="page-header">Cadastro de Usuário</h3>
    <div id="row">
        <div class="box box-solid box-success">
            <div class="box-header">
                <h3 class="box-title">
                    Avatar
                </h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa
                fa-minus"></i></button>
                </div>
            </div>

            <div class="box-body">
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
                <style>


                </style>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                <div class="imagePreviewArea image64PreviewArea img-circle">
                </div>
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

                <script type='text/javascript'>
                    $(function(){
                       $("#drop-avatar").UploadCrop64({
                           funcao: function(){
                                   $("#wellPreview").show();
                           }
                       });
                    });
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

