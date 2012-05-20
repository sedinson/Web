<script type="text/javascript">
    $("#tabla").html(Stat.getTableInfo(myData));
    $("#media").text(Stat.averrage(myData).toFixed(3));
    $("#mediana").text(Stat.median(myData).toFixed(3));
    $("#moda").text(Stat.mode(myData)[0]);
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

                $("#media").text(Stat.averrage(myData).toFixed(3));
                $("#mediana").text(Stat.median(myData).toFixed(3));
                $("#moda").text(Stat.mode(myData)[0]);
            }
        }
        catch (exception)
        {
            clearInterval(timmerPeriodic);
        }
    }
    
    function modalClosed() 
    {
        clearInterval(timmerPeriodic);
    }
</script>
<div class="title2">Medidas de Centralizaci&oacute;n</div>
<div class="title1">Valores</div>
<div class="regular">
    <table class="tabla">
        <tr>
            <th>Media (x&#772;)</th>
            <td><div id="media"></div></td>
        </tr>
        <tr>
            <th>Mediana (x&tilde;)</th>
            <td><div id="mediana"></div></td>
        </tr>
        <tr>
            <th>Moda</th>
            <td><div id="moda"></div></td>
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
