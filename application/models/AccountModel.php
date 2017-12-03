<?php
/**
 * Get or Set Account information
 */
class AccountModel extends Model{

    public $_exist = false;
    protected $_username;
    protected $_id;
    protected $_uuid;
    protected $_solde;
    protected $_level;
    protected $_birthday;

    public function __construct($username)
    {
        parent::__construct();
        $this->_table = "Account";
        $result = $this->where(array("username='".$username."'"))->selectAll();
        if (count($result > 0)){
            $this->_exist = true;
            $this->_username = $result[0]["username"];
            $this->_id = $result[0]["id"];
            $this->_uuid = $result[0]["uuid"];
            $this->_solde = $result[0]["solde"];
            $this->_level = $result[0]["level"];
            $this->_birthday = $result[0]["birthday"];
        }
    }

    public function getUsername(){
        return $this->_username;
    }

    public function getId(){
        return $this->_id;
    }

    public function getUuid(){
        return $this->_username;
    }

    public function getSolde(){
        return $this->_solde;
    }

    public function getLevel(){
        return $this->_level;
    }

    public function getBirthday(){
        return $this->_birthday;
    }

    // Change permission
    public function setLevel($level){
        // To Do -- Only the people who level >= 4 have this permission
        if (!$this->_exist){
            return false;
        }
        $this->update($this->_id, array("level"=>level));
        $logger = new LogModel();
        $logger->logWithOperation("Permission Changed", 
            $this->_username." level from ".$this->_level." to ".$level);
        $this->_level = $level;
        return true;
    }

    // Change Solde
    public function setSolde($solde){
        // To Do -- Only the people who level >= 4 have this permission
        if (!$this->_exist){
            return false;
        }
        $this->update($this->_id, array("solde"=>$solde));
        $logger = new LogModel();
        $logger->logWithOperation("Solde Changed", 
            $this->_username." solde from ".$this->_solde." to ".$solde);
        $this->_solde = $solde;
        return true;
    }

}
