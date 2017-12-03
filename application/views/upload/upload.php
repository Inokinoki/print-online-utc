<div class="container">
    <div class="row">
        <div class="card col s12 m8 l6 xl6 offset-m2 offset-l3 offset-xl3" id="file-module">
            <?php if (!$hasError && $isPDF){ ?>
            <div class="card-content">
                <span class="card-title">
                    <b style="font-size:1.3em;">Imprimer Online</b>
                    <small class="grey-text" style="font-size:0.75em;">confirmer le PDF</small>
                </span>
                <form action="<?php echo View::$dirConfig['root']; ?>/Upload/confirm" method="<?php echo POST; ?>" id="file-confirm">
                <input name="name" type="text" value="<?php echo $name; ?>" hidden="hidden">
                <div class="input-field col s12">
                    <i class="material-icons prefix">present_to_all</i>
                    <input type="text" name="file" id="input-file" value="<?php echo $nom; ?>" readonly="readonly">
                    <label for="input-file" class="">nom de fichier</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">input</i>
                    <input type="text" id="input-type" value="<?php echo $isPDF?"PDF":"Unknown"; ?>" readonly="readonly">
                    <label for="input-fileType" class="">type de fichier</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">subject</i>
                    <input id="input-page" type="number" value="<?php echo $page; ?>" readonly="readonly">
                    <label for="input-page" class="">Page</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">info_outline</i>
                    <input id="input-piece" name="piece" type="number" value="1">
                    <label for="input-piece" class="">Pièce</label>
                </div>
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">view_array</i>
                    <select name="recto" form="file-confirm" id="input-recto">
                    <option value="1" selected>Single Page</option>
                    <option value="2">Recto</option>
                    </select>
                    <label for="input-recto" class="">Document</label>
                </div>
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">view_agenda</i>
                    <select name="color" form="file-confirm" id="input-color">
                    <option value="1" selected>Blanc et Noir</option>
                    <option value="2">Color</option>
                    </select>
                    <label for="input-color" class="">Document</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">my_location</i>
                    <select name="location" form="file-confirm" id="input-location">
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
            <?php } else { ?>
            <div class="card-content">
                <span class="card-title">
                    <b style="font-size:1.3em;">Error - File Upload</b>
                </span>
                <?php 
                    echo $error;
                    if (!$isPDF)
                        echo "C'est pas un PDF fichier";
                ?>
            </div>
            <div class="card-action">
                <a href="javascript:history.go(-1);"> Cliquez ici pour retourner la page dernière. </a>
            </div>
            <?php } ?>
        </div>
    </div>
</div>