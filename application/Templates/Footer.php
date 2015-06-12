
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Versão</b> Pre-alpha 0.01
    </div>
    <strong><?=date("Y", time());?> &copy; <?=$HUser->Aplicacao->Titulo;?> - </strong> Todos os direitos
    reservados.
</footer>
        </div><!-- ./wrapper -->

    <!-- define the project's URL (to make AJAX calls possible, even when using this in sub-folders etc) -->
    <script>
        var url = "<?php echo URL; ?>";
    </script>

<?
echo "\n<!--JAVASCRIPT-->\n";
\Libs\Helper::LoadMedia("js", [
    "dist/js/pages/header.js",
    "dist/js/application.js"
]);
?>
</body>
</html>
