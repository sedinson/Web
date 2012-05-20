<script type="text/javascript">
    document.getElementById("tabla").innerHTML = Stat.getTableInfo(myData);
    function periodic () 
    {
        try
        {
            $("#cuartil").val("El cuartil " + $("#rcuartil").val() + " tiene el valor " + Stat.getData(Stat.Quartile, parseInt($("#rcuartil").val()), original).toFixed(2));
            $("#decil").val("El decil " + $("#rdecil").val() + " tiene el valor " + Stat.getData(Stat.Decile, parseInt($("#rdecil").val()), original).toFixed(2));
            $("#percentil").val("El percentil " + $("#rpercentil").val() + " tiene el valor " + Stat.getData(Stat.Percentile, parseInt($("#rpercentil").val()), original).toFixed(2));

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
