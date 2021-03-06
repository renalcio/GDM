﻿<?
if($Model->Lista->Count() > 0)
{
    ?>
    <script type="text/javascript">
        $(function() {
            $("#listagem").dataTable({
                "aoColumns": [ null,null,null, {"bSortable": false} ]
            });
        });

        function Excluir(Id){
            bootbox.confirm('Deseja realmente excluir este item?', function(result){
                if(result)
                    location.href="<?=URL;?>Modulo/deletar/"+Id;

            });
        }
    </script>
<? } ?>

<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Módulos</h3>
        <div class="box-tools pull-right">
            <a href="<?=\Libs\Helper::getUrl("cadastro")?>" class="btn btn-primary btn-sm" style="color:#fff;" ><i class="fa
                    fa-plus"></i> Novo Módulo</a>
        </div>
    </div>
    <div class="box-body">
        <table id="listagem" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Título</th>
                <th>Publico</th>
                <th>Handler</th>
                <th style="width:18px" align="center"></th>
            </tr>
            </thead>
            <tbody>
            <?
            if($Model->Lista->Count() > 0)
            {

                $Model->Lista->For_Each(function($Item)
                {
                    ?>
                    <tr>
                        <td><?=$Item->Titulo;?></td>
                        <td><?=(empty($Item->Publico) ? "Não" : "Sim");?></td>
                        <td><?=(empty($Item->Handler) ? "Não" : "Sim");?></td>
                        <td align="center">

                            <div class="btn-group">
                                <i class="fa fa-bars" class="dropdown-toggle"
                                   data-toggle="dropdown"></i>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li><a href="<?=\Libs\Helper::getUrl("cadastro","", $Item->ModuloId)?>"><i
                                                class="fa fa-edit"></i>
                                            Editar</a></li>
                                    <li><a onclick="Excluir(<?=@$Item->ModuloId;?>)"><i class="fa fa-trash-o"></i> Excluir</a></li></ul>
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
</div>
</div>

