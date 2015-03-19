<?
use Libs\Form;
?>
<form method="post">
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">
            Gerador de Classe
        </h3>
    </div>
    <div class="box-body">
        <?
        //$gerador = new \Libs\ClassGenerator\ClassGenerator();
        //$gerador->run();
        ?>
        <div class="form-group" for="Titulo">
            <label>
                Aplicação:
            </label>
            <? Form::Select2("AplicacaoId", @$Model->AplicacaoId, "", Array("class" => "form-control AplicacaoSelect", "DataUrl" => URL."handler/aplicacao/Select2" ))?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <button type="submit" class="btn btn-primary btn-sm pull-right">Gerar</button></div>
</div>
</form>