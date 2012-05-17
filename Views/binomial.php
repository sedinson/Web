<script type="text/javascript">

    $(document).ready(function (){
        $("#datos").validate({
            rules: {
                n: {
                    required: true,
                    number: true,
                    min: 1
                },
                p: {
                    required: true,
                    number: true,
                    min: 0,
                    max: 1
                },
                x: {
                    required: true,
                    number: true
                },
                tipo: {
                    required: true
                }
            },
            messages: {
                n: {
                    required: "<br />Es obligatorio",
                    number: "<br />Se necesita un valor numerico",
                    min: "<br />No puede ser menor que 1"
                },
                p: {
                    required: "<br />Es obligatorio",
                    number: "<br />Se necesita un valor numerico",
                    min: "<br />No puede ser menor que 0",
                    max: "<br />No puede ser mayor que 1"
                },
                x: {
                    required: "<br />Es obligatorio",
                    number: "<br />Se necesita un valor numerico"
                }
            },
            submitHandler: function (){
                var n = $("#n").val();
                var p = $("#p").val();
                var x = $("#x").val();
                var direccion = "=";
                var res = 0;
                if ($("#puntual").is(":checked"))
                {
                    direccion = "=";
                    res = Probability.calculateBinomial(n, p, x, direccion);
                }
                else if ($("#acuIzq").is(":checked"))
                {
                    direccion = "<";
                    res = Probability.calculateBinomial(n, p, x, direccion);
                }
                else if ($("#acuDer").is(":checked"))
                {
                    direccion = ">";
                    res = Probability.calculateBinomial(n, p, x, direccion);
                }
                $("#formula").html("P( X "+direccion+" "+x+" ) = "+res);
            }
        });
    });

</script>

<div>
    <div class="title1">Distribuci&oacute;n Binomial</div>
    <div class="cuadroDatos">
        <form id="datos">
            <div>
                <label for="n">Tama&ntilde;o de la muestra (n):</label>
                <input id="n" name="n" type="text" />
            </div>
            <div>
                <label for="p">Probabilidad (p):</label>
                <input id="p" name="p" type="text" />
            </div>
            <div>
                <label for="x">Variable aleatoria (X):</label>
                <input id="x" name="x" type="text" />
            </div>
            <div>
                <label for="tipo">Tipo de probabilidad:</label>
                <br />
                <label for="puntual">Puntual</label>
                <input id="puntual" name="tipo" type="radio" checked="true" value="puntual" />
                <br />
                <label for="puntual">Acumulada a la izquierda</label>
                <input id="acuIzq" name="tipo" type="radio" value="izquierda" />
                <br />
                <label for="puntual">Acumulada a la derecha</label>
                <input id="acuDer" name="tipo" type="radio" value="derecha" />
            </div>
            <div>
                <input type="submit" class="calcular" value="Calcular Probabilidad" />
            </div>
        </form>
    </div>
    <div class="resultado">
        <div id="formula"></div>
    </div>
</div>
