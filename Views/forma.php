<script type="text/javascript">
    $("#tabla").html(Stat.getTableInfo(myData));
    $("#asimetria").text(Stat.CAs(myData).toFixed(3));
    $("#apuntamiento").text(Stat.CAp(myData).toFixed(3));
    function periodic () {
        
        if($("#text").val().length > 0) 
        {
            myData = Extra.transformData($("#text").val());
            $("#tabla").html(Stat.getTableInfo(myData));
            $("#text").val("");
            $("#text").blur();
            
            $("#asimetria").text(Stat.CAs(myData).toFixed(3));
            $("#apuntamiento").text(Stat.CAp(myData).toFixed(3));
        }
    }
    
    function modalClosed() 
    {
        clearInterval(timmerPeriodic);
    }
</script>
<div class="title2">Medidas de Forma</div>
<div class="title1">Variables</div>
<div class="regular">
    <table class="tabla">
        <tr>
            <th>Coeficiente de Asimetr&iacute;a</th>
            <td><div id="asimetria"></div></td>
        </tr>
        <tr>
            <th>Coeficiente de Apuntamiento</th>
            <td><div id="apuntamiento"></div></td>
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