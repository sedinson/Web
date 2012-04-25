<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AccessModel
 *
 * @author Edinson Salas
 */
class AccessModel extends ModelBase {
    
    function insertAccess($title, $img, $url)
    {
        $sql = "INSERT INTO access (title, image, url) VALUES ('$title', '$img', '$url');";
        $result = $this->db->query($sql);
        
        return $result;
    }
    
    function insertSubAccess($idparent, $title, $img, $url)
    {
        $sql = "INSERT INTO access (idparent, title, image, url) VALUES ($idparent, '$title', '$img', '$url');";
        $result = $this->db->query($sql);
        
        return $result;
    }
    
    function deleteBox($id)
    {
        $sql = "DELETE FROM access WHERE idparent = $id OR idaccess = $id";
        $result = $this->db->query($sql);
        
        return $result;
    }
    
    function deleteBox2($id)
    {
        $sql = "DELETE FROM access WHERE idaccess = $id";
        $result = $this->db->query($sql);
        
        return $result;
    }
    
    function getAccess()
    {
        $sql = "SELECT * FROM access WHERE idparent = 0;";
        $result = $this->db->query($sql);
        
        return $result;
    }
    
    function getSubAccess($id)
    {
        $sql = "SELECT * FROM access WHERE idparent = $id;";
        $result = $this->db->query($sql);
        
        return $result;
    }
}

?>
