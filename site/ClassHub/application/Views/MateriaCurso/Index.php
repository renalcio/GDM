﻿<?
//var_dump($Model);
if($Model->Lista->Count() > 0)
{
    ?>
    <script type="text/javascript">
        $(function() {
            $("#listagem").dataTable({
                "aoColumns": [ {"bSortable": false}, null, null, null, null, null, {"bSortable": false} ],
                "fnDrawCallback" : function() {
                    iChecks();
                },
                "order": [[ 1, "asc" ]]
            });
        });

        function iChecks(){
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck('destroy');
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });

            $(".chkDeleteAll").on('ifChecked', function(event){
                $(".chkDelete").iCheck('check');
            });

            $(".chkDeleteAll").on('ifUnchecked', function(event){
                $(".chkDelete").iCheck('uncheck');
            });
        }
        function Excluir(Id){
            bootbox.confirm('Deseja realmente excluir este item?', function(result){
                if(result)
                    location.href="<?=\Libs\Helper::getUrl("deletar")?>"+Id;

            });
        }
    </script>
<? } ?>
<?
if(empty(@$Model->MateriaCurso->MateriaCursoId))
    $Model->MateriaCurso->MateriaId =  $Model->Materia->MateriaId;
\Libs\Helper::LoadModelView($Model->MateriaCurso, "cadastro", "MateriaCurso");
?>
<br>
<form method="post" action="<?=\Libs\Helper::getUrl("deletar");?>">
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Vinculos - <?=$Model->Materia->Titulo;?></h3>
    </div>
    <div class="box-body">
        <table id="listagem" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th style="width:18px"><input type="checkbox" class="chkDeleteAll chkDelete minimal" /></th>
                <th>Escola</th>
                <th>Curso</th>
                <th>Dia da Semana</th>
                <th>De</th>
                <th>Até</th>
                <th style="width:18px" align="center"></th>
            </tr>
            </thead>
            <tbody>
            <?
            if($Model->Lista->Count() > 0)
            {
                $Model->Lista->For_Each(function ($Item, $i){
                    ?>
                    <tr>
                        <td><input type="checkbox" class="chkDelete minimal" name="DeleteItems[<?= $i ?>]"
                                   value="<?= $Item->MateriaCursoId ?>"/></td>
                        <td><?=$Item->Escola->Nome;?></td>
                        <td><?=$Item->Curso->Titulo;?></td>
                        <td><?=$Item->DiaSemana;?></td>
                        <td><?=$Item->HoraDe;?></td>
                        <td><?=$Item->HoraAte;?></td>
                        <td align="center">
                            <div class="btn-group">
                                <i class="fa fa-bars" class="dropdown-toggle"
                                   data-toggle="dropdown"></i>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li><a href="<?=\Libs\Helper::getUrl("index",
                                            "MateriaCurso", [@$Item->MateriaId, @$Item->MateriaCursoId]) ;?>"><i class="fa fa-edit"></i>Editar</a></li>
                                    <li><a onclick="Excluir(<?=@$Item->MateriaCursoId;?>)"><i class="fa fa-trash-o"></i> Excluir</a></li></ul>
                            </div>

                        </td>
                    </tr>
                <?
                    });
            }else
            {
                echo "<tr><td colspan='4'>Nenhum Registro</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
    <div class="box-footer">
        <button type="submit" class="btn btn-default"><i class="fa fa-trash-o"></i> Apagar</button>
        <a href="<?=\Libs\Helper::getUrl("index", "Materia") ;?>" class="btn btn-primary pull-right"><i class="fa fa-check"></i> Concluído</a>
    </div>
</div>
</form>

