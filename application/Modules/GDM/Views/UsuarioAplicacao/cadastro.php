<?
use Libs\Helper;
?>
<form method="post">
    <?
    \Libs\Form::ValidationSummary();
    ?>
    <?  Helper::LoadModelView($Model, "formulario", "usuarioaplicacao");?>

    <div class="row">
        <div class="col-lg-12">
            <a type="submit" class="btn btn-danger btn-sm" href="<?=URL?>usuario/" >Cancelar</a>   <button type="submit" class="btn btn-primary btn-sm pull-right">Salvar</button></div>
    </div>
</form>

