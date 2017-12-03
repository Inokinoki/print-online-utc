<?php
/**
 * Log Model
 */
class LogModel extends Model {

    public function logWithOperation($op, $arg){
        $this->_table = "Log";
        $operation = array(
            "id" => 'NULL',
            "operation" => $op,
            "arg" => $arg,
            "ip" => Model::$_params["SERVER"]["REMOTE_ADDR"],
            "browser" => Model::$_params["SERVER"]["HTTP_USER_AGENT"],
            "time" => "NULL"
        );  
        $this->add($operation);  
    }
}