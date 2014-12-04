<?
use Libs\Form;
?>


<div id="row">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
                Cadastro de Pessoa
            </h3>

        </div>
        <div class="box-body">
            <pre>
            <? print_r($Model)?>
                </pre>
            <form>
                <?Form::Hidden("PessoaId", @$Model->PessoaId);?>
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="<? if(@$Model->TipoPessoaFisica == 1) echo "active"; ?>"><a href="#pf" data-toggle="tab">Pessoa Física</a></li>
                        <li class="<? if(@$Model->TipoPessoaFisica != true) echo "active"; ?>"><a href="#pj" data-toggle="tab">Pessoa Jurídica</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane <? if(@$Model->TipoPessoaFisica == 1) echo "active"; ?>"
                             id="pf">
                            <div class="row">
                            <div class="form-group col-lg-4">
                                <label>
                                    CPF:
                                </label>
                                <?Form::Mask("99.999.999-99", "PessoaFisica_CPF", @$Model->PessoaFisica->CPF, Array("class" => "form-control"));?>
                            </div>
                                <div class="form-group col-lg-4">
                                    <label>
                                        RG:
                                    </label>
                                    <?Form::Text("PessoaFisica_RG", @$Model->PessoaFisica->RG, Array("class" => "form-control"));?>
                                </div>

                                <div class="form-group col-lg-4">
                                    <label>
                                        Data de Nascimento:
                                    </label>
                                    <?Form::DatePicker("PessoaFisica_Nascimento", @$Model->PessoaFisica->Nascimento, Array("class" => "form-control"));?>
                                </div>
                                </div>


                            <div class="row">
                                <div class="form-group col-lg-4">
                                    <label>
                                        Sexo:
                                    </label>
                                    <? Form::DropDown("PessoaFisica_Sexo", @$Model->PessoaFisica->Sexo, Array(
                                        "Masculíno"=>"Masculíno",
                                        "Feminíno"=> "Feminíno"
                                    ), Array("class" => "form-control"))?>
                                </div>

                                <div class="form-group col-lg-4">
                                    <label>
                                        Estado Civíl:
                                    </label>
                                        <? Form::DropDown("PessoaFisica_EstadoCivil", @$Model->PessoaFisica->EstadoCivil, Array(
                                            "Solteiro"=>"Solteiro",
                                            "Casado"=> "Casado",
                                            "Viúvo"=>"Viúvo",
                                            "Divorciado"=>"Divorciado"
                                        ), Array("class" => "form-control"))?>
                                </div>

                                <div class="form-group col-lg-4">
                                    <label>
                                        Nacionalidade:
                                    </label>
                                    <script>
                                        $(function(){
                                            var paises = "";
                                            $.getJSON("<?=URL?>handler/index/pais/GetAll", function(data){
                                                $.each(data, function(i, item){
                                                    paises += "<option value='"+item.Nome+"'>"+item.Nome+"</option>";
                                                });
                                                console.log(paises);
                                                $("#select2").html(paises);
                                            });
                                            $("#select2").select2();
                                        });
                                    </script>
                                    <select id="select2" class="form-control">

                                    </select>
                                </div>

                            </div>

                        </div><!-- /.tab-pane -->
                        <div class="tab-pane <? if(@$Model->TipoPessoaFisica != true) echo "active"; ?>"
                             id="pj">
                            The European languages are members of the same family. Their separate existence is a myth.
                            For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                            in their grammar, their pronunciation and their most common words. Everyone realizes why a
                            new common language would be desirable: one could refuse to pay expensive translators. To
                            achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                            words. If several languages coalesce, the grammar of the resulting language is more simple
                            and regular than that of the individual languages.
                        </div><!-- /.tab-pane -->
                    </div><!-- /.tab-content -->
                </div>

<h3 class="page-header">Dados Gerais</h3>
                <div class="form-group">
                    <label>
                        Nome:
                    </label>
                    <?Form::Text("Nome", @$Model->Nome, Array("class" => "form-control"));?>
                </div>
                <div class="form-group">
                    <label>
                        Email:
                    </label>
                    <?Form::Text("Email", @$Model->Email, Array("class" => "form-control"));?>
                </div>
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label>
                            Telefone:
                        </label>
                        <?Form::Mask("(99) 9999-9999", "Telefone", @$Model->Telefone, Array("class" => "form-control"));?>
                    </div>

                    <div class="form-group col-lg-6">
                        <label>
                            Celular:
                        </label>
                        <?Form::Mask("(99) 9999-9999?9", "Celular", @$Model->Celular, Array("class" => "form-control"));?>
                    </div>
                </div>
                <div class="form-group">
                    <label>
                        Observações:
                    </label>
                    <?Form::TextArea("Observacao", @$Model->Observacao, Array("class" => "form-control"));?>
                </div>

            </form>
        </div>

        <div class="box-footer">
            <div class="row">
                <a href="apps/cadastro" class="btn btn-primary btn-sm" style="float: right; margin-right: 15px;" ><i class="fa
                    fa-plus"></i> Salvar</a>
            </div>
        </div>
    </div>
</div>

