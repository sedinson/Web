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
                }
            },
            
            //Funcion que calcula la probabilidad
            submitHandler: function (){
                
                //Se valida el valor de b
                if (validarLB() == true)
                {
                    ocultarResultado();

                    var a = $("#la").val();
                    var b = $("#lb").val();
                    
                    var res = Probability.calculateContinuousUniform(a, b);

                    mostrarResultado();

                    $("#intTitle").html("El calculo es");
                    $("#calculoDP").html("<pre class='wrap'>P(" + a + "&lt;X&lt;" + b + ") = " + res + "</pre>");
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
    
    
    function periodic () {validarLB();}
    
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