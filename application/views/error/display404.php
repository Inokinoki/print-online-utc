<div class="row">
    <div class="col s12 m8 l6 xl4 offset-m2 offset-l3 offset-xl4">
        <div class="card white">
            <div class="card-image">
                <img src="<?php echo View::$dirConfig['root'];?>/res/imgs/403.jpg"/>
                <h2 class="card-title black-text">
                    <i class="material-icons">error</i>Error 404</h2>
            </div>
            <div class="card-content">
                <p style="font-size:1.2em;">
                    Désolé, on ne peut pas trouver votre <big>page Internet</big>.<br/>
                    Mais vous pouvez imprimer quelques vos documents~
                </p>
            </div>
            <div class="card-action">
                <a href="#" onclick="window.location.reload(true);">Retry</a>
                <a href="<?php echo View::$dirConfig['root'];?>">Aller Imprimer</a>
            </div>
        </div>
    </div>
</div>