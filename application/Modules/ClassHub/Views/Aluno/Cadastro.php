<?
use Libs\Form;
//$Model = new \Model\Artista();
?>
<h3 class="page-header">Cadastro de Artista</h3>
<script>
    $(function(){
        //DropZone("drop-avatar", "drop-avatar-btn", "mouse-over");
        $('#avatar-modal').on('shown.bs.modal', function (e) {
            DropZone("drop-avatar", "drop-avatar-btn", "mouse-over");
        });

        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });
    });
</script>

<div class="row" id="crop-avatar">

    <!-- Current avatar -->
    <div class="avatar-view" title="Clique para alterar">
        <img src="<?=@$Model->Imagem;?>" alt="Avatar">
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
<br>
<form method="post">
    <?
    Form::ValidationSummary();
    Form::Hidden("ArtistaId", @$Model->ArtistaId);
    Form::Hidden("AplicacaoId", (!empty($Model->AplicacaoId) ? @$Model->AplicacaoId : APPID));
    Form::Hidden("Visitas", @$Model->Visitas);
    Form::Hidden("Ativo", @$Model->Ativo);
    Form::Hidden("Imagem", @$Model->Imagem, Array("class" => "hiddenImgArea"));
    ?>

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
                Dados do Artista
            </h3>
        </div>
        <div class="box-body">
            <div class="form-group" for="Titulo">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "Titulo");?>
                </label>
                <? Form::Text("Titulo", @$Model->Titulo, Array("class" => "form-control"))?>
            </div>

            <div class="form-group" for="Descricao">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "Descricao");?>
                </label>
                <? Form::Wysiwyg("Descricao", @$Model->Descricao, Array("class" => "form-control"))?>
            </div>

            <div class="form-group" for="mbid">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "mbid");?>
                </label>
                <? Form::Text("mbid", @$Model->mbid, Array("class" => "form-control"))?>
            </div>

            <div class="form-group" for="Relacionados">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "Relacionados");?>
                </label>
                <? Form::Text("Relacionados", @$Model->Relacionados, Array("class" => "form-control", "data-role" => "tagsinput", "style" => "width: 100%"))?>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-lg-12">
            <a type="submit" class="btn btn-danger btn-sm" href="<?=\Libs\Helper::getUrl("index"); ?>" >Cancelar</a>   <button type="submit" class="btn btn-primary btn-sm pull-right">Salvar</button></div>
    </div>
</form>