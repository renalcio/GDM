<?

    ?>
<style>
    .tdMenu{
        text-align: center;
    }
</style>
    <script type="text/javascript">
        $(function(){
            $("#listagem").dataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "<?=URL?>handler/musica/DataTable/",
                    "type": "POST"
                },
                "columns": [
                    {"data": "Titulo" },
                    {"data": "a.Titulo" },
                    {   "data": "OptionsMenu",
                        "orderable":      false,
                        "className": "tdMenu"
                    }
                ]
                //"aoColumns": [ null, null, {"bSortable": false} ]
            });
        });

        ///"aoColumns": [ null, null, {"bSortable": false} ]
        function Excluir(Id){
            bootbox.confirm('Deseja realmente excluir este item?', function(result){
                if(result)
                    location.href="<?=\Libs\Helper::getUrl("deletar")?>"+Id;

            });
        }

        function Filtrar(Destino, Pagina, Total, Titulo){
            var Pagina = Pagina.toInt() > 0 ? Pagina.toInt() : 1,
                Total = Total.toInt() > 0 ? Total.toInt() : 20,
                Url = "<?=URL?>handler/musica/GetTable/"+Pagina+"/"+Total+"/"+Titulo;
            $.get(Url, function(data){
                if(data!=""){
                    $(Destino+" tbody").html(data);
                    $("#listagem").dataTable({
                        "bFilter": false,
                        "bInfo": false,
                        "bPaginate": false,
                        "aoColumns": [ null, null, {"bSortable": false} ]
                    });
                }else{

                }
            });
        }
        $(function(){
           /*Filtrar("#listagem", "1","20","");
            $("#paginacao li").click(function(){
               var Pagina = $("a", this).html();
                Filtrar("#listagem", Pagina, "20", "");
            });*/
        });
    </script>
<?  ?>

<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Musicas</h3>
        <div class="box-tools pull-right">
            <a href="<?=\Libs\Helper::getUrl("cadastro")?>" class="btn btn-primary btn-sm" style="color:#fff;" ><i class="fa
                    fa-plus"></i> Nova Música</a>
        </div>
    </div>
    <div class="box-body">
        <table id="listagem" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Artista</th>
                <th style="width:18px" align="center"></th>
            </tr>
            </thead>
            <tbody>
            <?
            if(is_array($Model->Lista) && count($Model->Lista) > 0)
            {
                foreach($Model->Lista as $Item)
                {
                    //$Item = new \DAL\Musica();
                    //var_dump($Item);
                    ?>
                    <tr>
                        <td><?=$Item->Titulo;?></td>
                        <td><?=$Item->Artista->Titulo;?></td>
                        <td align="center">

                            <div class="btn-group">
                                <i class="fa fa-bars" class="dropdown-toggle"
                                   data-toggle="dropdown"></i>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li><a href="<?=\Libs\Helper::getUrl("cadastro","", $Item->MusicaId)?>"><i
                                                class="fa fa-edit"></i>
                                            Editar</a></li>
                                    <li><a onclick="Excluir(<?=@$Item->MusicaId;?>)"><i class="fa fa-trash-o"></i> Excluir</a></li></ul>
                            </div>

                        </td>
                    </tr>
                <?
                }
            }else
            {
               // echo "<tr><td colspan='2'>Nenhum Registro</td></tr>";
            }
            ?>
            </tbody>
        </table>
</div>
</div>

