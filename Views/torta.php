<script type="text/javascript">
    var graphics = new Graph(document.getElementById('grafica'));
    graphics.setData([11, 5, 14, 3, 12, 15, 16, 13, 22, 21, 23, 24, 19, 9, 9, 10, 6, 13, 6, 51, 32, 45, 40, 19, 39, 51]);
    graphics.setType(1);
    graphics.start();
    
    function periodic () 
    {
        var text = document.getElementById("text");
        if(text.value.length > 0) 
        {
            var data = text.value.split("\n");
            if(data.length > 0)
            {
                var tmp = [];
                for(var i=0; i<data.length; i++)
                {
                    if(data[i] != "")
                        tmp[i] =  parseFloat(data[i].replace(",", "."));
                }
            }
                graphics.setData(tmp);
            
            text.value = "";
            text.blur();
        }
    }
    
    function modalClosed() 
    {
        graphics.stop();
        graphics.stop();
    }
</script>
<div class="title1">Datos</div>
<div class="regular">
    <textarea id="text" placeholder="Pegue aqui la tabla"></textarea>
    <a href="#">Cargar contenido...</a>
</div>
<div id="grafica" class="shadowClear"></div>
<div style="clear: both;"></div>
<div class="title3">Gr&aacute;fica</div>