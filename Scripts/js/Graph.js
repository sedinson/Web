/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function Graph(div) 
{
    //Colores usados en el sistema para mostrar los graficos
    var colors = [["#3a7ccb", "#2c5e99"], ["#cd3c38", "#9c2d2a"], ["#9cc746", "#779735"], 
                  ["#7b57a8", "#5e427f"], ["#34b3d6", "#2889a3"], ["#cd3c38", "#9c2d2a"], 
                  ["#7b57a8", "#5e427f"]];
    
    //Crear un canvas e introducrilo dentro del objeto pasado
    var cnv = document.createElement('canvas');
    div.appendChild(cnv);
    cnv.height = 100;
    cnv.width = 100;
    
    //Variables usadas por la clase
    var g = cnv.getContext("2d");
    var timmer1 = null;
    var option = 0;
    var data = [];
    var max = 0;
    var min = 0;
    var sum = 0;
    var w = 100;
    var h = 100;
    
    //Crear la base con lineas guias para graficas como la de barra
    var base = function (funct) 
    {
        g.save();
        g.strokeStyle = "#cccccc";
        g.beginPath();
            for(var i=0; i<6; i++)
            {
                g.moveTo(40, i*(h-80)/6+20);
                g.lineTo(w-10, i*(h-80)/6+20);
            }
            g.stroke();
    g.restore();

    funct();

    g.strokeStyle = "#000000";
    g.beginPath();
        g.moveTo(50, 10);
        g.lineTo(50, h-50);
        g.lineTo(w-10, h-50);
        g.stroke();
    }
    
    //Grafica de Barras
    var barras = function () 
    {
        var sep = (w-80)/data.length;
        g.textAlign = "center";
        g.textBaseline = "top";
        for(var i=0; i<data.length; i++)
        {
            var y = (data[i][1]/max)*(h-60);
            var grad = g.createLinearGradient(10, (h-50)-y, 10, (h-50));
            grad.addColorStop(0, colors[i%colors.length][0]);
            grad.addColorStop(1, colors[i%colors.length][1]);
            g.fillStyle = grad;//colors[(i%colors.length)];
            g.fillRect(60+sep*i, (h-50)-y, sep, y);
            g.fillStyle = "#000000";
            g.fillText(data[i][0]+"", 60+sep*i+sep/2, h-45);
        }

        g.textAlign = "right";
        g.textBaseline = "bottom";
        for(i=1; i<=6; i++)
        {
            g.fillText((i*max/6).toFixed(0)+"", 45, (6-i)*(h-80)/6+20);
        }
    }
    
    //Grafico Circular
    var circular = function () 
    {
        var acum = 0;
        var weight = Math.min(h-20, w-20)/2;
        g.lineWidth = weight-1;
        for(var i=0; i<data.length; i++)
        {
            g.save();
                var grad = g.createRadialGradient(w/2, h/2, 0, w/2, h/2, weight);
                grad.addColorStop(0, colors[i%colors.length][0]);
                grad.addColorStop(1, colors[i%colors.length][1]);
                g.strokeStyle = grad;
                g.beginPath();
                    var angle = 2*(data[i][1]/sum)*Math.PI;
                    g.arc(w/2, h/2, weight/2, acum, acum+angle, false);
                    acum += angle;
                    g.stroke();
        }
    }
    
    var paint = function ()
    {
        w = div.offsetWidth-10;
        h = div.offsetHeight-10;
        cnv.width = w;
        cnv.height = h;
        
        g.fillStyle = "#ffffff";
        g.fillRect(0, 0, w, h);
        
        switch (option)
        {
            case 0: //Barra
                base(barras);
                break;
            case 1: //Circular
                circular();
                break;
        }
    }
    
    this.setType = function (opt)
    {
        option = opt;
    }
    
    this.setData = function (array)
    {
        data = Stat.prepare(array);
        data = data.sort();
        min = 99999;
        max = 0;
        sum = 0;
        for(var i=0; i<data.length; i++)
        {
            min = (Math.min(min, data[i][1]));
            max = (Math.max(max, data[i][1]));
            sum += data[i][1];
        }
    }
    
    this.start = function () 
    {
        timmer1 = setInterval(function() {paint()}, 250);
    }
    
    this.stop = function ()
    {
        clearInterval(timmer1);
    }
}