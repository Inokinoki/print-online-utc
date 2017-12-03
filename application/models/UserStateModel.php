<?php
/**
 * Get User State
 */
class UserStateModel extends Model{
    // UUID in db
    protected $_uuid;

    protected $_login = FALSE;

    protected $_uid = 0;
    protected $_username = "";
    protected $_birthday = 0;
    protected $_solde = 0;
    protected $_level = 0;

    public function __construct()
    {
        parent::__construct();
        $this->_table = "Account";
        if (isset(Model::$_params["COOKIE"]["print-uuid"]))
            $this->_uuid = Model::$_params["COOKIE"]["print-uuid"];
        if (!empty($this->_uuid)) {
            $result = $this->where($where = array("uuid='".$this->_uuid."'"))->selectAll();
            if (count($result)>0){
                $this->_uid = $result[0]["id"];
                $this->_username = $result[0]["username"];
                $this->_birthday = $result[0]["birthday"];
                $this->_solde = $result[0]["solde"];
                $this->_login = TRUE;
                $this->_level = $result[0]["level"];
            }
        }
    }

    /**
     * @return bool user is login or not
     */
    public function isLogin(){
        return $this->_login;
    }

    /**
     * @return string
     */
    public function getUsername(){
        return $this->_username;
    }

    /**
     * @return int
     */
    public function getUid(){
        return $this->_uid;
    }

    /**
    * @return int
    */
    public function getBirthday(){
        return $this->_birthday;
    }
    /**
    * @return int
    */
    public function getSolde(){
        return $this->_solde;
    }

    /**
    * @return int
    */
    public function getLevel(){
        return $this->_level;
    }
}