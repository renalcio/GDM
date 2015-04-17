/**
 * Created by Renalcio Junior on 23/12/2014.
 */

function LoadHeaderDrops(){
    LoadHeaderMensagens();
    LoadHeaderNotificacoes();
    LoadHeaderTarefas();
}

function LoadHeaderMensagens(){
    $.get(url+"handler/mensagem/GetIndex/", function(data) {
        //console.log(data);
        $("#topMenuMensagens ul.menu").html(data.Html);
        $("#topMenuMensagens li.header").html("Você tem "+data.Count+" mensagens");
        $("#topMenuMensagens .label").html(data.Count);
    });
}

function LoadHeaderNotificacoes(){
    $.get(url+"handler/notificacao/GetIndex/", function(data) {
        //console.log(data);
        $("#topMenuNotify ul.menu").html(data.HtmlDrop);
        $("#topMenuNotify li.header").html("Você tem "+data.Count+" notificações");
        $("#topMenuNotify .label").html(data.Count);
        $("#notifyModal table tbody").html(data.HtmlModal);
    });
}

function LoadHeaderTarefas(){

}

$(function(){
    LoadHeaderDrops();
    setInterval(LoadHeaderDrops, (60 * 5000));
});