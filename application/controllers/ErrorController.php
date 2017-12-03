<?php
/** 
 * Error actions
 */
class ErrorController extends Controller{

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

    public function display404(){
        $this->assign('title', 'Votre page perdu - Print Online');
        $this->render();
    }

}
