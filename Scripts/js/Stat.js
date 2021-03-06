/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//Creacion de algunas extensiones que son de utilidad en el programa
Array.prototype.unique = function(a) {return function(){return this.filter(a)}}(function(a,b,c){return c.indexOf(a,b+1)<0});
Math.logBase = function (x, b) {return Math.log(x)/Math.log(b)};
jQuery.fn.exists = function(){return this.length>0;}

function Stat () { }

//Definicion de algunos datos a utilizar en la aplicacion
Stat.min = Infinity;
Stat.max = -1*Infinity;
Stat.borders = false;
Stat.p = 1;

//Regresar el valor minimo de los datos analizados previamente
Stat.minVal = function () 
{
    return Stat.min;
}

//Regresar el maximo valor de los datos analizados previamente
Stat.maxVal = function () 
{
    return Stat.max;
}

//Regresar el promedio de los datos contenidos en el array
Stat.averrage = function (array)
{
    array = Stat.prepare(array);
    var sum = 0;
    var f = 0;
    for(var i=0; i<array.length; i++)
    {
        sum += array[i][1]*array[i][2];
        f += array[i][2];
    }

    return (sum/f);
}

//Regresar la moda de los datos contenidos en el array
Stat.mode = function (array) 
{
    array = Stat.prepare(array);
    var tmp = [0, 0, 0];    //[c, x, f]
    for(var i=0; i<array.length; i++)
    {
        if(array[i][2] > tmp[2])
            tmp = array[i];
    }
    
    return tmp;
}

//Regresar la varianza de los datos del array
Stat.variance = function (array)
{
    array = Stat.prepare(array);
    var sum = 0;
    var i = 0;
    var f = 0;
    for(i=0; i<array.length; i++)
    {
        sum += Math.pow(array[i][1], 2)*array[i][2];
        f += array[i][2];
    }

    return (sum/f-Math.pow(Stat.averrage(array), 2));
}

//Regresar la desviacion estandar de los datos del array
Stat.deviation = function (array)
{
    return Math.sqrt(Stat.variance(array));
}

//Regresar el Coeficiente de Variacion de los datos del array
Stat.CV = function (array)
{
    return Stat.deviation(array) / Stat.averrage(array);
}

//Regresar el coeficiente de asimetria
Stat.CAs = function (array)
{
    array = Stat.prepare(array);
    var xm = Stat.averrage(array);
    var sum = 0;
    var i = 0;
    var f = 0;
    for(i=0; i<array.length; i++)
    {
        sum += Math.pow(array[i][1]-xm, 3)*array[i][2];
        f += array[i][2];
    }

    return sum/(f*Math.pow(Stat.deviation(array), 3));
}

//Regresar el coeficiente de apuntamiento
Stat.CAp = function (array)
{
    array = Stat.prepare(array);
    var xm = Stat.averrage(array);
    var sum = 0;
    var i = 0;
    var f = 0;
    for(i=0; i<array.length; i++)
    {
        sum += Math.pow(array[i][1]-xm, 4)*array[i][2];
        f += array[i][2];
    }

    return sum/(f*Math.pow(Stat.deviation(array), 4));
}

/*Medidas de posicion*/
Stat.Quartile = function (i, n)
{
    return (i*(n+1))/4;
}

Stat.Percentile = function (i, n)
{
    return (i*(n+1))/100;
}

Stat.Decile = function (i, n)
{
    return (i*(n+1))/10;
}

//Obtener un dato en una posicion especificada por una medida de posicion (Decil, cuartil, percentil)
Stat.getData = function (f, i, array) 
{
    try
    {
        if(typeof array[0] != "number")
        {
            array = Stat.prepare(array);
            var n = Stat.n(array);
            var p = f(i, n);
            var d = p-Math.floor(p);
            p = Math.floor(p);
            var sum = 0;
            var j, l;
            for(j=0; j<array.length && sum<p; j++)
            {
                sum += array[j][2];
                l = (sum == p)? j+1 : j;
            }

            if(d != 0)
                return parseFloat(array[j-1][1])*d + parseFloat(array[l][1])*(1-d);
            else
                return parseFloat(array[j-1][1]);
        }
        else
        {
            array = Extra.insertSort(array);
            n = array.length;
            p = f(i, n);
            d = p-Math.floor(p);
            p = Math.floor(p);
            p = (p<1)? 1 : p;

            if(d != 0)
                return parseFloat(array[Math.min(p-1, n-1)])*d + parseFloat(array[Math.min(p, n-1)])*(1-d);
            else
                return parseFloat(array[Math.min(p-1, n-1)]);
        }
    }
    catch (exception)
    {
        return 0;
    }
    
}

//Regresar el numero de datos del array
Stat.n = function (array) 
{
    var sum = 0;
    array = Stat.prepare(array);
    for(var i=0; i<array.length; i++) 
    {
        sum += array[i][2];
    }
    
    return sum;
}

//Regresar la mediana de los datos contenidos en el array
Stat.median = function (array)
{
    return Stat.getData(Stat.Quartile, 2, array);
}

/*Regresa un array, donde todos los datos los divide y clasifica para que sean acumulados,
 *y asi poder trabajar en esta clase. Metodo importante!*/
Stat.frecuency = function (array)
{
    var tmp = [];
    try 
    {
        for(var i=0; i<array.length; i++)
        {
            Stat.min = (array[i] < Stat.min)? array[i] : Stat.min;
            Stat.max = (array[i] > Stat.max)? array[i] : Stat.max;
        }
        if(typeof array[0] == "number") 
        {
            var li = Stat.minVal(array);
            var ls = Stat.maxVal(array);
            var r = ls - li;
            var c = Math.round(3.322*Math.logBase(array.length, 10)+1);
            var w = Math.ceil(r/c);
            var f = (Stat.borders)? Stat.p/2 : 0;

            for(var i=0; i<c; i++)
                tmp[i] = [(li+i*w-f) + "-" + (li+(i+1)*w-Stat.p+f), ((li+i*w)+(li+(i+1)*w-Stat.p))/2, 0];

            for(i=0; i<array.length; i++)
            {
                if(Math.floor((array[i]-li)/w) >= tmp.length)
                    tmp[c] = [(li+c*w-f) + "-" + (li+(c+1)*w-Stat.p+f), ((li+c*w)+(li+(++c)*w-Stat.p))/2, 0];

                tmp[Math.floor((array[i]-li)/w)][2] += 1;
            }
        } 
        else if(typeof array[0] == "string") 
        {
            var vars = array.unique();

            for(i=0; i<vars.length; i++) {
                tmp[i] = [vars[i], vars[i], 0];
                for(var j=0; j<array.length; j++) 
                {
                    if(array[j] == vars[i])
                        tmp[i][2] += 1;
                }
            }
        }
    }
    catch (exception) { }
    
    return tmp;
}

/*Prepara el array pasado para que este normalizado como se necesita para que funcione en esta clase*/
Stat.prepare = function (array)
{
    Stat.min = Infinity;
    Stat.max = -1*Infinity;
    
    if(typeof array[0] == "number" || typeof array[0] == "string")
        return Stat.frecuency(array);
    else
        return array;
}

/*Genera una tabla que muestra los diferentes valores de una tabla de frecuencias, tales como
 *clase, marca de clase, frecuencia, frecuencia acumulada, frecuencia relativa y frecuencia relativa acumulada*/
Stat.getTableInfo = function (array)
{
    try
    {
        var data = Stat.prepare(array);
        var n = Stat.n(data);
        var sw = (data[0][0] != data[0][1]);
        var sum = 0;

        var str = "<table><thead><tr><th>clases</th>" + ((sw)? "<th>x</th>" : "") + 
                    "<th>f</th><th>f<sub>a</sub></th><th>f<sub>r</sub></th><th>f<sub>ra</sub>" +
                    "</th></tr></thead><tbody>";
        for(var i=0; i<data.length; i++)
        {
            sum += data[i][2];
            str += "<tr>";
            str += "<td>" + data[i][0] + "</td><td>" + ((sw)? data[i][1] + "</td><td>" : "") + data[i][2] + "</td>";
            str += "<td>" + sum + "</td><td>" + (data[i][2]/n).toFixed(3) + "</td><td>" + (sum/n).toFixed(3) + "</td>";
            str += "</tr>";
        }
        str += "</tbody></table>";
    }
    catch (exception)
    {
        var str = "<table><thead><tr><th>clases</th>" +
                    "<th>f</th><th>f<sub>a</sub></th><th>f<sub>r</sub></th><th>f<sub>ra</sub>" +
                    "</th></tr></thead><tbody><tr><td colspan=5>No information</td></tr></tbody></table>";
    }
    
    return str;
}

//Establecer configuraciones para la clase
Stat.config = function (p, borders) 
{
    Stat.p = p;
    Stat.borders = borders;
}

//Clase que contiene algunos metodos extras para usar
function Extra() { }

/*Convierte value en un array de datos. Usa \n como simbolo de nueva fila y \t como nueva columna.
 *tal como vienen los datos de excel. Una mejora a futuro es elegir los delimitadores.*/
Extra.transformData = function (value) 
{
    var str = value.split("\n");
    var tmp = [];
    if(str.length > 0)
    {
        var data = str[0].split("\t");
        if(data.length == 2)
        {
            var j = 0;
            for(var i=0; i<str.length; i++)
            {
                data = str[i].split("\t");
                if(data.length == 2)
                    tmp[j++] = [data[0], data[0], parseFloat(data[1].replace(",", "."))];
            }
        }
        else
        {
            data = str;
            for(var i=0; i<data.length; i++)
            {
                if(data[i] != "") {
                    var tmpstr =  parseFloat(data[i].replace(",", "."));
                    tmp[i] = (tmpstr+"" != data[i])? data[i] : tmpstr;
                }
            }
        }
    }
    
    original = Extra.createCopy(tmp);
    
    return tmp;
}

//Ordenamiento de datos por InsertSort (Matriz)
Extra.insertArraySort = function (array, pos) 
{
   var a = array;
   for (var i = 0, j, tmp; i < a.length; ++i) 
   {
      tmp = a[i];
      for (j = i - 1; j >= 0 && a[j][pos] < tmp[pos]; --j)
         a[j + 1] = a[j];
      a[j + 1] = tmp;
   }
   
   return a;
}

//Ordenamiento de datos por InsertSort (vector)
Extra.insertSort = function (a) 
{
   for (var i = 0, j, tmp; i < a.length; ++i) 
   {
      tmp = a[i];
      for (j = i - 1; j >= 0 && a[j] > tmp; --j)
         a[j + 1] = a[j];
      a[j + 1] = tmp;
   }
   
   return a;
}

//Crar una copia de un array
Extra.createCopy = function (array) 
{
    return array.slice(0);
}