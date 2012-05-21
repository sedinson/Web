<script type="text/javascript">
    $("#tabla").html(Stat.getTableInfo(myData));
    $("#varianza").text(Stat.variance(myData).toFixed(3));
    $("#desviacion").text(Stat.deviation(myData).toFixed(3));
    $("#variacion").text(Stat.deviation(myData).toFixed(3));
    function periodic () 
    {
        try 
        {
            if($("#text").val().length > 0) 
            {
                myData = Extra.transformData($("#text").val());
                $("#tabla").html(Stat.getTableInfo(myData));
                $("#text").val("");
                $("#text").blur();

                $("#varianza").text(Stat.variance(myData).toFixed(3));
                $("#desviacion").text(Stat.deviation(myData).toFixed(3));
                $("#variacion").text(Stat.CV(myData).toFixed(3));
            }
        }
        catch (exception)
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
    }
</script>
<div class="title2">Medidas de Variabilidad</div>

<div class="title1">Datos</div>
<div style="clear: both;"></div>
<div class="regular">
    <div id="tabla"></div>
    <a href="javascript:mostrar('Graficas/Datos/36');" style="text-align: center;">Ingreso de Datos manual</a>
    <textarea id="text" placeholder="Pegue aqui la tabla"></textarea>
</div>

<div class="right">
    <table class="tabla">
        <thead>
            <tr>
                <th>Medida</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tr>
            <th>Varianza (s<sup>2</sup>)</th>
            <td><div id="varianza"></div></td>
        </tr>
        <tr>
            <th>Desviaci&oacute;n Est&aacute;ndar (s)</th>
            <td><div id="desviacion"></div></td>
        </tr>
        <tr>
            <th>Coeficiente de Variaci&oacute;n (CV)</th>
            <td><div id="variacion"></div></td>
        </tr>
    </table>
</div>
<div style="clear: both;"></div>
<div class="title3">Variables</div>