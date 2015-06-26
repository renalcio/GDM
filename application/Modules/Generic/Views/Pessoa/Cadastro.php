<form method="post">
    <?  \Libs\Helper::LoadModelView($Model, "formulario", "pessoa");?>
        <div class="row">
            <div class="col-lg-12">
                <a type="submit" class="btn btn-danger" href="<?=URL?>pessoas/" >Cancelar</a>   <button type="submit" class="btn btn-primary pull-right">Salvar</button></div>
        </div>
</form>

