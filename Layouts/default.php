<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Web - Statistics</title>
        <link rel="stylesheet" href="<?=$config->get('BaseUrl')?>/Scripts/css/style.css"/>
        <script type="text/javascript" src="<?=$config->get('BaseUrl')?>/Scripts/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?=$config->get('BaseUrl')?>/Scripts/js/Stat.js"></script>
        <script type="text/javascript" src="<?=$config->get('BaseUrl')?>/Scripts/js/jquery.nicescroll.min.js"></script>
        <script type="text/javascript">
            var bodyScroll = null;
            var helpScroll = null;
            
            function subcontenido(val) {
                $("#subContainner").load("<?=$config->get('BaseUrl')?>/Index/subIndex/" + val); 
            }
            
            function mostrar(url) {
                document.getElementById("modalDialog").innerHTML = "<img src='<?=$config->get('BaseUrl')?>/Resources/Images/ajax.gif'/>";
                $("#modal").css("opacity", "0");
                $("#modal").css("display", "block");
                $("#modal").animate({opacity: 1}, 300);
                var w = $("#modal").innerWidth();
                var h = $("#modal").innerHeight();
                $(".modalDialog").css("width", (w-380) + "px");
                $(".modalDialog").css("height", (h-80) + "px");
                $("#modalDialog").css("width", (w-400) + "px");
                $("#close2").css("margin-left", (w-395) + "px");
                $("#modalDialog").load("<?=$config->get('BaseUrl')?>/"+url, function() {
                    modalScroll.resize().show();
                });
            }
            
            function subAdd(val) {
                $("#dialog").load("<?=$config->get('BaseUrl')?>/Form/addSubAccess/" + val, function() {
                    setSelFile();
                }); 
                $("#dadd").css("opacity", "0");
                $("#dadd").css("display", "block");
                $("#dadd").animate({opacity: 1}, 300);
            }
            
            function deleteBox(val) {
                $("#dialog").load("<?=$config->get('BaseUrl')?>/Form/deleteBox/" + val); 
                $("#dadd").css("opacity", "0");
                $("#dadd").css("display", "block");
                $("#dadd").animate({opacity: 1}, 300, function() {
                    $("#dropdown").css("display", "none");
                });
            }
            
            function deleteBox2(val) {
                $("#dialog").load("<?=$config->get('BaseUrl')?>/Form/deleteBox2/" + val); 
                $("#dadd").css("opacity", "0");
                $("#dadd").css("display", "block");
                $("#dadd").animate({opacity: 1}, 300);
            }
            
            function setSelFile() {
                var fileElem = document.getElementById("fileElem");
                var fileSelect = document.getElementById("fileSelect");
                fileSelect.addEventListener("click", function(e) {
                    if (fileElem) {  
                        fileElem.click();  
                    }
                    e.preventDefault();
                }, false);
            }
            
            $(document).ready(function() {
//                alert(Stat.deviation([[10, 5], [11, 3], [14, 19]]))
                $("body").niceScroll({cursorborder:"", cursorcolor:"#000", cursoropacitymax:0.7});
                $(".superpanel").niceScroll({cursorborder:"", cursorcolor:"#000", cursoropacitymax:0.7});
                $(".modalDialog").niceScroll({cursorborder:"", cursorcolor:"#000", cursoropacitymax:0.7});
                bodyScroll = $("body").getNiceScroll();
                helpScroll = $(".superpanel").getNiceScroll();
                modalScroll = $(".modalDialog").getNiceScroll();
                
                $("#dropdown").css("display", "none");
                
                $(".box").click(function(event) {
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
                        });
                    }
                    
                    bodyScroll.resize().show();
                    helpScroll.resize().show();
                });
                
                $(".add").click(function(event) {
                    $("#dialog").load("<?=$config->get('BaseUrl')?>/Form/addAccess", function() {
                        setSelFile();
                    }); 
                    $("#dadd").css("opacity", "0");
                    $("#dadd").css("display", "block");
                    $("#dadd").animate({opacity: 1}, 300);
                });
                
                $("#close1").click(function(event) {
                    $("#dadd").animate({opacity: 0}, 300, function() {
                        $("#dadd").css("display", "none");
                    });
                });
                
                $("#close2").click(function(event) {
                    modalScroll.hide();
                    $("#modal").animate({opacity: 0}, 300, function() {
                        $("#modal").css("display", "none");
                    });
                });
                
                <?php
                    if(isset($obj)) {
                        if($obj === "Failed") {
                            ?>
                            $("#Failed").css("opacity", "0");
                            $("#Failed").css("display", "block");
                            $("#Failed").animate({opacity: .8}, 1000);
                            <?php
                        } else {
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
                <div class="title1">Ayuda</div>
                <div id="help">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
                <div class="title1">Ejemplos</div>
                <div id="example">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
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
        
        <div class="footer"></div>
    </body>
</html>