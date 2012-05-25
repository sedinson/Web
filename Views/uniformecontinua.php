<script type="text/javascript">

    $(document).ready(function (){
        $("#datos").validate({
            
            //Limitacion para los datos de entrada
            rules: {
                a: {
                    required: true,
                    number: true
                },
                b: {
                    required: true,
                    number: true
                },
                x: {
                    required: true,
                    number: true,
                    min: 1
                }
            },
            
            //Mensajes en caso de violar las limitaciones para cada uno de los casos
            messages: {
                a: {
                    required: "<br />Es obligatorio",
                    number: "<br />Se necesita un valor numerico"
                },
                b: {
                    required: "<br />Es obligatorio",
                    number: "<br />Se necesita un valor numerico"
                },
                x: {
                    required: "<br />Es obligatorio",
                    number: "<br />Se necesita un valor numerico",
                    min: "<br />No puede ser menor que 1"
                }
            },
            
            //Funcion que calcula la probabilidad
            submitHandler: function (){
                
                //Se valida el valor de b y x
                if ((validarLB() == true) && (validarX() == true))
                {
                    ocultarResultado();

                    var a = $("#la").val();
                    var b = $("#lb").val();
                    var x = $("#x").val();
                    var direccion
                    var res = 0;
                    
                    //Probabilidad Puntual
                    if ($("#puntual").is(":checked"))
                    {
                        direccion = "=";
                        res = Probability.calculateContinuousUniform(a, b, x, "=");
                    }

                    //Proababilidad Acumulada a la Izquierda
                    else if ($("#acuIzq").is(":checked"))
                    {
                        direccion = "&le;";
                        res = Probability.calculateContinuousUniform(a, b, x, "<");
                    }

                    //Probabilidad Acumulada a la Derecha
                    else if ($("#acuDer").is(":checked"))
                    {
                        direccion = "&ge;";
                        res = Probability.calculateContinuousUniform(a, b, x, ">");
                    }

                    mostrarResultado();

                    $("#intTitle").html("El calculo es");
                    $("#calculoDP").html("<pre class='wrap'>P(X" + direccion + x + ") = " + res + "</pre>");
                }
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
    
    //Valida si b es mayor que a
    function validarLB ()
    {
        var a = parseInt($("#la").val());
        var b = parseInt($("#lb").val());
        
        if (a > b)
        {
            $("#LBerror").css("display", "inline");
            $("#lb").css("border", "1px solid red");
            return false;
        }
        else
        {
            $("#LBerror").css("display", "none");
            $("#lb").css("border", "");
            return true;
        }
    }
    
    //Valida si x es menor o igual que (b-a)
    function validarX ()
    {
        var x = parseInt($("#x").val());
        var a = parseInt($("#la").val());
        var b = parseInt($("#lb").val());
        
        if (x > (b - a))
        {
            $("#Xerror").css("display", "inline");
            $("#x").css("border", "1px solid red");
            return false;
        }
        else
        {
            $("#Xerror").css("display", "none");
            $("#x").css("border", "");
            return true;
        }
    }
    
    
    function periodic () {validarLB(); validarX();}
    
    function modalClosed() 
    {
        clearInterval(timmerPeriodic);
    }

</script>

<div id="probabilidad" class="estimacion">
    <div class="title2">Distribuci&oacute;n Uniforme Continua</div>
    <div class="title1">Datos</div>
    <div class="datos inlineB">
        <div style="padding: 10px 15px;">
            <form id="datos">
                <div>
                    <label for="la" class="data">L&iacute;mite inferior (a):</label>
                    <input id="la" name="la" type="text" />
                </div>
                <div>
                    <label for="lb" class="data">L&iacute;mite superior (b):</label>
                    <input id="lb" name="lb" type="text" />
                    <label id="LBerror" class="error" style="display: none;"><br />El limite superior no puede ser menor que el inferior</label>
                </div>
                <div>
                    <label for="x" class="data">Numero de &eacute;xitos (X):</label>
                    <input id="x" name="x" type="text" />
                    <label id="Xerror" class="error" style="display: none;"><br />X no puede ser menor que (b-a)</label>
                </div>
                <div class="tipoDP">
                    <label for="tipo" class="data">Tipo de probabilidad:</label>
                    <br />
                    <input id="puntual" name="tipo" type="radio" checked="true" value="puntual" />
                    <label for="puntual" class="data">P(X=x)</label>
                    <br />
                    <input id="acuIzq" name="tipo" type="radio" value="izquierda" />
                    <label for="puntual" class="data">P(X&le;x)</label>
                    <br />
                    <input id="acuDer" name="tipo" type="radio" value="derecha" />
                    <label for="puntual" class="data">P(X&ge;x)</label>
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