<?php
	$example = "";
	$idexample = -1;
	$idaccess = -1;
	
	if(!empty($vars))
	{
		foreach($vars as $row)
		{
			$idaccess = $row['idaccess'];
			$idexample = $row['idexample'];
			$example = $row['example'];
		}
	}
?>
<form method="POST" action="<?=$config->get('InitUrl')?>?controller=Register&action=example" enctype="multipart/form-data">
	<div class="title2">Editar Ejemplo</div>
	<input type="hidden" name="idaccess" value="<?=$obj?>" />
	<input type="hidden" name="idexample" value="<?=$idexample?>" />
	<textarea id="contenido" name="example" class="fillAll" placeholder="Escriba aqui el contenido"><?=$example?></textarea>
	<input type="text" name="user" placeholder="usuario" class="fillAll" />
	<input type="password" name="password" placeholder="clave" class="fillAll" />
<input type="submit" value="Aceptar y Editar" style="float: right;" />
</form>
<div style="clear: both;"></div>