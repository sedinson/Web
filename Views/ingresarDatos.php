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
            <li><a href="#tabs-3">Calculo de Lista</a></li>
	</ul>
        
        <div id="tabs-1">
            <form id="datos-1">
                <textarea id="txtLD" placeholder="Aqui van los datos ingresados" class="fillAll"></textarea>
                <table class="fillAll">
                    <tr>
                        <td><input type="text" id="txtList" placeholder="Digite Valor" class="fillAll" /></td>
                        <td><input type="submit" value="Añadir" /></td>
                    </tr>
                </table>
            </form>
        </div>
        
        <div id="tabs-2">
            <form id="datos-2">
                <textarea id="txtLA" placeholder="Aqui van los datos ingresados" class="fillAll"></textarea>
                <table class="fillAll">
                    <tr>
                        <td><input type="text" id="txtclass" placeholder="Digite Valor" class="fillAll" /></td>
                        <td><input type="text" id="txtfrec" placeholder="Digite Valor" class="fillAll" /></td>
                        <td><input type="submit" value="Añadir" /></td>
                    </tr>
                </table>
            </form>
        </div>
        
        <div id="tabs-3"></div>
    </div>
</div>