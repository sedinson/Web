/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

Array.prototype.unique = function(a) {return function(){return this.filter(a)}}(function(a,b,c){return c.indexOf(a,b+1)<0});
Math.logBase = function (x, b) {return Math.log(x)/Math.log(b)};

function Stat () { }

Stat.minVal = function (a) {
    var m = Infinity;
    for(var i=0; i<a.length; i++)
        m = (a[i]<m)? a[i] : m;
    return m;
}

Stat.maxVal = function (a) {
    var m = -1*Infinity;
    for(var i=0; i<a.length; i++)
        m = (a[i]>m)? a[i] : m;
    return m;
}

Stat.averrage = function (array)
{
    array = Stat.prepare(array);
    var sum = 0;
    var f = 0;
    for(var i=0; i<array.length; i++)
    {
        sum += array[i][0]*array[i][1];
        f += array[i][1];
    }

    return (sum/f);
    
}

Stat.variance = function (array)
{
    array = Stat.prepare(array);
    var sum = 0;
    var i = 0;
    var f = 0;
    for(i=0; i<array.length; i++)
    {
        sum += Math.pow(array[i][0], 2)*array[i][1];
        f += array[i][1];
    }

    return (sum/f-Math.pow(Stat.averrage(array), 2));
}

Stat.deviation = function (array)
{
    return Math.sqrt(Stat.variance(array));
}

Stat.n = function (array) {
    var sum = 0;
    for(var i=0; i<array.length; i++) {
        sum += array[i][2];
    }
    
    return sum;
}

Stat.frecuency = function (array)
{
    var tmp = [];
    if(typeof array[0] == "number") {
        var li = Stat.minVal(array);
        var ls = Stat.maxVal(array);
        var r = ls - li;
        var c = Math.round(3.322*Math.logBase(array.length, 10)+1);
        var w = Math.ceil(r/c);

        for(var i=0; i<c; i++)
            tmp[i] = [(li+i*w) + "-" + (li+(i+1)*w-1), ((li+i*w)+(li+(i+1)*w-1))/2, 0];

        for(i=0; i<array.length; i++)
        {
            if(Math.floor((array[i]-li)/w) >= tmp.length)
                tmp[c] = [(li+c*w) + "-" + (li+(c+1)*w-1), ((li+c*w)+(li+(++c)*w-1))/2, 0];

            tmp[Math.floor((array[i]-li)/w)][2] += 1;
        }
    } else if(typeof array[0] == "string") {
        var vars = array.unique();

        for(i=0; i<vars.length; i++) {
            tmp[i] = [vars[i], vars[i], 0];
            for(var j=0; j<array.length; j++) {
                if(array[j] == vars[i])
                    tmp[i][2] += 1;
            }
        }
    }
    
    return tmp;
}

Stat.prepare = function (array)
{
    if(typeof array[0] == "number" || typeof array[0] == "string")
        return Stat.frecuency(array);
    else
        return array;
}

Stat.getTableInfo = function (array)
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
    str += "<tbody></table>";
    
    return str;
}

function Extra() { }

//Convierte value en un array de datos. Usa \n como simbolo de nueva fila y \t como nueva columna.
//tal como vienen los datos de excel. Una mejora a futuro es elegir los delimitadores.
Extra.transformData = function (value) {
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
    
    return tmp;
}