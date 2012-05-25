<script type="text/javascript">
    
    //Se carga la imagen de la grafica
    $("#graf").html("<embed src='" + BaseUrl + "/Resources/Public/exponential.svg' alt='Distribucion Exponencial' type='image/svg+xml' width=400px />");

    $(document).ready(function (){
        $("#datos").validate({
            
            //Limitacion para los datos de entrada
            rules: {
                beta: {
                    required: true,
                    number: true,
                    min: 1
                },
                tipo: {
                    required: true
                },
                la: {
                    required: true,
                    number: true,
                    min: 0
                },
                lb: {
                    required: true,
                    number: true,
                    min: 0
                },
                x: {
                    required: true,
                    number: true,
                    min: 0
                }
            },
            
            //Mensajes en caso de violar las limitaciones para cada uno de los casos
            messages: {
                beta: {
                    required: "<br />Es obligatorio",
                    number: "<br />Se necesita un valor numerico",
                    min: "<br />No puede ser menor que 1"
                },
                tipo: {
                    required: "<br />Es obligatorio"
                },
                la: {
                    required: "<br />Es obligatorio",
                    number: "<br />Se necesita un valor numerico",
                    min: "<br />No puede ser menor que 0"
                },
                lb: {
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
                
                //Se valida que el valor de b cuando esta presente
                if (validarLB() == true)
                {
                    ocultarResultado();

                    var beta = parseFloat($("#beta").val());
                    var la = parseFloat($("#la").val());
                    var lb = parseFloat($("#lb").val());
                    var x = parseFloat($("#x").val());
                    var res = 0;
                    var direccion = "<";
                    
                    //Probabilidad Acumulada a la izquierda
                    if ($("#caso1").is(":checked"))
                    {
                        direccion = "X&lt;" + x;
                        res = Probability.calculateExponential(beta, la, x, "<");
                        var pos = parseInt(ubicarX(beta, x));
                        $("#valor").html("<div style='padding-left: " + pos + "px; text-align: left;'>" + x + "</div>");
                    }
                    
                    //Probabilidad Acumulada entre dos valores
                    else if ($("#caso2").is(":checked"))
                    {
                        direccion = la + "&lt;X&lt;" + lb;
                        res = Probability.calculateExponential(beta, la, lb, "<<");
                        var posA = ubicarX(beta, la);
                        var posB = ubicarX(beta, lb);
                        var valor = "<div style='display: inline; padding-left: " + posA + "px;'>" + la + "</div>";
                        valor += "<div style='display: inline; padding-left: " + (posB - posA) + "px;'>" + lb + "</div>";
                        
                        //Se colocan los valores correspondientes en la grafica
                        $("#valor").html(valor);
                    }

                    mostrarResultado();

                    //Se coloca el resultado en sus respectivos DIVS
                    $("#intTitle").html("El calculo es");
                    $("#calculoDP").html("<pre class='wrap'>P(" + direccion + ") = " + res + "</pre>");
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
            $("#graficaDP").fadeIn(300);
        });
    }
    
    //Se muestra la entrada que tendra el usuario de acuerdo a lo seleccionado
    function cambiarContenidoDiv(valor)
    {
        var div
        
        if (valor == "limites")
        {
            var label1 = '<label for="la" class="data">L&iacute;mite inferior:</label>';
            var texto1 = '<input id="la" name="la" type="text" />';
            var label2 = '<label for="lb" class="data">L&iacute;mite superior:</label>';
            var texto2 = '<input id="lb" name="lb" type="text" />';
            var error = '<label id="LBerror" class="error" style="display: none;"><br />El limite superior no puede ser mayor que el inferior</label>';
            div = label1 + texto1 + label2 + texto2 + error;
        }
        else if (valor == "x")
        {
            var label = '<label for="x" class="data">Valor de X:</label>';
            var texto = '<input id="x" name="x" type="text" />';
            div = label + texto;
        }
        
        $("#lim").fadeOut(300, function (){
            $("#lim").html(div);
            $("#lim").fadeIn(300);
        });
    }
    
    function mostrarLimites ()
    {
        $("#liminf").fadeIn("slow");
        $("#limsup").fadeIn("slow");
    }
    
    function ubicarX (beta, x)
    {
        if (x < (2 * beta))
        {
            return parseInt((x / (2 * beta)) * 400);
        }
        else
        {
            return 380;
        }
    }
    
    
    //Se valida si b es mayor que a
    function validarLB ()
    {
        var la = parseInt($("#la").val());
        var lb = parseInt($("#lb").val());

        if (la > lb)
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
    
    
    function periodic () {validarLB();}
    
    function modalClosed() 
    {
        clearInterval(timmerPeriodic);
    }

</script>

<div id="probabilidad" class="estimacion">
    <div class="title2">Distribuci&oacute;n Exponencial</div>
    <div class="title1">Datos</div>
    <div class="datos inlineB">
        <div style="padding: 10px 15px;">
            <form id="datos">
                <div>
                    <label for="beta" class="data">Promedio de ocurrencias (&beta;):</label>
                    <input id="beta" name="beta" type="text" />
                </div>
                <div class="tipoDP">
                    <label for="tipo" class="data">Tipo de intervalo:</label>
                    <br />
                    <strong><label for="caso1">P(X&lt;x)</label>
                        <input id="caso1" name="tipo" type="radio" value="caso1" onclick="javascript:cambiarContenidoDiv('x');" /></strong>
                    <strong><label for="caso2">P(a&lt;x&lt;b)</label>
                        <input id="caso2" name="tipo" type="radio" value="caso2" onclick="javascript:cambiarContenidoDiv('limites');" /></strong>
                </div>
                <div id="lim"></div>
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
            <div id="graphTitle" class="wrap">Gr&aacute;fica Exponencial</div>
            <div id="graf"></div>
            <div id="valor" class="wrap" style="width: 400px; text-align: left;"></div>
        </div>
    </div>
    <div style="clear: left;"></div>
    <div class="title3">Resultado</div>
</div>
