
$(function() {

    SetMenuAtivo($(".sidebar-menu>li"), 0);
    // just a super-simple JS demo

    var demoHeaderBox;

    // simple demo to show create something via javascript on the page
    if ($('#javascript-header-demo-box').length !== 0) {
        demoHeaderBox = $('#javascript-header-demo-box');
        demoHeaderBox
            .hide()
            .text('Hello from JavaScript! This line has been added by public/js/application.js')
            .css('color', 'green')
            .fadeIn('slow');
    }

    // if #javascript-ajax-button exists
    if ($('#javascript-ajax-button').length !== 0) {

        $('#javascript-ajax-button').on('click', function(){

            // send an ajax-request to this URL: current-server.com/songs/ajaxGetStats
            // "url" is defined in views/_templates/footer.php
            $.ajax(url + "/songs/ajaxGetStats")
                .done(function(result) {
                    // this will be executed if the ajax-call was successful
                    // here we get the feedback from the ajax-call (result) and show it in #javascript-ajax-result-box
                    $('#javascript-ajax-result-box').html(result);
                })
                .fail(function() {
                    // this will be executed if the ajax-call had failed
                })
                .always(function() {
                    // this will ALWAYS be executed, regardless if the ajax-call was success or not
                });
        });
    }

});

//Menu Class Builder
function SetMenuAtivo($obj, Nivel){
    var UrlAtual = location.href;
    console.log(UrlAtual);

    $obj.each(function(){
        var MenuUrl = $("a:first", this).attr("href");
        //Verifica se é o menu atual
        if(UrlAtual == MenuUrl) {
            $(this).addClass("active");
            if(Nivel > 0)
                $(this).parent("ul:first").show().parent("li:first").addClass("active");

            if(Nivel > 1)
                $(this).parent("ul:first").parent("li:first").parent("ul:first").show().parent("li:first").addClass("active");
        }else{
            //Verifica se existe submenu
            if($("ul", this).size() > 0){
                //Passa No SubMenu
                $("ul:first", this).each(function() {
                    //Chama a função nos subitens
                    SetMenuAtivo($(">li", this), Nivel+1);
                    //$(">li", this).each(function() {
                    //});
                });
            }
        }
    });
}

//SubFormularios
function SubFormulario(divForm, nomeObj){
    $(divForm+" input, "+divForm+" select, "+divForm+" textarea").each(function(){
        var Nome = $(this).attr("name"),
            Id = $(this).attr("id");
        $(this).attr("name", nomeObj+"_"+Nome);
        $(this).attr("id", nomeObj+"_"+Id);
    });
}