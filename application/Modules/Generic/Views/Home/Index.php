<?
use Libs\ArrayHelper;
use DAL\Site;
?>
<div class="container">
    <h2>You are in the View: application/views/home/index.php (everything in the box comes from this file)</h2>
    <p>
    <form method="post">
        Grupo 0 -> Titulo
        <input type="text" id="Grupo__1_Titulo" name="Grupo[0]_Titulo">
        Grupo 1 -> Titulo
        <input type="text" id="Grupo__1_Titulo" name="Grupo[1]_Titulo">
        <button type="submit">Vai</button>
    </form>

    <?

    $time = microtime(1);
    $mem = memory_get_usage();

    $ctrl = new \Modules\Generic\Controllers\HomeController();

    $notes = \Libs\ModelState::CheckAnnotation($ctrl, "Public");
    var_dump($notes);

    /**
    SELECT p.*
    FROM
    GDM.Pessoa p,
    GDM.PessoaAplicacao pa,
    GDM.Aplicacao a
    WHERE a.AplicacaoId = '3'
    AND pa.AplicacaoId = a.AplicacaoId
    AND p.PessoaId = pa.PessoaId

    SELECT GDM.Pessoa.* FROM GDM.Pessoa
    INNER JOIN GDM.Aplicacao
    INNER JOIN GDM.PessoaAplicacao ON GDM.PessoaAplicacao.PessoaId = GDM.Pessoa.PessoaId AND GDM.PessoaAplicacao
    .AplicacaoId = GDM.Aplicacao.AplicacaoId
    WHERE GDM.Aplicacao.AplicacaoId = '3'


    Ideias:
    Criar um Objeto de Retorno como stdClass e nele adicionar objetos com os tipos especificados no JOIN
    ex:
    Sem join: $retorno->Get = Objeto do GET
    Joins:
    $retorno->Get = Objeto do GET
    $retorno->Join1 = Objeto do Join1
    $retorno->Join2 = Objeto do Join2

    no Select deixar padrão o Objeto do GET e permitir que ele identifique quais quer retornar em uma logica parecida com
    a do WHERE do ArrayHelper
    Ex:
    Select(function($x){$x->Join1; })->....
    */
    ?>
    </p>
</div>