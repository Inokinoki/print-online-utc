<div class="container">
    <div class="row">
        <div class="col s12 m8 l6 xl6 offset-m2 offset-l3 offset-xl3">
            <div class="card">
<?php if ($state==0){
        $state = "unknown";
        $badgeColor = "grey";
        switch($command["state"]){
            case "1":
                $state = "à payer";
                $badgeColor = "red";
            break;
            case "2":
                $state = "payée";
                $badgeColor = "green";
            break;
            case "9":
                $badgeColor = "grey";
                $state = "fini";
        }
?>
            <div class="card-content">
                <div class="card-title">
                    <span>No. <?php echo $command["no"]; ?> </span>
                    <span class="badge <?php echo $badgeColor;?> white-text"><?php echo $state; ?></span>
                </div>
                <div class="col s12" style="text-align:center;">
                    <img src="http://chart.apis.google.com/chart?chs=128x128&cht=qr&chld=L|0&chl=poapp://no=<?php echo $commandeno;?>" 
                        alt="qrcode"/>
                </div>
                <span>Temps : <?php echo $command["time"]; ?></span><br/>
                <span>Prix : €<?php echo $command["price"]/100; ?> </span>
                <span>Pièce : <?php echo $command["piece"]; ?></span>
                <br/>
                <span>Nom : <?php echo $command["name"]; ?></span><br/>
                <span>Client : <?php echo $command["belonger"]; ?></span><br/>
                <span>Vendeur : <?php echo $command["publisher"]; ?></span><br/>
            </div>  
            <div class="card-action">
                <a href="http://chart.apis.google.com/chart?chs=128x128&cht=qr&chld=L|0&chl=poapp://no=<?php echo $commandeno;?>">Enregistrer le QRCode</a>
            </div>
<?php } else {?>
            <div class="card-content">
                <span class="card-title">
                    <b style="font-size:1.3em;">Error - Command</b>
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
</div>