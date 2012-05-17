<script type="text/javascript">
    $(document).load(function (){
        $("#vpoblacional").hide();
        $("#vmuestral").hide();
    });
    function mostrarVarP(){
        $("#vmuestral").fadeOut("slow", function(){
            $("#vpoblacional").fadeIn("slow");
        });
    };
    function mostrarVarM(){
        $("#vpoblacional").fadeOut("slow", function(){
            $("#vmuestral").fadeIn("slow");
        });
    };
    $(document).ready(function (){
       $("#datos").validate({
          rules:{
              alfa:{
                  required: true,
                  number: true,
                  min: 0.01,
                  max: 0.1
              },
              tamano: {
                  required: true,
                  digits: true,
                  min: 1
              },
              proporcion: {
                  required: true,
                  number: true,
                  min: 0,
                  max: 1
              }
          },
          messages: {
              alfa:{
                  required: "<br />Es obligatorio",
                  number: "<br />Se necesita un valor numerico",
                  min: "<br />Tan pequeño?",
                  max: "<br />Es un intervalo muy amplio. No crees?"
              },
              tamano: {
                  required: "<br />Es obligatorio",
                  digits: "<br />Solo numero enteros",
                  min: "<br />Es imposible"
              },
              proporcion: {
                  required: "<br />Es obligatorio",
                  number: "<br />Solo se permiten datos numericos",
                  min: "<br />No existen probabilidades negativas",
                  max: "<br />Proporcion 0&le;p&#x302;&le;1"
              }
          },
          submitHandler: function(){
            var n = $("#tamano").val();
            var p = $("#proporcion").val();
            if(n*p<5 || (1-p)*n<5){
                $("#nxp").show();
            }else{
                $("#nxp").hide();
                var alfa = $("#alfa").val();
                var q = 1-p;
                var z = NORMSINV(alfa/2);
                var amplitud = z*Math.sqrt(p*q/n);
                var min = p - amplitud;
                var may = p*1 + amplitud;
                var res = $("#resultado");
                var cont = $("#modalDialog");
                res.width(cont.width()-580);
                var intervalo = $("#intervalo");
                intervalo.html("<pre class='wrap'>"+min+"   &le;   p   &le;   "+may+"</pre>");
                $("#intTitle").html("Intervalo con un "+((1-alfa)*100)+"% de Confiabilidad");
                $("#errorTitle").html("Error Muestral para n = "+n+" y p&#x302; = "+p);
                $("#errorM").html("<pre class='wrap'>|p&#x302;-p|   &le;   "+amplitud+"</pre>");
                $("#maxNTitle").html("Tamaño maximo para e="+trimfloat(amplitud,4));
                $("#maxN").html("<pre class='wrap'>n   =   "+(Math.pow(z,2)/(4*Math.pow(amplitud,2)))+"</pre>");
                $("#divError").show();
                res.slideUp(function(){
                    res.slideDown(function(){
                        $("#divIntervalo").fadeIn();
                    });
                });
                ajustarIntervalo();
              }
          }
       });
    });
    function ajustarIntervalo(){
        $("#intervalo").width($("#intervalo").children().width()+20);
        $("#errorM").width($("#errorM").children().width()+20);
    }
    function periodic () {/*SI NECESITAS HACER ALGO PERIODICO SE PONE AQUI*/}
    
    function modalClosed() 
    {
        clearInterval(timmerPeriodic);
    }
    function actualizarP(){
        var n = $("#tamano");
        var x = $("#exitos");
        if($(n.val()!=null && x.val()>=0 && n.val()>0)){
            $("#proporcion").val($("#exitos").val()/$("#tamano").val())
        }
    }
    function verificarP(){
        var n = $("#tamano");
        var p = $("#proporcion");
        if(n!=null){
            if(n.val()*p.val()<5 || (1-p.val())*n.val()<5){
                $("#nxp").show();
            }else{
                $("#nxp").hide();
            }
        }
    }
</script>
<div class="estimacion">
    <div class="title1">Media</div>
    <div class="datos inlineB">
        <h2 class="data">Datos</h2>
        <div style="padding: 0 15px;">
        <form id="datos"> 
            <div id="divAlfa">
                <label for="alfa" class="data">Nivel de Confiabilidad(&alpha;):</label>
                <input id="alfa" name="alfa" type="text"/>
            </div>
            <div id="divN">
                <label for="tamano" class="data">Tama&ntilde;o de la muestra(n):</label>
                <input id="tamano" name="tamano" type="text" onchange="javascript: actualizarP();"/>
            </div>
            <div id="divExitos">
                <label for="exitos" class="data">Numero de exitos(x): </label>
                <input type="text" id="exitos" name="exitos" onchange="javascript: actualizarP();"/>
            </div>
            <div id="divP">
                <label for="proporcion" class="data">Proporcion muestral(p&#x302;)</label>
                <input type="text" id="proporcion" name="proporcion" onchange="javascript: verificarP();"/>
                <label class="error" id="nxp" style="display: none;">El tamaño de la muestra es muy pequeño</label>
            </div>
            <input type="submit" class="calcular" value="Calcular Intervalo" />
        </form>
        </div>
   </div>
    <div id="resultado"  class="inlineB" style="display: none;margin-left: 50px;">
        <div id="casoTipo" class="title1" style="margin-left: -15px">Intervalo</div>
        <h3 id="descCaso"></h3>
        <div id="divIntervalo" style="display: hidden" class="wrap subdivRes">
            <div id="intTitle" class="resTitle"></div>
            <div id="intervalo" class="wrap res"></div>
        </div>
        <br>
        <div id="divError" style="display: none" class="wrap subdivRes">
            <div id="errorTitle" class="resTitle"></div>
            <div id="errorM" class="wrap res"></div>
            <div id="maxNTitle" class="resTitle"></div>
            <div id="maxN" class="wrap res"></div>
        </div>
        <br>
    </div>
</div>
