<script>
    $(function() {
        $('.dd').nestable({
            maxDepth: 3
        });

        $("#btnSalvar").click(function(){
            $("#Validacao").html('');
            var dados = {
                    menu : JSON.stringify($('.dd').nestable('serialize'))
                },
                AppId = $("#AppId").val();
            $.ajax({
                type: "POST",
                url: "<?=URL?>menu/salvar/"+AppId,
                data: dados,
                success: function( data )
                {
                    console.log(data);
                    data = JSON.parse(JSON.stringify(data));
                    $("#Validacao").html('<div class="alert alert-success alert-dismissable">\
                                                            <i class="fa fa-check"></i>\
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
                                                            <b>Sucesso!</b><br>O menu foi salvo com sucesso... \
                                                        </div>');
                    setTimeout(function(){
                        //location.reload();
                    }, 1500);
                }
            });

        });
    });

    function AddMenu() {
        var Menu = {
            Titulo: $("#Titulo").val(),
            Url: $("#Url").val(),
            Icone: $("#Icone").val(),
            Index: parseInt($("#Index").val()),
            MenuId: $("#MenuId").val().toInt()
        };

        if(!isNaN(Menu.Index))
        {
            $obj = $("li.dd-item[ref='"+Menu.Index+"']");
            $obj.find(".dd-handle:first").html('<i class="fa ' + Menu.Icone + '" style="margin-right: 5px"></i>' + Menu.Titulo);
            $obj.attr("data-Titulo", Menu.Titulo);
            $obj.attr("data-Url", Menu.Url);
            $obj.attr("data-Icone", Menu.Icone);

            $(".dd-handle").removeClass("dd-editing");
            $obj.find(".dd-handle:first").addClass("dd-editing");

        }else
        {
            Menu.Index = $("li.dd-item").size();

            var HTML = '<li class="dd-item" ref="' + Menu.Index + '" data-Titulo="' + Menu.Titulo + '" data-Url="' + Menu.Url + '" data-Icone="' + Menu.Icone + '" data-MenuId="'+ Menu.MenuId +'" data-Apagar="0">\
                                <button data-rel="tooltip" data-placement="left" title="Editar Menu" href="#" class="btn btn-xs btn-success editarMenu" style="margin-left:0"><i class="fa fa-edit"></i></button>\
                                <button data-rel="tooltip" data-placement="left" title="Excluir Menu" href="#" class="btn btn-xs btn-danger removerMenu" style="margin-left:0"><i class="fa fa-trash-o"></i></button>\
			                     <div class="dd-handle">\
									<i class="fa ' + Menu.Icone + '" style="margin-right: 5px"></i>' + Menu.Titulo + '\
			                     </div>\
                            </li>'
            $("#MenuList").append(HTML);
        }

        $("#Titulo").val("");
        $("#Url").val("");
        $("#Icone").val("");
        $("#Index").val("");
        $("#MenuId").val("0");
        $("#menuIconediv i").attr("class", "");


        ActionButtons();
    }

    function ActionButtons(){
        $(".editarMenu").click(function(){
            var $obj = $(this).parent(),
                index = $obj.attr("ref");


            $("#Titulo").val($obj.attr("data-Titulo"));
            $("#Url").val($obj.attr("data-Url"));
            $("#Icone").val($obj.attr("data-Icone"));
            $("#MenuId").val($obj.attr("data-MenuId"));
            $("#Index").val(index);
            $("#menuIconediv i").attr("class", "fa " + $obj.attr("data-Icone"));

            var subitens = $("ol:first", $obj).html();

            //$("#MenuList").append(subitens);

            //$obj.remove();
            $(".dd-handle").removeClass("dd-editing");
            $("li.dd-item[ref='"+index+"']").find(".dd-handle:first").addClass("dd-editing");

        });
        $(".removerMenu").click(function(){
            $obj = $(this);
            $obj.parent().attr("data-Apagar", "1").hide();
        });
    }

    $(function() {
        ActionButtons();
        $("#addMenuItem").click(AddMenu);
    });
</script>

<input type="hidden" id="AppId" value="<?=$Model->AppId;?>" />
<div id="Validacao" class="col-12"></div>

<div class="row">

    <div class="col-md-6">

        <div class="panel panel-primary">
            <div class="panel-header">
                <h3>
                    Hierarquia
                </h3>
            </div>
            <div class="panel-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="dd" id="nestable" id="nestable">
                            <ol class="dd-list" id="MenuList">
                                <?php
                                if(isset($Model->ListMenu) && is_array($Model->ListMenu) && count($Model->ListMenu) > 0)
                                {
                                    $ref = -1;
                                    foreach($Model->ListMenu as $MenuItem)
                                    {
                                        $ref++;
                                        ?>
                                        <li class="dd-item" ref="<?=$ref;?>" data-Titulo="<?=$MenuItem->Titulo;?>" data-Url="<?=$MenuItem->Url;?>" data-Icone="<?=$MenuItem->Icone;?>" data-MenuId="<?=$MenuItem->MenuId;?>"
                                            data-Apagar="0">
                                            <button data-rel="tooltip" data-placement="left" title="Editar Menu" href="#" class="btn btn-xs btn-success editarMenu" style="margin-left:0"><i class="fa fa-edit"></i></button>
                                            <button data-rel="tooltip" data-placement="left" title="Excluir Menu" href="#" class="btn btn-xs btn-danger removerMenu" style="margin-left:0"><i class="fa fa-trash-o"></i></button>
                                            <div class="dd-handle">
                                                <i class="fa <?=$MenuItem->Icone?>" style="margin-right: 5px"></i> <?= htmlspecialchars($MenuItem->Titulo, ENT_QUOTES, 'UTF-8');?>
                                            </div>
                                            <?php
                                            if(isset($MenuItem->ListSubMenu) && is_array($MenuItem->ListSubMenu) && count($MenuItem->ListSubMenu) > 0)
                                            {
                                                ?>
                                                <ol class="dd-list">
                                                    <?php
                                                    foreach($MenuItem->ListSubMenu as $SubItem)
                                                    {
                                                        $ref++;
                                                        ?>
                                                        <li class="dd-item" ref="<?=$ref;?>" data-Titulo="<?=$SubItem->Titulo;?>" data-Url="<?=$SubItem->Url;?>" data-Icone="<?=$SubItem->Icone;?>" data-MenuId="<?=$SubItem->MenuId;?>" data-Apagar="0">
                                                            <button data-rel="tooltip" data-placement="left" title="Editar Menu" href="#" class="btn btn-xs btn-success editarMenu" style="margin-left:0"><i class="fa fa-edit"></i></button>
                                                            <button data-rel="tooltip" data-placement="left" title="Excluir Menu" href="#" class="btn btn-xs btn-danger removerMenu" style="margin-left:0"><i class="fa fa-trash-o"></i></button>
                                                            <div class="dd-handle">
                                                                <i class="fa <?=$SubItem->Icone?>" style="margin-right: 5px"></i> <?=$SubItem->Titulo;?>
                                                            </div>
                                                            <?php
                                                            if(isset($SubItem->ListSubMenu) && is_array($SubItem->ListSubMenu) && count($MenuItem->ListSubMenu) > 0)
                                                            {
                                                                ?>
                                                                <ol class="dd-list">
                                                                    <?php
                                                                    foreach($SubItem->ListSubMenu as $SubSubItem)
                                                                    {
                                                                        $ref++;
                                                                        ?>
                                                                        <li class="dd-item" ref="<?=$ref;?>" data-Titulo="<?=$SubSubItem->Titulo;?>" data-Url="<?=$SubSubItem->Url;?>" data-Icone="<?=$SubSubItem->Icone;?>" data-MenuId="<?=$SubSubItem->MenuId;?>" data-Apagar="0">
                                                                            <button data-rel="tooltip" data-placement="left" title="Editar Menu" href="#" class="btn btn-xs btn-success editarMenu" style="margin-left:0"><i class="fa fa-edit"></i></button>
                                                                            <button data-rel="tooltip" data-placement="left" title="Excluir Menu" href="#" class="btn btn-xs btn-danger removerMenu" style="margin-left:0"><i class="fa fa-trash-o"></i></button>
                                                                            <div class="dd-handle">
                                                                                <i class="fa <?=$SubSubItem->Icone?>" style="margin-right: 5px"></i> <?=$SubSubItem->Titulo;?>
                                                                            </div>
                                                                        </li>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </ol>
                                                            <?php
                                                            }
                                                            ?>
                                                        </li>
                                                    <?
                                                    }
                                                    ?>
                                                </ol>
                                            <?php
                                            }
                                            ?>
                                        </li>
                                    <?php
                                    }
                                }

                                ?>
                            </ol>
                        </div>
                    </div>
                    <div class="col-lg-4">
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="row">
                    <button type="button" id="btnSalvar" class="btn btn-primary" style="float: right; margin-right: 15px;">
                        Salvar
                    </button>
                </div>
            </div>
        </div>
        <!-- /.panel-body -->
    </div>

    <div class="col-md-6">
        <div class="panel">
            <div class="panel-header">
                <h3 class="panel-title">Item do Menu</h3>
            </div>
            <div class="panel-content" style="display: block;">

                <!-- <div class="form-group">
                <label>Date range:</label>
                <div class="input-group">
                <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="reservation">
                </div> /.input group
                </div>-->

                <input type="hidden" id="Index" value="" />
                <input type="hidden" id="MenuId" value="0" />

                <div class="form-group">
                    <label>
                        Título:
                    </label>
                    <input type="text" class="form-control" id="Titulo" name="Titulo" />
                </div>
                <div class="form-group">
                    <label>
                        Url:
                    </label>
                    <input type="text" class="form-control" id="Url" name="Url" />
                </div>
                <script>
                    $(function() {
                        $("#Icone").on("keyup blur change", function() {
                            var classe = $(this).val();
                            $("#menuIconediv i").attr("class", "fa " + classe);
                        });
                    });
                </script>
                <div class="form-group">
                    <label>
                        Icone:
                    </label>

                    <div class="input-group" id="menuIconediv" for="Icone">
                        <span class="input-group-addon" id="icon-span"><i class="fa "></i></span>
                        <input type="text" class="form-control pull-right" id="Icone" name="Icone" />
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-primary m-0" data-toggle="modal" data-target="#iconeModal">Selecionar Icone</button>
                        </div><!-- /btn-group -->
                    </div>
                </div>
            </div><!-- /.panel-body -->
            <div class="panel-footer" style="display: block;">
                <div class="row">
                    <button type="button" id="addMenuItem" class="btn btn-primary" style="float: right; margin-right: 15px;">
                        Concluido
                    </button>
                </div>
            </div><!-- /.panel-footer-->
        </div>
    </div>
</div>

<script>
    $(function(){
        $("#BuscaIcone").on("keypress keyup change",function(){
            var termo = $(this).val();
            if(termo.length > 0) {
                $("#iconeModal .fontawesome-icon-list div").hide();
                $("#iconeModal .fontawesome-icon-list div:contains('" + termo + "')").show();
            }else{
                $("#iconeModal .fontawesome-icon-list div").show();
            }
        });

        $("#iconeModal .fontawesome-icon-list div").click(function(){
            var $ico = $(this).find("i");
            $ico.removeClass("fa");
            $ico.removeClass("fa-fw");
            var classe = $ico.attr("class");
            $ico.addClass("fa");
            $ico.addClass("fa-fw");
            $("#Icone").val(classe).change();
            $('#iconeModal').modal('hide');
        });
    });
</script>
<style>
    #iconeModal .fontawesome-icon-list div {
        padding: 10px;
    }
    #iconeModal .fontawesome-icon-list div:hover {
        background: #cecece;
    }
</style>
<!-- Modal icone -->
<div class="modal fade" id="iconeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Selecione um Icone</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-8"></div>
                    <div class="col-lg-4">
                        <input type="text" id="BuscaIcone" class="pull-right form-control" placeholder="Pesquisar" />
                    </div>
                    <br>
                    <br>
                </div>
                <?  \Libs\Helper::LoadModelView($Model, "icones", "notificacao");?>
            </div>
        </div>
    </div>
</div>