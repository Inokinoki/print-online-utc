<?php
/** 
 * Default actions
 */
class DefaultController extends Controller{

    public function index(){
        $this->assign('title', 'Votre page perdu - Print Online');
        $this->render();
    }

}