<input type="hidden" id="AplicacaoId" value="<?=$Model->AplicacaoId;?>" />
<input type="hidden" id="PerfilId" value="<?=$Model->PerfilId;?>" />
<div id="Validacao" class="col-12"></div>
<script type="text/javascript">
    $(function() {
        $(".switch").on('switchChange.bootstrapSwitch', function(event, state) {
            var ref = $(this).attr("ref"); // MenuId
            $.getJSON("<?=URL;?>handler/permissao/acesso/"+ref+"/<?=@$Model->PerfilId;?>/"+state, function(data){
                //console.log(data);
            });
        });
</script>
<style>
    .listmenu {
        list-style: none;
        -webkit-padding-start: 0px;
    }
    .listmenu:first-child {
        border-right: 1px solid #ddd;
    }
    .listmenu li {
        padding: 10px 0;
        border-top: 1px solid #ddd;
        border-left: 1px solid #ddd;
        padding-left: 15px;
        border-collapse: collapse;
    }
    .listmenu li:last-child {
        border-bottom: 1px solid #ddd;
    }
    .bootstrap-switch {
        margin-right: 10px;
    }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">
                    Acessos ao Perfil <?=@$Model->Titulo;?>
                </h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="listmenu">
                            <?php
                            if(isset($Model->Menu) && is_array($Model->Menu) && count($Model->Menu) > 0)
                            {
                                foreach($Model->Menu as $MenuItem)
                                {
                                    ?>
                                    <li>
                                        <?=$MenuItem->Titulo;?>
                                        <div class="pull-right">
                                            <input  data-placement="left" type="checkbox" ref="<?=$MenuItem->MenuId;?>" name="my-checkbox" class="switch pull-right" <? if(\Libs\Usuario::GetAcessoByPerfil(@$MenuItem->MenuId, @$Model->PerfilId)) echo "checked";?> data-size="mini" data-off-color="danger" data-on-text="<i class='fa fa-check'></i>" data-off-text="<i class='fa fa-ban'></i>" />
                                        </div>
                                        <?php
                                        if(isset($MenuItem->ListSubMenu) && is_array($MenuItem->ListSubMenu) && count($MenuItem->ListSubMenu) > 0)
                                        {
                                            ?>
                                            <ul class="listmenu" style="margin-top: 10px;">
                                                <?php
                                                foreach($MenuItem->ListSubMenu as $SubItem)
                                                {
                                                    ?>
                                                    <li>
                                                        <div class="pull-right">
                                                            <input  data-placement="left" type="checkbox" ref="<?=$SubItem->MenuId;?>" name="my-checkbox" class="switch pull-right" <? if(\Libs\Usuario::GetAcessoByPerfil(@$SubItem->MenuId, @$Model->PerfilId)) echo "checked";?> data-size="mini" data-off-color="danger" data-on-text="<i class='fa fa-check'></i>" data-off-text="<i class='fa fa-ban'></i>" />
                                                        </div>
                                                        <?=$SubItem->Titulo;?>
                                                        <?php
                                                        if(isset($SubItem->ListSubMenu) && is_array($SubItem->ListSubMenu) && count($MenuItem->ListSubMenu) > 0)
                                                        {
                                                            ?>
                                                            <ul class="listmenu" style="margin-top: 10px;">
                                                                <?php
                                                                foreach($SubItem->ListSubMenu as $SubSubItem)
                                                                {
                                                                    ?>
                                                                    <li>
                                                                        <div class="pull-right">
                                                                            <input  data-placement="left" type="checkbox" ref="<?=@$SubSubItem->MenuId;?>" name="my-checkbox" class="switch pull-right" <? if(\Libs\Usuario::GetAcessoByPerfil(@$SubSubItem->MenuId, @$Model->PerfilId)) echo "checked";?> data-size="mini" data-off-color="danger" data-on-text="<i class='fa fa-check'></i>" data-off-text="<i class='fa fa-ban'></i>" />
                                                                        </div>
                                                                        <?=$SubSubItem->Titulo;?>
                                                                    </li>
                                                                <?php
                                                                }
                                                                ?>
                                                            </ul>
                                                        <?php
                                                        }
                                                        ?>
                                                    </li>
                                                <?
                                                }
                                                ?>
                                            </ul>
                                        <?php
                                        }
                                        ?>
                                    </li>
                                <?php
                                }
                            }

                            ?>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="box-footer">
                <div class="row">
                    <a href="<?=Libs\Helper::getUrl("index")?>" class="btn btn-primary" style="float: right;
                        margin-right: 15px;">
                        Voltar
                    </a>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
</div>
