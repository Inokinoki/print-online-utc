<div class="container">
    <div class="row">
        <div class="card col s12 m8 l6 xl6 offset-m2 offset-l3 offset-xl3" id="file-module">
            <?php if ($state == 0){ ?>
            <div class="card-content">
                <span class="card-title">
                    <b style="font-size:1.3em;">Resultat de Payement</b>
                    <small class="grey-text" style="font-size:0.75em;">OK</small>
                </span>
                <div class="input-field col s12">
                    <i class="material-icons prefix">work</i>
                    <input type="text" id="input-file" value="<?php echo $commandeno; ?>" readonly="readonly">
                    <label for="input-file" class="">Commande No.</label>
                </div>
                <div class="col s12" style="text-align:center;">
                    <img src="http://chart.apis.google.com/chart?chs=128x128&cht=qr&chld=L|0&chl=poapp://no=<?php echo $commandeno;?>" 
                        alt="code"/>
                </div>
            </div>
            <?php } else { ?>
            <div class="card-content">
                <span class="card-title">
                    <b style="font-size:1.3em;">Payement failed</b>
                    <small class="grey-text" style="font-size:0.75em;">Error</small>
                </span>
                <?php 
                    echo $message;
                    //echo $result;
                ?>
            </div>
            <div class="card-action">
                <a href="javascript:history.go(-1);"> Cliquez ici pour retourner la page dernière. </a>
            </div>
            <?php } ?>
        </div>
    </div>
</div>