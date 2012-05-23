<?php error_reporting(0); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Web - Statistics</title>
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
//            var myData = [11, 5, 14, 3, 12, 15, 16, 13, 22, 21, 23, 24, 19, 9, 9, 10, 6, 13, 6, 51, 32, 45, 40, 19, 39, 51];
            var myData = [0];
            var original = Extra.createCopy(myData);
            var BaseUrl = '<?=$config->get('BaseUrl')?>';
            var bodyScroll = null;
            var helpScroll = null;
            var fps = 250;
            var selOpt = 0;
            
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
            
            function subAdd(val) 
            {
                $("#dialog").load("<?=$config->get('InitUrl')?>?controller=Form&action=addSubAccess&str=" + val, function() {
                    setSelFile();
                }); 
                $("#dadd").css("opacity", "0");
                $("#dadd").css("display", "block");
                $("#dadd").animate({opacity: 1}, 300);
            }
            
            function deleteBox(val) 
            {
                $("#dialog").load("<?=$config->get('InitUrl')?>?controller=Form&action=deleteBox&str=" + val); 
                $("#dadd").css("opacity", "0");
                $("#dadd").css("display", "block");
                $("#dadd").animate({opacity: 1}, 300, function() {
                    $("#dropdown").css("display", "none");
                });
            }
            
            function deleteBox2(val) 
            {
                $("#dialog").load("<?=$config->get('InitUrl')?>?controller=Form&action=deleteBox2&str=" + val); 
                $("#dadd").css("opacity", "0");
                $("#dadd").css("display", "block");
                $("#dadd").animate({opacity: 1}, 300);
            }
            
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
            
            //Funcion periodica
            function periodic () { }
    
            function modalClosed() 
            {
                clearInterval(timmerPeriodic);
            }
            
            $(document).ready(function() 
            {
                $("body").niceScroll({cursorborder:"", cursorcolor:"#000", cursoropacitymax:0.7});
                $(".superpanel").niceScroll({cursorborder:"", cursorcolor:"#000", cursoropacitymax:0.7});
                $(".modalDialog").niceScroll({cursorborder:"", cursorcolor:"#fff", cursoropacitymax:0.7});
                bodyScroll = $("body").getNiceScroll();
                helpScroll = $(".superpanel").getNiceScroll();
                modalScroll = $(".modalDialog").getNiceScroll();
                
                $("#dropdown").css("display", "none");
                
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
                
                $(".add").click(function(event) 
                {
                    $("#dialog").load("<?=$config->get('InitUrl')?>?controller=Form&action=addAccess", function() {
                        setSelFile();
                    }); 
                    $("#dadd").css("opacity", "0");
                    $("#dadd").css("display", "block");
                    $("#dadd").animate({opacity: 1}, 300);
                });
                
                $("#close1").click(function(event) 
                {
                    $("#dadd").animate({opacity: 0}, 300, function() {
                        $("#dadd").css("display", "none");
                    });
                });
                
                $("#close2").click(function(event) 
                {
                    modalScroll.hide();
                    modalClosed();
                    $(".superpanel").animate({opacity: 0}, 300, function() {
                        $("#modal").animate({opacity: 0}, 300, function() {
                            $(".superpanel").css("display", "none");
                            $("#modal").css("display", "none");
                        });
                    });

                    selOpt = 0;
                    $("#help").load("<?=$config->get('InitUrl')?>?controller=Help&action=load&str=" + selOpt, function() {
                        navegador("#help");
                    });
                    $("#example").load("<?=$config->get('InitUrl')?>?controller=Example&action=load&str=" + selOpt, function() {
                        navegador("#example");
                    });
                });
				
                $("#close3").click(function(event)
                {
                        $("#editHelp").animate({opacity: 0}, 300, function() {
                        $("#editHelp").css("display", "none");
                    });
                });

                selOpt = '0';
                $("#help").load("<?=$config->get('InitUrl')?>?controller=Help&action=load&str=" + selOpt, function() {
                    navegador("#help");
                });
                $("#example").load("<?=$config->get('InitUrl')?>?controller=Example&action=load&str=" + selOpt, function() {
                    navegador("#example");
                });
                
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
