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