<?php
class ExampleModel extends ModelBase {
	
	public function getInformation ($id) {
		$sql = "SELECT example FROM example WHERE idaccess = $id";
		$result = $this->db->query($sql);
        
        return $result;
	}
	
	public function getAllInformation ($id) {
		$sql = "SELECT * FROM example WHERE idaccess = $id";
		$result = $this->db->query($sql);
        
        return $result;
	}
	
	public function insertExample ($example, $idaccess, $idexample, $iduser) {
		if($idexample != '-1')
			$sql = "UPDATE example SET example='$example' WHERE idaccess=$idaccess";
		else
			$sql = "INSERT INTO example (example, idaccess, iduser) VALUES ('$example', $idaccess, $iduser)";
		$result = $this->db->query($sql);
		
		return $result;
	}
}
?>