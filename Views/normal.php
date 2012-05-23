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
                }
            },
            submitHandler: function (){
                
                ocultarResultado();
                
                var m = $("#m").val();
                var s = $("#s").val();
                var la = $("#la").val();
                var lb = $("#lb").val();
                var res = 0;
                var direccion = "<";
                var grafica = "/Resources/Public/normal";
                var valorX;
                if ($("#caso1").is(":checked"))
                {
                    direccion = "P(X&lt;" + lb + ")";
                    res = Probability.calculateNormal(m, s, la, lb, "<");
                    grafica += "inf.svg";
                    valorX = "<div style='text-align: left;'>" + direccion + "</div>";
                }
                else if ($("#caso2").is(":checked"))
                {
                    direccion = "P(" + la + "&lt;X&lt;" + lb + ")";
                    res = Probability.calculateNormal(m, s, la, lb, "<<");
                    grafica += "bi.svg";
                    valorX = "<div style='position: relative; float: left;'>P(X&lt;" + la + ")</div>";
                    valorX += "<div style='position: relative; float: right;'>P(X&lt;" + lb + ")</div>";
                }
                else if ($("#caso3").is(":checked"))
                {
                    direccion = "P(X&gt;" + la + ")";
                    res = Probability.calculateNormal(m, s, la, lb, ">");
                    grafica += "sup.svg";
                    valorX = "<div style='text-align: right;'>" + direccion + "</div>";
                }
                
                $("#graf").html("<embed src='" + BaseUrl + grafica + "' alt='Distribucion Normal' type='image/svg+xml' width=400px />");
                $("#valor").html(valorX);

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
    
    function mostrarLimInf ()
    {
        $("#limsup").fadeOut("slow", function (){
            $("#liminf").fadeIn("slow");
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
    
    function periodic () {/*SI NECESITAS HACER ALGO PERIODICO SE PONE AQUI*/}
    
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
                        <input id="caso1" name="tipo" type="radio" value="caso1" onclick="javascript:mostrarLimSup();" /></strong>
                    <strong><label for="caso2">P(a&lt;X&lt;b)</label>
                        <input id="caso2" name="tipo" type="radio" value="caso2" onclick="javascript:mostrarLimites();" /></strong>
                    <strong><label for="caso3">P(X&gt;x)</label>
                        <input id="caso3" name="tipo" type="radio" value="caso3" onclick="javascript:mostrarLimInf();" /></strong>
                </div>
                <div id="liminf" style="display: none;">
                    <label for="la" class="data">L&iacute;mite inferior:</label>
                    <input id="la" name="la" type="text" />
                </div>
                <div id="limsup" style="display: none;">
                    <label for="lb" class="data">L&iacute;mite superior:</label>
                    <input id="lb" name="lb" type="text" />
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