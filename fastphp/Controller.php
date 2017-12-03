<?php 
/**
 * Controller base class
 */
class Controller
{
    protected $_controller;
    protected $_action;
    protected $_view;
    protected $_userstate;
 
    public function __construct($controller, $action)
    {
        $this->_controller = $controller;
        $this->_action = $action;
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

    // Assign to view
    public function assign($name, $value)
    {
        $this->_view->assign($name, $value);
    }

    // Render view
    public function render()
    {
        $this->_view->render();
    }
}