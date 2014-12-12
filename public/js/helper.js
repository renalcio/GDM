//Converter Para Dinheiro (Casas, Símbolo Decimal, Símbolo de Milhar)
Number.prototype.toMoney = function (c, d, t) {
    var n = this,
        c = isNaN(c = Math.abs(c)) ? 2 : c,
        d = d == undefined ? "." : d,
        t = t == undefined ? "," : t,
        s = n < 0 ? "-" : "",
        i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
        j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};

//Converter String Para Int, retorna 0 se não for numero
String.prototype.toInt = function () {
    if (isNaN(parseFloat(this)))
        var n = parseInt(parseFloat(this.replace(/[^0-9\,\-]/g, '').replace(/[^0-9\-]/g, '.')));
    else
        var n = parseInt(parseFloat(this));

    if (isNaN(n))
        return 0;
    else
        return n;
};

//Converter String para Float, retorna 0 se não for numero, substitui vírgular por ponto e remove ponto de milhares
String.prototype.toFloat = function () {
    if (this.indexOf(",") > -1)
        var n = parseFloat(this.replace(/[^0-9\,\-]/g, '').replace(/[^0-9\-]/g, '.'));
    else
        var n = parseFloat(this);

    if (isNaN(n))
        return 0;
    else
        return n;
};

String.prototype.Contains = function (texto) {
    return this.indexOf(texto) != -1;
};

/********************************
 Tab Helper
 Data: 31/10/2014
 Autor: Renalcio Carlos
 Versão: 1.0
 Função:
 Acessa Tab de acordo com a URL
 ***********************************/
function TabAtual() {
    var tab = location.href.split("#")[1];
    if (Boolean(tab)) {
        $("a[href='#" + tab + "'").click();
    }
}

/********************************
 Plugin Input Numérico
 Data: 24/10/2014
 Autor: Renalcio Carlos
 Versão: 1.0
 Função:
 Bloqueia virgulas e pontos em um campo de texto forçando um numero inteiro
 ***********************************/
(function ($) {
    $.fn.campoNumerico = function (options) {
        // configurações padrão
        var config = {
            decimal: false,
            negativo: false,
        };
        options = $.extend(config, options);
        return this.each(function () {
            var valor = $(this).val();
            //Tratamento Inicial
            if (options.negativo == true)
                valor = valor.replace(/[^0-9\,\-]/g, '');
            else
                valor = valor.replace(/[^0-9\,]/g, '');

            if (options.decimal != true)
                valor = valor.replace(/[^0-9]/g, '');

            $(this).val(valor);

            $(this).keyup(function (e) {

                //pega código da tecla atual
                var code = e.keyCode || e.which,
                    val = $(this).val();

                if (code == 109 || code == 189) {
                    //pressionou hifen
                    if (options.negativo == true) {
                        //permite negativo

                        //Pega posição do hifem
                        var NegativoPos = val.indexOf("-");

                        if (NegativoPos > -1) {
                            if (NegativoPos == 0)
                                val = val.replace("-", "!");

                            val = val.replace(/[-]/g, '');

                            if (NegativoPos == 0)
                                val = val.replace("!", "-");
                        }

                    } else {
                        val = val.replace(/[-]/g, '');
                    }
                }

                //Verifica se não é espaço ou setas
                if (code != 8 && (code < 36 || code > 40) && code != 46) {

                    if (options.decimal == true) {
                        //Permite NUmeros decimais

                        // filtra letras e caracteres especiais, exceto virgula
                        if (options.negativo == true)
                            val = val.replace(/[^0-9\,\-]/g, '');
                        else
                            val = val.replace(/[^0-9\,]/g, '');


                        var VirgulaPos = val.indexOf(","); // pega a posição da primeira vigurla

                        if (options.negativo == true)
                            val = val.replace(/[^0-9\-]/g, '');
                        else
                            val = val.replace(/[^0-9]/g, ''); // remove todas as virgulas


                        // Se a virgula exisitir a partir da primeira casa
                        if (VirgulaPos > -1) {
                            val = val.substring(0, VirgulaPos) + "," + val.substr(VirgulaPos); // insere a virgula na posição salva
                        }

                        $(this).val(val);
                    }

                    else {
                        //Somente numeros inteiros
                        if (options.negativo == true)
                            $(this).val(val.replace(/[^0-9\-]/g, ''));
                        else
                            $(this).val(val.replace(/[^0-9]/g, ''));
                    }
                }
            });

            $(this).focus(function (e) {
                var val = $(this).val();
                if (val.toFloat(options.decimal) == 0) {
                    $(this).val("");
                }
            });

            $(this).blur(function (e) {
                var val = $(this).val(),
                    VirgulaPos = val.indexOf(","),
                    NegativoPos = val.indexOf("-");

                //se a virgula existir na primeira casa, adiciona um 0 ao numero
                if (NegativoPos == 0 && VirgulaPos == 1) {
                    val = val.substring(0, 1) + "0" + val.substr(1); // insere 0 na posição 1
                } else if (VirgulaPos == 0) {
                    val = 0 + val;
                }

                if (val == "-0," || val == "-" || val == "," || val == ",0" || (VirgulaPos > -1 && val.split(",")[0].toInt() == 0 && (!Boolean(val.split(",")[1]) || val.split(",")[1].toInt() == 0)) || val.toFloat(options.decimal) == 0)
                    val = 0;

                $(this).val(val);
            });
        });
    };
})(jQuery);
