<?php

class ArticleController extends Controller{
    
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