<?
use Libs\Form;
?>
    <script>
        function SetPF(valor){
            $(".TipoPessoaFisicaBit").val(valor);
        }
    </script>
    <?Form::Hidden("PessoaId", @$Model->PessoaId);?>
    <?Form::Hidden("PessoaFisica_PessoaId", @$Model->PessoaFisica->PessoaId);?>
    <?Form::Hidden("PessoaJuridica_PessoaId", @$Model->PessoaJuridica->PessoaId);?>
    <?Form::Hidden("TipoPessoaFisica", @$Model->TipoPessoaFisica, Array("class"=>"TipoPessoaFisicaBit"));?>

        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#pf" id="pfLink"
                                                                                       onclick="SetPF(1)"
                                                                                       data-toggle="tab">Pessoa Física</a></li>
                <li><a href="#pj"
                                                                                          onclick="SetPF
                                                                                                  (0)"
                                                                                          data-toggle="tab">Pessoa Jurídica</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active"
                     id="pf">
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label>
                                CPF:
                            </label>
                            <?Form::Mask("999.999.999-99", "PessoaFisica_CPF", @$Model->PessoaFisica->CPF,
                                Array("class" => "form-control"));?>
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
                            <div class="input-group">
                                <?Form::DatePicker("PessoaFisica_Nascimento", @$Model->PessoaFisica->Nascimento, Array("class" => "form-control"));?>
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>

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
                            <? Form::Select2("PessoaFisica_Nacionalidade", @$Model->PessoaFisica->Nacionalidade, "", Array("class" => "form-control", "DataUrl" => URL."handler/pais/Select2" ))?>
                        </div>

                    </div>

                </div><!-- /.tab-pane -->
                <div class="tab-pane"
                     id="pj">

                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>
                                CNPJ:
                            </label>
                            <?Form::Mask("99.999.999/9999-99", "PessoaJuridica_CNPJ", @$Model->PessoaJuridica->CNPJ, Array("class" => "form-control"));?>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>
                                Nome Fantasia:
                            </label>
                            <?Form::Text("PessoaJuridica_NomeFantasia", @$Model->PessoaJuridica->NomeFantasia, Array("class" => "form-control"));?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>
                                IE:
                            </label>
                            <?Form::Text("PessoaJuridica_IE", @$Model->PessoaJuridica->IE, Array("class" => "form-control"));?>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>
                                IM:
                            </label>
                            <?Form::Text("PessoaJuridica_IM", @$Model->PessoaJuridica->CNPJ,
                                Array("class" => "form-control"));?>
                        </div>
                    </div>

                </div><!-- /.tab-pane -->
            </div><!-- /.tab-content -->
        </div>

        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">
                    Dados Gerais
                </h3>

            </div>

            <div class="box-body">
                <div class="form-group">
                    <label>
                        Nome / Razão Social:
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


            </div>
        </div>


