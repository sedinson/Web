<script type="text/javascript">
    $(function () {
        $("#rcuartil").slider({range: "min", value: 2, min: 0, max: 4, animate: true});
        $("#rdecil").slider({range: "min", value: 5, min: 0, max: 10, animate: true});
        $("#rpercentil").slider({range: "min", value: 50, min: 0, max: 100, animate: true});
    });
    $("document").ready(function () {
        $("#tabla").html(Stat.getTableInfo(myData));
    });
    
    function periodic ()
    {
        try
        {
            var c = $("#rcuartil").slider("option", "value");
            var d = $("#rdecil").slider("option", "value");
            var p = $("#rpercentil").slider("option", "value");
            $("#cuartil").html("El <b>cuartil</b> " + c + " tiene el <b>valor </b>" + Stat.getData(Stat.Quartile, parseInt(c), original).toFixed(2));
            $("#decil").html("El <b>decil</b> " + d + " tiene el <b>valor </b>" + Stat.getData(Stat.Decile, parseInt(d), original).toFixed(2));
            $("#percentil").html("El <b>percentil</b> " + p + " <b>tiene el valor </b>" + Stat.getData(Stat.Percentile, parseInt(p), original).toFixed(2));

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
<div class="title2">Medidas de Posici&oacute;n</div>
<div class="left">
    <div class="title1">Cuartil</div>
    <div id="rcuartil" class="fillAll"></div>
    <div class="title1">Decil</div>
    <div id="rdecil" class="fillAll"></div>
    <div class="title1">Percentil</div>
    <div id="rpercentil" class="fillAll"></div>
</div>
<div class="right">
    <div style="width: 100%; height: 50px;"></div>
    <div id="cuartil" class="textPos"></div>
    <div style="clear: both;"></div>
    <div class="title3">Valores</div>
    <div id="decil" class="textPos"></div>
    <div style="clear: both;"></div>
    <div class="title3">Valores</div>
    <div id="percentil" class="textPos"></div>
    <div style="clear: both;"></div>
    <div class="title3">Valores</div>
</div>
<div style="clear: both;"></div>
<div class="left">
    <div class="title1">Datos</div>
    <div id="tabla"></div>
    <a href="javascript:mostrar('Graficas/Datos/36');" style="text-align: center;">Ingreso de Datos manual</a>
    <textarea id="text" placeholder="Pegue aqui la tabla"></textarea>
</div>
<div style="clear: both;"></div>
