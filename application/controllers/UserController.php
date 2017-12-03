<?php
/** 
 * User actions
 */
class UserController extends Controller{

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

    public function recharger(){

    }

    public function info(){
        
    }

    public function commande(){
        $this->_view->setNeedLogin();
        $this->assign("title", "Vos commandes");
        if ($this->_userstate->isLogin()){
            $commandModel = new CommandModel();
            $commands = $commandModel->getCommandWithBel($this->_userstate->getUsername());
            $this->assign("commands", array_reverse($commands));
        }$this->render();
    }

    public function command(){
        $this->_view->setNeedLogin();
        $this->assign("title", "Votre commande");
        if ($this->_userstate->isLogin()){
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
                    $this->assign("command", $commande);
                    $this->assign("state", 0);
                }
            }
        }
        $this->render();
    }
}
