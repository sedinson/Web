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
		if($idhelp != '-1')
			$sql = "UPDATE help SET help='$help' WHERE idaccess=$idaccess";
		else
			$sql = "INSERT INTO help (help, idaccess, iduser) VALUES ('$help', $idaccess, $iduser)";
		$result = $this->db->query($sql);
		
		return $result;
	}
}
?>