<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BookModel
 *
 * @author sedinson
 */
    class BookModel extends ModelBase
    {
        public function getBook ($idlibro)
        {
            $query = "SELECT * FROM libros WHERE idlibro=$idlibro";
            $result = $this->db->query($query);

            return $result;
        }
        
        public function recentBooks ()
        {
            $query = "SELECT l.*, c.name as categ FROM libros l, categorias c WHERE l.idcategoria = c.idcategory ORDER BY fecha ASC LIMIT 0, 20";
            $result = $this->db->query($query);

            return $result;
        }
    }
?>