<div class="container">
    <div class="row">
        <div class="card col s12 m8 l6 xl6 offset-m2 offset-l3 offset-xl3" id="command-module">
            <div class="card-content">
                <span class="card-title">
                    <b style="font-size:1.3em;">Impression Commande</b>
                </span>
                <form action="<?php echo View::$dirConfig['root']; ?>/Command/fini" method="<?php echo POST; ?>" id="command-confirm">
                <div class="input-field col s12">
                    <i class="material-icons prefix">subject</i>
                    <input name="page" id="input-page" type="number" value="1">
                    <label for="input-page" class="">Page</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">info_outline</i>
                    <input id="input-piece" name="piece" type="number" value="1">
                    <label for="input-piece" class="">Pièce</label>
                </div>
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">view_array</i>
                    <select name="recto" form="command-confirm" id="input-recto">
                    <option value="1" selected>Single Page</option>
                    <option value="2">Recto</option>
                    </select>
                    <label for="input-recto" class="">Document</label>
                </div>
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">view_agenda</i>
                    <select name="color" form="command-confirm" id="input-color">
                    <option value="1" selected>Blanc et Noir</option>
                    <option value="2">Color</option>
                    </select>
                    <label for="input-color" class="">Document</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">my_location</i>
                    <select name="location" form="command-confirm" id="input-location">
                    <?php
                        $location = "";
                        foreach ($provider as $index => $pro) {
                            $location.="<option value='".$pro["id"]."' ".($pro["id"]==1?"selected":"").">"
                            .$pro["name"]." - ".$pro["publisher"]. " - €"
                            .($pro["price"]/100)."/€".($pro["priceColor"]/100)
                            ."</option>";
                        }
                        echo $location;
                    ?>
                    </select>
                    <label for="input-location" class="">Type - Lieu - Vendeur - Prix/Prix en coleur</label>
                </div>
                <div id="page-tip" class="grey-text">Type - Lieu - Vendeur - Prix/Prix en coleur</div>
                <input id="comfirm-button" type="submit" class="btn right" value="Confirm">
                <br/>
                </form>
            </div>
        </div>
    </div>
</div>