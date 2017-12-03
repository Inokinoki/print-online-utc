<div class="container">
    <div class="row">
<?php
    // print_r($commands);
    // echo '<div class="row">';
    foreach ($commands as $index => $command) {
        echo ' <div class="col s12 m12 l6 xl4">
                    <div class="card">
                    <div class="card-content">
                        <div class="card-title">
                            <span>No. '.$command["commande"].' </span>
                        </div>
                        <span>Temps : '.$command["time"].'</span><br/>
                        <span>Prix : €'.($command["price"]/100).' </span><br/> 
                        <span>Payeur : '.$command["payer"].'</span><br/>
                        <span>Profiteur : '.$command["profiter"].'</span><br/>
                    </div>
                    </div>
                </div>';
    }
?>
    </div>
</div>