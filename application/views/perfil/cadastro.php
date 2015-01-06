<?
use Libs\Form;
use Libs\Session;
?>
<h3 class="page-header">Cadastro de Nicho</h3>
<form method="post">
    <div id="row">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">
                  Dados do Nicho
                </h3>

            </div>
            <div class="box-body">


                <?Form::Hidden("NichoId", @$Model->NichoId);?>

                <div class="form-group">
                    <label>
                        Título:
                    </label>
                    <?Form::Text("Titulo", @$Model->Titulo, Array("class" => "form-control"));?>
                </div>
            </div>
            
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <a type="submit" class="btn btn-danger btn-sm" href="<?=URL?>pessoas/" >Cancelar</a>   <button type="submit" class="btn btn-primary btn-sm pull-right">Salvar</button></div>
    </div>
</form>