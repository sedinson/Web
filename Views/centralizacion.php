<script type="text/javascript">
    document.getElementById("tabla").innerHTML = Stat.getTableInfo(myData);
    function periodic () {}
    
    function modalClosed() 
    {
        clearInterval(timmerPeriodic);
    }
</script>
<div class="title2">Medidas de Centralizaci&oacute;n</div>
<div class="title1">Media</div>
<div class="regular">
</div>
<div style="clear: both;"></div>
<div class="title3">Mediana</div>
<div style="clear: both;"></div>
<div class="regular">
    <div class="title1">Datos</div>
    <div id="tabla"></div>
    <textarea id="text" placeholder="Pegue aqui la tabla"></textarea>
</div>
<div style="clear: both;"></div>