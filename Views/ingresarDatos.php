<script type="text/javascript">
    $(function() {
        $( "#tabs" ).tabs();
        $("#time").slider({range: "min", value: fps, min: 60, max: 1000, animate: true});
        $("#front").buttonset();
        $("#precision").val(Stat.p);
    });
    
    $("document").ready(function() {
        $("#btnConfigurar").click(function() {
            Stat.config($("#precision").val(), ($("input[name='radio']:checked").val() == "Si")? true : false);
            fps = $("#time").slider("value");
            alert("Configuraciones Guardadas!");
        });
        
        $("#datos-1").validate({
            rules:{
                txtList:{
                    required: true
                },
                txtnclass:{
                    required: true,
                    digits: true
                },
                txtli:{
                    required: true,
                    number: true
                },
                txtamp:{
                    required: true,
                    number: true
                }
            },
            messages:{
                txtList:{
                    required: ""
                },
                txtnclass:{
                    required: "Especifique N° Clases",
                    digits: "Debe ser Entero"
                },
                txtli:{
                    required: "Especifique LI",
                    number: "Debe ser Numérico"
                },
                txtamp:{
                    required: "Especifique Amplitud",
                    number: "Debe ser Numérico"
                }
            },
            submitHandler: function() {
                var c = parseInt($("#txtnclass").val());
                var li = parseInt($("#txtli").val());
                var w = parseInt($("#txtamp").val());
                var d = parseInt($("#txtList").val());
                var r = w * c;
                if((d-li)/w <= c && d-li >= 0) {
                    $("#txtLD").val($("#txtLD").val() + (($("#txtLD").val().length > 0)? "\n" : "") + d);
                    $("#txtList").val("");
                    $("#txtList").focus();
                } else {
                    alert("El dato " + d + " está fuera de los límites permitidos: " + li + " a " + r);
                    $("#txtList").val("");
                    $("#txtList").focus();
                }
                
            }
        });
        
        $("#datos-2").validate({
            rules:{
                txtclass:{
                    required: true
                },
                txtfrec:{
                    required: true,
                    digits: true
                }
            },
            messages:{
                txtclass:{
                    required: ""
                },
                txtfrec:{
                    required: "",
                    digits: ""
                }
            },
            submitHandler: function() {
                $("#txtLA").val($("#txtLA").val() + (($("#txtLA").val().length > 0)? "\n" : "") + $("#txtclass").val() + "\t" + $("#txtfrec").val());
                $("#txtclass").val("");
                $("#txtfrec").val("");
                $("#txtclass").focus();
            }
        });
    });
    function periodic() { }
    
    function modalClosed() 
    {
        clearInterval(timmerPeriodic);
    }
</script>
<div class="title2">Ingresar Datos Manualmente</div>
<div class="title1">Ingreso de Datos</div>
<div class="left">
    <div id="tabs">
        <ul>
            <li><a href="#tabs-1">Lista de Datos</a></li>
            <li><a href="#tabs-2">Lista de Agrupados</a></li>
	</ul>
        
        <div id="tabs-1">
            <form id="datos-1">
                <textarea id="txtLD" placeholder="Aqui van los datos ingresados" class="fillAll" style="height: 200px;"></textarea>
                <table class="fillAll">
                    <tr>
                        <td><input type="text" name="txtnclass" id="txtnclass" placeholder="Numero Clases" style="text-align: center;" class="fillAll" /></td>
                        <td><input type="text" name="txtli" id="txtli" placeholder="Limite Inferior" style="text-align: center;" class="fillAll" /></td>
                        <td><input type="text" name="txtamp" id="txtamp" placeholder="amplitud" style="text-align: center;" class="fillAll" /></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="text" id="txtList" name="txtList" placeholder="Digite Valor" class="fillAll" />
                        </td>
                        <td><input type="submit" value="Añadir Dato" /></td>
                    </tr>
                </table>
            </form>
            <input type="button" id="btnGenerar-1" value="Generar Tabla" style="float: right;" />
            <div style="clear: both;"></div>
        </div>
        
        <div id="tabs-2">
            <form id="datos-2">
                <textarea id="txtLA" placeholder="Aqui van los datos ingresados" class="fillAll" style="height: 200px;"></textarea>
                <table class="fillAll">
                    <tr>
                        <td><input type="text" id="txtclass" name="txtclass" placeholder="Digite Valor de x" class="fillAll" /></td>
                        <td><input type="text" id="txtfrec" name="txtfrec" placeholder="Digite su Frecuencia" class="fillAll" /></td>
                        <td><input type="submit" value="Añadir" /></td>
                    </tr>
                </table>
            </form>
            <input type="button" id="btnGenerar-2" value="Generar Tabla" style="float: right;" />
            <div style="clear: both;"></div>
        </div>
    </div>
</div>
<div class="right">
    <table id="tabla">
        <thead>
            <tr>
                <th>Configuraci&oacute;n</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tr>
            <th>Precisi&oacute;n</th>
            <td><input type="text" id="precision" class="fillAll" style="text-align: right;" /></td>
        </tr>
        <tr>
            <th>Usar Fronteras</th>
            <td>
                <div id="front" class="fillAll" style="text-align: center;">
                    <input type="radio" id="radio1" value="Si" name="radio" /><label for="radio1">Si</label>
                    <input type="radio" id="radio2" value="No" name="radio" checked="checked" /><label for="radio2">No</label>
                </div>
            </td>
        </tr>
        <tr>
            <th>Tiempo de Repintado</th>
            <td><div id="time" class="fillAll"></div></td>
        </tr>
    </table>
    <input type="button" id="btnConfigurar" value="Guardar Cambios" style="float: right;" />
</div>
<div style="clear: both;"></div>
<div class="title3">Configuraciones</div>