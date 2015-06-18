<?
use Libs\Form;
//$Model = new \Model\ClassHub\Aula();
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
            <span class="input-group-addon" id="basic-addon1">Sala</span>
            <input type="text" class="form-control" value="<?=@$Model->Sala?>" readonly>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Data</span>
            <input type="text" class="form-control" value="<?=@$Model->Data;?>" readonly>
        </div>
    </div>
    <div class="col-sm-2">
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">De</span>
            <input type="text" class="form-control" value="<?=@$Model->HoraDe?>" readonly>
        </div>
    </div>
    <div class="col-sm-2">
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Até</span>
            <input type="text" class="form-control" value="<?=@$Model->HoraAte?>" readonly>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Privado</span>
            <input type="text" class="form-control" value="<?=((@$Model->Compartilhado == 0) ? "Sim" : "Não");?>"
                   readonly>
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

        <?=@$Model->Conteudo?>

    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"><?=\Libs\ModelState::DisplayName($Model, "MateriaId");?></span>
            <input type="text" class="form-control" value="<?=$Model->Materia->Titulo;?>" readonly>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"><?=\Libs\ModelState::DisplayName($Model, "ProfessorId");?></span>
            <input type="text" class="form-control" value="<?=$Model->Professor->Pessoa->Nome;?>" readonly>
        </div>
    </div>
</div>
<br>
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
            if(!empty($Model->ListAulaArquivo) && $Model->ListAulaArquivo->Count() > 0) {
                $Model->ListAulaArquivo->For_Each(function ($item, $i) {
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
