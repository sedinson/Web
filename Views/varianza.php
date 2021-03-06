<script type="text/javascript">

    $(document).ready(function (){
       $("#datos").validate({
          //Limites establecidos para los datos de entrada
          rules:{
              alfa:{
                  required: true,
                  number: true,
                  min: 0.90,
                  max: 0.99
              },
              tamano: {
                  required: true,
                  digits: true,
                  min: 1
              },
              smuestral: {
                 required: "#conno:checked",
                 number: true,
                 min:0
              }
          },
          
          //Mensajes de error en caso de violar los limites
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
              smuestral: {
                 required: "<br />Es obligatorio",
                 number: "Se necesita un valor numerico",
                 min: "Todo numero al cuadro es positivo verdad?"
              }
          },
          
          //Funcion que evalua el resultado del intervalo
          submitHandler: function(){
              var alfa = 1-$("#alfa").val();
              var n = $("#tamano").val();
              var chiMin = critchi(alfa/2,n-1);
              var chiMax = critchi(1-alfa/2,n-1);
              var chiMinUni = critchi(alfa,n-1);
              var chiMaxUni = critchi(1-alfa,n-1);
              var s2 = $("#smuestral").val();
              var min = trimfloat((n-1)*s2/chiMin,4);
              var inf = trimfloat((n-1)*s2/chiMinUni,4);
              var may = trimfloat((n-1)*s2/chiMax,4);
              var sup = trimfloat((n-1)*s2/chiMaxUni,4);
              var res = $("#resultado");
              var cont = $("#modalDialog");
              res.width(cont.width()-$("#datos").width()-130);
              var intervalo = $("#intervalo");
              
              //Se colocan los resultados en sus respectivas divisiones
              intervalo.html("<pre class='wrap'>"+min+"   &le;   &sigma;&sup2;   &le;   "+may+"</pre>");
              $("#intTitle").html("Intervalo con un "+((1-alfa)*100)+"% de Confianza");
              $("#uniTitle").html("Limites Unilaterales");
              $("#unilateral").html("<pre class='wrap'>Inferior: "+inf+"<br>Superior: "+sup+"</pre>");
              
              //Se muestra el Resultado
              res.slideUp(function(){
                  res.slideDown(function(){
                      $("#divIntervalo").fadeIn();
                  });
              });
              ajustarIntervalo();
          }
       });
    });
    
    //Funcion que acomoda el tamaño de las divisiones delos intervalos para que los cubra correctamente
    function ajustarIntervalo(){
        $("#intervalo").width($("#intervalo").children().width()+20);
        $("#unilateral").width($("#unilateral").children().width()+20);
    }
    
    //Esta funcion se llama periodicamente
    function periodic () {ajustarIntervalo()}
    
    function modalClosed() 
    {
        clearInterval(timmerPeriodic);
    }
</script>
<div class="estimacion">
    <div class="title2">Intervalo de Confianza para la Varianza</div>
    <div class="title1">Datos</div>
    <div class="datos inlineB">
        <div style="padding: 5px 15px;">
        <form id="datos"> 
            <div id="divAlfa">
                <label for="alfa" class="data">Nivel de Confianza(1-&alpha;):</label>
                <input id="alfa" name="alfa" type="text"/>
            </div>
            <div id="divN">
                <label for="tamano" class="data">Tama&ntilde;o de la muestra(n):</label>
                <input id="tamano" name="tamano" type="text"/>
            </div>
            <div id="divVar">                
                <label for="smuestral" class="data">Varianza muestral(s&sup2;): </label>
                <input id="smuestral" name="smuestral" type="text"/>
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
        <div id="divGraphBi"></div>
        <br>
        <div id="divUnilateral" class="wrap subdivRes">
            <div id="uniTitle" class="resTitle"></div>
            <div id="unilateral" class="wrap res"></div>
        </div>
        <br>
        <div id="divGraphInf"></div>
        <br>
        <div id="divGraphSup"></div>
        <br>
    </div>
    <div style="clear: left;"></div>
    <div class="title3">Resultado</div>
</div>
