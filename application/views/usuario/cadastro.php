<form method="post">
    <h3 class="page-header">Cadastro de Usuário</h3>

    <div id="row">
        <div class="box box-solid box-success">
            <div class="box-header">
                <h3 class="box-title">
                    Avatar
                </h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa
                fa-minus"></i></button>
                </div>
            </div>

            <div class="box-body">
                <?  \Libs\Helper::LoadModelView($Model, "avatar", "usuario");?>
            </div>

        </div>
    </div>

    <?  \Libs\Helper::LoadModelView($Model, "formulario", "usuario");?>
    <div class="row">
        <div class="col-lg-12">
            <a type="submit" class="btn btn-danger btn-sm" href="<?=URL?>usuario/" >Cancelar</a>   <button type="submit" class="btn btn-primary btn-sm pull-right">Salvar</button></div>
    </div>
</form>

