﻿<?
//var_dump($Model);
if($Model->Lista->Count() > 0)
{
    ?>
    <script type="text/javascript">
        $(function() {
            $("#listagem").dataTable({
                "aoColumns": [ {"bSortable": false}, null, null, null, null, {"bSortable": false} ],
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
<form method="post" action="<?=\Libs\Helper::getUrl("deletar");?>">
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Canal Social</h3>
        <div class="box-tools pull-right">
            <a href="<?=\Libs\Helper::getUrl("Cadastro")?>" class="btn btn-primary btn-sm" style="color:#fff;" ><i class="fa
                    fa-plus"></i> Novo Canal Social</a>
        </div>
    </div>
    <div class="box-body">
        <table id="listagem" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th style="width:18px"><input type="checkbox" class="chkDeleteAll chkDelete minimal" /></th>
                <th>Escola</th>
                <th>Curso</th>
                <th>Turma</th>
                <th>Tipo</th>
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
                                   value="<?= $Item->AulaId ?>"/></td>
                        <td><?=$Item->Escola->Nome;?></td>
                        <td><?=$Item->Curso->Titulo;?></td>
                        <td><?=$Item->Turma->Semestre."S ".$Item->Turma->Ano." - ".$Item->Turma->Turno." - ".$Item->Turma->Curso->Titulo;?></td>
                        <td><?=$Item->Tipo;?></td>
                        <td align="center">
                            <div class="btn-group">
                                <i class="fa fa-bars" class="dropdown-toggle"
                                   data-toggle="dropdown"></i>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li><a href="<?=\Libs\Helper::getUrl("cadastro","", $Item->CanalSocialId)?>"><i class="fa fa-edit"></i>Editar</a></li>
                                    <li><a onclick="Excluir(<?=@$Item->CanalSocialId;?>)"><i class="fa fa-trash-o"></i>
                                            Excluir</a></li>
                                    <li><a href="<?=$Item->Url;?>" target="_blank"><i class="fa
                                    fa-external-link"></i>Acessar</a></li>
                                </ul>
                            </div>

                        </td>
                    </tr>
                <?
                    });
            }else
            {
                echo "<tr><td colspan='5'>Nenhum Registro</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
    <div class="box-footer">
        <button type="submit" class="btn btn-default"><i class="fa fa-trash-o"></i> Apagar</button>
    </div>
</div>
</form>

