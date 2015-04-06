<?
use Libs\Form;
//$Model = new \DAL\Musica();
?>
<h3 class="page-header">Cadastro de Site</h3>
<form method="post">
    <?
    Form::ValidationSummary();
    Form::Hidden("ArtistaId", @$Model->ArtistaId);
    Form::Hidden("MusicaId", @$Model->MusicaId);
    Form::Hidden("AplicacaoId", (!empty($Model->AplicacaoId) ? @$Model->AplicacaoId : APPID));
    ?>

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
                Dados da Música
            </h3>
        </div>
        <div class="box-body">
            <?=$Model->Titulo?>
            <div class="form-group" for="Titulo">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "Titulo");?>
                </label>
                <? Form::Text("Titulo", @$Model->Titulo, Array("class" => "form-control"))?>
            </div>
            <div class="form-group" for="ArtistaId">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "ArtistaId");?>
                </label>
                <? Form::Select2("ArtistaId", @$Model->ArtistaId, "", Array("class" => "form-control
                AplicacaoSelect",
                    "DataUrl" => URL."handler/artista/Select2" ))?>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-lg-12">
            <a class="btn btn-danger btn-sm" href="<?=\Libs\Helper::getUrl("index"); ?>" >Cancelar</a>   <button type="submit" class="btn btn-primary btn-sm pull-right">Salvar</button></div>
    </div>
</form>