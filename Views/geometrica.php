<script type="text/javascript">

    $(document).ready(function (){
        $("#datos").validate({
            rules: {
                p: {
                    required: true,
                    number: true,
                    min: 0,
                    max: 1
                },
                x: {
                    required: true,
                    number: true,
                    min: 1,
                    max: 1000
                },
                tipo: {
                    required: true
                }
            },
            messages: {
                p: {
                    required: "<br />Es obligatorio",
                    number: "<br />Se necesita un valor numerico",
                    min: "<br />No puede ser menor que 0",
                    max: "<br />No puede ser mayor que 1"
                },
                x: {
                    required: "<br />Es obligatorio",
                    number: "<br />Se necesita un valor numerico",
                    min: "<br />No puede ser menor que 1",
                    max: "<br />No puede ser mayor que n"
                }
            },
            submitHandler: function (){
                
                var p = $("#p").val();
                var x = $("#x").val();
                var direccion = "=";
                var res = 0;
                if ($("#puntual").is(":checked"))
                {
                    direccion = "=";
                    res = Probability.calculateGeometric(p, x, "=");
                }
                else if ($("#acuIzq").is(":checked"))
                {
                    direccion = "&le;";
                    res = Probability.calculateGeometric(p, x, "<");
                }
                else if ($("#acuDer").is(":checked"))
                {
                    direccion = "&ge;";
                    res = Probability.calculateGeometric(p, x, ">");
                }
                
                $("#calculoDP").html("P(X"+direccion+x+") = "+res);
            }
        });
    });
    
    function periodic () {/*SI NECESITAS HACER ALGO PERIODICO SE PONE AQUI*/}
    
    function modalClosed() 
    {
        clearInterval(timmerPeriodic);
    }

</script>

<div>
    
</div>
