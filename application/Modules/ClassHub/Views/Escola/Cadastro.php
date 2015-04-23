<?
use Libs\Form;
//$Model = new \DAL\ClassHub\Escola();
?>
<h3 class="page-header">Cadastro de Escola</h3>

<form method="post">
    <?
    Form::ValidationSummary();
    Form::Hidden("ArtistaId", @$Model->EscolaId);
    ?>

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
                Dados da Escola
            </h3>
        </div>
        <div class="box-body">
            <div class="form-group" for="Nome">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "Nome");?>
                </label>
                <? Form::Text("Nome", @$Model->Nome, Array("class" => "form-control"))?>
            </div>

            <div class="form-group" for="Endereco">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "Endereco");?>
                </label>
                <? Form::Text("Endereco", @$Model->Endereco, Array("class" => "form-control"))?>
            </div>

            <div class="form-group" for="Telefone">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "Telefone");?>
                </label>
                <? Form::Text("Telefone", @$Model->Telefone, Array("class" => "form-control"))?>
            </div>

            <div class="form-group" for="Email">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "Email");?>
                </label>
                <? Form::Text("Email", @$Model->Email, ["class" => "form-control"])?>
            </div>

            <div class="form-group" for="Site">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "Site");?>
                </label>
                <? Form::Text("Site", @$Model->Site, ["class" => "form-control", "placeholder" => "www.exemplo.com"])?>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-lg-12">
            <a type="submit" class="btn btn-danger btn-sm" href="<?=\Libs\Helper::getUrl("index"); ?>" >Cancelar</a>   <button type="submit" class="btn btn-primary btn-sm pull-right">Salvar</button></div>
    </div>
</form>