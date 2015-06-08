<?
if(is_array($Model->Lista) && count($Model->Lista) > 0)
{
    ?>
    <script type="text/javascript">
        $(function() {
            $('.dd').nestable({
                maxDepth: 1
            });

            $("#btnSalvar").click(function(){
                $("#Validacao").html('');
                var dados = {
                        destaques : JSON.stringify($('.dd').nestable('serialize'))
                    },
                    AppId = $("#AppId").val();
                $("#Validacao").html('');
                $.ajax({
                    type: "POST",
                    url: "<?=URL?>sitedestaque/salvar/",
                    data: dados,
                    success: function( data )
                    {
                        console.log(data);
                        data = JSON.parse(JSON.stringify(data));
                        $("#Validacao").html('<div class="alert alert-success alert-dismissable">\
                                                            <i class="fa fa-check"></i>\
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
                                                            <b>Sucesso!</b><br>Os destaques foram salvos com sucesso.\
                                                             \
                                                        </div>');
                    }
                });
            });
        });

        function Excluir(Id){
            bootbox.confirm('Deseja realmente excluir este item?', function(result){
                if(result)
                    location.href="<?=\Libs\Helper::getUrl("deletar")?>"+Id;

            });
        }
        function Editar(Id){

                    location.href="<?=\Libs\Helper::getUrl("cadastro")?>"+Id;
        }
    </script>
<? } ?>
<div id="Validacao" class="col-12"></div>
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Destaques do Site</h3>
        <div class="box-tools pull-right">
            <a href="<?=\Libs\Helper::getUrl("cadastro")?>" class="btn btn-primary btn-sm" style="color:#fff;" ><i class="fa
                    fa-plus"></i> Novo Destaque</a>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="dd" id="nestable" id="nestable">
                    <ol class="dd-list" id="DestaqueList">
                        <?
                        if(is_array($Model->Lista) && count($Model->Lista) > 0)
                        {
                            foreach($Model->Lista as $Item)
                            {
                                //$Item = new \Model\Artista();
                                ?>
                                <li class="dd-item" data-SiteDestaqueId="<?=$Item->SiteDestaqueId;?>"
                                    data-ReferenciaId="<?=$Item->ReferenciaId;?>">
                                    <button onclick="Editar(<?=$Item->SiteDestaqueId;?>)" data-rel="tooltip" data-placement="left" title="Editar Destaque" class="btn btn-xs btn-success" style="margin-left:0"><i class="fa fa-edit"></i></button>
                                    <button onclick="Excluir(<?=$Item->SiteDestaqueId;?>)" data-rel="tooltip" data-placement="left" title="Excluir Destaque" class="btn btn-xs btn-danger" style="margin-left:0"><i class="fa fa-trash-o"></i></button>
                                    <div class="dd-handle">
                                        <?=$Item->Titulo;?>
                                    </div>
                                </li>
                            <?
                            }
                        }
                        ?>
                    </ol>
                </div>
            </div>
        </div>

    </div>
    <div class="box-footer" style="display: block;">
        <div class="row">
            <div class="col-lg-12">
                <button type="button" id="btnSalvar" class="btn btn-primary btn-sm pull-right">Salvar</button></div>
        </div>
        </div>
    </div>
</div>

