<div class="container">
    <div class="row">
        <div class="card col s12 m8 l6 xl6 offset-m2 offset-l3 offset-xl3 hoverable" id="file-module">
            <div class="card-content">
                <span class="card-title">
                    <b style="font-size:1.3em;">Imprimer Online</b>
                    <small class="grey-text" style="font-size:0.75em;">avec vos PDFs</small>
                </span>
                <form action="<?php echo View::$dirConfig['root']; ?>/Upload/upload" method="<?php echo "POST"; ?>" enctype="multipart/form-data">
                <div class="input-field col s12">
                    <i class="material-icons prefix">present_to_all</i>
                    <input type="file" name="file" id="input-file">
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">subject</i>
                    <input id="input-page" name="page" type="number">
                    <label for="input-page" class="">Page</label>
                </div>
                <div id="page-tip" class="grey-text">Si vous avez pas d'idée qu'il y a combien de page, laissez vide.</div>
                <input id="comfirm-button" type="submit" class="btn right" value="Upload">
                <br/>
                </form>
            </div>
        </div>
    </div>
</div>