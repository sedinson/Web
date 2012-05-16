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
          submitHandler: function(){
              var alfa = $("#alfa").val();
              var n = $("#tamano").val();
              var chiMin = critchi(alfa/2,n-1);
              var chiMax = critchi(1-alfa/2,n-1);
              var s2 = $("#smuestral").val();
              var min = (n-1)*s2/chiMin;
              var may = (n-1)*s2/chiMax;
              var res = $("#resultado");
              var cont = $("#modalDialog");
              res.width(cont.width()-580);
              var intervalo = $("#intervalo");
              intervalo.html("<pre class='wrap'>"+min+"   &le;   &sigma;&sup2;   &le;   "+may+"</pre>");
              $("#intTitle").html("Intervalo con un "+((1-alfa)*100)+"% de Confiabilidad");
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
    }
    function periodic () {/*SI NECESITAS HACER ALGO PERIODICO SE PONE AQUI*/}
    
    function modalClosed() 
    {
        clearInterval(timmerPeriodic);
    }
</script>
<style type="text/css">
    body{
        color: #222;
    }
    h1{
        color: #BBB;
        text-shadow: 3px 3px 5px;
        font-size: 38px;
    }
    h2.data{
        background: #AAA;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
        font-size: 24px;
        margin: 0;
        margin-bottom: 10px;
        padding-left: 12px;
        width: 97.4%
    }
    input[type="text"], input[type="number"]{
        display: inline-block;
        text-align: right;
        width: 200px;
    }
    input[type="radio"]{
        margin-right: 10px;
    }
    pre{
        display: table;
    }
    strong{
        display: inline-block;
        font-weight: normal;
        margin-right: 40px;
        text-shadow: 1px 1px 3px #000;     
    }
    #divIntervalo{
        background-color: #AAA;
        border-radius: 10px;
        display: table;
        margin-bottom: 20px;
    }
    #resultado{
        background-image: linear-gradient(left , rgb(240,240,240) 0%, rgb(255,255,255) 15%, rgb(255,255,255) 85%, rgb(240,240,240) 100%);
        background-image: -o-linear-gradient(left , rgb(240,240,240) 0%, rgb(255,255,255) 15%, rgb(255,255,255) 85%, rgb(240,240,240) 100%);
        background-image: -moz-linear-gradient(left , rgb(240,240,240) 0%, rgb(255,255,255) 15%, rgb(255,255,255) 85%, rgb(240,240,240) 100%);
        background-image: -webkit-linear-gradient(left , rgb(240,240,240) 0%, rgb(255,255,255) 15%, rgb(255,255,255) 85%, rgb(240,240,240) 100%);
        background-image: -ms-linear-gradient(left , rgb(240,240,240) 0%, rgb(255,255,255) 15%, rgb(255,255,255) 85%, rgb(240,240,240) 100%);

        background-image: -webkit-gradient(
                linear,
                left bottom,
                right bottom,
                color-stop(0, rgb(240,240,240)),
                color-stop(0.15, rgb(255,255,255)),
                color-stop(0.85, rgb(255,255,255)),
                color-stop(1, rgb(240,240,240))
        );
        border-radius: 5px;
        box-shadow: 2px 2px 3px #999;
        text-align: center
    }
    #intervalo{
        background-image: linear-gradient(bottom, rgb(212,212,212) 0%, rgb(250,250,250) 15%);
        background-image: -o-linear-gradient(bottom, rgb(212,212,212) 0%, rgb(250,250,250) 15%);
        background-image: -moz-linear-gradient(bottom, rgb(212,212,212) 0%, rgb(250,250,250) 15%);
        background-image: -webkit-linear-gradient(bottom, rgb(212,212,212) 0%, rgb(250,250,250) 15%);
        background-image: -ms-linear-gradient(bottom, rgb(212,212,212) 0%, rgb(250,250,250) 15%);

        background-image: -webkit-gradient(
                linear,
                left bottom,
                left top,
                color-stop(0, rgb(212,212,212)),
                color-stop(0.15, rgb(250,250,250))
        );
        border-radius: 7px;
        box-shadow: 1px 1px 2px #444;
    }
    .calcular{
        background-image: linear-gradient(bottom, rgb(232,232,232) 8%, rgb(247,247,247) 54%);
        background-image: -o-linear-gradient(bottom, rgb(232,232,232) 8%, rgb(247,247,247) 54%);
        background-image: -moz-linear-gradient(bottom, rgb(232,232,232) 8%, rgb(247,247,247) 54%);
        background-image: -webkit-linear-gradient(bottom, rgb(232,232,232) 8%, rgb(247,247,247) 54%);
        background-image: -ms-linear-gradient(bottom, rgb(232,232,232) 8%, rgb(247,247,247) 54%);

        background-image: -webkit-gradient(
                linear,
                left bottom,
                left top,
                color-stop(0.08, rgb(232,232,232)),
                color-stop(0.54, rgb(247,247,247))
        );
        border: 1px solid #999;
        border-radius: 9px;
        box-shadow: 1px 1px 2px #444;
        color: #222;
        float: right;
        font-weight: bold;
        height: 30px;
        padding: 12px 7px 3px 7px;
    }
    .calcular:hover,.calcular:focus{
        background-image: linear-gradient(bottom, rgb(201,201,201) 8%, rgb(235,235,235) 54%);
        background-image: -o-linear-gradient(bottom, rgb(201,201,201) 8%, rgb(235,235,235) 54%);
        background-image: -moz-linear-gradient(bottom, rgb(201,201,201) 8%, rgb(235,235,235) 54%);
        background-image: -webkit-linear-gradient(bottom, rgb(201,201,201) 8%, rgb(235,235,235) 54%);
        background-image: -ms-linear-gradient(bottom, rgb(201,201,201) 8%, rgb(235,235,235) 54%);

        background-image: -webkit-gradient(
                linear,
                left bottom,
                left top,
                color-stop(0.08, rgb(201,201,201)),
                color-stop(0.54, rgb(235,235,235))
        );
        cursor: pointer;
    }
    .data{
       display: inline-block;
       text-align: left;
       text-shadow: 1px 1px 2px #000;
       width: 200px;
       
    }
    .datos{
        background-image: linear-gradient(bottom, rgb(201,201,201) 0%, rgb(237,237,237) 100%);
        background-image: -o-linear-gradient(bottom, rgb(201,201,201) 0%, rgb(237,237,237) 100%);
        background-image: -moz-linear-gradient(bottom, rgb(201,201,201) 0%, rgb(237,237,237) 100%);
        background-image: -webkit-linear-gradient(bottom, rgb(201,201,201) 0%, rgb(237,237,237) 100%);
        background-image: -ms-linear-gradient(bottom, rgb(201,201,201) 0%, rgb(237,237,237) 100%);

        background-image: -webkit-gradient(
                linear,
                left bottom,
                left top,
                color-stop(0, rgb(201,201,201)),
                color-stop(1, rgb(237,237,237))
        );
        border-radius: 5px;
        box-shadow: 2px 2px 3px #999;
        color: #FFF;
        margin-left: 30px;
        padding: 0;
        padding-bottom: 10px;
        width: 450px;
    }
    label.error{
        display: none;
        color: #ff6666;
        text-shadow: 1px 1px 3px #FFF;
    }
    input[type="text"].error{
        border: 1px solid red;    
    }
    .block{
        display: block;
    }
    .inlineB{
        display: inline-block;
        float: left;
    }
    .inline{
        display: inline;
        float: left;
    }
    .wrap{
        margin: 0 auto;
    }
</style>
<div>
    <div class="title1">Varianza</div>
    <div class="datos inlineB">
        <h2 class="data">Datos</h2>
        <div style="padding: 0 15px;"">
        <form id="datos"> 
            <div id="divAlfa">
                <label for="alfa" class="data">Nivel de Confiabilidad(&alpha;):</label>
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
        <div id="divIntervalo" style="display: hidden" class="wrap">
            <div id="intTitle">Intervalo</div>
            <div id="intervalo" class="wrap"></div>
        </div>
    </div>
</div>
