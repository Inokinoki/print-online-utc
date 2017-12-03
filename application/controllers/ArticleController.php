<?php

class ArticleController extends Controller{
    
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
    public function add(){
        $this->_view->setNeedLogin();
        $this->_view->setNeedLevel(3);
        $this->assign('title', 'Add Article - Print Online');
        $this->assign('keyword', "hi");
        $this->render();
    }

    public function list(){
        $this->assign('title', 'List Article - Print Online');
        $this->render();
    }
    
}