<script type="text/javascript">
    document.getElementById("tabla").innerHTML = Stat.getTableInfo(myData);
    var graphics = new Graph(document.getElementById('grafica'));
    graphics.setData(myData);
    graphics.setType(graphics.BARRAS);
    graphics.start();
    
    function periodic () 
    {
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
        graphics.stop();
    }
</script>
<div class="title1">Datos</div>
<div class="regular">
    <div id="tabla"></div>
    <textarea id="text" placeholder="Pegue aqui la tabla"></textarea>
</div>
<div id="grafica" class="shadowClear"></div>
<div style="clear: both;"></div>
<div class="title3">Gr&aacute;fica</div>