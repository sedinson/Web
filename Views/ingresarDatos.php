<script type="text/javascript">
    $(function() {
        $( "#tabs" ).tabs();
    });
    function periodic() { }
    
    function modalClosed() 
    {
        clearInterval(timmerPeriodic);
    }
</script>
<div class="title2">Ingresar Datos Manualmente</div>
<div class="left">
    <div id="tabs">
        <ul>
            <li><a href="#tabs-1">Lista de Datos</a></li>
            <li><a href="#tabs-2">Lista de Agrupados</a></li>
	</ul>
        
        <div id="tabs-1">
            <form id="datos-1">
                <textarea id="txtLD" placeholder="Aqui van los datos ingresados" class="fillAll" style="height: 200px;"></textarea>
                <table class="fillAll">
                    <tr>
                        <td colspan="2"><input type="text" id="txtList" placeholder="Digite Valor" class="fillAll" /></td>
                        <td><input type="submit" value="Añadir Dato" /></td>
                        <tr>
                            <td><input type="text" id="txtclass" placeholder="Digite N° Clases" class="fillAll" /></td>
                            <td><input type="text" id="txtfrec" placeholder="Digite Lim Inferior" class="fillAll" /></td>
                            <td><input type="text" id="txtfrec" placeholder="Digite Lim Superior" class="fillAll" /></td>
                        </tr>
                    </tr>
                </table>
            </form>
            <input type="button" value="Generar Tabla" style="float: right;" />
            <div style="clear: both;"></div>
        </div>
        
        <div id="tabs-2">
            <form id="datos-2">
                <textarea id="txtLA" placeholder="Aqui van los datos ingresados" class="fillAll" style="height: 200px;"></textarea>
                <table class="fillAll">
                    <tr>
                        <td><input type="text" id="txtclass" placeholder="Digite Valor de x" class="fillAll" /></td>
                        <td><input type="text" id="txtfrec" placeholder="Digite su Frecuencia" class="fillAll" /></td>
                        <td><input type="submit" value="Añadir" /></td>
                    </tr>
                </table>
            </form>
            <input type="button" value="Generar Tabla" style="float: right;" />
            <div style="clear: both;"></div>
        </div>
    </div>
</div>