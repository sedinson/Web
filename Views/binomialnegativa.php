<script type="text/javascript">

    $(document).ready(function (){
        $("#datos").validate({
            
            //Limitacion para los datos de entrada
            rules: {
                k: {
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
                    min: 1
                }
            },
            
            //Mensajes en caso de violar las limitaciones para cada uno de los casos
            messages: {
                k: {
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
                    min: "<br />No puede ser menor que 1"
                }
            },
            
            //Funcion que calcula la probabilidad
            submitHandler: function (){
                
                if(validarX() == true)
                {
                    ocultarResultado();

                    var k = $("#k").val();
                    var p = $("#p").val();
                    var x = $("#x").val();
                    var res = 0;
                    var direccion = "=";
                    
                    //Probabilidad Puntual
                    if ($("#puntual").is(":checked"))
                    {
                        direccion = "=";
                        res = Probability.calculateNegativeBinomial(k, p, x, "=");
                    }

                    //Proababilidad Acumulada a la Izquierda
                    else if ($("#acuIzq").is(":checked"))
                    {
                        direccion = "&le;";
                        res = Probability.calculateNegativeBinomial(k, p, x, "<");
                    }

                    //Probabilidad Acumulada a la Derecha
                    else if ($("#acuDer").is(":checked"))
                    {
                        direccion = "&ge;";
                        res = Probability.calculateNegativeBinomial(k, p, x, ">");
                    }
                    
                    mostrarResultado();

                    //Se coloca el resultado en sus respectivos DIVS
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
    
    //Se valida si X es mayor o igual que k
    function validarX ()
    {
        var k = parseInt($("#k").val());
        var x = parseInt($("#x").val());
        
        if (x < k)
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
    
    //Se evalua periodicamente la funcion que valida X
    function periodic () {validarX();}
    
    function modalClosed() 
    {
        clearInterval(timmerPeriodic);
    }

</script>

<div id="probabilidad" class="estimacion">
    <div class="title2">Distribuci&oacute;n Binomial Negativa</div>
    <div class="title1">Datos</div>
    <div class="datos inlineB">
        <div style="padding: 10px 15px;">
            <form id="datos">
                <div>
                    <label for="k" class="data">N&uacute;mero de &eacute;xitos (k):</label>
                    <input id="k" name="k" type="text" />
                </div>
                <div>
                    <label for="p" class="data">Proporci&oacute;n de &eacute;xitos (p):</label>
                    <input id="p" name="p" type="text" />
                </div>
                <div>
                    <label for="x" class="data">N&uacute;mero de intentos (X):</label>
                    <input id="x" name="x" type="text" />
                    <label id="Xerror" class="error" style="display: none;"><br />X no puede ser menor que k</label>
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