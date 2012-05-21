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
                  min: 0.01,
                  max: 0.1
              },
              miu: {
                required: true,
                number: true
              },
              tamano: {
                  required: true,
                  digits: true,
                  min: 1
              },
              conocida: {
                  required: true
              },
              varpoblacional: {
                  required: "#consi:checked",
                  number: true,
                  min: 0
              },
              smuestral: {
                 required: "#conno:checked",
                 number: true
              }
          },
          messages: {
              alfa:{
                  required: "<br />Es obligatorio",
                  number: "<br />Se necesita un valor numerico",
                  min: "<br />Tan pequeño?",
                  max: "<br />Es un intervalo muy amplio. No crees?"
              },
              miu: {
                required: "<br />Es obligatorio",
                number: "<br />Se necesita un valor numerico"
              },
              tamano: {
                  required: "<br />Es obligatorio",
                  digits: "<br />Solo numero enteros",
                  min: "<br />Es imposible"
              },
              varpoblacional: {
                  required: "<br />Es obligatorio",
                  number: "<br />Se necesita un valor numerico",
                  min: "<br />Todo numero al cuadrado es positivo verdad?"
              },
              smuestral: {
                 required: "<br />Es obligatorio",
                 number: "Se necesita un valor numerico"
              }
          },
          submitHandler: function(){
              var alfa = $("#alfa").val();
              var z,zuni;
              var n = $("#tamano").val();
              var x = $("#miu").val();
              var sigma;
              if($("#consi:checked").val() == "si"){
                  sigma = Math.sqrt($("varpoblacional").val());
                  z = NORMSINV(alfa/2);
                  zuni = NORMSINV(alfa);
              }else{
                  sigma = $("#smuestral").val();
                  z = tStudentICDF(alfa/2, n-1);
                  zuni = tStudentICDF(alfa, n-1);
              }
              
              var amplitud = z*sigma/Math.sqrt(1+(1/n));
              var amplituduni = zuni*sigma/Math.sqrt(1+(1/n))
              var min = trimfloat(x - amplitud,4);
              var may = trimfloat(x*1 + amplitud,4);
              var inf = trimfloat(x - amplituduni,4);
              var sup = trimfloat(x*1 + amplituduni,4);
              var res = $("#resultado");
              var cont = $("#modalDialog");
              res.width(cont.width()-580);
              var intervalo = $("#intervalo");
              intervalo.html("<pre class='wrap'>"+min+"   &le;   x<sub>0</sub>   &le;   "+may+"</pre>");
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
       });
    });
    function ajustarIntervalo(){
        $("#intervalo").width($("#intervalo").children().width()+20);
        $("#unilateral").width($("#unilateral").children().width()+20);
    }
    function periodic () {ajustarIntervalo()}
    
    function modalClosed() 
    {
        clearInterval(timmerPeriodic);
    }
</script>
<div class="estimacion">
    <div class="title2">Intervalo de Prediccion para Poblacion Normal</div>
    <div class="title1">Datos</div>
    <div class="datos inlineB">        
        <div style="padding: 5px 15px;">
        <form id="datos"> 
            <div id="divAlfa">
                <label for="alfa" class="data">Nivel de Confianza(&alpha;):</label>
                <input id="alfa" name="alfa" type="text"/>
            </div>
            <div id="divMedia">
                <label for="miu" class="data">Media muestral(x&#772;):</label>
                <input id="miu" name="miu" type="text"/>
            </div>
            <div id="divN">
                <label for="tamano" class="data">Tama&ntilde;o de la muestra(n):</label>
                <input id="tamano" name="tamano" type="text"/>
            </div>
            <div id="divVar">
                <label for="conocida" class="data">Varianza poblacional(&sigma;&sup2;) conocida?</label>
                <strong><label for="consi">Si</label>
                <input type="radio" id="consi" name="conocida" value="si" onclick="javascript: mostrarVarP();" /></strong>
                <strong><label for="conno">No</label>
                <input type="radio" id="conno" name="conocida" value="no" onclick="javascript: mostrarVarM();" /></strong>
                <label for="conocida" class="error block"><br />Es obligatorio</label>
                <div id="vpoblacional" style="display: none">
                    <label for="varpoblacional" class="data">Varianza poblacional(&sigma;&sup2;): </label>
                    <input id="varpoblacional" name="varpoblacional" type="text"/>
                </div>
                <div id="vmuestral" style="display: none">
                    <label for="smuestral" class="data">Desviaci&oacute;n estandar muestral(s): </label>
                    <input id="smuestral" name="smuestral" type="text"/>
                </div>
            </div>
            <input type="submit" class="calcular" value="Calcular Intervalo" />
        </form>
        </div>
   </div>
    <div id="resultado"  class="inlineB" style="display: none;margin-left: 50px;">
        <div id="casoTipo" class="title1" style="margin-left: -15px">Intervalo</div>
        <div id="divIntervalo" style="display: hidden" class="wrap subdivRes">
            <div id="intTitle" class="resTitle"></div>
            <div id="intervalo" class="wrap res"></div>
        </div>
        <br>
        <div id="divUnilateral" class="wrap subdivRes">
            <div id="uniTitle" class="resTitle"></div>
            <div id="unilateral" class="wrap res"></div>
        </div>
        <br>
    </div>
    <div style="clear: left;"></div>
    <div class="title3">Resultado</div>
</div>
