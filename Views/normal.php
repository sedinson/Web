<script type="text/javascript">

    $(document).ready(function (){
        $("#datos").validate({
            
            //Limitacion para los datos de entrada
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
                tipo: {
                    required: true
                },
                la: {
                    required: true,
                    number: true
                },
                lb: {
                    required: true,
                    number: true
                },
                x: {
                    required: true,
                    number: true
                }
            },
            
            //Mensajes en caso de violar las limitaciones para cada uno de los casos
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
                tipo: {
                    required: "<br />Es obligatorio"
                },
                la: {
                    required: "<br />Es obligatorio",
                    number: "<br />Se necesita un valor numerico"
                },
                lb: {
                    required: "<br />Es obligatorio",
                    number: "<br />Se necesita un valor numerico"
                },
                x: {
                    required: "<br />Es obligatorio",
                    number: "<br />Se necesita un valor numerico"
                }
            },
            
            //Funcion que calcula la probabilidad
            submitHandler: function (){
                
                //Se valida el valor de b cuando esta presente
                if (validarLB() == true)
                {
                    ocultarResultado();

                    var m = $("#m").val();
                    var s = $("#s").val();
                    var la = $("#la").val();
                    var lb = $("#lb").val();
                    var x = $("#x").val();
                    var res = 0;
                    var direccion = "<";
                    var grafica = "/Resources/Public/normal";
                    var valorX;

                    //Probabilidad Acumulada a la izquierda
                    if ($("#caso1").is(":checked"))
                    {
                        direccion = "P(X&lt;" + x + ")";
                        res = Probability.calculateNormal(m, s, la, x, "<");
                        grafica += "sup.svg";
                        valorX = "<div style='text-align: left;'>" + direccion + "</div>";
                    }

                    //Probabilidad Acumulada entre dos valores
                    else if ($("#caso2").is(":checked"))
                    {
                        direccion = "P(" + la + "&lt;X&lt;" + lb + ")";
                        res = Probability.calculateNormal(m, s, la, lb, "<<");
                        grafica += "bi.svg";
                        valorX = "<div style='position: relative; float: left;'>P(X&lt;" + la + ")</div>";
                        valorX += "<div style='position: relative; float: right;'>P(X&lt;" + lb + ")</div>";
                    }

                    //Probabilidad Acumulada a la derecha
                    else if ($("#caso3").is(":checked"))
                    {
                        direccion = "P(X&gt;" + x + ")";
                        res = Probability.calculateNormal(m, s, x, lb, ">");
                        grafica += "inf.svg";
                        valorX = "<div style='text-align: right;'>" + direccion + "</div>";
                    }

                    //Agrega el grafico respectivo al Div correspondiente
                    $("#graf").html("<embed src='" + BaseUrl + grafica + "' alt='Distribucion Normal' type='image/svg+xml' width=400px />");
                    $("#valor").html(valorX);

                    mostrarResultado();

                    //Se coloca el resultado en sus respectivos DIVS
                    $("#intTitle").html("El calculo es");
                    $("#calculoDP").html("<pre class='wrap'>" + direccion + " = " + res + "</pre>");
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
    <div class="title2">Distribuci&oacute;n Normal</div>
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
                <div class="tipoDP">
                    <label for="tipo" class="data">Tipo de intervalo:</label>
                    <br />
                    <strong><label for="caso1">P(X&lt;x)</label>
                        <input id="caso1" name="tipo" type="radio" value="caso1" onclick="javascript:cambiarContenidoDiv('x');" /></strong>
                    <strong><label for="caso2">P(a&lt;X&lt;b)</label>
                        <input id="caso2" name="tipo" type="radio" value="caso2" onclick="javascript:cambiarContenidoDiv('limites');" /></strong>
                    <strong><label for="caso3">P(X&gt;x)</label>
                        <input id="caso3" name="tipo" type="radio" value="caso3" onclick="javascript:cambiarContenidoDiv('x');" /></strong>
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
            <div id="graphTitle" class="wrap">Gr&aacute;fica Normal</div>
            <div id="graf"></div>
            <div id="valor" class="wrap" style="padding-left: 100px; padding-right: 100px;"></div>
        </div>
    </div>
    <div style="clear: left;"></div>
    <div class="title3">Resultado</div>
</div>