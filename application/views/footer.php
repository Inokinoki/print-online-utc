    <footer class="page-footer blue-grey">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">Print Online</h5>
                <p class="grey-text text-lighten-4">Imprimer vos PDFs partout des résidences à l'UTC.</p>
                <p class="grey-text text-lighten-4">Print your PDFs everywhere in the residences of UTC.</p>
            </div>
            <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Links</h5>
                <ul>
                    <li><a class="grey-text text-lighten-3" href="./service.php?aid=1">Imprimer</a></li>
                    <li><a class="grey-text text-lighten-3" href="./service.php?aid=2">Recopier</a></li>
                    <li><a class="grey-text text-lighten-3" href="./service.php?aid=3">Scanner</a></li>
                    <li><a class="grey-text text-lighten-3" href="./advice.php">Suggestion</a></li>
                    <li><a class="grey-text text-lighten-3" href="./apropos.php">Apropos</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
        © 2017 Copyright Inoki
        </div>
    </div>
</footer>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-108089983-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-108089983-1');
</script>
<script src="https://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="<?php echo View::$dirConfig['root']; ?>/res/js/materialize.js"></script>
<script src="<?php echo View::$dirConfig['root']; ?>/res/js/vue.js"></script>
<script>
    $(".button-collapse").sideNav();
    $(".collapsible").collapsible();
    $(".modal").modal();
    $("select").material_select();
    $('.parallax').parallax();
</script>
<script>
<?php echo (empty($specific_script)?"":$specific_script); ?>
</script>
</body>
</html>