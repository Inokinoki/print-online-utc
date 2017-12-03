<?php
/** 
 * Error actions
 */
class ErrorController extends Controller{

    public function display404(){
        $this->assign('title', 'Votre page perdu - Print Online');
        $this->render();
    }

}
