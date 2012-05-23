<script type="text/javascript">
    
    $("#graf").html("<embed src='" + BaseUrl + "/Resources/Public/exponential.svg' alt='Distribucion Exponencial' type='image/svg+xml' width=400px />");

    $(document).ready(function (){
        $("#datos").validate({
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
                }
            },
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
                }
            },
            submitHandler: function (){
                
                if (validarLB() == true)
                {
                    ocultarResultado();

                    var beta = $("#beta").val();
                    var la = $("#la").val();
                    var lb = $("#lb").val();
                    var res = 0;
                    var direccion = "<";
                    if ($("#caso1").is(":checked"))
                    {
                        direccion = "X&lt;" + lb;
                        res = Probability.calculateExponential(beta, la, lb, "<");
                        var pos = parseInt(ubicarX(beta, lb));
                        $("#valor").html("<div style='padding-left: " + pos + "px; width: 400px; text-align: left;'>" + lb + "</div>");
                    }
                    else if ($("#caso2").is(":checked"))
                    {
                        direccion = la + "&lt;X&lt;" + lb;
                        res = Probability.calculateExponential(beta, la, lb, "<<");
                        var valor;
                        if (lb < beta)
                        {
                            var posA = parseInt(ubicarX(beta, la));
                            var posB = parseInt(ubicarX(beta, lb));
                            valor = "<div style='padding-left: " + posA + "px; display: inline-block; text-align: left;'>" + la + "</div>";
                            valor += "<div style='padding-left: " + (posB - posA) + "px; display: inline-block; text-align: left;'>" + lb + "</div>";
                        }
                        else if (la > beta)
                        {
                            var posA = parseInt(ubicarX(beta, la));
                            var posB = parseInt(ubicarX(beta, lb));
                            valor = "<div style='padding-left: " + posA + "px; display: inline-block; text-align: left;'>" + la + "</div>";
                            valor += "<div style='padding-left: " + (posB - posA) + "px; display: inline-block; text-align: left;'>" + lb + "</div>";
                        }
                        else
                        {
                            var posA = parseInt((ubicarX(beta, la)) / 2);
                            var posB = parseInt((ubicarX(beta, lb)) / 2);
                            valor = "<div style='position: relative; float: left; margin-left: " + posA + "px; width: 200px; text-align: left;'>" + la + "</div>";
                            valor += "<div style='position: relative; float: right; margin-left: " + posB + "px; width: 200px; text-align: left;'>" + lb + "</div>";
                        }
                        $("#valor").html(valor);
                    }

                    mostrarResultado();

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
    
    function mostrarLimSup ()
    {
        $("#liminf").fadeOut("slow", function (){
            $("#limsup").fadeIn("slow");
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
            return ((x / (2 * beta)) * 400);
        }
        else
        {
            return 380;
        }
    }
    
    function ubicarX2 (beta, a, b)
    {
        if (b < beta){
            
        }
    }
    
    
    $("#lb").keyup(validarLB);
    
    function validarLB ()
    {
        if(isNaN($("#la").val()) == false)
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
    }
    
    
    function periodic () {/*SI NECESITAS HACER ALGO PERIODICO SE PONE AQUI*/}
    
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
                    <label for="beta" class="data">Parametro beta (&beta;):</label>
                    <input id="beta" name="beta" type="text" />
                </div>
                <div class="tipoDP">
                    <label for="tipo" class="data">Tipo de intervalo:</label>
                    <br />
                    <strong><label for="caso1">P(X&lt;x)</label>
                        <input id="caso1" name="tipo" type="radio" value="caso1" onclick="javascript:mostrarLimSup();" /></strong>
                    <strong><label for="caso2">P(a&lt;x&lt;b)</label>
                        <input id="caso2" name="tipo" type="radio" value="caso2" onclick="javascript:mostrarLimites();" /></strong>
                </div>
                <div id="liminf" style="display: none;">
                    <label for="la" class="data">L&iacute;mite inferior:</label>
                    <input id="la" name="la" type="text" />
                </div>
                <div id="limsup" style="display: none;">
                    <label for="lb" class="data">L&iacute;mite superior:</label>
                    <input id="lb" name="lb" type="text" />
                    <label id="LBerror" class="error" style="display: none;"><br />El limite superior no puede ser mayor que el inferior</label>
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
            <div id="graphTitle" class="wrap">Gr&aacute;fica Exponencial</div>
            <div id="graf"></div>
            <div id="valor" class="wrap" style="width: 400px;"></div>
        </div>
    </div>
    <div style="clear: left;"></div>
    <div class="title3">Resultado</div>
</div>
