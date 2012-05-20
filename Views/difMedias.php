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
              normal: {
                required: true  
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
              var z;
              var n = $("#tamano").val();
              var x = $("#miu").val();
              var sigma;
              var casetype;
              var des;
              var caso12 = false;
              if($("#consi:checked").val()=="si"){
                  sigma = Math.sqrt($("#varpoblacional").val());
                  z = NORMSINV(alfa/2);
                  if($("#siNorm:checked").val() == "si"){
                      casetype = "Tipo I";
                      des = 1;
                      caso12=true;
                  }else if(n>=30){
                      casetype = "Tipo II";
                      des = 2;
                      caso12=true;
                  }else{
                      casetype = "Desconocido";
                      $("#casoTipo").html(casetype);
                      $("#descCaso").html(desc[0]);
                      $("#resultado").fadeIn();
                      return false;
                  }
              }else{
                  sigma = $("#smuestral").val();
                  if($("#siNorm:checked").val() == "si"){
                      z= tStudentICDF(alfa/2,n-1);
                      casetype="Tipo III";
                      des = 3;
                  }else if(n>=30){
                      z = NORMSINV(alfa/2);
                      casetype="Tipo IV";
                      des = 4;
                  }else{
                      casetype = "Desconocido";
                      $("#casoTipo").html(caseType);
                      $("#descCaso").html(desc[0]);
                      $("#resultado").fadeIn();
                      return false;
                  }
              }
              
              var amplitud = z*sigma/Math.sqrt(n);
              var min = trimfloat(x - amplitud,4);
              var may = trimfloat(x*1 + amplitud,4);
              $("#casoTipo").html("Caso "+casetype);
              $("#descCaso").html(desc[des]);
              var res = $("#resultado");
              var cont = $("#modalDialog");
              res.width(cont.width()-580);
              var intervalo = $("#intervalo");
              intervalo.html("<pre class='wrap'>"+min+"   &le;   &micro;   &le;   "+may+"</pre>");
              $("#intTitle").html("Intervalo con un "+((1-alfa)*100)+"% de Confiabilidad");
              if(caso12){
                  $("#errorTitle").html("Error Muestral para n = "+n+" y &sigma; = "+sigma);
                  $("#errorM").html("<pre class='wrap'>|x&#772;-&micro;|   &le;   "+amplitud+"</pre>");
                  $("#divError").show();
              }
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
        $("#errorM").width($("#errorM").children().width()+20);
    }
    function periodic () {
        if($("#chkTabla:checked").val()=="tabla"){
            var text = $("#text");
            if(text.val().length > 0){
                
            }
        }
    }
    
    function modalClosed() 
    {
        clearInterval(timmerPeriodic);
    }
    function mostrarTabla(){
        if($("#chkTabla:checked").val()=="tabla")
            $("#tabla").fadeIn();
        else
            $("#tabla").fadeOut();
    }
    function mostrarVar(){
        $("#divSD")
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
            <div id="tablaDatos">
                <label for="chkTabla" class="data">Tabla</label>
                <input type="checkbox" name="tablaDatos" id="chkTabla" value="tabla" onclick="javascript: mostrarTabla();"/>
            </div>
            <div id="tabla" style="display: none">
                <textarea id="text" placeholder="Pegue aqui la tabla"></textarea>
            </div>
            <div id="divMedia">
                <label for="miu1" class="data">Media muestral(x&#772;<sub>1</sub>):</label>
                <input id="miu1" name="miu1" type="text"/>
                <label for="miu2" class="data">Media muestral(x&#772;<sub>2</sub>):</label>
                <input id="miu2" name="miu2" type="text"/>
            </div>
            <div id="divNormal">
                <label for="normal" class="data">Poblacion Normal? </label>
                <strong><label for="siNorm">Si</label>
                <input type="radio" id="siNorm" name="normal" value="si"></strong>
                <strong><label for="noNorm">No</label>
                <input type="radio" id="noNorm" name="normal" value="no"></strong>
                <label for="normal" class="error block"><br />Es obligatorio</label>
            </div>
            <div id="divN">
                <label for="tamano1" class="data">Tama&ntilde;o de la muestra 1(n<sub>1</sub>):</label>
                <input id="tamano1" name="tamano1" type="text"/>
                <label for="tamano2" class="data">Tama&ntilde;o de la muestra 2(n<sub>2</sub>):</label>
                <input id="tamano2" name="tamano2" type="text"/>
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
                <div id="vpoblacional" style="display: none">
                    <label for="varpoblacional" class="data">Varianza poblacional(&sigma;&sup2;<sub>1</sub>): </label>
                    <input id="varpoblacional1" name="varpoblacional" type="text"/>
                    <label for="varpoblacional2" class="data">Varianza poblacional(&sigma;&sup2;<sub>2</sub>): </label>
                    <input id="varpoblacional2" name="varpoblacional2" type="text"/>
                </div>
                <div id="vmuestral" style="display: none">
                    <label for="smuestral1" class="data">Varianza muestral(s<sub>1</sub>): </label>
                    <input id="smuestral1" name="smuestral1" type="text"/>
                    <label for="smuestra2" class="data">Varianza muestral(s<sub>2</sub>): </label>
                    <input id="smuestral2" name="smuestral2" type="text"/>
                </div>
            </div>
            <div id="divSD" style="display: none;">
                <label for="sd" class="data">S<sub>d</sub></label>
                <input id="sd" name="sd" type="text"/>
            </div>
            <input type="submit" class="calcular" value="Calcular Intervalo" />
        </form>
        </div>
   </div>
    <div id="resultado"  class="inlineB" style="display: none;margin-left: 50px;">
        <div id="casoTipo" class="title1" style="margin-left: -15px"></div>
        <h3 id="descCaso"></h3>
        <div id="divIntervalo" style="display: hidden" class="wrap subdivRes">
            <div id="intTitle" class="resTitle"></div>
            <div id="intervalo" class="wrap res"></div>
        </div>
        <br>
        <div id="divError" style="display: none" class="wrap subdivRes">
            <div id="errorTitle" class="resTitle"></div>
            <div id="errorM" class="wrap res"></div>
        </div>
        <br>
    </div>
</div>