<?php
/**
 * View base class
 */
class View
{
    protected $variables = array();
    protected $_controller;
    protected $_action;
    public static $dirConfig = [];
    protected $_needlogin;
    protected $_needlevel;

    function __construct($controller, $action)
    {
        $this->_controller = strtolower($controller);
        $this->_action = strtolower($action);
    }

    function setNeedLogin($need = true)
    {
        $this->_needlogin = $need;
    }

    function setNeedLevel($need = 5)
    {
        $this->_needlevel = $need;
    }
 
    // Assign
    public function assign($name, $value)
    {
        $this->variables[$name] = $value;
    }
 
    // Render
    public function render()
    {
        extract($this->variables);
        $defaultHeader = APP_PATH . 'application/views/header.php';
        $defaultFooter = APP_PATH . 'application/views/footer.php';

        $controllerHeader = APP_PATH . 'application/views/' . $this->_controller . '/header.php';
        $controllerFooter = APP_PATH . 'application/views/' . $this->_controller . '/footer.php';
        $controllerLayout = APP_PATH . 'application/views/' . $this->_controller . '/' . $this->_action . '.php';

        if ($this->_needlogin && !$isLogin){
            $needRefresh = true;
            $needRefreshSecond = 3;
            $needRefreshUrl =  View::$dirConfig['root']."/Login/login";
        } else if ($this->_needlevel > 0 && $level < $this->_needlevel){
            $needRefresh = true;
            $needRefreshSecond = 3;
            $needRefreshUrl = View::$dirConfig['root'];
        }

        // Page header
        if (file_exists($controllerHeader)) {
            include ($controllerHeader);
        } else {
            include ($defaultHeader);
        }

        if ($this->_needlogin && !$isLogin){
            include (APP_PATH . 'application/views/nopermission/needlogin.php');
        } else if ($this->_needlevel > 0 && $level < $this->_needlevel){
            include (APP_PATH . 'application/views/nopermission/needlevel.php');
        } else {
            include ($controllerLayout);
        }
        
        // Page footer
        if (file_exists($controllerFooter)) {
            include ($controllerFooter);
        } else {
            include ($defaultFooter);
        }
    }
}