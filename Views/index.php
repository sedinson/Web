<?php
    foreach($vars as $row)
    {
        ?>
        <div class="baseBox box" title="<?=$row['url']?>">
            <div class="close2" onclick="javascript: deleteBox(<?=$row['idaccess']?>);"></div>
            <div class="boxImg" style="background: url(<?=$this->config->get('BaseUrl') . '/Resources/Public/' . $row['image']?>);" onclick="javascript: subcontenido(<?=$row['idaccess']?>);"></div>
            <?=$row['title']?>
        </div>
    <?php 
    }
?>
<div class="baseBox add" title="Haga clic aqui para agregar un nuevo cuadro."></div>