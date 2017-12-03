<?php

class CommandController extends Controller{
    
    public function __constructor(){
        parent::__constructor();
        $this->_userstate = new UserStateModel();
        $this->_view = new View($controller, $action);
        $this->_view->assign("isLogin", $this->_userstate->isLogin());
        if ($this->_userstate->isLogin()) 
        {
            $this->_view->assign("username", $this->_userstate->getUsername());
            $this->_view->assign("solde", $this->_userstate->getSolde());  
            $this->_view->assign("level", $this->_userstate->getLevel());        
        }
    }

    // Test
    public function create(){
        $this->_view->setNeedLogin();
        $this->_view->setNeedLevel(3);
        $this->assign('title', 'Add Article - Print Online');
        $this->assign('keyword', "hi");
        $this->render();
    }

    public function print(){
        $this->_view->setNeedLogin();
        $this->assign('title', 'Print - Print Online');
        $providerModel = new ProviderModel();
        $this->assign('provider', $providerModel->getProvider(1));
        $this->render();
    }

    public function fini(){
        $this->_view->setNeedLogin();
        $this->assign('title', 'Commande - Print Online');
        $email = "";
        $phone = "";
        $state = 0;
        $msg = "Argument pas complet. <br/>";
        if (!isset(Model::$_params[POST]["page"])){
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

            // Piece
            $piece = Model::$_params[POST]["piece"];
            $this->assign("piece", $piece);

            // Page
            $page = Model::$_params[POST]["page"];
            $this->assign("page", $page);

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
            $command = $commander->generateCommand($pro[0]["name"], "Custom Command",  
                $pro[0]["publisher"], $this->_userstate->getUsername(), $piece, 
                Model::$_params[POST]["recto"], Model::$_params[POST]["color"], 
                $price, "", "", "");

            if (count($command) < 1)
                $state += 128;

            if ($state == 0){
                $this->assign("argOk", true);
                foreach ($command as $key =>$value){
                    $this->assign("commande".$key, $value);
                }

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

    public function copy(){
        $this->_view->setNeedLogin();
        $this->assign('title', 'Copy - Print Online');
        $providerModel = new ProviderModel();
        $this->assign('provider', $providerModel->getProvider(2));
        $this->render();
    }

    public function scan(){
        $this->_view->setNeedLogin();
        $this->assign('title', 'Scan - Print Online');
        $providerModel = new ProviderModel();
        $this->assign('provider', $providerModel->getProvider(3));
        $this->render();
    }

    public function direct(){
        $this->_view->setNeedLogin();
        $this->_view->setNeedLevel(4);
        $this->assign('title', 'Direct - Print Online');
        $providerModel = new ProviderModel();
        $this->assign('provider', $providerModel->getProvider(1));
        $this->render();
    }
}