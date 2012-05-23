<script type="text/javascript">
    $("#tabla").html(Stat.getTableInfo(myData));
    var graphics = new Graph(document.getElementById('grafica'));
    graphics.setData(myData);
    graphics.setType(graphics.TALLO_Y_HOJAS);
    graphics.start();
    
    function periodic () 
    {
        try
        {
            if($("#text").val().length > 0) 
            {
                myData = Extra.transformData($("#text").val());
                $("#tabla").html(Stat.getTableInfo(myData));
                graphics.setData(myData);
                $("#text").val("");
                $("#text").blur();
            }
        }
        catch(exception)
        {
            if($("#text").exists())
                $("#text").val("");
            else
                clearInterval(timmerPeriodic);
        }
    }
    
    function modalClosed() 
    {
        clearInterval(timmerPeriodic);
        graphics.stop();
    }
</script>
<div class="title2">Histograma</div>
<div class="title1">Datos</div>
<div class="regular">
    <div id="tabla"></div>
    <a href="javascript:mostrar('Graficas/Datos/36');" style="text-align: center;">Ingreso de Datos manual</a>
    <textarea id="text" placeholder="Pegue aqui la tabla"></textarea>
</div>
<div id="grafica" class="shadowClear"></div>
<div style="clear: both;"></div>
<div class="title3">Gr&aacute;fica</div>
