<?php

class UploadController extends Controller{
    
    // Test
    public function index(){
        $this->_view->setNeedLogin();
        $this->assign('title', 'Upload - Print Online');
        $this->assign('keyword', "hi");
        $this->render();
    }
    
    public function upload(){
        $this->_view->setNeedLogin();
        $pdfModel = new PDFModel();
        $providerModel = new ProviderModel();
        $this->assign('title', 'Confirm Uploaded File - Print Online');
        $this->assign('nom', $pdfModel->getName());
        $this->assign('isPDF', $pdfModel->isPDF());
        $this->assign('page', $pdfModel->getPage());
        $this->assign('hasError', !empty($pdfModel->getError()));
        $this->assign('error', $pdfModel->getError());
        $this->assign('name', $pdfModel->save($this->_userstate->getUsername()));
        $this->assign('provider', $providerModel->getProvider(4));
        $this->render();
    }

    // POST /print-online/Upload/fini
    /*
        name: name of file to print
        file: file origin name
        // typeFile : type of file
        // page: page of pdf (non)
        piece: piece of this file
        recto: type of print
        color: color of print
        location: id of article
        // price: price prevue
    */
    public function confirm(){
        $this->_view->setNeedLogin();
        $this->assign('title', 'Confirm vos Coordonnées - Print Online');
        $email = "";
        $phone = "";
        $state = 0;
        $msg = "Argument pas complet. <br/>";
        // Check args
        if (!isset(Model::$_params[POST]["name"])){
            $msg .= "<b> Nom de Fichier </b> ";
            $state += 32;
        }
        if (!isset(Model::$_params[POST]["file"])){
            $msg .= "<b> Fichier </b> ";
            $state += 16;
        }
        if (!isset(Model::$_params[POST]["piece"])){
            $msg .= "<b> Piece </b> ";
            $state += 8;
        }
        if (!isset(Model::$_params[POST]["recto"])){
            $msg .= "<b> Recto </b> ";
            $state += 4;
        }
        if (!isset(Model::$_params[POST]["color"])){
            $msg .= "<b> Coleur </b> ";
            $state += 2;
        }
        if (!isset(Model::$_params[POST]["location"])){
            $msg .= "<b> Location </b> ";
            $state += 1;
        }

        if ($state == 0){
            $name = Model::$_params[POST]["name"];
            $pdfInDB = new PDFDBModel($name);

            // Check PDF fichier
            if ($pdfInDB->getError()){
                $state += 64;
                $msg.="<b> Fichier n'exist pas </b>";
            }

            // Get PDF page
            if (!$pdfInDB->getError()){
                $page = $pdfInDB->getPage();
                $this->assign("page", $page);
            }

            // Piece
            $piece = Model::$_params[POST]["piece"];
            $this->assign("piece", $piece);

            // Get Prix
            $pricer = new GetPriceModel();
            $price = $pricer->getPrice(Model::$_params[POST]["location"], Model::$_params[POST]["color"]);
            $price = $price * $piece * $page;
            $this->assign("price", $price);

            // Get location
            $provider = new ProviderModel();
            $pro = $provider->getInfo(Model::$_params[POST]["location"]);
            if (count($provider) > 0){
                $this->assign("location", $pro[0]["name"]);
                $this->assign("locationid", $pro[0]["id"]);
            }

            // Other args
            $this->assign("nom", Model::$_params[POST]["file"]);
            $this->assign("name", Model::$_params[POST]["name"]);
            $this->assign("recto", Model::$_params[POST]["recto"] == 2?"Recto": "Single Page");
            $this->assign("color", Model::$_params[POST]["color"] == 2?"En coleur": "Blanc et noir");
            $this->assign("rectoid", Model::$_params[POST]["recto"]);
            $this->assign("colorid", Model::$_params[POST]["color"]);

            // Get last coordonnes
            $user = new UserModel($this->_userstate->getUsername());
            $email = $user->getRecentEmail();
            $phone = $user->getRecentPhone();
            $this->assign("email", $email);
            $this->assign("phone", $phone);

            if ($state == 0){
                $this->assign("argOk", true);
            } else {
                $this->assign("argOk", false);
                $this->assign("message", $msg);
            }
        } else {
            $this->assign("argOk", false);
            $this->assign("message", $msg);
        }
        
        $this->render();
    }

    // POST /print-online/Upload/fini
    /*
        name: name of file to print !
        file: file origin name !
        // page: page of pdf (non)
        piece: piece of this file !
        recto: type of print !
        color: color of print !
        location: id of article !
        // price: price prevue
        email: email (NULLABLE)
        phone: phone number (NULLABLE)
    */
    public function fini(){
        $this->_view->setNeedLogin();
        $this->assign('title', 'Commande - Print Online');
        $email = "";
        $phone = "";
        $state = 0;
        $msg = "Argument pas complet. <br/>";
        // Check args
        if (!isset(Model::$_params[POST]["name"])){
            $state += 32;
        }
        if (!isset(Model::$_params[POST]["file"])){
            $state += 16;
        }
        if (!isset(Model::$_params[POST]["piece"])){
            $state += 8;
        }
        if (!isset(Model::$_params[POST]["piece"])){
            $state += 4;
        }
        if (!isset(Model::$_params[POST]["color"])){
            $state += 2;
        }
        if (!isset(Model::$_params[POST]["location"])){
            $state += 1;
        }

        if ($state == 0){
            $name = Model::$_params[POST]["name"];
            $pdfInDB = new PDFDBModel($name);

            // Check PDF fichier
            if ($pdfInDB->getError()){
                $state += 64;
                $msg.="<b> Fichier n'exist pas </b>";
            }

            // Get PDF page
            if (!$pdfInDB->getError()){
                $page = $pdfInDB->getPage();
                $this->assign("page", $page);
            }

            // Piece
            $piece = Model::$_params[POST]["piece"];
            $this->assign("piece", $piece);

            // Get Prix
            $pricer = new GetPriceModel();
            $price = $pricer->getPrice(Model::$_params[POST]["location"], Model::$_params[POST]["color"]);
            $price = $price * $piece * $page;
            $this->assign("price", $price);

            // Get location
            $provider = new ProviderModel();
            $pro = $provider->getInfo(Model::$_params[POST]["location"]);
            if (count($provider) > 0){
                $this->assign("location", $pro[0]["name"]);
            }

            // Update last coordonnes

            // Generate Command
            $commander = new CommandModel();
            $command = $commander->generateCommand($pro[0]["name"], Model::$_params[POST]["file"],  
                $pro[0]["publisher"], $this->_userstate->getUsername(), $piece, 
                Model::$_params[POST]["recto"], Model::$_params[POST]["color"], 
                $price, 
                Model::$_params[POST]["email"], Model::$_params[POST]["phone"], 
                Model::$_params[POST]["name"]);

            if (count($command) < 1)
                $state += 128;

            if ($state == 0){
                $this->assign("argOk", true);
                foreach ($command as $key =>$value){
                    $this->assign("commande".$key, $value);
                }

                $this->assign("nom", Model::$_params[POST]["file"]);
                $this->assign("recto", Model::$_params[POST]["recto"] == 2?"Recto": "Single Page");
                $this->assign("color", Model::$_params[POST]["color"] == 2?"En coleur": "Blanc et noir");
            } else {
                $this->assign("argOk", false);
                $this->assign("message", $msg);
            }
        } else {
            $this->assign("argOk", false);
            $this->assign("message", $msg);
        }
        
        $this->render();
    }
}