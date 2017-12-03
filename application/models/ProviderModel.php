<?php
/**
 * Provider Model
 */
class ProviderModel extends Model {

    public function getProvider($type){
        $this->_table = "Article";
        $result = $this->where($where = array( "type = '". $type."'" ))->selectAll(); 
        if (count($result) > 0){
            return $result;
        } else
            return array();
    }

    public function getInfo($id){
        $this->_table = "Article";
        $result = $this->where($where = array( "id = '".$id."'" ))->selectAll(); 
        if (count($result) > 0){
            return $result;
        } else
            return array();
    }
}