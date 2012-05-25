<?php 

    /*
     * Este archivo es el que tiene la vista principal. El contiene la plantilla de
     * como esta diseñada la pagina, ademas es la encargada de cargar todos los scripts
     * a usar durante la ejecucion de esta misma.
     */
    error_reporting(0); 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Web - Statistics</title>
        <!--Carga de las hojas de estilo y los scripts utilizados en la aplicacion-->
        <link rel="stylesheet" href="<?=$config->get('BaseUrl')?>/Scripts/css/style.css"/>
        <link rel="stylesheet" href="<?=$config->get('BaseUrl')?>/Scripts/css/custom-theme/jquery-ui-1.8.20.custom.css"/>
        <script type="text/javascript" src="<?=$config->get('BaseUrl')?>/Scripts/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?=$config->get('BaseUrl')?>/Scripts/js/jquery-ui-1.8.20.custom.min.js"></script>
        <script type="text/javascript" src="<?=$config->get('BaseUrl')?>/Scripts/js/Stat.js"></script>
        <script type="text/javascript" src="<?=$config->get('BaseUrl')?>/Scripts/js/Graph.js"></script>
        <script type="text/javascript" src="<?=$config->get('BaseUrl')?>/Scripts/js/jquery.nicescroll.min.js"></script>
        <script type="text/javascript" src="<?=$config->get('BaseUrl')?>/Scripts/js/jquery.validate.js"></script>
        <script type="text/javascript" src="<?=$config->get('BaseUrl')?>/Scripts/js/Estimacion.js"></script>
        <script type="text/javascript" src="<?=$config->get('BaseUrl')?>/Scripts/js/Probability.js"></script>
        <script type="text/javascript">
            var myData = [];    //Este array contiene de manera global toda la informacion necesaria para construir la tabla de frecuencias y las graficas
            var original = Extra.createCopy(myData);    //Este array contiene la informacion original que se carga
            var BaseUrl = '<?=$config->get('BaseUrl')?>';   //Aqui esta registrada la url base de la aplicacion
            
            /*Contiene los nicescrolls. Se utiliza cuando se produce alguna accion que redimensiona estos controles*/
            var bodyScroll = null;
            var helpScroll = null;
            var modalScroll = null;
            
            var fps = 250;      //Realmente no es los Frames Per Second, sino la cantidad de segundos que pasan entre un timeInterval y otro
            var selOpt = 0;     //Opcion seleccionada cada vez que se abre una vista, un cuadro, etc...
            
            //Este metodo es el encargado de cargar los subaccesos al hacer clic sobre un acceso
            function subcontenido(val) 
            {
                if(document.getElementById("dropdown").style.display == "none")
                {
                    document.getElementById("subContainner").innerHTML = "<img src='<?=$config->get('BaseUrl')?>/Resources/Images/ajax.gif'/>";
                    $("#subContainner").load("<?=$config->get('InitUrl')?>?controller=Index&action=subIndex&str=" + val, function() {
                        bodyScroll.resize().show();
                    });
                }
            }
            
            //Este metodo es el responsable de darle acciones a los titulos de las ayudas y los ejemplos. Hace que se puedan
            //mostrar / ocultar cada vez que se hace clic sobre un titulo de uno de estos
            function navegador(nav)
            {
                helpScroll.resize().show();
                $(nav + " ul > li").click(function(event)
                {
                    $(nav + " ul li > ul li").click(function(event) {
                        event.stopPropagation();
                    });
                    
                    $(this).find("li").animate({height: 'toggle'}, 150, function() {
                        helpScroll.resize().show();
                    });
                });
            }
            
            /*
            * Este metodo es el encargado de cargar la vista, luego que se abre un subacceso
            */
            function mostrar(url) 
            {
                var str = url.split("/");
                if(str.length >= 2) url = "controller=" + str[0] + "&action=" + str[1];
                if(str.length >= 3) selOpt = str[2];
                $("#modalDialog").html("<img src='<?=$config->get('BaseUrl')?>/Resources/Images/ajax.gif'/>");
                $("#modal").css("opacity", "0");
                $("#modal").css("display", "block");
                $("#modal").animate({opacity: 1}, 300, function() {
                    $(".superpanel").css("display", "block");
                    $(".superpanel").css("opacity", "0");
                    $(".superpanel").animate({opacity: 1}, 600);
                });
                var w = $("#modal").innerWidth();
                var h = $("#modal").innerHeight();
                $(".modalDialog").css("width", (w-380) + "px");
                $(".modalDialog").css("height", (h-80) + "px");
                $("#modalDialog").css("width", (w-400) + "px");
                $("#close2").css("margin-left", (w-395) + "px");
                $("#modalDialog").load("<?=$config->get('InitUrl')?>?" + url, function() {
                    modalScroll.resize().show();
                    timmerPeriodic = setInterval(function() {periodic()}, fps);
                });
                $("#help").load("<?=$config->get('InitUrl')?>?controller=Help&action=load&str=" + selOpt, function() {
                    navegador("#help");
                });
                $("#example").load("<?=$config->get('InitUrl')?>?controller=Example&action=load&str=" + selOpt, function() {
                    navegador("#example");
                });
            }
		
            /*
             * Metodo encargado de cargar los formularios de edicion de ejmplos y ayudas
             **/
            function edit(url) 
            {
                var str = url.split("/");
                if(url.length >=2) url = "controller=" + str[0] + "&action=" + str[1] + "&str=" + selOpt;
				
                $("#editDialog").html("<img src='<?=$config->get('BaseUrl')?>/Resources/Images/ajax.gif'/>");
                $("#editHelp").css("opacity", "0");
                $("#editHelp").css("display", "block");
                $("#editHelp").animate({opacity: 1}, 300);
                $("#editDialog").load("<?=$config->get('InitUrl')?>?" + url);
            }
            
            /*
             * Metodo encargado de mostrar el formulario de agregar subacceso
             **/
            function subAdd(val) 
            {
                $("#dialog").load("<?=$config->get('InitUrl')?>?controller=Form&action=addSubAccess&str=" + val, function() {
                    setSelFile();
                }); 
                $("#dadd").css("opacity", "0");
                $("#dadd").css("display", "block");
                $("#dadd").animate({opacity: 1}, 300);
            }
            
            /*
             * Metodo encargado de mostrar el formulario de eliminar acceso
             **/
            function deleteBox(val) 
            {
                $("#dialog").load("<?=$config->get('InitUrl')?>?controller=Form&action=deleteBox&str=" + val); 
                $("#dadd").css("opacity", "0");
                $("#dadd").css("display", "block");
                $("#dadd").animate({opacity: 1}, 300, function() {
                    $("#dropdown").css("display", "none");
                });
            }
            
            /*
             * Metodo encargado de mostrar el formulario de eliminar subacceso
             **/
            function deleteBox2(val) 
            {
                $("#dialog").load("<?=$config->get('InitUrl')?>?controller=Form&action=deleteBox2&str=" + val); 
                $("#dadd").css("opacity", "0");
                $("#dadd").css("display", "block");
                $("#dadd").animate({opacity: 1}, 300);
            }
            
            /*
             * Metodo que tiene a cargo el hacer que se dispare el cargador de archivos. Por defecto este es escondido porque es 
             * horrible el que viene por defecto en los navegadores.
             **/
            function setSelFile() 
            {
                var fileElem = document.getElementById("fileElem");
                var fileSelect = document.getElementById("fileSelect");
                fileSelect.addEventListener("click", function(e) {
                    if (fileElem) {  
                        fileElem.click();  
                    }
                    e.preventDefault();
                }, false);
            }
            
            /*
             * Este metodo puede ser redefinido al gusto cada vez que se carga una vista. Se ejecutará cada x milesimas de segundo
             * luego que se haya cargado una vista.
             **/
            function periodic () { }
    
            /*
             *  Este metodo es el encargado de matar el proceso que se ejecuta cada x milesimas de segundo, encargado de ejecutar
             *  el metodo periodic al abrir una vista.
             **/
            function modalClosed() 
            {
                clearInterval(timmerPeriodic);
            }
            
            /*
             * Esto se ejecuta cuando la pagina es cargada.
             **/
            $(document).ready(function() 
            {
                //Establecer los scrolls nuevos, y asignarlos a variables globales para manipularlos luego
                $("body").niceScroll({cursorborder:"", cursorcolor:"#000", cursoropacitymax:0.7});
                $(".superpanel").niceScroll({cursorborder:"", cursorcolor:"#000", cursoropacitymax:0.7});
                $(".modalDialog").niceScroll({cursorborder:"", cursorcolor:"#fff", cursoropacitymax:0.7});
                bodyScroll = $("body").getNiceScroll();
                helpScroll = $(".superpanel").getNiceScroll();
                modalScroll = $(".modalDialog").getNiceScroll();
                
                //Ocultar el div que muestra los subaccesos inicialmente
                $("#dropdown").css("display", "none");
                
                /*
                 *  Este evento se ejecuta cada vez que se hace clic en una caja. Las cajas son los accesos
                 **/
                $(".box").click(function(event) 
                {
                    var post = $(this).offset();
                    var size = $(this).innerHeight() + 7;
                    var wobj = ($(this).innerWidth()-50)/2;
                    if(document.getElementById("dropdown").style.display == "none") {
                        $("#dropdown").css("top", (post.top+size) + "px");
                        $("#triangle").css("left", (post.left+wobj) + "px");
                        $("#dropdown").css("opacity", "0");
                        $("#dropdown").css("display", "block");
                        $("#dropdown").animate({opacity: 1}, 300);
                    } else {
                        $("#dropdown").animate({opacity: 0}, 300, function() {
                            $("#dropdown").css("display", "none");
                            bodyScroll.resize().show();
                        });
                    }
                    
                    helpScroll.resize().show();
                });
                
                /*
                * Este metodo se ejecuta cada vez que se hace clic sobre un agregador de contenido.
                * Puede ser un acceso o un suacceso.
                **/
                $(".add").click(function(event) 
                {
                    $("#dialog").load("<?=$config->get('InitUrl')?>?controller=Form&action=addAccess", function() {
                        setSelFile();
                    }); 
                    $("#dadd").css("opacity", "0");
                    $("#dadd").css("display", "block");
                    $("#dadd").animate({opacity: 1}, 300);
                });
                
                /*
                 * Este evento se dispara al hacer clic sobre el boton cerrar de el formulario de agregar acceso / subacceso
                 **/
                $("#close1").click(function(event) 
                {
                    $("#dadd").animate({opacity: 0}, 300, function() {
                        $("#dadd").css("display", "none");
                    });
                });
                
                /*
                 * Este se ejecuta cada vez que se intenta cerrar una carga producida al hacer clic en un subacceso
                 **/
                $("#close2").click(function(event) 
                {
                    modalScroll.hide();
                    modalClosed();
                    //Ocultar el panel que contiene la ayuda y ejemplos (No es necesario en la vista principal)
                    $(".superpanel").animate({opacity: 0}, 300, function() {
                        $("#modal").animate({opacity: 0}, 300, function() {
                            $(".superpanel").css("display", "none");
                            $("#modal").css("display", "none");
                            helpScroll.hide();
                        });
                    });

                    selOpt = 0; //Establecer que la opcion elegida es ninguna
                });
			
                /*
                * Este evento ocurre cuando se hace clic en el boton de cerrar del formulario de edicion de ejmplos / ayudas
                **/
                $("#close3").click(function(event)
                {
                        $("#editHelp").animate({opacity: 0}, 300, function() {
                        $("#editHelp").css("display", "none");
                    });
                });
                
                //Inicialmente se oculta el scroll de la ayuda, puesto que no sale en la vista principal
                helpScroll.hide();
                
                /*
                 * Decidir si mostrar alguna informacion especial. En este caso mostrar un div que dice que todo
                 * ocurrió satisfactoriamente o uno que diga que hubieron problemas al intentar cargar / enviar.
                 **/
                <?php
                    if(isset($obj)) {
                        if($obj === "Failed") {
                            ?>
                            $("#Failed").css("opacity", "0");
                            $("#Failed").css("display", "block");
                            $("#Failed").animate({opacity: .8}, 1000);
                            <?php
                        } else if($obj === "Done") {
                            ?>
                            $("#Done").css("opacity", "0");
                            $("#Done").css("display", "block");
                            $("#Done").animate({opacity: .8}, 1000);
                            <?php
                        }
                        ?>
                        //Desaparecer esta informacion despues de 3 segundos
                        setTimeout(function() {
                            $(".message").animate({opacity: 0}, 300, function() {
                                $(".message").css("display", "none");
                            })}, 3000);
                        <?php
                    }
                ?>
            });
        </script>
    </head>
    <body>
        <div id="Failed" class="message">Lo siento, tu clave es inv&aacute;lida o no seleccionaste una im&aacute;gen.</div>
        <div id="Done" class="message">Excelente, no hay de que temer.</div>
        <div class="superpanel">
            <div class="panel">
                <div class="title1"><a href="javascript: edit('Form/help');" style="float: left; margin-right: 10px;"><img src="<?=$config->get('BaseUrl')?>/Resources/Images/edit.png" alt="Editar" /></a>Ayuda</div>
                <div id="help">Loading...</div>
                <div class="title1"><a href="javascript: edit('Form/example');" style="float: left; margin-right: 10px;"><img src="<?=$config->get('BaseUrl')?>/Resources/Images/edit.png" alt="Editar" /></a>Ejemplos</div>
                <div id="example">Loading...</div>
            </div>
        </div>
        
        <div id="containner">
            <!--Aqui se carga el contenido de la pagina que va en la plantilla-->
            <?=$this->content->display()?>
        </div>
        
        <div id="dropdown">
            <div id="triangle"></div>
            <div id="subContainner"></div>
        </div>
        
        <div class="darkBox" id="dadd">
            <div class="dialog" class="shadowInt">
                <div id="close1"></div>
                <div id="dialog"></div>
            </div>
        </div>
        
        <div class="darkBox" id="modal">
            <div class="modalDialog" class="shadowInt">
                <div id="close2"></div>
                <div id="modalDialog"></div>
            </div>
        </div>
		
		<div class="darkBox" id="editHelp">
            <div class="editHelp" class="shadowInt">
                <div id="close3"></div>
                <div id="editDialog"></div>
            </div>
        </div>
        
        <div class="footer"></div>
    </body>
</html>
