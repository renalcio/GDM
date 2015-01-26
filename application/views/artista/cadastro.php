<?
use Libs\Form;
//$Model = new \DAL\Artista();
?>
<h3 class="page-header">Cadastro de Site</h3>
<form method="post">
    <?Form::Hidden("ArtistaId", @$Model->ArtistaId);?>
    <?Form::Hidden("AplicacaoId", @$Model->AplicacaoId);?>

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
                Cadastro de Artista
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
                <? Form::Text("Url", @$Model->mbid, Array("class" => "form-control"))?>
            </div>

            <div class="form-group" for="Relacionados">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "Relacionados");?>
                </label>
                <? Form::Text("Metatags", @$Model->Relacionados, Array("class" => "form-control", "data-role" => "tagsinput", "style" => "width: 100%"))?>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-lg-12">
            <a type="submit" class="btn btn-danger btn-sm" href="<?=\Libs\Helper::getUrl("index"); ?>" >Cancelar</a>   <button type="submit" class="btn btn-primary btn-sm pull-right">Salvar</button></div>
    </div>
</form>