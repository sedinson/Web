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
    this.OJIVA = 4;
    this.PARETO = 5;
    this.POLIGONO_FRECUENCIA = 6;
    this.PUNTOS = 7;
    
    //Variables usadas por la clase
    var g = cnv.getContext("2d");
    var frecuently = 0;             //Dato mas frecuente
    var pData = 2;                  //Ubicacion en la cual estan los datos en el array
    var pLabel = 0;                 //Ubicacion en el array donde se encuentra la etiqueta, Puede ser marca de clase o clases
    var timmer1 = null;             //Temporizador encargado de pintar cada x milisegundos
    var option = 0;                 //Tipo de grafica (barra, torta, frecuencia, etc)
    var data = [];                  //Array que contiene los datos a graficar
    var olData = [];                //Array que contiene los datos a graficar ordenados descendentemente
    var cmdData = [];               //Array que contiene los datos para la grafica de puntos
    var max = 0;                    //Valor maximo del array de datos
    var min = 0;                    //Valor minimo del array de datos
    var q1 = 0;                     //Cuartil 1
    var q2 = 0;                     //Cuartil 2
    var q3 = 0;                     //Cuartil 3
    var xm = 0;                     //Media de los datos
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
            var y = (data[i][pData]/frecuently)*(h-60);
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
            g.fillText((i*frecuently/6).toFixed(0)+"", 45, (6-i)*(h-80)/6+20);
        }
    }
    
    //Grafica de Barras
    var poligonoFrecuencia = function () 
    {   //Calcular el ancho de las barras y algunas propiedades del texto
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
        for(var i=0; i<data.length; i++)
        {   //Pintar la barra
            var y = (data[i][pData]/frecuently)*(h-60);
            var grad = g.createLinearGradient(10, (h-50)-y, 10, (h-50));
            grad.addColorStop(0, colors[i%colors.length][0]);
            grad.addColorStop(1, colors[i%colors.length][1]);
            g.fillStyle = grad;
            g.fillRect(60+sep*i, (h-50)-y, sep, y);
            g.fillStyle = "#000000";
            g.fillText(data[i][pLabel]+"", 60+sep*i+sep/2, h-45);
        }
        
        for(var i=0; i<data.length; i++)
        {   //Pintar el punto y si es necesario la linea
            y = (data[i][pData]/frecuently)*(h-60);
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
            g.fillText((i*frecuently/6).toFixed(0)+"", 45, (6-i)*(h-80)/6+20);
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
            var y = (data[i][pData]/frecuently)*(h-60);
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
            g.fillText((i*frecuently/6).toFixed(0)+"", 45, (6-i)*(h-80)/6+20);
        }
    }
    
    //Grafica de Frecuencia
    var frecuenciaAcumulada = function () 
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
        var acum = 0;
        for(var i=0; i<data.length; i++)
        {   //Pintar el punto y si es necesario la linea
            acum += data[i][pData];
            var y = (acum/sum)*(h-60);
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
            g.fillText((i*sum/6).toFixed(0)+"", 45, (6-i)*(h-80)/6+20);
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
        var dxm = (xm*width)/D;
        
        //Estableciendo configuraciones de pintado
        g.strokeStyle = "#000";
        g.fillStyle = "#000";
        g.lineWidth = 2;
        g.font = "15px Arial";
        g.textAlign = "center";
        
        //Pintando las lineas del campo
        g.beginPath();
            //linea larga de la base
            g.moveTo(sideBase, h-bottomBase);
            g.lineTo(sideBase+width, h-bottomBase);
            
            //Lineas verticales de la linea base
            g.moveTo(sideBase, h-bottomBase-5);
            g.lineTo(sideBase, h-bottomBase+5);
            g.moveTo(sideBase+width, h-bottomBase-5);
            g.lineTo(sideBase+width, h-bottomBase+5);
            
            //Linea larga del centro
            g.moveTo(sideBase, 3*h/8);
            g.lineTo(sideBase+width, 3*h/8);
            
            //Lineas verticales de la linea del centro
            g.moveTo(sideBase, 3*h/8-5);
            g.lineTo(sideBase, 3*h/8+5);
            g.moveTo(sideBase+width, 3*h/8-5);
            g.lineTo(sideBase+width, 3*h/8+5);
            
            //Lineas verticales de los 3 cuartiles
            g.moveTo(sideBase+dq1, h-bottomBase-5);
            g.lineTo(sideBase+dq1, h-bottomBase+5);
            
            g.moveTo(sideBase+dq2, h-bottomBase-5);
            g.lineTo(sideBase+dq2, h-bottomBase+5);
            
            g.moveTo(sideBase+dq3, h-bottomBase-5);
            g.lineTo(sideBase+dq3, h-bottomBase+5);
            
            g.stroke();
            
            //Pintando las leyendas
            g.textBaseline = "bottom";
            g.fillText(q1.toFixed(2)+"", sideBase+dq1, h-bottomBase-5);
            g.fillText(q2.toFixed(2)+"", sideBase+dq2, h-bottomBase-5);
            g.fillText(q3.toFixed(2)+"", sideBase+dq3, h-bottomBase-5);
            g.textBaseline = "top";
            g.fillText("min", sideBase, h-bottomBase+5);
            g.fillText("Q1", sideBase+dq1, h-bottomBase+5);
            g.fillText("Q2", sideBase+dq2, h-bottomBase+5);
            g.fillText("Q3", sideBase+dq3, h-bottomBase+5);
            g.fillText("max", sideBase+width, h-bottomBase+5);
            
            //Pintando las Cajas
            var grad = g.createLinearGradient(10, h/4, 10, h/2);
            grad.addColorStop(0, colors[0][0]);
            grad.addColorStop(1, colors[0][1]);
            g.fillStyle = grad;
            g.fillRect(sideBase+dq1, h/4, (dq2-dq1), h/4);
            g.strokeRect(sideBase+dq1, h/4, (dq2-dq1), h/4);
            
            grad = g.createLinearGradient(10, h/4, 10, h/2);
            grad.addColorStop(0, colors[1][0]);
            grad.addColorStop(1, colors[1][1]);
            g.fillStyle = grad;
            g.fillRect(sideBase+dq2, h/4, (dq3-dq2), h/4);
            g.strokeRect(sideBase+dq2, h/4, (dq3-dq2), h/4);
            
            //Pintando el punto de la media
            g.strokeStyle = "#fff";
            g.lineWidth = 6;
            g.save();
                g.beginPath();
                    g.arc(sideBase+dxm, 3*h/8, 3, 0, 2*Math.PI, false);
                    g.stroke();
            g.restore();
    }
    
    //Grafica de Pareto
    var pareto = function () 
    {   //Calcular el ancho de las barras y algunas propiedades del texto
        var sep = (w-80)/olData.length;
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
        
        for(var i=0; i<olData.length; i++)
        {   //Pintar la barra
            var y = (olData[i][pData]/sum)*(h-60);
            var grad = g.createLinearGradient(10, (h-50)-y, 10, (h-50));
            grad.addColorStop(0, colors[i%colors.length][0]);
            grad.addColorStop(1, colors[i%colors.length][1]);
            g.fillStyle = grad;
            g.fillRect(60+sep*i, (h-50)-y, sep, y);
            g.fillStyle = "#000000";
            g.fillText(olData[i][pLabel]+"", 60+sep*i+sep/2, h-45);
        }
        
        g.fillStyle = "#000000";
        var acum = 0;
        for(var i=0; i<olData.length; i++)
        {   //Pintar el punto y si es necesario la linea
            acum += olData[i][pData];
            y = (acum/sum)*(h-60);
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
        }
        
        //Dibujar el ultimo punto al salir
        setPoint(antX, antY, olData.length);

        //Pintar el texto de la guias del eje y
        g.textAlign = "right";
        g.textBaseline = "bottom";
        for(i=1; i<=6; i++)
        {
            g.fillText((i*sum/6).toFixed(0)+"", 45, (6-i)*(h-80)/6+20);
        }
    }
    
    //Grafica de Frecuencia
    var puntos = function () 
    {   //Calcular la separacion entre cada punto
        var sep = (w-80)/cmdData.length;
        var ant = Infinity;
        
        //Funcion que pintara un punto
        var setPoint = function (x, y, i) 
        {
            g.save();
                g.lineWidth = 4;
                g.beginPath();
                    g.strokeStyle = colors[((i-1)%colors.length)][0];
                    g.arc(x, y, 2, 0, 2*Math.PI, false);
                    g.stroke();
            g.restore();
        }
        
        g.textAlign = "center";
        g.textBaseline = "top";
        g.fillStyle = "#000000";
        for(var i=0; i<cmdData.length; i++)
        {   //Pintar los puntos horizontalmente de la clase tomada
            var ancho = 0;
            for(var j=0; j<cmdData[i][1].length; j++)
            {
                var y = (cmdData[i][1][j]/frecuently)*(h-60);
                
                //Dibujar puntos
                setPoint(60+sep*i+sep/2+ancho, (h-50)-y, i+1)
                if(j < cmdData[i][1].length-1) 
                {
                    if(cmdData[i][1][j] == cmdData[i][1][j+1])
                        ancho += 8;
                    else
                        ancho = 0;
                }
            }
            
            g.fillText(cmdData[i][0]+"", 60+sep*i+sep/2, h-45);
        }

        //Pintar el texto de la guias del eje y
        g.textAlign = "right";
        g.textBaseline = "bottom";
        for(i=1; i<=6; i++)
        {
            g.fillText((i*frecuently/6).toFixed(0)+"", 45, (6-i)*(h-80)/6+20);
        }
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
            case 0:     //Barra
                base(barras);
                break;
            case 1:     //Circular
                circular();
                break;
            case 2:     //Frecuencia
                base(frecuencia);
                break;
            case 3:     //Caja y Bigotes
                cajaybigotes();
                break;
            case 4:     //Frecuencia Acumulada
                base(frecuenciaAcumulada);
                break;
            case 5:     //Pareto
                base(pareto);
                break;
            case 6:     //Poligono de Frecuencia
                base(poligonoFrecuencia);
                break;
            case 7:     //Diagrama de Puntos
                base(puntos);
                break;
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
        olData = Extra.insertArraySort(Stat.prepare(array), 2);
        
        //Obtener los valores minimo, maximo y la suma de todos los elementos del array
        min = Stat.minVal();
        max = Stat.maxVal();
        frecuently = 0;
        q1 = Stat.getData(Stat.Quartile, 1, original);
        q2 = Stat.median(original);
        q3 = Stat.getData(Stat.Quartile, 3, original);
        xm = Stat.averrage(data);
        
        sum = 0;
        for(var i=0; i<data.length; i++)
        {
            frecuently = (data[i][2] > frecuently)? data[i][2] : frecuently;
            sum += data[i][pData];
        }
        
        cmdData = [];
        if(typeof original[0] != "number") {
            var init = [];
            for(i=0; i<original.length; i++)
                init[i] = original[i][0];
            init = init.unique();
            
            for(i=0; i<init.length; i++) {
                var tmp = [];
                for(var j=0; j<original.length; j++) {
                    if(init[i] == original[j][0]) {
                        tmp.push(original[j][2]);
                    }
                }
                cmdData[i] = [init[i], Extra.insertSort(Extra.createCopy(tmp))];
            }
        }
    }
    
    this.tablaPuntos = function () 
    {
        var str = "<table><thead><tr><th>clase</th><th>datos</th></tr></thead>";
        for(var i=0; i<cmdData.length; i++) 
        {
            str += "<tr><td>" + cmdData[i][0] + "</td><td>";
            for(var j=0; j<cmdData[i][1].length; j++)
            {
                str += cmdData[i][1][j] + " ";
            }
            str += "</td></tr>";
        }
        str += "</table>";
        
        return str;
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
