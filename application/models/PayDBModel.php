<?php
/**
 * Pay DB Model
 */
class PayDBModel extends Model {

    public function getPayWithPayer($payer){
        $this->_table = "Pay";
        $result = $this->where(array("payer='".$payer."'"))->selectAll();
        if (count($result) > 0){
            return $result;
        }
        return NULL;
    }

    public function getPayWithId($id){
        $this->_table = "Pay";
        $result = $this->where(array("id='".$id."'"))->selectAll();
        if (count($result) > 0){
            return $result;
        }
        return NULL;
    }

    public function getPayWithNo($no){
        $this->_table = "Pay";
        $result = $this->where(array("commande='".$no."'"))->selectAll();
        if (count($result) > 0){
            return $result;
        }
        return NULL;
    }

    public function getPayWithProfiter($profiter){
        $this->_table = "Pay";
        $result = $this->where(array("profiter='".$profiter."'"))->selectAll();
        if (count($result) > 0){
            return $result;
        }
        return NULL;
    }

}