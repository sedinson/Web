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
                  required: true
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
              smuestral: {
                 required: "#conno:checked",
                 number: true
              }
          },
          messages: {
              alfa:{
                  required: "<br />Es obligatorio"
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
              smuestral: {
                 required: "<br />Es obligatorio",
                 number: "Se necesita un valor numerico"
              }
          },
          submitHandler: function(){
              var alfa = $("#alfa")[0].selectedIndex;
              var n = $("#tamano")[0].selectedIndex;
              var x = $("#miu").val();
              var sigma = $("#smuestral").val();
              var k,kuni;
              if($("#gamma")[0].selectedIndex == 1){
                  k = matrizbi01[n][alfa];
                  kuni = matrizuni01[n][alfa];
              }else{
                  k = matrizbi05[n][alfa];
                  kuni = matrizuni05[n][alfa];
              }              
              var amplitud = k*sigma;
              var amplituduni = kuni*sigma;
              var min = trimfloat(x - amplitud,4);
              var may = trimfloat(x*1 + amplitud,4);
              var inf = trimfloat(x - amplituduni,4);
              var sup = trimfloat(x*1 + amplituduni,4);
              var res = $("#resultado");
              var cont = $("#modalDialog");
              res.width(cont.width()-580);
              var intervalo = $("#intervalo");
              intervalo.html("<pre class='wrap'>"+min+"   &le;   x   &le;   "+may+"</pre>");
              $("#intTitle").html("Intervalo con un "+((1-$("#gamma")[0].options[$("#gamma")[0].selectedIndex].value)*100)+"% de Confianza<br>Contiene "+($("#alfa")[0].options[alfa].value*100)+"% de la Poblaci&oacute;n");
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
    <div class="title2">Intervalo de Tolerancia para Poblacion Normal</div>
    <div class="title1">Datos</div>
    <div class="datos inlineB">        
        <div style="padding: 5px 15px;">
        <form id="datos"> 
            <div id="divAlfa">
                <label for="alfa" class="data">Porcentaje de Mediciones(1-&alpha;):</label>
                <select id="alfa" name="alfa">
                    <option value=0.90>90%</option>
                    <option value=0.95>95%</option>
                    <option value=0.99>99%</option>
                </select> 
            </div>
            <div id="divGamma">
                <label for="gamma" class="data">Nivel de Confianza(&gamma;):</label>
                <select id="gamma" name="gamma">
                    <option value=0.05>0.05</option>
                    <option value=0.01>0.01</option>
                </select> 
            </div>
            <div id="divMedia">
                <label for="miu" class="data">Media muestral(x&#772;):</label>
                <input id="miu" name="miu" type="text"/>
            </div>
            <div id="divN">
                <label for="tamano" class="data">Tama&ntilde;o de la muestra(n):</label>
                <select id="tamano" name="tamano">
                    <option value=2>2</option>
                    <option value=3>3</option>
                    <option value=4>4</option>
                    <option value=5>5</option>
                    <option value=6>6</option>
                    <option value=7>7</option>
                    <option value=8>8</option>
                    <option value=9>9</option>
                    <option value=10>10</option>
                    <option value=11>11</option>
                    <option value=12>12</option>
                    <option value=13>14</option>
                    <option value=14>15</option>
                    <option value=15>15</option>
                    <option value=16>16</option>
                    <option value=17>17</option>
                    <option value=18>18</option>
                    <option value=19>19</option>
                    <option value=20>20</option>
                    <option value=25>25</option>
                    <option value=30>30</option>
                    <option value=35>35</option>
                    <option value=40>40</option>
                    <option value=45>45</option>
                    <option value=50>50</option>
                    <option value=60>60</option>
                    <option value=70>70</option>
                    <option value=80>80</option>
                    <option value=90>90</option>
                    <option value=100>100</option>
                    <option value=150>150</option>
                    <option value=200>200</option>
                    <option value=250>250</option>
                    <option value=300>300</option>
                    <option value=Infinity>Infinity</option>
                </select> 
            </div>            
            <div id="vmuestral">
                <label for="smuestral" class="data">Desviaci&oacute;n estandar muestral(s): </label>
                <input id="smuestral" name="smuestral" type="text"/>
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
