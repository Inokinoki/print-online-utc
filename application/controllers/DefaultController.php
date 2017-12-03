<?php
/** 
 * Default actions
 */
class DefaultController extends Controller{

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

    public function index(){
        $this->assign('title', 'Print Online');
        $this->render();
    }

}