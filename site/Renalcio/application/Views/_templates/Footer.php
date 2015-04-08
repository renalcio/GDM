<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
<div class="scroll-top page-scroll visible-xs visble-sm">
    <a class="btn btn-primary" href="#page-top">
        <i class="fa fa-chevron-up"></i>
    </a>
</div>


<!-- Footer -->
<footer class="text-center">
    <div class="footer-above">
        <div class="container">
            <div class="row">
                <div class="footer-col col-md-4">
                    <h3>Localização</h3>
                    <p>Rua Eugênio Graupner, 181<br>
                        Vila Menuzzo
                        <br>Sumaré, SP 13171-590</p>
                </div>
                <div class="footer-col col-md-4">
                    <h3>Social</h3>
                    <ul class="list-inline">
                        <li>
                            <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-google-plus"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-linkedin"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-dribbble"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="footer-col col-md-4">
                    <h3>Telefones</h3>
                    <p>(19) 3883-6146<br> (19) 9-8234-9306</p>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-below">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                   Site desenvolvido por Renalcio Carlos
                     Copyright &copy; Todos os direitos reservados - <?=date("Y", time());?>
                </div>
            </div>
        </div>
    </div>
</footer>
<?
echo "<!--JAVASCRIPT-->\n";
\Libs\Helper::LoadMedia("js", [
    //JQUERY
    "js/jquery.js",
    //BOOTSTRAP
    "js/bootstrap.min.js",
]);
?>

<!-- Plugin JavaScript -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

<?
echo "<!--JAVASCRIPT-->\n";
\Libs\Helper::LoadMedia("js", [
    //TEMA
    "js/classie.js",
    "js/cbpAnimatedHeader.js",
    "js/jqBootstrapValidation.js",
    "js/contact_me.js",
    "js/freelancer.js"
]);
?>
</body>
</html>
