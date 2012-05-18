<script type="text/javascript">
    document.getElementById("tabla").innerHTML = Stat.getTableInfo(myData);
    function periodic () {}
    
    function modalClosed() 
    {
        clearInterval(timmerPeriodic);
    }
</script>
<div class="title2">Medidas de Centralizaci&oacute;n</div>
<div class="title1">Centralizaci&oacute;n</div>
<div class="regular">
    <table>
        <tr>
            <td>x&#772;</td>
        </tr>
        <tr>
            <td>x&tilde;</td>
        </tr>
    </table>
</div>
<div class="regular">
    <div class="title1">Datos</div>
    <div id="tabla"></div>
    <textarea id="text" placeholder="Pegue aqui la tabla"></textarea>
</div>
<div style="clear: both;"></div>