<?php
class PDFDBModel extends FileDBModel{

    public function __construct($name)
    {
        parent::__construct($name);
    }

    public function getPage(){
        if ($this->_file != NULL)
            return $this->_file["page"];
        else
            return 9999;
    }
}