<?php
class UserModel extends ModelBase {
	
    public function getUser ($user, $pass) {
        $sql = "SELECT id FROM users WHERE user = '$user' AND password = MD5('$pass')";
        $result = $this->db->query($sql);

        return $result;
    }
}
?>
