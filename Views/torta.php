<script type="text/javascript">
    var graphics = new Graph(document.getElementById('grafica'));
    graphics.setData([[11, 5], [14, 3], [12, 19], [9, 9], [10, 6], [13, 6]]);
    graphics.setType(1);
    graphics.start();
    
    function modalClosed() {
        graphics.stop();
    }
</script>
<div class="title1">Datos</div>
<div id="grafica"></div>
<div style="clear: both;"></div>
<div class="title3">Gr&aacute;fica</div>