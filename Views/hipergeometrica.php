<script type="text/javascript">

    $(document).ready(function (){
        $("#datos").validate({
            rules: {
                N: {
                    required: true,
                    number: true
                },
                n: {
                    required: true,
                    number: true,
                    min: 1
                },
                k: {
                    required: true,
                    number: true,
                    min: 0
                },
                x: {
                    required: true,
                    number: true,
                    min: 0
                },
                tipo: {
                    required: true
                }
            },
            messages: {
                N: {
                    required: "<br />Es obligatorio",
                    number: "<br />Se necesita un valor numerico"
                },
                n: {
                    required: "<br />Es obligatorio",
                    number: "<br />Se necesita un valor numerico",
                    min: "<br />No puede ser menor que 1"
                },
                k: {
                    required: "<br />Es obligatorio",
                    number: "<br />Se necesita un valor numerico",
                    min: "<br />No puede ser menor que 0"
                },
                x: {
                    required: "<br />Es obligatorio",
                    number: "<br />Se necesita un valor numerico",
                    min: "<br />No puede ser menor que 0"
                }
            },
            submitHandler: function (){
                
                ocultarResultado();
                
                var N = $("#N").val();
                var n = $("#n").val();
                var k = $("#k").val();
                var x = $("#x").val();
                var direccion = "=";
                var res = 0;
                if ($("#puntual").is(":checked"))
                {
                    direccion = "=";
                    res = Probability.calculateHyperGeometric(N, n, k, x, "=");
                }
                else if ($("#acuIzq").is(":checked"))
                {
                    direccion = "&le;";
                    res = Probability.calculateHyperGeometric(N, n, k, x, "<");
                }
                else if ($("#acuDer").is(":checked"))
                {
                    direccion = "&ge;";
                    res = Probability.calculateHyperGeometric(N, n, k, x, ">");
                }

                mostrarResultado();
   
                $("#intTitle").html("El calculo es");
                $("#calculoDP").html("<pre class='wrap'>P(X" + direccion + x + ") = " + res + "</pre>");
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
    <div class="title2">Distribuci&oacute;n Binomial</div>
    <div class="title1">Datos</div>
    <div class="datos inlineB">
        <div style="padding: 10px 15px;">
            <form id="datos">
                <div>
                    <label for="N" class="data">Tama&ntilde;o de la poblaci&oacute;n (N):</label>
                    <input id="N" name="N" type="text" />
                </div>
                <div>
                    <label for="n" class="data">Tama&ntilde;o de la muestra (n):</label>
                    <input id="n" name="n" type="text" />
                </div>
                <div>
                    <label for="k" class="data">Exitos (k):</label>
                    <input id="k" name="k" type="text" />
                </div>
                <div>
                    <label for="x" class="data">Variable aleatoria (X):</label>
                    <input id="x" name="x" type="text" />
                </div>
                <div class="tipoDP">
                    <label for="tipo" class="data">Tipo de probabilidad:</label>
                    <br />
                    <input id="puntual" name="tipo" type="radio" checked="true" value="puntual" />
                    <label for="puntual" class="data">Puntual (=)</label>
                    <br />
                    <input id="acuIzq" name="tipo" type="radio" value="izquierda" />
                    <label for="puntual" class="data">Acumulada a la izquierda (&le;)</label>
                    <br />
                    <input id="acuDer" name="tipo" type="radio" value="derecha" />
                    <label for="puntual" class="data">Acumulada a la derecha (&ge;)</label>
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
    </div>
    <div style="clear: left;"></div>
    <div class="title3">Resultado</div>
</div>