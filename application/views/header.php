<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Inoki Shaw"/>
        <meta name="description" content="Print Server in UTC by Inoki"/>
        <?php
            if (isset($needRefresh) && $needRefresh === true){
        ?>
        <meta http-equiv="refresh" content="<?php echo $needRefreshSecond; ?>;url=<?php echo $needRefreshUrl; ?>">
        <?php
            }
        ?>
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" href="<?php echo View::$dirConfig['root']; ?>/res/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo View::$dirConfig['root']; ?>/res/css/general.css">

        <!--[if lt IE 9]>
        <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <nav class="blue-grey">
        <div class="container">
        <div class="nav-wrapper">
            <a href="<?php echo View::$dirConfig['root']; ?>" class="brand-logo"><i class="material-icons">cloud</i>Print</a>
            <a href="#" data-activates="mobile-drop" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
<?php if (!$isLogin){ ?>
                <li><a class="waves-effect waves-blue btn pulse" href="<?php echo View::$dirConfig['root']; ?>/Login/login">Login</a></li>
<?php } else { ?>
                <li><a href="<?php echo View::$dirConfig['root']; ?>/User/commande"><i class="material-icons left">person</i> <?php echo $username; ?></a></li>
                <li><a href="<?php echo View::$dirConfig['root']; ?>/Pay/list"><i class="material-icons left">credit_card</i> €<?php echo $solde/100; ?></a></li>
<?php } ?>
                <li><a href="<?php echo View::$dirConfig['root']; ?>/Upload/index"><i class="material-icons" title="Imprimer">present_to_all</i></a></li>
                <li><a href="<?php echo View::$dirConfig['root']; ?>/Command/print"><i class="material-icons" title="Imprimer">print</i></a></li>
                <li><a href="<?php echo View::$dirConfig['root']; ?>/Command/copy"><i class="material-icons" title="Recopier">content_copy</i></a></li>
                <li><a href="<?php echo View::$dirConfig['root']; ?>/Command/scan"><i class="material-icons" title="Scanner">scanner</i></a></li>
            </ul>
            <ul class="side-nav" id="mobile-drop">
<?php if (!$isLogin){ ?>
                <li><a href="<?php echo View::$dirConfig['root']; ?>/Login/login"><i class="material-icons">person_add</i> Login</a></li>
<?php } else { ?>
                <li><a href="<?php echo View::$dirConfig['root']; ?>/User/commande"><i class="material-icons">person</i> <?php echo $username; ?></a></li>
                <li><a href="<?php echo View::$dirConfig['root']; ?>/Pay/list"><i class="material-icons">credit_card</i> €<?php echo $solde/100; ?></a></li>
<?php } ?>
                <li><a href="<?php echo View::$dirConfig['root']; ?>/Upload/index"><i class="material-icons">present_to_all</i> Imprimer PDF</a></li>
                <li><a href="<?php echo View::$dirConfig['root']; ?>/Command/print"><i class="material-icons">print</i> Imprimer</a></li>
                <li><a href="<?php echo View::$dirConfig['root']; ?>/Command/copy"><i class="material-icons">content_copy</i> Recopier</a></li>
                <li><a href="<?php echo View::$dirConfig['root']; ?>/Command/scan"><i class="material-icons">scanner</i> Scanner</a></li> 
            </ul>
        </div>
        </div>
        </nav>