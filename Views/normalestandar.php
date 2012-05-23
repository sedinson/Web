<script type="text/javascript">



    $(document).ready(function (){
        $("#datos").validate({
            rules: {
                z: {
                    required: true,
                    number: true
                },
                tipo: {
                    required: true
                }
            },
            messages: {
                z: {
                    required: "<br />Es obligatorio",
                    number: "<br />Se necesita un valor numerico"
                },
                tipo: {
                    required: "<br />Es obligatorio"
                }
            },
            submitHandler: function (){
                
                ocultarResultado();
                
                var z = $("#z").val();
                var res = 0;
                var direccion = "<";
                var grafica = "/Resources/Public/normal";
                var valorZ;
                if ($("#caso1").is(":checked"))
                {
                    direccion = "P(Z&lt;" + z + ")";
                    res = Probability.calculateStandardNormal(z, "<");
                    grafica += "inf.svg";
                    valorZ = "<div style='text-align: left;'>" + direccion + "</div>";
                }
                else if ($("#caso2").is(":checked"))
                {
                    direccion = "P(Z&gt;" + z + ")";
                    res = Probability.calculateStandardNormal(z, ">");
                    grafica += "sup.svg";
                    valorZ = "<div style='text-align: right;'>" + direccion + "</div>";
                }
                
                $("#graf").html("<embed src='" + BaseUrl + grafica + "' alt='Distribucion Normal' type='image/svg+xml' width=400px />");
                $("#valor").html(valorZ);

                mostrarResultado();
   
                $("#intTitle").html("El calculo es");
                $("#calculoDP").html("<pre class='wrap'>" + direccion + " = " + res + "</pre>");
            }
        });
    });
    
    function ocultarResultado ()
    {
        $("#resultado").fadeOut(300, function() {
            $("#resultadoDP").css("display", "none")
        });
    }
    
    function mostrarResultado ()
    {
        $("#resultadoDP").width($("#resultadoDP").children().width());
        $("#resultado").fadeIn(150, function() {
            $("#resultadoDP").fadeIn(300);
        });
    }
    
    function periodic () {/*SI NECESITAS HACER ALGO PERIODICO SE PONE AQUI*/}
    
    function modalClosed() 
    {
        clearInterval(timmerPeriodic);
    }

</script>

<div id="probabilidad" class="estimacion">
    <div class="title2">Distribuci&oacute;n Normal Est&aacute;ndar</div>
    <div class="title1">Datos</div>
    <div class="datos inlineB">
        <div style="padding: 10px 15px;">
            <form id="datos">
                <div>
                    <label for="z" class="data">Valor (Z):</label>
                    <input id="z" name="z" type="text" />
                </div>
                <div class="tipoDP">
                    <label for="tipo" class="data">Tipo de intervalo:</label>
                    <br />
                    <strong><label for="caso1">P(Z&lt;z)</label>
                        <input id="caso1" name="tipo" type="radio" value="caso1" checked="true" /></strong>
                    <strong><label for="caso2">P(Z&gt;z)</label>
                        <input id="caso2" name="tipo" type="radio" value="caso2" /></strong>
                </div>
                <div>
                    <input type="submit" class="calcular" value="Calcular Probabilidad" />
                </div>
            </form>
        </div>
    </div>
    <div id="resultado" class="inlineB" style="padding: 40px 20px; display: none; margin-left: 50px;">
        <div id="resultadoDP" class="wrap subdivRes">
            <div class="resTitle" id="intTitle"></div>
            <div id="calculoDP" class="wrap res" style="padding: 0 10px;"></div>
        </div>
        <div id="graficaDP">
            <div id="graphTitle" class="wrap">Gr&aacute;fica Normal</div>
            <div id="graf"></div>
            <div id="valor" class="wrap" style="padding-left: 100px; padding-right: 100px;"></div>
        </div>
    </div>
    <div style="clear: left;"></div>
    <div class="title3">Resultado</div>
</div>