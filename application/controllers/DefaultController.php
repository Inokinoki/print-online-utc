<?php
/** 
 * Default actions
 */
class DefaultController extends Controller{

    public function index(){
        $this->assign('title', 'Print Online');
        $this->render();
    }

}