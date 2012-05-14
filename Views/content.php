<?php
	$content = "No hay informaci&oacute;n a&uacute;n. S&eacute; el primero.";
	
	if(!empty($vars))
	{
		foreach ($vars as $row)
		{
			$content = $row[0];
		}
	}
	
	echo $content;
?>