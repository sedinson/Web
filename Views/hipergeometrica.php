<script type="text/javascript">

    $(document).ready(function (){
        $("#datos").validate({
            
            //Limitacion para los datos de entrada
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
            
            //Mensajes en caso de violar las limitaciones para cada uno de los casos
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
            
            //Funcion que calcula la probabilidad
            submitHandler: function (){
                
                //Se validan los valores de n, k y X
                if ((validarn() == true) && (validarK() == true) && (validarX() == true))
                {
                    ocultarResultado();

                    var N = $("#N").val();
                    var n = $("#n").val();
                    var k = $("#k").val();
                    var x = $("#x").val();
                    var direccion = "=";
                    var res = 0;
                    
                    //Probabilidad Puntual
                    if ($("#puntual").is(":checked"))
                    {
                        direccion = "=";
                        res = Probability.calculateHyperGeometric(N, n, k, x, "=");
                    }
                    
                    //Proababilidad Acumulada a la Izquierda
                    else if ($("#acuIzq").is(":checked"))
                    {
                        direccion = "&le;";
                        res = Probability.calculateHyperGeometric(N, n, k, x, "<");
                    }
                    
                    //Proababilidad Acumulada a la Derecha
                    else if ($("#acuDer").is(":checked"))
                    {
                        direccion = "&ge;";
                        res = Probability.calculateHyperGeometric(N, n, k, x, ">");
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
    
    
    //Se valida si n es menor o igual que N
    function validarn ()
    {
        var n = parseInt($("#n").val());
        var N = parseInt($("#N").val());
        
        if (n > N)
        {
            $("#nerror").css("display", "inline");
            $("#n").css("border", "1px solid red");
            return false;
        }
        else
        {
            $("#nerror").css("display", "none");
            $("#n").css("border", "");
            return true;
        }
    }
    
    //Se valida si k es menor o igual que n
    function validarK ()
    {
        var N = parseInt($("#N").val());
        var k = parseInt($("#k").val());
        
        if (k > N)
        {
            $("#Kerror").css("display", "inline");
            $("#k").css("border", "1px solid red");
            return false;
        }
        else
        {
            $("#Kerror").css("display", "none");
            $("#k").css("border", "");
            return true;
        }
    }
    
    //Se valida si x es menor o igual que n
    function validarX ()
    {
        var n = parseInt($("#n").val());
        var x = parseInt($("#x").val());
        
        if (x > n)
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
    
    
    //Se evaluda periodicamente las funciones que validan N, n, k y X
    function periodic () {validarn(); validarK(); validarX();}
    
    function modalClosed() 
    {
        clearInterval(timmerPeriodic);
    }

</script>

<div id="probabilidad" class="estimacion">
    <div class="title2">Distribuci&oacute;n Hipergeom&eacute;trica</div>
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
                    <label id="nerror" class="error" style="display: none;"><br />n no puede ser mayor que N</label>
                </div>
                <div>
                    <label for="k" class="data">&Eacute;xitos en la poblaci&oacute;n (k):</label>
                    <input id="k" name="k" type="text" />
                    <label id="Kerror" class="error" style="display: none;"><br />k no puede ser mayor que N</label>
                </div>
                <div>
                    <label for="x" class="data">&Eacute;xitos en la muestra (X):</label>
                    <input id="x" name="x" type="text" />
                    <label id="Xerror" class="error" style="display: none;"><br />X no puede ser mayor que n</label>
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