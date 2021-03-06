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
<div class="title2">Medidas de Centralizaci&oacute;n</div>
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
<div class="title3">Valores</div>
