<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<form method="POST" action="<?=$config->get('InitUrl')?>?controller=Register&action=deleteBox2&str=<?=$obj?>" enctype="multipart/form-data">
    <div class="title2">Eliminar Sub Acceso</div>
    <input type="password" name="pass" placeholder="Clave" style="width: 100%;"/>
    <input type="submit" value="Eliminar" style="float: right;"/>
    <div style="clear: both;"></div>
</form>