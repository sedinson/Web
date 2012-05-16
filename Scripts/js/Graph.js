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
    
    //Variables que tienen los tipos de graficas
    this.BARRAS = 0;
    this.CIRCULAR = 1;
    this.FRECUENCIA = 2;
    this.CAJA_Y_BIGOTES = 3;
    
    //Variables usadas por la clase
    var g = cnv.getContext("2d");
    var pData = 2;                  //Ubicacion en la cual estan los datos en el array
    var pLabel = 0;                 //Ubicacion en el array donde se encuentra la etiqueta, Puede ser marca de clase o clases
    var timmer1 = null;             //Temporizador encargado de pintar cada x milisegundos
    var option = 0;                 //Tipo de grafica (barra, torta, frecuencia, etc)
    var data = [];                  //Array que contiene los datos a graficar
    var max = 0;                    //Valor maximo del array de datos
    var min = 0;                    //Valor minimo del array de datos
    var q1 = 0;
    var q2 = 0;
    var q3 = 0;
    var sum = 0;                    //Suma de todos los elementos del array de datos
    var w = 100;                    //Ancho del canvas
    var h = 100;                    //Alto del canvas
    
    //Crear la base con lineas guias para graficas como la de barra
    var base = function (funct) 
    {   //Pintar las lineas guias
        g.save();
            g.lineWidth = 1;
            g.strokeStyle = "#cccccc";
            g.beginPath();
                for(var i=0; i<6; i++)
                {
                    g.moveTo(40, i*(h-80)/6+20);
                    g.lineTo(w-10, i*(h-80)/6+20);
                }
                g.stroke();
    g.restore();

    //Pintar la grafica contenida en la funcion
    funct();

    //Pintar el marco del eje x e y
    g.strokeStyle = "#000000";
    g.lineWidth = 2;
    g.beginPath();
        g.moveTo(50, 10);
        g.lineTo(50, h-50);
        g.lineTo(w-10, h-50);
        g.stroke();
    }
    
    //Grafica de Barras
    var barras = function () 
    {   //Calcular el ancho de las barras y algunas propiedades del texto
        var sep = (w-80)/data.length;
        g.textAlign = "center";
        g.textBaseline = "top";
        for(var i=0; i<data.length; i++)
        {   //Pintar la barra
            var y = (data[i][pData]/max)*(h-60);
            var grad = g.createLinearGradient(10, (h-50)-y, 10, (h-50));
            grad.addColorStop(0, colors[i%colors.length][0]);
            grad.addColorStop(1, colors[i%colors.length][1]);
            g.fillStyle = grad;
            g.fillRect(60+sep*i, (h-50)-y, sep, y);
            g.fillStyle = "#000000";
            g.fillText(data[i][pLabel]+"", 60+sep*i+sep/2, h-45);
        }

        //Pintar el texto de la guias del eje y
        g.textAlign = "right";
        g.textBaseline = "bottom";
        for(i=1; i<=6; i++)
        {
            g.fillText((i*max/6).toFixed(0)+"", 45, (6-i)*(h-80)/6+20);
        }
    }
    
    //Grafica de Frecuencia
    var frecuencia = function () 
    {   //Calcular la separacion entre cada punto
        var sep = (w-80)/data.length;
        var antX = -1;
        var antY = -1;
        
        //Funcion que pintara un punto
        var setPoint = function (x, y, i) 
        {
            g.save();
                g.lineWidth = 6;
                g.beginPath();
                    g.strokeStyle = colors[((i-1)%colors.length)][0];
                    g.arc(x, y, 3, 0, 2*Math.PI, false);
                    g.stroke();
            g.restore();
        }
        
        g.textAlign = "center";
        g.textBaseline = "top";
        g.fillStyle = "#000000";
        for(var i=0; i<data.length; i++)
        {   //Pintar el punto y si es necesario la linea
            var y = (data[i][pData]/max)*(h-60);
            if(i>0) 
            {   //Si es el segundo punto, dibujar una linea que una los puntos
                g.strokeStyle = "#000000";
                g.lineWidth = 1;
                g.beginPath();
                    g.moveTo(antX, antY);
                    g.lineTo(60+sep*i+sep/2, (h-50)-y);
                    g.stroke();
                    
                    //Dibujar el punto
                    setPoint(antX, antY, i);
            }
            
            //Guardar el punto actual
            antX = 60+sep*i+sep/2;
            antY = (h-50)-y;
            g.fillText(data[i][pLabel]+"", 60+sep*i+sep/2, h-45);
        }
        
        //Dibujar el ultimo punto al salir
        setPoint(antX, antY, data.length);

        //Pintar el texto de la guias del eje y
        g.textAlign = "right";
        g.textBaseline = "bottom";
        for(i=1; i<=6; i++)
        {
            g.fillText((i*max/6).toFixed(0)+"", 45, (6-i)*(h-80)/6+20);
        }
    }
    
    //Grafico Circular
    var circular = function () 
    {   //Algunos calculos preliminares antes de empezar a graficar
        var acum = 0;
        var weight = Math.min(h-20, w-20)/2;
        g.lineWidth = weight-1;
        g.fillStyle = "#fff";
        g.font = "15px Arial";
        g.textBaseline = "middle";
        g.textAlign = "left";
        for(var i=0; i<data.length; i++)
        {   //Graficar dependiendo del radio que ocupa cada parte, ademas ir llevando el angulo acumulado
            g.save();
                var grad = g.createRadialGradient(w/2, h/2, 0, w/2, h/2, weight);
                grad.addColorStop(0, colors[i%colors.length][0]);
                grad.addColorStop(1, colors[i%colors.length][1]);
                g.strokeStyle = grad;
                g.beginPath();
                    var angle = 2*(data[i][pData]/sum)*Math.PI;
                    g.arc(w/2, h/2, weight/2, acum, acum+angle, false);
                    acum += angle;
                    g.stroke();
            g.restore();
            
            //Pintar texto informativo que esta dentro de la grafica
            g.save();
                g.translate(w/2+(3*weight/5)*Math.cos(acum-angle/2), h/2+(3*weight/5)*Math.sin(acum-angle/2));
                g.rotate(acum-angle/2);
                g.fillText(data[i][pLabel], 0, 0);
            g.restore();
        }
    }
    
    var cajaybigotes = function ()
    {   //Algunos calculos preliminares antes de empezar a graficar
        var bottomBase = 50;
        var sideBase = 50;
        var width = w-2*sideBase;
        var D = max-min;
        var dq1 = (q1*width)/D;
        var dq2 = (q2*width)/D;
        var dq3 = (q3*width)/D;
        
        //Estableciendo configuraciones de pintado
        g.strokeStyle = "#000";
        g.lineWidth = 2;
        g.font = "15px Arial";
        g.textBaseline = "top";
        g.textAlign = "center";
        
        //Pintando las lineas del campo
        g.beginPath();
            g.moveTo(sideBase, h-bottomBase);
            g.lineTo(sideBase+width, h-bottomBase);
            
            g.moveTo(sideBase, h-bottomBase-5);
            g.lineTo(sideBase, h-bottomBase+5);
            
            g.moveTo(sideBase+width, h-bottomBase-5);
            g.lineTo(sideBase+width, h-bottomBase+5);
            
            g.moveTo(sideBase+dq1, h-bottomBase-5);
            g.lineTo(sideBase+dq1, h-bottomBase+5);
            
            g.stroke();
    }
    
    var paint = function ()
    {   //Obtener el tamaño del contenedor y establecerlo en el canvas
        w = div.offsetWidth-10;
        h = div.offsetHeight-10;
        cnv.width = w;
        cnv.height = h;
        
        //Fondo blanco en el lienzo
        g.fillStyle = "#ffffff";
        g.fillRect(0, 0, w, h);
        
        //Seleccionar la opcion que se va a graficar
        switch (option)
        {
            case 0: //Barra
                base(barras);
                break;
            case 1: //Circular
                circular();
                break;
            case 2: //Frecuencia
                base(frecuencia);
                break;
            case 3:
                cajaybigotes();
        }
    }
    
    //Establece el tipo de grafica que se utilizara
    this.setType = function (opt)
    {
        option = opt;
    }
    
    //Establece cual de las columnas contiene la informacion a mostrar como etiqueta
    this.setLabel = function (opt)
    {
        pLabel = opt;
    }
    
    //Funcion que establece el array de datos y estandariza a la manera que lo usa la clase
    this.setData = function (array)
    {   //Utiliza informacion de la clase Stat, encargada de preparar el array (estandarizar)
        data = Stat.prepare(array);
        
        //Obtener los valores minimo, maximo y la suma de todos los elementos del array
        min = Stat.minVal();
        max = Stat.maxVal();
        q1 = Stat.getData(Stat.Quartile, 1, array);
        alert(q1)
        q2 = Stat.median(array);
        q3 = Stat.getData(Stat.Quartile, 3, array);
        
        sum = 0;
        for(var i=0; i<data.length; i++)
            sum += data[i][pData];
    }
    
    //Funcion que inicia el hilo que repintara
    this.start = function () 
    {
        timmer1 = setInterval(function() {paint()}, 250);
    }
    
    //Funcion que detiene el hilo que repinta
    this.stop = function ()
    {
        clearInterval(timmer1);
    }
}