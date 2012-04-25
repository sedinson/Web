<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<form method="POST" action="<?=$config->get('BaseUrl')?>/Register/deleteBox/<?=$obj?>" enctype="multipart/form-data">
    <div class="title2">Eliminar Acceso</div>
    <input type="password" name="pass" placeholder="Clave" style="width: 100%;"/>
    <input type="submit" value="Eliminar" style="float: right;"/>
    <div style="clear: both;"></div>
</form>