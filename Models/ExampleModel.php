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
		if($idexample != '-1') {
                    $sql2 = "UPDATE example SET example='$example' WHERE idaccess=$idaccess";
                    $sql1 = "INSERT INTO modexample (idexample, iduser, example) VALUES ($idexample, (SELECT iduser FROM example WHERE idexample = $idexample), (SELECT example FROM example WHERE idexample = $idexample))";
                    $this->db->query($sql1);
                } else
			$sql2 = "INSERT INTO example (example, idaccess, iduser) VALUES ('$example', $idaccess, $iduser)";
		$result = $this->db->query($sql2);
		
		return $result;
	}
}
?>