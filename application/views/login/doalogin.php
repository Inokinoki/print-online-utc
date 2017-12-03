<div class="container">
    <div class="row">
        <div class="card col s12 m8 l6 xl6 offset-m2 offset-l3 offset-xl3" id="login-module">
            <div class="card-content">
                <span class="card-title">
                    <b style="font-size:1.3em;"><?php echo $cardTitle; ?></b>
                </span>
                <?php echo $message; ?>
            </div>
            <div class="card-action">
                <a href="javascript:window.location.href='<?php echo $needRefreshUrl; ?>';"> Si votre browser n'ai pas d'action, Cliquez ici </a>
            </div>
        </div>
    </div>
</div>
