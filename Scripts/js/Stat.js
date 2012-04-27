/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

Array.prototype.unique = function(a) {return function(){return this.filter(a)}}(function(a,b,c){return c.indexOf(a,b+1)<0});

function Stat () { }

Stat.averrage = function (array)
{
    var sum = 0;
    var i = 0;
    if(typeof array[i] == "number")
    {
        for(i=0; i<array.length; i++)
        {
            sum += array[i];
        }
        return (sum/array.length);
    }
    else
    {
        var f = 0;
        for(i=0; i<array.length; i++)
        {
            sum += array[i][0]*array[i][1];
            f += array[i][1];
        }
        
        return (sum/f);
    }
    
}

Stat.variance = function (array)
{
    var sum = 0;
    var i = 0;
    if(typeof array[i] == "number")
    {
        for(var i=0; i<array.length; i++)
        {
            sum += Math.pow(array[i], 2);
        }

        return (sum/array.length-Math.pow(Stat.averrage(array), 2));
    }
    else 
    {
        var f = 0;
        for(i=0; i<array.length; i++)
        {
            sum += Math.pow(array[i][0], 2)*array[i][1];
            f += array[i][1];
        }
        
        return (sum/f-Math.pow(Stat.averrage(array), 2));
    }
}

Stat.deviation = function (array)
{
    return Math.sqrt(Stat.variance(array));
}

Stat.frecuency = function (array)
{
    var values = array.unique();
    var tmp = [];
    
    for(var i=0; i<values.length; i++)
    {
        tmp[i] = [values[i], 0];
        for(var j=0; j<array.length; j++)
        {
            tmp[i][1]+= ((array[j] == values[i])? 1 : 0);
        }
    }
    
    return tmp;
}