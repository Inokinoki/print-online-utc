<?php
/**
 * Login
 */
class LoginController extends Controller{
    
    public function doLogin(){
        $dologinModel = new DoLoginModel(); 
        $state = 0;

        // Check args
        $msg = "<span>Entrer votre<br/>";
        if (!isset(Model::$_params[POST]["username"])){
            $msg.=" <b>nom de compte</b>, <br/>";
            $state += 4;
        }
        if (!isset(Model::$_params[POST]["password"])){
            $msg.=" <b>mot de passe</b>,<br/>";
            $state += 2;
        }
        if (!isset(Model::$_params[POST]["birthday"])){
            $msg.=" <b>date de naissance</b>,<br/>";
            $state += 1;
        }
        $msg .= "s'il vous plait.</span>";

        if ( $state == 0){
            // Complete Args
            $result = $dologinModel->dologin();
            if ($result == 0) {
                $msg = '<span>Login Success</span><br/>';
            } else {
                $msg = '<span>Login Failed</span><br/>';
            }
            $state += $result;
            if ($result > 8)
                $msg .= '<span><b>Mot de passe</b> ou <b>date de naissance</b> erronée</span><br/>';
        }

        $this->assign('needRefresh', true);
        $this->assign('needRefreshSecond', 3);

        // Check state of login
        if ( $state == 0){
            $this->assign('title', 'Login OK - Print Online');
            $this->assign('cardTitle', 'Login OK');
            $this->assign('needRefreshUrl', View::$dirConfig['root']);
            $msg .= "<span>Attendez-vous, svp</span>";
        } else {
            // Incomplete args
            $this->assign('title', 'Login Error - Print Online');
            $this->assign('cardTitle', 'Login Error ['.(1000+$state).']');
            $this->assign('needRefreshUrl', View::$dirConfig['root']."/Login/login");
        }
        $this->assign('message', $msg);
        $this->assign('errorNo', $state);
        $this->render();
    }

    public function doALogin(){
        $dologinModel = new DoLoginModel(); 
        $state = 0;

        // Check args
        $msg = "<span>Entrer votre<br/>";
        if (!isset(Model::$_params[POST]["username"])){
            $msg.=" <b>nom de compte</b>, <br/>";
            $state += 4;
        }
        if (!isset(Model::$_params[POST]["password"])){
            $msg.=" <b>mot de passe</b>,<br/>";
            $state += 2;
        }
        $msg .= "s'il vous plait.</span>";

        if ( $state == 0){
            // Complete Args
            $result = $dologinModel->doalogin();
            if ($result == 0) {
                $msg = '<span>Login Success</span><br/>';
            } else {
                $msg = '<span>Login Failed</span><br/>';
            }
            $state += $result;
            if ($result > 8)
                $msg .= '<span><b>Mot de passe</b> ou <b>date de naissance</b> erronée</span><br/>';
        }

        $this->assign('needRefresh', true);
        $this->assign('needRefreshSecond', 3);

        // Check state of login
        if ( $state == 0){
            $this->assign('title', 'Login OK - Print Online');
            $this->assign('cardTitle', 'Login OK');
            $this->assign('needRefreshUrl', View::$dirConfig['root']);
            $msg .= "<span>Attendez-vous, svp</span>";
        } else {
            // Incomplete args
            $this->assign('title', 'Login Error - Print Online');
            $this->assign('cardTitle', 'Login Error ['.(1000+$state).']');
            $this->assign('needRefreshUrl', View::$dirConfig['root']."/Login/login");
        }
        $this->assign('message', $msg);
        $this->assign('errorNo', $state);
        $this->render();
    }

    public function login()
    {
        $this->assign('title', 'Login - Print Online');
        $this->render();
    }

    public function loginb()
    {
        $this->assign('title', 'Login - Print Online');
        $this->render();
    }
}