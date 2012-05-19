<script type="text/javascript">
    $("#tabla").html(Stat.getTableInfo(myData));
    $("#varianza").text(Stat.variance(myData).toFixed(3));
    $("#desviacion").text(Stat.deviation(myData).toFixed(3));
    function periodic () {
        
        if($("#text").val().length > 0) 
        {
            myData = Extra.transformData($("#text").val());
            $("#tabla").html(Stat.getTableInfo(myData));
            $("#text").val("");
            $("#text").blur();
            
            $("#varianza").text(Stat.variance(myData).toFixed(3));
            $("#desviacion").text(Stat.deviation(myData).toFixed(3));
        }
    }
    
    function modalClosed() 
    {
        clearInterval(timmerPeriodic);
    }
</script>
<div class="title2">Medidas de Variabilidad</div>
<div class="title1">Variables</div>
<div class="regular">
    <table class="tabla">
        <tr>
            <th>Varianza (s<sup>2</sup>)</th>
            <td><div id="varianza"></div></td>
        </tr>
        <tr>
            <th>Desviaci&oacute;n Est&aacute;ndar (s)</th>
            <td><div id="desviacion"></div></td>
        </tr>
    </table>
</div>
<div style="clear: both;"></div>
<div class="regular">
    <div class="title1">Datos</div>
    <div id="tabla"></div>
    <textarea id="text" placeholder="Pegue aqui la tabla"></textarea>
</div>
<div style="clear: both;"></div>