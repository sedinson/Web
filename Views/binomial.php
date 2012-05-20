<script type="text/javascript">

    $(document).ready(function (){
        $("#datos").validate({
            rules: {
                n: {
                    required: true,
                    number: true,
                    min: 1
                },
                p: {
                    required: true,
                    number: true,
                    min: 0,
                    max: 1
                },
                x: {
                    required: true,
                    number: true,
                    min: 0,
                    max: 1000
                },
                tipo: {
                    required: true
                }
            },
            messages: {
                n: {
                    required: "<br />Es obligatorio",
                    number: "<br />Se necesita un valor numerico",
                    min: "<br />No puede ser menor que 1"
                },
                p: {
                    required: "<br />Es obligatorio",
                    number: "<br />Se necesita un valor numerico",
                    min: "<br />No puede ser menor que 0",
                    max: "<br />No puede ser mayor que 1"
                },
                x: {
                    required: "<br />Es obligatorio",
                    number: "<br />Se necesita un valor numerico",
                    min: "<br />No puede ser menor que 0",
                    max: "<br />No puede ser mayor que n"
                }
            },
            submitHandler: function (){
                
//                ocultarResultado();
                
                var n = $("#n").val();
                var p = $("#p").val();
                var x = $("#x").val();
                var direccion = "=";
                var res = 0;
                if ($("#puntual").is(":checked"))
                {
                    direccion = "=";
                    res = Probability.calculateBinomial(n, p, x, "=");
                }
                else if ($("#acuIzq").is(":checked"))
                {
                    direccion = "&le;";
                    res = Probability.calculateBinomial(n, p, x, "<");
                }
                else if ($("#acuDer").is(":checked"))
                {
                    direccion = "&ge;";
                    res = Probability.calculateBinomial(n, p, x, ">");
                }
                
//                mostrarResultado();
                
                $("#calculoDP").html("P(X"+direccion+x+") = "+res.toFixed(3));
            }
        });
    });
    //
    function ocultarResultado ()
    {
//        $("#resultadoDP").animate({
//            opacity: "0",
//            marginLeft: "100%"
//        }, 100);
    }
    
    function mostrarResultado ()
    {
        $("#resultadoDP").animate({
            marginLeft: "-=320",
            opacity: "1"
        }, 500);
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
                    <label for="n" class="data">Tama&ntilde;o de la muestra (n):</label>
                    <input id="n" name="n" type="text" />
                </div>
                <div>
                    <label for="p" class="data">Probabilidad (p):</label>
                    <input id="p" name="p" type="text" />
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
    <div class="right">
        <div id="resultadoDP" class="inlineB">
            <div id="calculoDP"></div>
        </div>
    </div>
    <div style="clear: both;"></div>
    <div class="title3">Resultado</div>
</div>
