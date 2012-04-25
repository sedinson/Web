<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategoryModel
 *
 * @author sedinson
 */
class categoryModel extends ModelBase 
{    
    public function getCategories() 
    {
        $query = "SELECT * FROM categorias";
        $result = $this->db->query($query);
        
        return $result;
    }
    
    public function getBooks ($idcategory)
    {
        $query = "SELECT * FROM libros WHERE idcategoria=$idcategory";
        $result = $this->db->query($query);
        
        return $result;
    }
}

?>
