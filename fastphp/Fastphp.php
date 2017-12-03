<?php
/**
 * fastphp framework
 */
class Fastphp
{
    protected $_config = [];
    protected $_all_data = [];

    public function __construct($config)
    {
        $this->_config = $config;
    }

    // Run it
    public function run()
    {
        spl_autoload_register(array($this, 'loadClass'));
        $this->setReporting();
        $this->removeMagicQuotes();
        $this->saveQueryDatas();
        $this->unregisterGlobals();
        $this->setDbConfig();
        $this->setDirConfig();
        $this->setParam();
        $this->route();
        if (APP_DEBUG === true)
        {
            foreach ($this->_all_data as $keys => $values) {
                echo $keys."<br/>";
                foreach ($values as $key => $value) {
                    echo $key.":".$value."<br/>";
                }
                echo "<br/>";
            }
        }
    }

    // Save query datas
    public function saveQueryDatas(){
        // GET
        $this->_all_data["GET"] = array();
        foreach ($_GET as $key => $value) {
            $this->_all_data["GET"][$key] = $value;
        }

        // POST
        $this->_all_data["POST"] = array();
        foreach ($_POST as $key => $value) {
            $this->_all_data["POST"][$key] = $value;
        }

        // COOKIE
        $this->_all_data["COOKIE"] = array();
        foreach ($_COOKIE as $key => $value) {
            $this->_all_data["COOKIE"][$key] = $value;
        }

        // REQUEST
        $this->_all_data["REQUEST"] = array();
        foreach ($_REQUEST as $key => $value) {
            $this->_all_data["REQUEST"][$key] = $value;
        }

        // SERVER
        $this->_all_data["SERVER"] = array();
        foreach ($_SERVER as $key => $value) {
            $this->_all_data["SERVER"][$key] = $value;
        }

        // FILE
        $this->_all_data["FILES"] = array();
        foreach ($_FILES as $key => $value) {
            $this->_all_data["FILES"][$key] = $value;
        }
    }

    // Router
    public function route()
    {
        $controllerName = $this->_config['defaultController'];
        $actionName = $this->_config['defaultAction'];
        $param = array();

        $url = $_SERVER['REQUEST_URI'];
        // Clear the content after ?
        $position = strpos($url, '?');
        $url = $position === false ? $url : substr($url, 0, $position);
        // Delete “/”
        $url = trim($url, '/');

        if ($url) {
            // Use “/” to explode
            $urlArray = explode('/', $url);
            // Delete empty element
            $urlArray = array_filter($urlArray);
            
            // shift first folder name
            while ($urlArray && stripos($this->_config["dir"]["root"], $urlArray[0])!=FALSE)
                array_shift($urlArray);

            // get Controller name
            $controllerName = $urlArray ? $urlArray[0] : $controllerName;
            
            // get Action name
            array_shift($urlArray);
            $actionName = $urlArray ? $urlArray[0] : $actionName;

            // get URL argument
            array_shift($urlArray);
            $param = $urlArray ? $urlArray : array();
        }
        //if (APP_DEBUG)
        //    echo $controllerName.":".$actionName."<br/>";

        // Controller or action exist?
        $controller = $controllerName . 'Controller';
        if (!class_exists($controller) || !method_exists($controller, $actionName)) {
            // exit($controller . ' Controller not exist');
            $controller = "ErrorController";
            $controllerName = "Error";
            $actionName = "display404";
        }
        //if (APP_DEBUG)
        //    echo $controller.":".$actionName;

        $dispatch = new $controller($controllerName, $actionName);

        call_user_func_array(array($dispatch, $actionName), $param);
    }

    // Configure DEBUG
    public function setReporting()
    {
        if (APP_DEBUG === true) {
            error_reporting(E_ALL);
            ini_set('display_errors','On');
        } else {
            error_reporting(E_ALL);
            ini_set('display_errors','Off');
            ini_set('log_errors', 'On');
        }
    }

    // Delete sensible characters
    public function stripSlashesDeep($value)
    {
        $value = is_array($value) ? array_map(array($this, 'stripSlashesDeep'), $value) : stripslashes($value);
        return $value;
    }

    // Delete sensible characters in GET or POST or ...
    public function removeMagicQuotes()
    {
        if (get_magic_quotes_gpc()) {
            $_GET = isset($_GET) ? $this->stripSlashesDeep($_GET ) : '';
            $_POST = isset($_POST) ? $this->stripSlashesDeep($_POST ) : '';
            $_COOKIE = isset($_COOKIE) ? $this->stripSlashesDeep($_COOKIE) : '';
            $_SESSION = isset($_SESSION) ? $this->stripSlashesDeep($_SESSION) : '';
        }
    }

    public function unregisterGlobals()
    {
        if (ini_get('register_globals')) {
            $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
            foreach ($array as $value) {
                foreach ($GLOBALS[$value] as $key => $var) {
                    if ($var === $GLOBALS[$key]) {
                        unset($GLOBALS[$key]);
                    }
                }
            }
        }
    }

    public function setDbConfig()
    {
        if ($this->_config['db']) {
            Model::$dbConfig = $this->_config['db'];
        }
    }

    public function setDirConfig()
    {
        if ($this->_config['dir']) {
            View::$dirConfig = $this->_config['dir'];
        }
    }

    public function setParam()
    {
        Model::$_params = $this->_all_data;
    }

    public static function loadClass($class)
    {
        $frameworks = __DIR__ . '/' . $class . '.php';
        $controllers = APP_PATH . 'application/controllers/' . $class . '.php';
        $models = APP_PATH . 'application/models/' . $class . '.php';

        if (file_exists($frameworks)) {
            include $frameworks;
        } elseif (file_exists($controllers)) {
            include $controllers;
        } elseif (file_exists($models)) {
            include $models;
        } else {
            // Error
        }
    }
}