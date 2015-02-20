<form method="post">
    <h3 class="page-header">Cadastro de Pessoa</h3>
    <?  \Libs\Helper::LoadModelView($Model, "formulario", "pessoa");?>
        <div class="row">
            <div class="col-lg-12">
                <a type="submit" class="btn btn-danger btn-sm" href="<?=URL?>pessoas/" >Cancelar</a>   <button type="submit" class="btn btn-primary btn-sm pull-right">Salvar</button></div>
        </div>
</form>

