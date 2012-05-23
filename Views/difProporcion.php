<script type="text/javascript">
    var desc = ["El tamaño de la muestra no es la suficientemente grande para aproximar a la Normal","Poblacion Normal, Varianza poblacional(&sigma;&sup2;) conocida","Poblacion No Normal, Varianza poblacional(&sigma;&sup2;) conocida, Tamaño de muestra &ge; 30",
                "Poblacion Normal,Varianza poblacional(&sigma;&sup2;) desconocida","Poblacion No Normal, Varianza poblacional(&sigma;&sup2;) desconocida, Tamaño de muestra &ge; 30"]
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
                  min: 0.90,
                  max: 0.99
              },
              tamano1: {
                  required: true,
                  digits: true,
                  min: 1
              },
              p1: {
                 required: true,
                 number: true,
                 min:0
              },
              tamano2: {
                  required: true,
                  digits: true,
                  min: 1
              },
              p2: {
                 required: true,
                 number: true,
                 min:0
              }
          },
          messages: {
              alfa:{
                  required: "<br />Es obligatorio",
                  number: "<br />Se necesita un valor numerico",
                  min: "<br />Tan pequeño?",
                  max: "<br />Es un intervalo muy amplio. No crees?"
              },
              tamano1: {
                  required: "<br />Es obligatorio",
                  digits: "<br />Solo numero enteros",
                  min: "<br />Es imposible"
              },
              p1: {
                 required: "<br />Es obligatorio",
                 number: "Se necesita un valor numerico",
                 min: "Toda probabilidad es positiva"
              },
              tamano2: {
                  required: "<br />Es obligatorio",
                  digits: "<br />Solo numero enteros",
                  min: "<br />Es imposible"
              },
              p2: {
                 required: "<br />Es obligatorio",
                 number: "Se necesita un valor numerico",
                 min: "Toda probabilidad es positiva"
              }
              
          },
          submitHandler: function(){
              var alfa = 1-$("#alfa").val();
              var n1 = $("#tamano1").val();
              var n2 = $("#tamano2").val();
              var p1 = $("#p1").val();
              var p2 = $("#p2").val();
              var q1 = 1-p1;
              var q2 = 1-p2;
              if(n1*p1>=5 && n1*q1>=5 && n2*p2>=5 && n2*q2>=5){
                var z = NORMSINV(alfa/2);
                var zuni = NORMSINV(alfa);
                var amplitud = z*Math.sqrt(((p1*q1)/n1)+(p2*q2/n2));
                var amplituduni = zuni*Math.sqrt(((p1*q1)/n1)+(p2*q2/n2));
                var min = trimfloat((p1-p2)-amplitud,4);
                var may = trimfloat((p1-p2)+amplitud,4);
                var inf = trimfloat((p1-p2)-amplituduni,4);
                var sup = trimfloat((p1-p2)+amplituduni,4);
                var analisis;
                if(min<=0 && may>=0){
                    analisis = "p<sub>1</sub> y p<sub>2</sub> son estadisticamente <b>IGUALES</b>";
                }else if(may<0){
                    analisis = "p<sub>1</sub> es estadisticamente <b>MENOR</b> que p<sub>2</sub>"
                }else if(min>0){
                    analisis = "p<sub>1</sub> es estadisticamente <b>MAYOR</b> que p<sub>2</sub>"
                }
                $("#analisis").html(analisis);
                var res = $("#resultado");
                var cont = $("#modalDialog");
                res.width(cont.width()-$("#datos").width()-130);
                var intervalo = $("#intervalo");
                intervalo.html("<pre class='wrap'>"+min+"   &le;   p<sub>1</sub>-p<sub>2</sub>   &le;   "+may+"</pre>");
                $("#intTitle").html("Intervalo con un "+((1-alfa)*100)+"% de Confianza");
                $("#uniTitle").html("Limites Unilaterales");
                $("#unilateral").html("<pre class='wrap'>Inferior: "+inf+"<br>Superior: "+sup+"</pre>");
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
        $("#unilateral").width($("#unilateral").children().width()+20);
    }
    function periodic () {
        ajustarIntervalo();
        var x1 = $("#x1");
        var x2 = $("#x2");
        var n1 = $("#tamano1");
        var n2 = $("#tamano2");
        var p1 = $("#p1");
        var p2 = $("#p2");
        if(x1.val().length > 0 && n1.val().length > 0)
            p1.val((x1.val()/n1.val()));
        if(x2.val().length > 0 && n2.val().length > 0)
            p2.val((x2.val()/n2.val()));
        if(n1.val().length > 0 && p1.val().length > 0){
            var q1 = 1-p1.val();
            if(n1.val()*p1.val()<5 || n1.val()*q1<5){
                $("#errorNP1").show();
            }else{
                $("#errorNP1").hide();
            }
        }
        if(n2.val().length > 0 && p2.val().length > 0){
            var q2 = 1-p2.val();
            if(n2.val()*p2.val()<5 || n2.val()*q2<5){
                $("#errorNP2").show();
            }else{
                $("#errorNP2").hide();
            }
        }
            
    }
    
    function modalClosed() 
    {
        clearInterval(timmerPeriodic);
    }
</script>
<div class="estimacion">
    <div class="title2">Intervalo de Confianza para la Diferencia de Proporciones</div>
    <div class="title1">Datos</div>
    <div class="datos inlineB">
        <div style="padding: 5px 15px;">
        <form id="datos"> 
            <div id="divAlfa">
                <label for="alfa" class="data">Nivel de Confianza(1-&alpha;):</label>
                <input id="alfa" name="alfa" type="text"/>
            </div>
            <div id="divN">
                <label for="tamano1" class="data">Tama&ntilde;o de la muestra 1(n<sub>1</sub>):</label>
                <input id="tamano1" name="tamano1" type="text"/>
                <label for="tamano2" class="data">Tama&ntilde;o de la muestra 2(n<sub>2</sub>):</label>
                <input id="tamano2" name="tamano2" type="text"/>
            </div>
            <div id="divExitostos">
                <label for="x1" class="data">Exitos de Muestra 1(x<sub>1</sub>): </label>
                <input id="x1" name="x1" type="text"/>
                <label for="x2" class="data">Exitos de Muestra 2(x<sub>2</sub>): </label>
                <input id="x2" name="x2" type="text"/>
            </div>
            <div id="vmuestral">
                <label for="p1" class="data">Proporcion muestral 1(p&#x302;<sub>1</sub>): </label>
                <input id="p1" name="p1" type="text"/>
                <label for="p2" class="data">Proporcion muestral 2(p&#x302;<sub>2</sub>): </label>
                <input id="p2" name="p2" type="text"/>
            </div>
            <div id="errorNP1" class="error block" style="display: none;">n<sub>1</sub>p&#x302;<sub>1</sub> ó n<sub>1</sub>q&#x302;<sub>1</sub> &le; 5</div>
            <div id="errorNP2" class="error block" style="display: none;">n<sub>2</sub>p&#x302;<sub>2</sub> ó n<sub>2</sub>q&#x302;<sub>2</sub> &le; 5</div>
            <input type="submit" class="calcular" value="Calcular Intervalo" />
        </form>
        </div>
   </div>
    <div id="resultado"  class="inlineB" style="display: none;margin-left: 50px;">
        <div id="casoTipo" class="title1" style="margin-left: -15px">Intervalo</div>
        <div id="divIntervalo" style="display: hidden" class="wrap subdivRes">
            <div id="intTitle" class="resTitle">Intervalo</div>
            <div id="intervalo" class="wrap res"></div>
        </div>
        <div id="divGraphBi"></div>
        <br>
        <div id="analisis" class="wrap">            
        </div>
        <br>
        <div id="divUnilateral" class="wrap subdivRes">
            <div id="uniTitle" class="resTitle"></div>
            <div id="unilateral" class="wrap res"></div>
        </div>
        <br><div id="divGraphInf"></div>
        <br><div id="divGraphSup"></div>
        <br>
    </div>
    <div style="clear: left;"></div>
    <div class="title3">Resultado</div>
</div>
