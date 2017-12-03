<?php

class PayController extends Controller{
    
    // Test
    public function index(){
        $this->_view->setNeedLogin();
        if ($this->_userstate->isLogin()){
            $this->assign("payCheckLogin", true);

            // Check commande exist
            $payCommandeExist = false;
            if (!isset(Model::$_params[GET]["command"])){
                // Not set commande Number
                $this->assign("state", 1000 + 1);
                $this->assign("message", "Argument incomplet. <br/>");
            } else {
                $commandeModel = new CommandModel();
                $commande = $commandeModel->getCommandWithNo(Model::$_params[GET]["command"]);
                if ($commande == NULL) {
                    $this->assign("state", 1000 + 2);
                    $this->assign("message", "No such Commande <br/>");
                } else {
                    // Get the first, maybe the only commande
                    $commande = $commande[0];
                    $this->assign("commandeno", $commande["no"]);
                    $this->assign("price", $commande["price"] / 100);
                    $this->assign("recto", $commande["recto"]);
                    $this->assign("piece", $commande["piece"]);
                    $this->assign("color", $commande["color"]);
                    $this->assign("location", $commande["name"]);
                    $this->assign("state", 0);
                }

            }
        }
        $this->assign('title', 'Pay - Print Online');
        $this->assign('keyword', "hi");
        $this->render();
    }

    public function list(){
        $this->_view->setNeedLogin();
        if ($this->_userstate->isLogin()){
            $payDBmodel = new PayDBModel();
            $this->assign("commands", array_reverse($payDBmodel->getPayWithPayer($this->_userstate->getUsername())));
        }
        
        
        $this->assign('title', 'List de paiement - Print Online');
        $this->render();
    }

    // CommandeNo
    // Pay ok | Not ok
    /**
     * State:
     *      1 -- Commande Number not Set
     *      2 -- Commande Not Fount
     *      4 -- Not enough credit
     */
    public function fini(){
        $this->_view->setNeedLogin();
        if ($this->_userstate->isLogin()){
            $this->assign("payCheckLogin", true);

            // Check commande exist
            $payCommandeExist = false;
            if (!isset(Model::$_params[POST]["commandeNo"])){
                // Not set commande Number
                $this->assign("state", 1000 + 1);
                $this->assign("message", "Argument incomplet. <br/>");
            } else {
                // Check commande
                $commandeModel = new CommandModel();
                $commande = $commandeModel->getCommandWithNo(Model::$_params[POST]["commandeNo"]);
                if ($commande == NULL) {
                    $this->assign("state", 1000 + 2);
                    $this->assign("message", "No such Commande <br/>");
                } else {
                    // Get the first, maybe the only commande
                    $commande = $commande[0];
                    if ($commande["state"]!=1){
                        $this->assign("state", 1000 + 16);
                        $this->assign("message", "Commande déjà payée <br/>");
                    } else {
                        $this->assign("commandeno", $commande["no"]);

                        // Create an instance of PayModel
                        $paymodel = new PayModel();
                        $paymodel -> setPayer($this->_userstate->getUsername());
                        // Get User Resting Money
                        $payRestMoney = $this->_userstate->getSolde();

                        // Get Pay Need Money
                        $payNeedMoney = $commande["price"];

                        // Is money enough
                        if ($payRestMoney < $payNeedMoney){
                            $this->assign("state", 1000 + 4);
                            $this->assign("message", "Not enough credit. <br/>");
                        } else {
                            $paymodel->setPrice($payNeedMoney);
                            $paymodel->setProfiter("admin");
                            $paymodel->setCommande(Model::$_params[POST]["commandeNo"]);
                            if(($result = $paymodel->valide()) == 0){
                                $commandeModel = new CommandModel();
                                if ($commandeModel->updateCommandeState(2, Model::$_params[POST]["commandeNo"])){
                                    $this->assign("state", 0);
                                    $this->assign("message", "Pay OK <br/>");
                                } else {
                                    $this->assign("state", 1000+16);
                                    $this->assign("message", "Change commande state failed <br/>");
                                }
                            } else {
                                $this->assign("result", $result);
                                $this->assign("state", 1000+8);
                                $this->assign("message", "Valide Failed <br/>");
                            }
                        }
                    }
                }
            }
        }

        $this->assign('title', 'Payment Fini - Print Online');
        $this->render();
    }
    
}