<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<form method="POST" action="<?=$config->get('BaseUrl')?>/Register/newAccess" enctype="multipart/form-data">
    <div class="title2">Agregar Acceso</div>
    <input type="text" name="title" placeholder="Titulo"  style="width: 100%;"/>
    <input type="text" name="url" placeholder="Comentario" style="width: 100%;"/>
    <input type="password" name="pass" placeholder="Clave" style="width: 100%;"/>
    <input type="file" name="bg" id="fileElem" accept="image/*" onchange="document.getElementById('fileSelect').innerHTML = this.files[0].name;"/>
    <a href="#" id="fileSelect">Elegir imagen</a>
    <input type="submit" value="Agregar" style="float: right;"/>
    <div style="clear: both;"></div>
</form>