<script type="text/javascript">
    $("#tabla").html(Stat.getTableInfo(myData));
    var cas = Stat.CAs(myData).toFixed(3);
    var cap = Stat.CAp(myData).toFixed(3);
    $("#asimetria").text(cas);
    $("#apuntamiento").text(cap);
    $("#gasimetria").html("<img src='" + BaseUrl + "/Resources/measures/" + asimetria(cas) + ".png' alt='coeficiente asimetria' />");
    $("#lasimetria").text(asimetria(cas));
    
    function asimetria(val) 
    {
        if(val < 0)
            return "izquierda";
        else if(val > 0)
            return "derecha";
        else
            return "simetrica";
    }
    
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

                $("#asimetria").text(Stat.CAs(myData).toFixed(3));
                $("#apuntamiento").text(Stat.CAp(myData).toFixed(3));
                $("#gasimetria").html("<img src='" + BaseUrl + "/Resources/measures/" + asimetria(cas) + ".png' alt='coeficiente asimetria' />");
                $("#lasimetria").text(asimetria(cas));
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
<div class="title2">Medidas de Forma</div>
<div class="title1">Medidas</div>
<div class="regular">
    <table class="tabla">
        <tr>
            <th>Medida de Asimetr&iacute;a</th>
            <td><div id="asimetria"></div></td>
        </tr>
        <tr>
            <th>Medida de Apuntamiento</th>
            <td><div id="apuntamiento"></div></td>
        </tr>
    </table>
</div>
<div class="right">
    <table>
        <tr>
            <td><div id="gasimetria"></div></td>
        </tr>
        <tr>
            <th><div id="lasimetria"></div></th>
        </tr>
    </table>
</div>
<div style="clear: both;"></div>
<div class="title3">Gr&aacute;fica</div>
<div style="clear: both;"></div>
<div class="regular">
    <div class="title1">Datos</div>
    <div id="tabla"></div>
    <textarea id="text" placeholder="Pegue aqui la tabla"></textarea>
</div>
<div style="clear: both;"></div>
