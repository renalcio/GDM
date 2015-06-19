<?
use Libs\Form;
//$Model = new \Model\ClassHub\Avaliacao();
//var_dump($Model);
?>

<script>
    $(function(){
        $('section.content').slimScroll({
            height: ($(window).height())
        });
    });
</script>

<div class="row">
    <div class="col-sm-2">
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Peso</span>
            <input type="text" class="form-control" value="<?=@$Model->Peso?>" readonly>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"><?=\Libs\ModelState::DisplayName($Model, "Data");?></span>
            <input type="text" class="form-control" value="<?=@$Model->Data;?>" readonly>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Início</span>
            <input type="text" class="form-control" value="<?=@$Model->HoraInicio?>" readonly>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Fim</span>
            <input type="text" class="form-control" value="<?=@$Model->HoraFim?>" readonly>
        </div>
    </div>

</div>
<br>
<div class="row">
    <div class="col-sm-3">
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Privado</span>
            <input type="text" class="form-control" value="<?=((@$Model->Compartilhado == 0) ? "Sim" : "Não");?>"
                   readonly>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Tipo</span>
            <input type="text" class="form-control" value="<?=((@$Model->Trabalho == 0) ? "Prova" : "Trabalho");?>"
                   readonly>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"><?=\Libs\ModelState::DisplayName($Model, "MateriaId");?></span>
            <input type="text" class="form-control" value="<?=@$Model->Materia->Titulo?>" readonly>
        </div>
    </div>
</div>

<br>


<div class="box box-primary box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">
            <?=@$Model->Titulo;?>
        </h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">

        <?=@$Model->Descricao?>

    </div>
</div>


<? if(!empty($Model->AvaliacaoId)){ ?>
<div class="box box-success box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">
            Arquivos
        </h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">
        <table id="tbOutrosArquivos" class="table table-striped">
            <thead>
            <tr>
                <th></th>
                <th>Arquivo</th>
                <th>Autor</th>
                <th>Tamanho</th>
            </tr>
            </thead>
            <tbody>
            <?
            if(!empty($Model->ListArquivo) && $Model->ListArquivo->Count() > 0) {
                $Model->ListArquivo->For_Each(function ($item, $i) {
                    ?>
                    <tr>
                        <td><a class="btn btn-success btn-sm" href="<?= $item->Url; ?>" title="<?= $item->Titulo; ?>"
                               target="_blank" download="<?= $item->Url; ?>"><i class="fa fa-download"></i></a>

                        </td>
                        <td><?= $item->Titulo; ?></td>
                        <td>
                            <?= $item->Pessoa->Nome; ?>
                        </td>
                        <td><?= $item->Tamanho; ?></td>
                    </tr>
                <?
                });
            }else{
                ?>
                <td colspan="4">Nenhum Arquivo</td>
            <?
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<? } ?>
