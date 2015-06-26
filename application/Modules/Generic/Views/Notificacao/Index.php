<?
if($Model->Lista->Count() > 0)
{
    ?>
    <script type="text/javascript">
        $(function() {
            $("#listagem").dataTable({
                "aoColumns": [  null, null, {"bSortable": false}, {"bSortable": false} ]
            });
        });

        function Excluir(Id){
            bootbox.confirm('Deseja realmente excluir este item?', function(result){
                if(result)
                    location.href="<?=URL;?>Notificacao/deletar/"+Id;

            });
        }
    </script>
<? } ?>
<div class="row">
    <a href="<?=\Libs\Helper::getUrl("cadastro")?>" class="btn btn-primary pull-right" style="color:#fff;" ><i
            class="fa
                    fa-plus"></i> Nova Notificaçao</a>
</div>
<div class="row">
<div class="panel panel-primary">
    <div class="panel-header">
        <h3 class="panel-title">Notificações</h3>

    </div>
    <div class="panel-content pagination2">
        <table id="listagem" class="table table-hover">
            <thead>
            <tr>
                <th>Conteúdo</th>
                <th>Data</th>
                <th width="24px">Icone</th>
                <th style="width:18px" align="center"></th>
            </tr>
            </thead>
            <tbody>
            <?
            if($Model->Lista->Count() > 0)
            {

                $Model->Lista->For_Each(function($Item)
                {
                    $dataArr = explode("/", $Item->Data);

                    ?>
                    <tr>
                        <td><?=$Item->Conteudo;?></td>
                        <td data-order="<?=(!empty($dataArr) ? $dataArr[2].$dataArr[1].$dataArr[0] : 0)?>
                        "><?=$Item->Data;
                            ?></td>
                        <td align="center"><i class="fa <?=$Item->Icone;?> <?=$Item->Classe;?>"></i></td>
                        <td align="center">
                            <div class="btn-group">
                                <i class="fa fa-bars" class="dropdown-toggle"
                                   data-toggle="dropdown"></i>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li><a href="<?=\Libs\Helper::getUrl("cadastro","", $Item->NotificacaoId)?>"><i
                                                class="fa fa-edit"></i>
                                            Editar</a></li>
                                    <li><a onclick="Excluir(<?=@$Item->NotificacaoId;?>)"><i class="fa fa-trash-o"></i> Excluir</a></li></ul>
                            </div>

                        </td>
                    </tr>
                <?
                });
            }else
            {
                echo "<tr><td colspan='2'>Nenhum Registro</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
</div>

