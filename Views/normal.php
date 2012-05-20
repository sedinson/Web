<script type="text/javascript">

    $(document).ready(function (){
        $("#datos").validate({
            rules: {
                m: {
                    required: true,
                    number: true
                },
                s: {
                    required: true,
                    number: true,
                    min: 0
                },
                x: {
                    required: true,
                    number: true
                }
            },
            messages: {
                m: {
                    required: "<br />Es obligatorio",
                    number: "<br />Se necesita un valor numerico"
                },
                s: {
                    required: "<br />Es obligatorio",
                    number: "<br />Se necesita un valor numerico",
                    min: "<br />No puede ser menor que 0"
                },
                x: {
                    required: "<br />Es obligatorio",
                    number: "<br />Se necesita un valor numerico"
                }
            },
            submitHandler: function (){
                
                ocultarResultado();
                
                var m = $("#m").val();
                var s = $("#s").val();
                var x = $("#x").val();
                var res = Probability.calculateNormal(m, s, x);

                mostrarResultado();
   
                $("#intTitle").html("El calculo es");
                $("#calculoDP").html("<pre class='wrap'>P(X=" + x + ") = " + res + "</pre>");
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
                    <label for="m" class="data">Media (&micro;):</label>
                    <input id="m" name="m" type="text" />
                </div>
                <div>
                    <label for="s" class="data">Desviaci&oacute;n Estandar (&sigma;):</label>
                    <input id="s" name="s" type="text" />
                </div>
                <div>
                    <label for="x" class="data">Variable aleatoria (X):</label>
                    <input id="x" name="x" type="text" />
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