<?php

class PayModel extends Model{
    protected $_profiter;
    protected $_payer;
    protected $_price;
    protected $_commande;

    public function __contruct($username){
        parent::__contruct();
        // echo $username;
        $this->_payer = $username;
    }

    public function setPayer($payer){
        $this->_payer = $payer;
    }

    public function setProfiter($profiter){
        $this->_profiter = $profiter;
    }

    public function setPrice($price){
        $this->_price = $price;
    }

    public function setCommande($commande){
        $this->_commande = $commande;
    }

    public function print(){
        if (APP_DEBUG){
            echo $this->_profiter;
            echo $this->_payer;
            echo $this->_price;
            echo $this->_commande;
        }
    }

    public function valide(){
        if (!$this->_profiter || !$this->_payer
            || !$this->_price || !$this->_commande){
            return 1;
        }
        $this->_table = "Pay";
        $accountModel = new AccountModel($this->_payer);
        if (!$accountModel->_exist){
            return 2;
        }
        if ($accountModel->getSolde() < $this->_price){
            return 3;
        }
        $logger = new LogModel();
        if ($accountModel->setSolde($accountModel->getSolde() - $this->_price)){
            $logger->logWithOperation("Pay finished", 
                $this->_payer." pay to ".$this->_profiter
                ." ".$this->_price." for the commande No.".$this->_commande);
            $payInfo = array(
                "id" => 'NULL',
                "payer" => $this->_payer,
                "profiter" => $this->_profiter,
                "price" => $this->_price,
                "time" => 'NULL',
                "commande" => $this->_commande
            );
            $this->add($payInfo);
            return 0;
        } else {
            $logger->logWithOperation("Pay failed", 
                $this->_payer." attemp to pay to ".$this->_profiter
                ." ".$this->_price." for the commande No.".$this->_commande);
            return 4;
        }
    }

}