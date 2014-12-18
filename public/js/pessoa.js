/**
 * Created by renalcio.freitas on 12/12/2014.
 */
function BuscaPessoa(DOC, formPRE){
    if(DOC != null && DOC != "" && DOC.length > 2) {
        formPRE = (formPRE != null && formPRE != undefined) ? formPRE + "_" : "";

        formPRE = "#" + formPRE;

        $.get(SiteURL + "handler/pessoa/GetByDoc/" + DOC, function (data) {
            if (data != null) {

                bootbox.confirm('O CPF inserído já existe, deseja carregar seus dados?', function (result) {
                    if (result) {
                        //DEFINE FORMULARIO
                        $.each(data, function (i, item) {
                            if (item !== null && i != "CPF") {
                                if (typeof item === 'object') {
                                    $.each(item, function (x, subitem) {
                                        if (x != "CPF") {
                                            $(formPRE + i + "_" + x).val(subitem).change();
                                        }
                                    });
                                } else {
                                    $(formPRE + i).val(item).change();
                                }
                            }

                        });
                    }
                });


            }
        });
    }
}