<?
use Libs\Form;
//$Model = new \Model\SiteDestaque();
?>
<h3 class="page-header">Cadastro de Destaque</h3>

<form method="post">
    <?
    Form::ValidationSummary();
    Form::Hidden("SiteDestaqueId", @$Model->SiteDestaqueId);
    Form::Hidden("Posicao", @$Model->Posicao);
    Form::Hidden("SiteId", @$Model->SiteId);
    ?>

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
                Dados do Destaque
            </h3>
        </div>
        <div class="box-body">
            <div class="form-group" for="ReferenciaId">
                <label>
                    Artista
                </label>
                <? Form::Select2("ReferenciaId", @$Model->ReferenciaId, "", Array(
                    "class" => "form-control RefereciaSelect",
                    "DataUrl" => URL."handler/artista/Select2" ))?>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-lg-12">
            <a class="btn btn-danger btn-sm" href="<?=\Libs\Helper::getUrl("index"); ?>" >Cancelar</a>   <button type="submit" class="btn btn-primary btn-sm pull-right">Salvar</button></div>
    </div>
</form>