<?php
class HelpModel extends ModelBase {
	
	public function getInformation ($id) {
		$sql = "SELECT help FROM help WHERE idaccess = $id";
		$result = $this->db->query($sql);
        
        return $result;
	}
	
	public function getAllInformation ($id) {
		$sql = "SELECT * FROM help WHERE idaccess = $id";
		$result = $this->db->query($sql);
        
        return $result;
	}
	
	public function insertHelp ($help, $idaccess, $idhelp, $iduser) {
		if($idhelp != '-1') {
                    $sql2 = "UPDATE help SET help='$help' WHERE idaccess=$idaccess";
                    $sql1 = "INSERT INTO modhelp (idhelp, iduser, help) VALUES ($idhelp, (SELECT iduser FROM help WHERE idhelp = $idhelp), (SELECT help FROM help WHERE idhelp = $idhelp))";
                    $this->db->query($sql1);
                }
		else
                    $sql2 = "INSERT INTO help (help, idaccess, iduser) VALUES ('$help', $idaccess, $iduser)";
		$result = $this->db->query($sql2);
		
		return $result;
	}
}
?>