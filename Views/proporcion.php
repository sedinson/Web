<script type="text/javascript">

    $(document).ready(function (){
       $("#datos").validate({
           
           //Limites establecidos para los datos de Entrada
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
              proporcion: {
                  required: true,
                  number: true,
                  min: 0,
                  max: 1
              }
          },
          
          //Mensaje de error en caso de violar los limites
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
          
          //Funcion que se encarga de calcular el resultado del Intervalo
          submitHandler: function(){
            var n = $("#tamano").val();
            var p = $("#proporcion").val();
            
            //Verifica que se cumpa que np y nq sean mayor o igual a 5 en caso contrario muestra un error
            if(n*p<5 || (1-p)*n<5){
                $("#nxp").show();
            }else{
                $("#nxp").hide();
                var alfa = 1-$("#alfa").val();
                var q = 1-p;
                var z = NORMSINV(alfa/2);
                var zuni = NORMSINV(alfa);
                var amplitud = z*Math.sqrt(p*q/n);
                var amplituduni = zuni*Math.sqrt(p*q/n);
                var min = trimfloat(p - amplitud,4);
                var may = trimfloat(p*1 + amplitud,4);
                var inf = trimfloat(p - amplituduni,4);
                var res = $("#resultado");
                var cont = $("#modalDialog");
                res.width(cont.width()-$("#datos").width()-130);
                var intervalo = $("#intervalo");
                
                //Se colocan los resultados en sus respectivas Divisiones
                intervalo.html("<pre class='wrap'>"+min+"   &le;   p   &le;   "+may+"</pre>");
                $("#intTitle").html("Intervalo con un "+((1-alfa)*100)+"% de Confianza");
                $("#errorTitle").html("Error Muestral para n = "+n+" y p&#x302; = "+p);
                $("#errorM").html("<pre class='wrap'>|p&#x302;-p|   &le;   "+amplitud+"</pre>");
                $("#maxNTitle").html("Tamaño maximo para e="+trimfloat(amplitud,4));
                $("#maxN").html("<pre class='wrap'>n   =   "+(Math.pow(z,2)/(4*Math.pow(amplitud,2)))+"</pre>");
                $("#divError").show();
                $("#uniTitle").html("Limites Unilaterales");
                $("#unilateral").html("<pre class='wrap'>Inferior: "+inf+"<br>Superior: "+sup+"</pre>");
                
                //Se muestra el resultado
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
    
    //Funcion que se encarga de mantener el tamaño adecuado para las divisiones que contienen los reusltados
    function ajustarIntervalo(){
        $("#intervalo").width($("#intervalo").children().width()+20);
        $("#errorM").width($("#errorM").children().width()+20);
        $("#unilateral").width($("#unilateral").children().width()+20);
    }
    
    //Esta funcion se llama periodicamente
    function periodic () {
        ajustarIntervalo()
        actualizarP();
    }
    
    function modalClosed() 
    {
        clearInterval(timmerPeriodic);
    }
    
    //Funcion establece el valor de p basado en x/n
    function actualizarP(){
        var n = $("#tamano");
        var x = $("#exitos");
        if($(n.val().length>0 && x.val().length>0 && n.val()>0)){
            $("#proporcion").val($("#exitos").val()/$("#tamano").val())
        }
    }
    
    //Verfica que np y nq sean mayor o igual a 5
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
    <div class="title2">Intervalo de Confianza para Proporci&oacute;n</div>
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
        <div id="divGraphBi"></div>
        <br>
        <div id="divError" style="display: none" class="wrap subdivRes">
            <div id="errorTitle" class="resTitle"></div>
            <div id="errorM" class="wrap res"></div>
            <div id="maxNTitle" class="resTitle"></div>
            <div id="maxN" class="wrap res"></div>
        </div>
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
