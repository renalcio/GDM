
<script>
    $(function(){
        //DropZone("drop-avatar", "drop-avatar-btn", "mouse-over");
        $('#avatar-modal').on('shown.bs.modal', function (e) {
            DropZone("drop-avatar", "drop-avatar-btn", "mouse-over");
        });
    });
</script>

<div class="row" id="crop-avatar">

    <!-- Current avatar -->
    <div class="avatar-view" title="Clique para alterar">
        <img src="<?=@$Model->Avatar;?>" alt="Avatar">
    </div>

    <!-- Cropping modal -->
    <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form class="avatar-form" action="<?=URL?>/avatar.php" enctype="multipart/form-data"
                method="post">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal" type="button">&times;</button>
                        <h4 class="modal-title" id="avatar-modal-label">Mudar Avatar</h4>
                    </div>
                    <div class="modal-body">
                        <div class="avatar-body">

                            <!-- Upload image and data -->
                            <div class="avatar-upload">
                                <input class="avatar-src" name="avatar_src" type="hidden">
                                <input class="avatar-data" name="avatar_data" type="hidden">
                                <!--
                                <label for="avatarInput">Arquivo</label>
                                <input class="avatar-input" id="avatarInput" name="avatar_file" type="file">
                                -->
                                <div id="drop-avatar" class="dropZone">
                                    Arraste e solte uma imagem aqui...<br />
                                    <div id="drop-avatar-btn" class="btn btn-sm btn-primary">
                                        ou clique para escolher...
                                        <input class="avatar-input" type="file" name="avatar_file" id="avatarInput" />
                                    </div>
                                </div>

                            </div>

                            <!-- Crop and preview -->
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="avatar-wrapper"></div>
                                </div>
                                <div class="col-md-3">
                                    <div class="avatar-preview preview-lg"></div>
                                    <div class="avatar-preview preview-md"></div>
                                    <div class="avatar-preview preview-sm"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" data-dismiss="modal" type="button">Cancelar</button>
                        <button class="btn btn-primary avatar-save" type="submit">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
</div>

