<script type="text/javascript" src="../Scripts/js/Estimacion.js"></script>
<script type="text/javascript">
    $(document).load(function (){
        $("#vpoblacional").hide();
        $("#vmuestral").hide();
    });
    function mostrarVarP(){
        $("#vmuestral").fadeOut("slow", function(){
            $("#vpoblacional").fadeIn("slow");
        });
    }
    function mostrarVarM(){
        $("#vpoblacional").fadeOut("slow", function(){
            $("#vmuestral").fadeIn("slow");
        });
    }
</script>
<div>
    <h1>Intervalos de Confianza para la Media: </h1>
    <form>
        <div>
            <div>
                <label for="alfa">Nivel de Confiabilidad(&alpha;):</label>
                <input id="alfa" type="number" min="0.01" max="0.1" step="0.01"/>
            </div>
            <div>
                <label for="miu">Media poblacional(&micro;):</label>
                <input id="miu" type="number" min="0.01" max="0.1" step="0.01"/>
            </div>
            <div>
                <label for="tamano">Tama&ntilde;o de la muestra(n):</label>
                <input type="number" min="1">
            </div>
            <div>
                <label for="conocida">Varianza poblacional(&sigma;) conocida?</label>
                <input type="radio" id="conocida" name="conocida" value="si" onclick="javascript: mostrarVarP();"/>Si
                <input type="radio" id="conocida" name="conocida" value="no" onclick="javascript: mostrarVarM();"/>No
                <div id="vpoblacional" style="display: none"><input type="number" min="0"/></div>
                <div id="vmuestral" style="display: none">
                    <label for="smuestral">Desviaci&oacute;n estandar muestral(s): </label>
                    <input id="smuestral" type="number" min="0"/>
                </div>
            </div>

        </div>
    </form>
</div>