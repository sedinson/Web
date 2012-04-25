<?php

class CouponModel extends ModelBase {
    
    public function getCoupon($id) {
        $query = "SELECT * 
                  FROM offer 
                  WHERE idoffer=$id";
        $result = $this->db->query($query);
        
        return $result;
    }
}
?>
