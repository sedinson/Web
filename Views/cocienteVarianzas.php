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
              tamano1: {
                  required: true,
                  digits: true,
                  min: 1
              },
              smuestral1: {
                 required: true,
                 number: true,
                 min:0
              },
              tamano2: {
                  required: true,
                  digits: true,
                  min: 1
              },
              smuestral2: {
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
              smuestral1: {
                 required: "<br />Es obligatorio",
                 number: "Se necesita un valor numerico",
                 min: "Todo numero al cuadro es positivo verdad?"
              },
              tamano2: {
                  required: "<br />Es obligatorio",
                  digits: "<br />Solo numero enteros",
                  min: "<br />Es imposible"
              },
              smuestral2: {
                 required: "<br />Es obligatorio",
                 number: "Se necesita un valor numerico",
                 min: "Todo numero al cuadro es positivo verdad?"
              }
              
          },
          submitHandler: function(){
              var alfa = $("#alfa").val();
              var n1 = $("#tamano1").val();
              var n2 = $("#tamano2").val();
              var s1 = $("#smuestral1").val();
              var s2 = $("#smuestral2").val();
              var interval = cocienteVarianzas(s1,s2,n1,n2,alfa);
              var intervaluni = cocienteVarianzas(s1,s2,n2,alfa*2);
              var min = trimfloat(interval[0],4);
              var may = trimfloat(interval[1],4);
              var inf = trimfloat(intervaluni[0],4);
              var sup = trimfloat(intervaluni[1],4);
              var analisis;
              if(min<=1 && may>=1){
                  analisis = "&sigma;&sup2;<sub>1</sub> y &sigma;&sup2;<sub>2</sub> son estadisticamente <b>IGUALES</b>";
              }else if(may<1){
                  analisis = "&sigma;&sup2;<sub>1</sub> es estadisticamente <b>MENOR</b> que &sigma;&sup2;<sub>2</sub>"
              }else if(min>1){
                  analisis = "&sigma;&sup2;<sub>1</sub> es estadisticamente <b>MAYOR</b> que &sigma;&sup2;<sub>2</sub>"
              }
              $("#analisis").html(analisis);
              var res = $("#resultado");
              var cont = $("#modalDialog");
              res.width(cont.width()-580);
              var intervalo = $("#intervalo");
              intervalo.html("<pre class='wrap'>"+min+"   &le;   &sigma;&sup2;<sub>1</sub>/&sigma;&sup2;<sub>2</sub>   &le;   "+may+"</pre>");
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
    function periodic () {
        ajustarIntervalo();
        var text = $("#text");
        if(text.val().length > 0){
            getData(text.val());
            text.val("");
            text.blur();
        }
    }
    function getData(text){
        var lines = text.split("\n");
        $("#textError").hide();
        if(lines.length >= 2){
            var line0 = lines[0].split(" ");
            var line1 = lines[1].split(" ");
            if(line0.length>0 && line1.length>0){
                var med1,med2;
                var n1 = line0.length;
                var n2 = line1.length;
                var sum=0;
                for(var i=0;i<line0.length;i++){
                    try{
                        sum += parseFloat(line0[i]);
                    }catch(err) {
                        $("#textError").show();
                        return;
                    }
                }
                med1=sum/n1;
                sum=0;
                for(var i=0;i<line1.length;i++){
                    try{
                        sum += parseFloat(line1[i]);
                    }catch(err) {
                        $("#textError").show();
                        return;
                    }
                }
                med2=sum/n2;
                $("#tamano1").val(n1);
                $("#tamano2").val(n2);
                sum = 0;
                for(var i=0;i<n1;i++){
                    try{
                        sum += Math.pow((parseFloat(line0[i])-med1),2);
                    }catch(err){};
                }
                $("#smuestral1").val(sum/(n1-1));
                sum = 0
                for(var i=0;i<n2;i++){
                    try{
                        sum += Math.pow((parseFloat(line1[i])-med2),2);
                    }catch(err){};
                }
                $("#smuestral2").val(sum/(n2-1));                
            }
        }
    }
    
    function modalClosed() 
    {
        clearInterval(timmerPeriodic);
    }
</script>
<div class="estimacion">
    <div class="title2">Intervalo de Confianza para el Cociente de Varianzas</div>
    <div class="title1">Datos</div>
    <div class="datos inlineB">
        <div style="padding: 5px 15px;">
        <form id="datos"> 
            <div id="divAlfa">
                <label for="alfa" class="data">Nivel de Confianza(&alpha;):</label>
                <input id="alfa" name="alfa" type="text"/>
            </div>
            <div id="tabla">
                <textarea id="text" placeholder="Pegue aqui la tabla"></textarea>
                <label for="text" id="textError" class="error block">2 lineas. Datos separados por un espacio.</label>
            </div>
            <div id="divN">
                <label for="tamano1" class="data">Tama&ntilde;o de la muestra 1(n<sub>1</sub>):</label>
                <input id="tamano1" name="tamano1" type="text"/>
                <label for="tamano2" class="data">Tama&ntilde;o de la muestra 2(n<sub>2</sub>):</label>
                <input id="tamano2" name="tamano2" type="text"/>
            </div>
            <div id="vmuestral">
                <label for="smuestral1" class="data">Varianza muestral(s&sup2;<sub>1</sub>): </label>
                <input id="smuestral1" name="smuestral1" type="text"/>
                <label for="smuestral2" class="data">Varianza muestral(s&sup2;<sub>2</sub>): </label>
                <input id="smuestral2" name="smuestral2" type="text"/>
            </div>
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
        <br>
        <div id="analisis" class="wrap">            
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
