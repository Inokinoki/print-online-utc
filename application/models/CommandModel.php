<?php
/**
 * Command Model
 */
class CommandModel extends Model {

    private function generateNo(){
        $num = time();
        $num .= rand(10000,99999);
        return $num;
    }

    public function generateCommand($article, $name, $publisher, $belonger, $piece, $recto, $color, $price, $email, $phone, $file = NULL){
        $this->_table = "Commande";
        $commandinfo = array(
            "id" => "NULL",
            "no" => $this->generateNo(),
            "name" => $article." - ".$name,
            "publisher" => $publisher,
            "belonger" => $belonger,
            "state" => 1,
            "piece" => $piece,
            "price" => $price * 100,
            "recto" => $recto,
            "color" => $color,
            "contact" => $email.",".$phone,
            "time" => "NULL"
        );
        $this->add($commandinfo);
        $logger = new LogModel();
        $logger->logWithOperation("Commande Created", $commandinfo['no']." ".$belonger);
        return $commandinfo;
    }

    public function getCommandWithId($id){
        $this->_table = "Commande";
        $result = $this->where(array("id='".$id."'"))->selectAll();
        if (count($result) > 0){
            return $result;
        }
        return NULL;
    }

    public function getCommandWithNo($no){
        $this->_table = "Commande";
        $result = $this->where(array("no='".$no."'"))->selectAll();
        if (count($result) > 0){
            return $result;
        }
        return NULL;
    }

    public function getCommandWithPub($publisher, $state = 0){
        $this->_table = "Commande";
        if ($state != 0)
            $result = $this->where(array("publisher='".$publisher."' state='".$state."'"))->selectAll();
        else
            $result = $this->where(array("publisher='".$publisher."'"))->selectAll();
        if (count($result) > 0){
            return $result;
        }
        return NULL;
    }

    public function getCommandWithBel($belonger, $state = 0){
        $this->_table = "Commande";
        if ($state != 0)
            $result = $this->where(array("belonger='".$belonger."' state='".$state."'"))->selectAll();
        else
            $result = $this->where(array("belonger='".$belonger."'"))->selectAll();
        if (count($result) > 0){
            return $result;
        }
        return NULL;
    }

    public function updateCommandeState($state, $commandeNo){
        $this->_table = "Commande";
        $result = $this->where(array("no='".$commandeNo."'"))->selectAll();
        if (count($result) < 1){
            return false;
        }
        $this->update($result[0]["id"], array("state" => $state ));
        return true;
    }
}