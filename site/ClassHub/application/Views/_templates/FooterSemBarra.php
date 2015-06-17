
</section><!-- /.content -->

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
