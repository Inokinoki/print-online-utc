<div class="container">
    <div class="row">
        <div class="card col s12 m8 l6 xl6 offset-m2 offset-l3 offset-xl3" id="login-module">
            <div class="card-content">
                <span class="card-title">
                    <b style="font-size:1.3em;">Se connecter</b>
                    <small class="grey-text" style="font-size:0.75em;">avec votre compte UTC</small>
                </span>
                <form action="<?php echo View::$dirConfig['root']; ?>/Login/doalogin" method="<?php echo POST; ?>">
                <div class="input-field col s12">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="input-username" name="username" type="text">
                    <label for="input-username" class="">Username</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">vpn_key</i>
                    <input id="input-password" name="password" type="password">
                    <label for="input-password" class="">Password</label>
                </div>
                <div id="birthday-tip" class="grey-text"> </div>
                <div id="wrong-tip"></div>
                <input id="comfirm-button" type="submit" class="btn right" value="Login">
                </form>
                <br/>
            </div>
        </div>
    </div>
</div>
