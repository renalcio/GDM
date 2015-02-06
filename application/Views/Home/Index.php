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
    /*$classe = get_class($obj);

    $classe = explode("\\", $classe);
    $banco = isset($classe[2]) ? $classe[1] : ROOTDB;
    $tabela = isset($classe[2]) ? $classe[2] : $classe[1];

    $pdo = new \Libs\Database();
    $sql = $pdo->select("SELECT * FROM ".$banco.".".$tabela);
    var_dump($sql);
    */

    $unitofwork = new \Libs\UnitofWork();

    $dados = $unitofwork->Get(new \DAL\MediaSpot\Artista())->First();

    var_dump((Array)$dados);

    ?>

    </p>
</div>
