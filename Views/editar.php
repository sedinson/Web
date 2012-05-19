<?php
	$help = "";
	$idhelp = -1;
	$idaccess = -1;
	
	if(!empty($vars))
	{
		foreach($vars as $row)
		{
			$idaccess = $row['idaccess'];
			$idhelp = $row['idhelp'];
			$help = $row['help'];
		}
	}
?>
<form method="POST" action="<?=$config->get('InitUrl')?>?controller=Register&action=help" enctype="multipart/form-data">
	<div class="title2">Editar Ayuda</div>
	<input type="hidden" name="idaccess" value="<?=$obj?>" />
	<input type="hidden" name="idhelp" value="<?=$idhelp?>" />
	<textarea id="contenido" name="help" class="fillAll" placeholder="Escriba aqui el contenido"><?=$help?></textarea>
	<input type="text" name="user" placeholder="usuario" class="fillAll" />
	<input type="password" name="password" placeholder="clave" class="fillAll" />
<input type="submit" value="Aceptar y Editar" style="float: right;" />
</form>
<div style="clear: both;"></div>