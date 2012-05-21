<script type="text/javascript">
    var graphics = new Graph(document.getElementById('grafica'));
    graphics.setData(myData);
    $("#tabla").html(graphics.tablaPuntos());
    graphics.setType(graphics.PUNTOS);
    graphics.setLabel(1);
    graphics.start();
    
    function periodic () 
    {
        try
        {
            if($("#text").val().length > 0) 
            {
                myData = Extra.transformData($("#text").val());
                graphics.setData(myData);
                $("#tabla").html(graphics.tablaPuntos());
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
<div class="title2">Diagrama de Puntos</div>
<div class="title1">Datos</div>
<div class="regular">
    <div id="tabla"></div>
    <a href="javascript:mostrar('Graficas/Datos/36');" style="text-align: center;">Ingreso de Datos manual</a>
    <textarea id="text" placeholder="Pegue aqui la tabla"></textarea>
</div>
<div id="grafica" class="shadowClear"></div>
<div style="clear: both;"></div>
<div class="title3">Gr&aacute;fica</div>