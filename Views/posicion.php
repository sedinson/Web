<script type="text/javascript">
    function periodic () {}
    
    function modalClosed() 
    {
        clearInterval(timmerPeriodic);
    }
</script>
<div class="title2">Medidas de Posici&oacute;n</div>
<div class="left">
    <div class="title1">Cuartil</div>
    <input type="range" class="fillAll" min="0" max="4" />
    <div class="title1">Decil</div>
    <input type="range" class="fillAll" min="0" max="10" />
    <div class="title1">Percentil</div>
    <input type="range" class="fillAll" min="0" max="100" />
</div>
<div class="right">
    <div style="width: 100%; height: 50px;"></div>
    <input type="text" id="cuartil" class="textPos" />
    <div style="clear: both;"></div>
    <div class="title3">Valores</div>
    <input type="text" id="decil" class="textPos" />
    <div style="clear: both;"></div>
    <div class="title3">Valores</div>
    <input type="text" id="percentil" class="textPos" />
    <div style="clear: both;"></div>
    <div class="title3">Valores</div>
</div>