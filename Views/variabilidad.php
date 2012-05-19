<script type="text/javascript">
    document.getElementById("tabla").innerHTML = Stat.getTableInfo(myData);
    function periodic () {}
    
    function modalClosed() 
    {
        clearInterval(timmerPeriodic);
    }
</script>
<div class="title2">Medidas de Variabilidad</div>
<div class="title1">Variabilidad</div>
<div class="regular">
</div>
<div style="clear: both;"></div>
<div class="title3">Valores</div>
<div style="clear: both;"></div>
<div class="regular">
    <div class="title1">Datos</div>
    <div id="tabla"></div>
    <textarea id="text" placeholder="Pegue aqui la tabla"></textarea>
</div>
<div style="clear: both;"></div>