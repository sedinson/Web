<script type="text/javascript">
    $("#tabla").html(Stat.getTableInfo(myData));
    var graphics = new Graph(document.getElementById('grafica'));
    graphics.setData(myData);
    graphics.setType(graphics.FRECUENCIA);
    graphics.setLabel(1);
    graphics.start();
    
    function periodic () 
    {
        try
        {
            if($("#text").val().length > 0) 
            {
                myData = Extra.transformData(text.value);
                $("#tabla").html(Stat.getTableInfo(myData));
                graphics.setData(myData);
                $("#text").val("");
                $("#text").blur();
            }
        }
        catch(exception)
        {
            clearInterval(timmerPeriodic);
        }
    }
    
    function modalClosed() 
    {
        clearInterval(timmerPeriodic);
        graphics.stop();
    }
</script>
<div class="title2">Diagrama de Frecuencia</div>
<div class="title1">Datos</div>
<div class="regular">
    <div id="tabla"></div>
    <textarea id="text" placeholder="Pegue aqui la tabla"></textarea>
</div>
<div id="grafica" class="shadowClear"></div>
<div style="clear: both;"></div>
<div class="title3">Gr&aacute;fica</div>