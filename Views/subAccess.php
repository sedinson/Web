<?php
    foreach($vars as $row)
    {
        @$a = split("/", $row['url']);
        $url = "controller=" . $a[0] . "&action=" . $a[1];
        ?>
            <div class="baseBox box shadowInt" onclick="javascript: mostrar('<?=$url?>');">
            <div class="close2" onclick="javascript: deleteBox2(<?=$row['idaccess']?>);"></div>
            <div class="boxImg" style="background: url(<?=$config->get('BaseUrl') . '/Resources/Public/' . $row['image']?>);"></div>
            <?=$row['title']?>
        </div>
    <?php 
    }
?>
<div class="baseBox sadd shadowInt" onclick="javascript:subAdd(<?=$obj?>);" title="Haga clic aqui para agregar un nuevo sub cuadro."></div>