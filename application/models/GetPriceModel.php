<?php
/**
 * Get Price Model
 */
class GetPriceModel extends Model {

    public function getPrice($id, $color){
        $this->_table = "Article";
        $result = $this->where($where = array( "id='".$id."'" ))->selectAll(); 
        if (count($result) > 0){
            if ($color == 1)
                return $result[0]["price"]/100;
            else
                return $result[0]["priceColor"]/100;
        } else
            return 9999/100;
    }
}