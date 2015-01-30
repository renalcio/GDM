<?
use Libs\ArrayHelper;
?>
<div class="container">
    <h2>You are in the View: application/views/home/index.php (everything in the box comes from this file)</h2>
    <p>
        <?

        $lista = new \Libs\ListHelper();
        $lista->Add(new \DAL\PessoaFisica(0, "Teste"));
        $lista->Add(new \DAL\PessoaFisica(0, "Teste2"));
        $lista->Add(new \DAL\PessoaFisica(0, "Teste3"));

        //var_dump($lista->ToList());
        $lista->For_Each(function($item){
            var_dump($item);
        });

        ?>

    </p>
</div>
