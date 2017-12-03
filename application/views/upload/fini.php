<div class="container">
    <div class="row">
        <div class="card col s12 m8 l6 xl6 offset-m2 offset-l3 offset-xl3" id="file-module">
            <?php if ($argOk){ ?>
            <div class="card-content">
                <span class="card-title">
                    <b style="font-size:1.3em;">Imprimer Online</b>
                    <small class="grey-text" style="font-size:0.75em;">Commande créé!</small>
                </span>
                <form action="<?php echo View::$dirConfig['root']; ?>/Pay/index" method="<?php echo GET; ?>" id="file-confirm">
                <div class="input-field col s12">
                    <i class="material-icons prefix">work</i>
                    <input type="text" name="command" id="input-file" value="<?php echo $commandeno; ?>" readonly="readonly">
                    <label for="input-file" class="">Commande No.</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">present_to_all</i>
                    <input type="text" id="input-file" value="<?php echo $nom; ?>" readonly="readonly">
                    <label for="input-file" class="">nom de fichier</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">subject</i>
                    <input id="input-page" type="number" value="<?php echo $page; ?>" readonly="readonly">
                    <label for="input-page" class="">Page</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">info_outline</i>
                    <input id="input-piece" type="number" value="<?php echo $piece; ?>" readonly="readonly">
                    <label for="input-piece" class="">Pièce</label>
                </div>
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">view_array</i>
                    <input id="input-recto" type="text" value="<?php echo $recto; ?>" readonly="readonly">
                    <label for="input-recto" class="">Document</label>
                </div>
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">view_agenda</i>
                    <input id="input-color" type="text" value="<?php echo $color; ?>" readonly="readonly">
                    <label for="input-color" class="">Document</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">my_location</i>
                    <input id="input-location" type="text" value="<?php echo $location; ?>" readonly="readonly">
                    <label for="input-location" class="">Location pour retirer</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">credit_card</i>
                    <input id="input-price" type="number" value="<?php echo $price; ?>" readonly="readonly">
                    <label for="input-price" class="">Prix montant</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">phone</i>
                    <input id="input-phone" type="text" value="<?php echo $commandecontact; ?>" readonly="readonly">
                    <label for="input-phone" class="">Contact</label>
                </div>
                <div id="page-tip"><b>Important ! </b> <br/> Après le paiement, on commencerai la impression.</div>
                <input id="comfirm-button" type="submit" class="btn right" value="Payer">
                <br/>
                </form>
            </div>
            <?php } else { ?>
            <div class="card-content">
                <span class="card-title">
                    <b style="font-size:1.3em;">Error - File Upload</b>
                </span>
                <?php echo $message; ?>
            </div>
            <div class="card-action">
                <a href="javascript:history.go(-1);"> Cliquez ici pour retourner la page dernière. </a>
            </div>
            <?php } ?>
        </div>
    </div>
</div>