<div class="container">
    <div class="row">
<?php
    // print_r($commands);
    // echo '<div class="row">';
    foreach ($commands as $index => $command) {
        $state = "unknown";
        $badgeColor = "grey";
        $cardAction = '<div class="card-action">
                            <a href="'.View::$dirConfig['root'].'/User/command?command='.$command["no"].'">Detail</a>
                        ';
        switch($command["state"]){
            case "1":
                $state = "à payer";
                $badgeColor = "red";
                $cardAction .= '<a href="'.View::$dirConfig['root'].'/Pay/index?command='.$command["no"].'">Pay</a>';
            break;
            case "2":
                $state = "payée";
                $badgeColor = "green";
            break;
            case "9":
                $badgeColor = "grey";
                $state = "fini";
        }
        $cardAction.='</div>';
        //if (($index+1)%3==1)
        //    echo '</div><div class="row">';
        echo ' <div class="col s12 m12 l6 xl4"><div class="card">
                    <div class="card-content">
                        <div class="card-title">
                            <span>'.$command["name"].' </span>
                        </div>
                        <span>'.$command["time"].'</span><br/>
                        <span>'.$command["no"].' </span>
                        <span class="badge '.$badgeColor.' white-text">'.$state.'</span><br/> 
                        <br/> 
                    </div>
                    '.$cardAction.'
                </div></div>';
    }
    // echo '</div>';

    //max = this->color[i*3]>this->color[i*3+1]?this->color[i*3]:this->color[i*3+1];
    //max = max>this->color[i*3+2]?max:this->color[i*3+2];
?>
    </div>
</div>