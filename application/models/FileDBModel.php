<?php
class FileDBModel extends Model{

    public function __construct($name)
    {
        $this->_table = "File";
        parent::__construct();
        $result = $this->where($where = array( "name='".$name."'"))->selectAll();
        if (count($result) > 0){
            $this->_file = $result[0];
        } else {
            $this->_error = true;
        }
    }

    protected $_file;
    protected $_error;
   
    public function getError(){ return $this->_error; }
    public function getName(){ return $this->_file["name"]; }
    public function getSize(){ return $this->_file["size"]; }

}