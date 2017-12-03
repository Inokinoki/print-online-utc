<?php
/**
 * Get User State
 */
class UserModel extends Model{

    protected $_username;
    protected $_email = array();
    protected $_phone = array();

    public function __construct($username)
    {
        parent::__construct();
        $this->_table = "Contact";
        $this->_username = $username;
        $result = $this->where($where = array("username='".$this->_username."'"))->selectAll();
        if (count($result)>0){
            foreach ($result as $index => $value) {
                array_push($this->_email, $value["email"]);
                array_push($this->_phone, $value["phone"]);
            }
        }
    }

    public function getEmail(){
        return $this->_email;
    }

    public function getPhone(){
        return $this->_phone;
    }

    public function getRecentEmail(){
        return isset($this->_email[-1])?$this->_email[-1]:"";
    }

    public function getRecentPhone(){
        return isset($this->_phone[-1])?$this->_phone[-1]:"";
    }

}
