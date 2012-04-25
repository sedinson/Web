<?php

/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IndexController
 *
 * @author sedinson
 */

class RegisterController extends ControllerBase {
    
    function newAccess () {
        $model = $this->getModel("Access");
        
        $nombre = substr(md5(uniqid(rand())),0,6) . $this->files["bg"]["name"];
        $path = "Resources/Public/";
        
        if ($nombre != "" && $this->post['pass']==$this->config->get('password')) {
            $dest = $path . $nombre;
            if (copy($this->files["bg"]["tmp_name"], $dest)) {
                $model->insertAccess($this->post['title'], $nombre, $this->post['url']);
                $status = "Done";
            } else {
                $status = "Failed";
            }
        } else {
            $status = "Failed";
        }
        
        header("location:" . $this->config->get("BaseUrl") . "/Index/index/" . $status);
    }
    
    function newSubAccess () {
        $model = $this->getModel("Access");
        
        $nombre = substr(md5(uniqid(rand())),0,6) . $this->files["bg"]["name"];
        $path = "Resources/Public/";
        
        if ($nombre != "" && $this->post['pass']==$this->config->get('password')) {
            $dest = $path . $nombre;
            if (copy($this->files["bg"]["tmp_name"], $dest)) {
                $model->insertSubAccess($this->get['0'], $this->post['title'], $nombre, $this->post['url']);
                $status = "Done";
            } else {
                $status = "Failed";
            }
        } else {
            $status = "Failed";
        }
        
        header("location:" . $this->config->get("BaseUrl") . "/Index/index/" . $status);
    }
    
    function deleteBox () {
        $model = $this->getModel("Access");
        
        if ($this->post['pass']==$this->config->get('password')) {
            $model->deleteBox($this->get['0']);
            $status = "Done";
        } else {
            $status = "Failed";
        }
        
        header("location:" . $this->config->get("BaseUrl") . "/Index/index/" . $status);
    }
    
    function deleteBox2 () {
        $model = $this->getModel("Access");
        
        if ($this->post['pass']==$this->config->get('password')) {
            $model->deleteBox2($this->get['0']);
            $status = "Done";
        } else {
            $status = "Failed";
        }
        
        header("location:" . $this->config->get("BaseUrl") . "/Index/index/" . $status);
    }
}
?>
