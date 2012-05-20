<script type="text/javascript">
    var desc = ["Poblaciones Normales, Varianzas poblacional(&sigma;&sup2;) conocidas","Poblaciones Normales, Varianzas poblacionales(&sigma;&sup2;) desconocidas, pero estadisticamente iguales",
                "Poblaciones Normales,Varianzas poblacionales(&sigma;&sup2;) desconocidas, pero estadisticamente diferentes","Muestras Dependientes"]
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
              tamano1: {
                  required: true,
                  digits: true,
                  min: 1
              },
              conocida: {
                  required: "#indsi:checked"
              },
              varpoblacional1: {
                  required: function(element){
                      return $("#consi:checked").val()=="si" && $("#indsi:checked").val()=="si";
                  },
                  number: true,
                  min: 0
              },
              smuestral1: {
                 required: function(element){
                      return $("#consi:checked").val()=="si" && $("#indsi:checked").val()=="si";
                  },
                 number: true,
                 min: 0
              },
              tamano2: {
                  required: "#indsi:checked",
                  digits: true,
                  min: 1
              },
              varpoblacional2: {
                  required: function(element){
                      return $("#consi:checked").val()=="si" && $("#indsi:checked").val()=="si";
                  },
                  number: true,
                  min: 0
              },
              smuestral2: {
                 required: function(element){
                      return $("#consi:checked").val()=="si" && $("#indsi:checked").val()=="si";
                  },
                 number: true,
                 min: 0
              },
              sd: {
                  required: "#indno:checked",
                  number: true,
                  min: 0
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
              tamano1: {
                  required: "<br />Es obligatorio",
                  digits: "<br />Solo numero enteros",
                  min: "<br />Es imposible"
              },
              varpoblacional1: {
                  required: "<br />Es obligatorio",
                  number: "<br />Se necesita un valor numerico",
                  min: "<br />Todo numero al cuadrado es positivo verdad?"
              },
              smuestral1: {
                 required: "<br />Es obligatorio",
                 number: "<br />Se necesita un valor numerico",
                 min: "<br />Todo numero al cuadrado es positivo verdad?"
              },
              tamano2: {
                  required: "<br />Es obligatorio",
                  digits: "<br />Solo numero enteros",
                  min: "<br />Es imposible"
              },
              varpoblacional2: {
                  required: "<br />Es obligatorio",
                  number: "<br />Se necesita un valor numerico",
                  min: "<br />Todo numero al cuadrado es positivo verdad?"
              },
              smuestral2: {
                 required: "<br />Es obligatorio",
                 number: "<br />Se necesita un valor numerico",
                 min: "<br />Todo numero al cuadrado es positivo verdad?"
              },
              sd: {
                required: "<br />Es obligatorio",
                number: "<br />Se necesita un valor numerico",
                min: "<br />Todo numero al cuadrado es positivo verdad?"
              }
          },
          submitHandler: function(){
              calcularIntervalo();
          }
       });
    });
    function calcularIntervalo(){
        var alfa = $("#alfa").val();
        var z;
        var n1 = $("#tamano1").val();
        var difmed = $("#miu").val();
        var casetype;
        var des;
        var amplitud;
        if($("#indsi:checked").val()=="si"){
            var sigma1;
            var sigma2;
            var n2 = $("#tamano2").val();
            if($("#consi:checked").val()=="si"){
                sigma1 = $("#varpoblacional1").val();
                sigma2 = $("#varpoblacional2").val();
                z = NORMSINV(alfa/2);
                casetype="Caso Tipo I y II";
                des=0;
                amplitud = z*Math.sqrt(sigma1/n1+sigma2/n2);                    

            }else{
                sigma1 = $("#smuestral1").val();
                sigma2 = $("#smuestral2").val();
                var interval = cocienteVarianzas(sigma1,sigma2,n1,n2,alfa);
                if(varianzasIguales(interval)){
                    casetype = "Caso Tipo III";
                    des=1;
                    z = tStudentICDF(alfa/2,n1+n2-2);
                    var sp = ((n1-1)*sigma1+(n2-1)*sigma2)/(n1+n2-2);
                    amplitud = z*Math.sqrt(sp*((1/n1)+(1/n2)));
                }else{
                    casetype = "Caso Tipo IV";
                    des=2;
                    var v = Math.pow((sigma1/n1)+(sigma2/n2),2)/((Math.pow(sigma1/n1,2)/(n1-1))+(Math.pow(sigma2/n2,2)/(n2-1)));
                    z = tStudentICDF(alfa/2,v);
                    amplitud = z*Math.sqrt((sigma1/n1)+(sigma2/n2));                            
                }                 
            }
        }else{
            var sd = $("#sd").val();
            casetype = "Caso Tipo V";
            des = 3;
            z = tStudentICDF(alfa/2,n1-1);
            amplitud = z*(sd/Math.sqrt(n1));
        }
        var min = trimfloat(difmed - amplitud,4);
        var may = trimfloat(difmed*1 + amplitud,4);
        $("#casoTipo").html(casetype);
        var analisis;
        if(min<=0 && may>=0){
            analisis = "&micro;<sub>1</sub> y &micro;<sub>2</sub> son estadisticamente <b>IGUALES</b>";
        }else if(may<0){
            analisis = "&micro;<sub>1</sub> es estadisticamente <b>MENOR</b> que &micro;<sub>2</sub>"
        }else if(min>0){
            analisis = "&micro;<sub>1</sub> es estadisticamente <b>MAYOR</b> que &micro;<sub>2</sub>"
        }
        $("#analisis").html(analisis);
        $("#descCaso").html(desc[des]);
        var res = $("#resultado");
        var cont = $("#modalDialog");
        res.width(cont.width()-580);
        var intervalo = $("#intervalo");
        intervalo.html("<pre class='wrap'>"+min+"   &le;   &micro;<sub>1</sub>-&micro;<sub>2</sub>   &le;   "+may+"</pre>");
        $("#intTitle").html("Intervalo con un "+((1-alfa)*100)+"% de Confianza");
        res.slideUp(function(){
            res.slideDown(function(){
                $("#divIntervalo").fadeIn();
            });
        });
        ajustarIntervalo();
    }
    function ajustarIntervalo(){
        $("#intervalo").width($("#intervalo").children().width()+20);
    }
    function periodic () {
        ajustarIntervalo();
        if($("#consi:checked").val()=="si" || $("#conno:checked").val()=="no")
            $("#masDatos").fadeIn();
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
                var difmed = med1*1-med2*1;
                $("#miu1").val(med1);
                $("#tamano1").val(n1);
                $("#miu2").val(med2);
                $("#tamano2").val(n2);
                $("#miu").val(difmed);
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
                sum = 0
                for(var i=0;i<n1;i++){
                    try{
                        sum += Math.pow((parseFloat(line0[i])-parseFloat(line1[i]))-difmed,2);
                    }catch(err){};
                }
                $("#sd").val(Math.sqrt(sum/(n1-1)));
            }
        }
    }
    function modalClosed() 
    {
        clearInterval(timmerPeriodic);
    }
    function mostrarVar(){
        $("#divVarInd").fadeIn();
        $("#divtamano2").fadeIn();
        $("#lmiu").html("Diferencia de Medias(x&#772;<sub>1</sub>-x&#772;<sub>2</sub>):");
        $("#ltamano1").html("Tama&ntilde;o de la muestra 1(n<sub>1</sub>):");
        $("#divSD").fadeOut(function(){
            $("#divVar").fadeIn();
        });
        
    }
    function mostrarSd(){ 
        $("#masDatos").fadeIn( function(){
            $("#divVarInd").fadeOut();
            $("#divtamano2").fadeOut();
            $("#lmiu").html("Diferencia de Medias(d): ");
            $("#ltamano1").html("Tama&ntilde;o de la muestra(n): ");
            $("#divVar").fadeOut(function(){
                $("#divSD").fadeIn();
            });
        });        
    }
</script>
<div class="estimacion">
    <div class="title2">Intervalo de Confianza para la Diferencia de Medias</div>
    <div class="title1">Datos</div>
    <div class="datos inlineB">
        <div style="padding: 0 15px;">
        <form id="datos"> 
            <div id="divAlfa">
                <label for="alfa" class="data">Nivel de Confianza(&alpha;):</label>
                <input id="alfa" name="alfa" type="text"/>
            </div>
            <div id="divInd">
                <label for="independientes" class="data">Muestras independientes?</label>
                <strong><label for="indsi">Si</label>
                <input type="radio" id="indsi" name="independientes" value="si" onclick="javascript: mostrarVar();" /></strong>
                <strong><label for="indno">No</label>
                <input type="radio" id="indno" name="independientes" value="no" onclick="javascript: mostrarSd();" /></strong>
                <label for="independientes" class="error block"><br />Es obligatorio</label>
            </div>
            <div id="divVar" style="display: none;">
                <label for="conocida" class="data">Varianza poblacional(&sigma;&sup2;) conocida?</label>
                <strong><label for="consi">Si</label>
                <input type="radio" id="consi" name="conocida" value="si" onclick="javascript: mostrarVarP();" /></strong>
                <strong><label for="conno">No</label>
                <input type="radio" id="conno" name="conocida" value="no" onclick="javascript: mostrarVarM();" /></strong>
                <label for="conocida" class="error block"><br />Es obligatorio</label>
            </div>
            <div id="masDatos" style="display: none">
                <div id="tabla">
                    <textarea id="text" placeholder="Pegue aqui la tabla"></textarea>
                    <label for="text" id="textError" class="error block">2 lineas. Datos separados por un espacio.</label>
                </div>
                <div id="divMedia">
                    <label for="miu1" class="data">Media muestral(x&#772;<sub>1</sub>):</label>
                    <input id="miu1" name="miu1" type="text"/>
                    <label for="miu2" class="data">Media muestral(x&#772;<sub>2</sub>):</label>
                    <input id="miu2" name="miu2" type="text"/>
                    <label for="miu" class="data" id="lmiu">Diferencia de Medias(x&#772;<sub>1</sub>-x&#772;<sub>2</sub>):</label>
                    <input id="miu" name="miu" type="text"/>
                </div>
                <div id="divN">
                    <label for="tamano1" class="data" id="ltamano1">Tama&ntilde;o de la muestra 1(n<sub>1</sub>):</label>
                    <input id="tamano1" name="tamano1" type="text"/>
                    <div id="divtamano2">
                        <label for="tamano2" class="data">Tama&ntilde;o de la muestra 2(n<sub>2</sub>):</label>
                        <input id="tamano2" name="tamano2" type="text"/>
                    </div>
                </div>
                <div id="divVarInd">
                    <div id="vpoblacional" style="display: none">
                        <label for="varpoblacional1" class="data">Varianza poblacional(&sigma;&sup2;<sub>1</sub>): </label>
                        <input id="varpoblacional1" name="varpoblacional1" type="text"/>
                        <label for="varpoblacional2" class="data">Varianza poblacional(&sigma;&sup2;<sub>2</sub>): </label>
                        <input id="varpoblacional2" name="varpoblacional2" type="text"/>
                    </div>
                    <div id="vmuestral" style="display: none">
                        <label for="smuestral1" class="data">Varianza muestral(s&sup2;<sub>1</sub>): </label>
                        <input id="smuestral1" name="smuestral1" type="text"/>
                        <label for="smuestral2" class="data">Varianza muestral(s&sup2;<sub>2</sub>): </label>
                        <input id="smuestral2" name="smuestral2" type="text"/>
                    </div>
                </div>
                <div id="divSD" style="display: none;">
                    <label for="sd" class="data">Desviacion estandar(S<sub>d</sub>)</label>
                    <input id="sd" name="sd" type="text"/>
                </div>
                <input type="submit" class="calcular" value="Calcular Intervalo" />
            </div>
        </form>
        </div>
   </div>
    <div id="resultado"  class="inlineB" style="display: none;margin-left: 50px;">
        <div id="casoTipo" class="title1" style="margin-left: -15px"></div>
        <h3 id="descCaso"></h3>
        <div id="divIntervalo" style="display: none" class="wrap subdivRes">
            <div id="intTitle" class="resTitle"></div>
            <div id="intervalo" class="wrap res"></div>
        </div>
        <br>
        <div id="analisis" class="wrap">            
        </div>
        <br>
    </div>
    <div style="clear: left;"></div>
    <div class="title3">Resultado</div>
</div>
