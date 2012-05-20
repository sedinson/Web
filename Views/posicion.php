<script type="text/javascript">
    document.getElementById("tabla").innerHTML = Stat.getTableInfo(myData);
    function periodic () {
        $("#cuartil").val("El cuartil " + $("#rcuartil").val() + " tiene el valor " + Stat.getData(Stat.Quartile, parseInt($("#rcuartil").val()), original).toFixed(2));
        $("#decil").val("El decil " + $("#rdecil").val() + " tiene el valor " + Stat.getData(Stat.Decile, parseInt($("#rdecil").val()), original).toFixed(2));
        $("#percentil").val("El percentil " + $("#rpercentil").val() + " tiene el valor " + Stat.getData(Stat.Percentile, parseInt($("#rpercentil").val()), original).toFixed(2));
        
        var tabla = document.getElementById("tabla");
        var text = document.getElementById("text");
        
        if(text.value.length > 0) 
        {
            var data = Extra.transformData(text.value);
            tabla.innerHTML = Stat.getTableInfo(data);
            graphics.setData(data);
            myData = data;
            text.value = "";
            text.blur();
        }
    }
    
    function modalClosed() 
    {
        clearInterval(timmerPeriodic);
    }
</script>
<div class="title2">Medidas de Posici&oacute;n</div>
<div class="left">
    <div class="title1">Cuartil</div>
    <input type="range" id="rcuartil" class="fillAll" min="0" max="4" />
    <div class="title1">Decil</div>
    <input type="range" id="rdecil" class="fillAll" min="0" max="10" />
    <div class="title1">Percentil</div>
    <input type="range" id="rpercentil" class="fillAll" min="0" max="100" />
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
<div style="clear: both;"></div>
<div class="regular">
    <div class="title1">Datos</div>
    <div id="tabla"></div>
    <textarea id="text" placeholder="Pegue aqui la tabla"></textarea>
</div>
<div style="clear: both;"></div>