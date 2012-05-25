/*
 *@author David Seija Duque
 */

/*
*@param a (integer) Numero para el cual se desea calcular el factorial
*@return (integer) Valor de a factorial
*/
Math.factorial = function (a)
{
    var n = 1;
    while (a > 0)
    {
        n = n * a;
        a--;
    }
    return n;
}

/*
*@param a (integer) Numero para el cual se desea hacer las combinaciones
*@param b (integer) Numero con el que se van a realizar las combinaciones de a
*@return (integer) Valor de a combinado en b (aCb)
*/
Math.combinatory = function (a, b)
{
    return ( Math.factorial(a)/( Math.factorial(b) * Math.factorial((a - b)) ) );
}


function Probability () { }


//CASOS DISCRETOS DE PROBABILIDAD PUNTUAL

/*
*@param n (integer) Tamaño de la muestra
*@param p (float) Proporcion de exitos
*@param x (integer) Cantidad de intentos
*@return (float) Valor de la funcion de Probabilidad Puntual Binomial
*/
Probability.binomial = function (n, p, x)
{
    return ( Math.combinatory(n, x) * Math.pow(p, x) * Math.pow((1 - p), (n - x)) );
}

/*
*@param p (float) Proporcion de exitos
*@param x (integer) Cantidad de intentos
*@return (float) Valor de la funcion de Probabilidad Puntual Geometrica
*/
Probability.geometric = function (p, x)
{
    return ( p * Math.pow((1 - p), (x - 1)) );
}

/*
*@param k (integer) Cantidad de exitos
*@param p (float) Proporcion de exitos
*@param x (integer) Cantidad de intentos
*@return (float) Valor de la funcion de Probabilidad Puntual Binomial Negativa
*/
Probability.negativeBinomial = function (k, p, x)
{
    return ( Math.combinatory((x - 1), (k - 1)) * Math.pow(p, k) * Math.pow((1 - p), (x - k)) );
}

/*
*@param N (integer) Tamaño de la poblacion
*@param n (integer) Tamaño de la muestra
*@param k (integer) Cantidad de exitos en la poblacion
*@param x (integer) Cantidad de exitos en la muestra
*@return (float) Valor de la funcion de Probabilidad Puntual HiperGeometrica
*/
Probability.hyperGeometric = function (N, n, k, x)
{
    return ( ( Math.combinatory(k, x) * Math.combinatory((N - k), (n - x)) )/Math.combinatory(N, n) );
}

/*
*@param lambda (float) Promedio de ocurrencias
*@param x (integer) Numero de ocurrencias
*@return (float) Valor de la funcion de Probabilidad Puntual de Poisson
*/
Probability.poisson = function (lambda, x)
{
    return ( ( Math.pow(lambda, x) * Math.exp((-1)*lambda) )/Math.factorial(x) );
}

/*
*@param k (integer) Numero de valores posibles de la variable discreta
*@return (float) Valor de la funcion de Probabilidad Puntual Uniforme Discreta
*/
Probability.discreteUniform = function (k)
{
    return (1/k);
}


/*
*@comment Todas las funciones acumuladas que aparecen aqui son acumuladas a la izquierda.
*La tabla de la normal también esta acumulada a la izquierda.
*Cuando se necesita calcular la acumulada a la derecha, se calcula la acumulada a la izquierda y se resta el valor resultante a 1, P(X>=x)=1-P(X<=x).
*/


//DISTRIBUCIONES DE PROBABILIDAD ACUMULADAS A LA IZQUIERDA

/*
*@param n (integer) Tamaño de la muestra
*@param p (float) Proporcion de exitos
*@param x (integer) Cantidad de intentos
*@return (float) Valor de la funcion de Probabilidad Acumulada Binomial
*/
Probability.binomialAccumulated = function (n, p, x)
{
    var sum = 0;
    for(var i=0; i<=x; i++)
    {
        sum += Probability.binomial(n, p, i);
    }
    return sum;
}

/*
*@param p (float) Proporcion de exitos
*@param x (integer) Cantidad de intentos
*@return (float) Valor de la funcion de Probabilidad Acumulada Geometrica
*/
Probability.geometricAccumulated = function (p, x)
{
    var sum = 0;
    for(var i=1; i<=x; i++)
    {
        sum += Probability.geometric(p, i);
    }
    return sum;
}

/*
*@param k (integer) Cantidad de exitos
*@param p (float) Proporcion de exitos
*@param x (integer) Cantidad de intentos
*@return (float) Valor de la funcion de Probabilidad Acumulada Binomial Negativa
*/
Probability.negativeBinomialAccumulated = function (k, p, x)
{
    var sum = 0;
    for(var i=k; i<=x; i++)
    {
        sum += Probability.negativeBinomial(k, p, i);
    }
    return sum;
}

/*
*@param N (integer) Tamaño de la poblacion
*@param n (integer) Tamaño de la muestra
*@param k (integer) Cantidad de exitos en la poblacion
*@param x (integer) Cantidad de exitos en la muestra
*@return (float) Valor de la funcion de Probabilidad Acumulada HiperGeometrica
*/
Probability.hyperGeometricAccumulated = function (N, n, k, x)
{
    var sum = 0;
    for(var i=0; i<=x; i++)
    {
        sum += Probability.hyperGeometric(N, n, k, i);
    }
    return sum;
}

/*
*@param lambda (float) Promedio de ocurrencias
*@param x (integer) Numero de ocurrencias
*@return (float) Valor de la funcion de Probabilidad Acumulada de Poisson
*/
Probability.poissonAccumulated = function (lambda, x)
{
    var sum = 0;
    for(var i=0; i<=x; i++)
    {
        sum += Probability.poisson(lambda, i);
    }
    return sum;
}

/*
*@param x (integer) Numero de exitos
*@param k (integer) Numero de valores posibles de la variable discreta
*@return (float) Valor de la funcion de Probabilidad Acumulada Uniforme Discreta
*/
Probability.discreteUniformAccumulated = function (x, k)
{
    var sum = 0;
    for(var i=1; i<=x; i++)
    {
        sum += Probability.discreteUniform(k);
    }
    return sum;
}


//CASOS CONTINUOS

/*
*@param z (float) Valor Z estandarizado para buscar su valor correspondiente en la tabla
*@return (float) Valor de la funcion de Probabilidad Normal segun la tabla P(Z<z)
*/
Probability.getNormalValue = function (z)
{
    //TABLA NORMAL ACUMULADA A LA IZQUIERDA
    var NormalTable = [ [0, 0.00, 0.01, 0.02, 0.03, 0.04, 0.05, 0.06, 0.07, 0.08, 0.09],
            [0.0, 0.5000, 0.5040, 0.5080, 0.5120, 0.5160, 0.5199, 0.5239, 0.5279, 0.5319, 0.5359],
            [0.1, 0.5398, 0.5438, 0.5478, 0.5517, 0.5557, 0.5596, 0.5636, 0.5675, 0.5714, 0.5753],
            [0.2, 0.5793, 0.5832, 0.5871, 0.5910, 0.5948, 0.5987, 0.6026, 0.6064, 0.6103, 0.6141],
            [0.3, 0.6179, 0.6217, 0.6255, 0.6293, 0.6331, 0.6368, 0.6406, 0.6443, 0.6480, 0.6517],
            [0.4, 0.6554, 0.6591, 0.6628, 0.6664, 0.6700, 0.6736, 0.6772, 0.6808, 0.6844, 0.6879],
            [0.5, 0.6915, 0.6950, 0.6985, 0.7019, 0.7054, 0.7088, 0.7123, 0.7157, 0.7190, 0.7224],
            [0.6, 0.7257, 0.7291, 0.7324, 0.7357, 0.7389, 0.7422, 0.7454, 0.7486, 0.7517, 0.7549],
            [0.7, 0.7580, 0.7611, 0.7642, 0.7673, 0.7703, 0.7734, 0.7764, 0.7794, 0.7823, 0.7652],
            [0.8, 0.7881, 0.7910, 0.7939, 0.7967, 0.7995, 0.8023, 0.8051, 0.8078, 0.8106, 0.8133],
            [0.9, 0.8159, 0.8186, 0.8212, 0.8238, 0.8264, 0.8289, 0.8315, 0.8340, 0.8365, 0.8389],
            [1.0, 0.8413, 0.8438, 0.8461, 0.8485, 0.8508, 0.8531, 0.8554, 0.8577, 0.8599, 0.8621],
            [1.1, 0.8643, 0.8665, 0.8686, 0.8708, 0.8729, 0.8749, 0.8770, 0.8790, 0.8810, 0.8930],
            [1.2, 0.8849, 0.8869, 0.8888, 0.8907, 0.8925, 0.8944, 0.8962, 0.8980, 0.8997, 0.9015],
            [1.3, 0.9032, 0.9049, 0.9066, 0.9082, 0.9099, 0.9115, 0.9131, 0.9147, 0.9162, 0.9177],
            [1.4, 0.9192, 0.9207, 0.9222, 0.9236, 0.9251, 0.9265, 0.9279, 0.9292, 0.9306, 0.9319],
            [1.5, 0.9332, 0.9345, 0.9357, 0.9370, 0.9382, 0.9394, 0.9406, 0.9418, 0.9429, 0.9441],
            [1.6, 0.9452, 0.9463, 0.9474, 0.9484, 0.9495, 0.9505, 0.9515, 0.9525, 0.9535, 0.9545],
            [1.7, 0.9554, 0.9561, 0.9573, 0.9582, 0.9591, 0.9599, 0.9608, 0.9616, 0.9625, 0.9633],
            [1.8, 0.9641, 0.9649, 0.9656, 0.9664, 0.9671, 0.9678, 0.9686, 0.9693, 0.9699, 0.9706],
            [1.9, 0.9713, 0.9719, 0.9726, 0.9732, 0.9738, 0.9744, 0.9750, 0.9756, 0.9761, 0.9767],
            [2.0, 0.9772, 0.9778, 0.9783, 0.9788, 0.9793, 0.9798, 0.9803, 0.9808, 0.9812, 0.9817],
            [2.1, 0.9821, 0.9826, 0.9830, 0.9934, 0.9838, 0.9842, 0.9846, 0.9850, 0.9854, 0.9857],
            [2.2, 0.9861, 0.9864, 0.9868, 0.9871, 0.9875, 0.9878, 0.9881, 0.9884, 0.9887, 0.9890],
            [2.3, 0.9893, 0.9896, 0.9898, 0.9901, 0.9901, 0.9906, 0.9909, 0.9911, 0.9913, 0.9916],
            [2.4, 0.9918, 0.9920, 0.9922, 0.9925, 0.9927, 0.9929, 0.9931, 0.9932, 0.9934, 0.9936],
            [2.5, 0.9938, 0.9940, 0.9941, 0.9943, 0.9945, 0.9946, 0.9948, 0.9949, 0.9951, 0.9952],
            [2.6, 0.9953, 0.9954, 0.9956, 0.9957, 0.9959, 0.9960, 0.9961, 0.9962, 0.9963, 0.9964],
            [2.7, 0.9965, 0.9966, 0.9967, 0.9968, 0.9969, 0.9970, 0.9971, 0.9972, 0.9973, 0.9974],
            [2.8, 0.9974, 0.9975, 0.9976, 0.9977, 0.9977, 0.9978, 0.9979, 0.9979, 0.9980, 0.9981],
            [2.9, 0.9981, 0.9982, 0.9982, 0.9983, 0.9984, 0.9984, 0.9985, 0.9985, 0.9986, 0.9986],
            [3.0, 0.9987, 0.9987, 0.9987, 0.9988, 0.9988, 0.9989, 0.9989, 0.9989, 0.9990, 0.9990],
            [3.1, 0.9990, 0.9991, 0.9991, 0.9991, 0.9992, 0.9992, 0.9992, 0.9992, 0.9993, 0.9993],
            [3.2, 0.9993, 0.9993, 0.9994, 0.9994, 0.9994, 0.9994, 0.9994, 0.9995, 0.9995, 0.9995],
            [3.3, 0.9995, 0.9995, 0.9995, 0.9996, 0.9996, 0.9996, 0.9996, 0.9996, 0.9996, 0.9997],
            [3.4, 0.9997, 0.9997, 0.9997, 0.9997, 0.9997, 0.9997, 0.9997, 0.9997, 0.9997, 0.9998],
            [3.5, 0.9998, 0.9998, 0.9999, 0.9999, 0.9999, 0.9999, 0.9999, 0.9999, 0.9999, 0.9999] ];
    
    //Se separa el valor z de entrada adecuandolo al valor de la columna y de la fila ara buscar en la tabla
    //El valor z viene en un formato real truncado a 2 decimas
    var zColumn = z.substring(0, 3);    //zColumn toma los primeros 3 caracteres del valor z, el valor entero, el punto (.) y el primer decimal
    var zRow = "0.0" + z.substring(3);  //zRow toma el caracter faltante, el segundo decimal
    
    //Se busca la fila correspondiente al valor de zColumn. Guarda la posicion de la fila en la variable i
    var i = 1;
    var sw = false;
    while ((i<36) && (sw == false))
    {
        if (NormalTable[i][0] == zColumn)
        {
            sw = true;
        }
        else
        {
            i++;
        }
    }
    
    //Se busca la columna correspondiente al valor de zRow. Guarda la posicion de la culumna en la variable j
    var j = 1;
    sw = false;
    while ((j<11) && (sw == false))
    {
        if (NormalTable[0][j] == zRow)
        {
            sw = true;
        }
        else
        {
            j++;
        }
    }
    
    //Retorna el valor correspondiente de la tabla en la fila y columna encontrada
    return NormalTable[i][j];
}

/*
*@param m (float) Valor de la media miu
*@param s (float) Valor de la desviacion estandar sigma
*@param x (float) Valor del dato con el que se va a estandarizar
*@return (float) Valor de la funcion de Probabilidad Normal
*/
Probability.normal = function (m, s, x)
{
    var z = ((x - m)/s).toFixed(2);     //Se estandariza a Z truncando a 2 decimas
    var value = 0;
    if (z >= 0)
    {
        if (z <= (3.59))
        {
            value = Probability.getNormalValue(z);
        }
        else{
            value = 1;
        }
    }
    else
    {
        if (z >= (-3.59))
        {
            z = (z * (-1)) + "";
            value = 1 - Probability.getNormalValue(z);
        }
        else{
            value = 0;
        }
    }
    
    return value;
}

/*
*@param z (float) Valor estandarizado
*@return (float) Valor de la funcion de Probabilidad Normal Estandar
*/
Probability.standardNormal = function (z)
{
    var value = 0;
    
    if (z >= 0)
    {
        if (z <= (3.59))
        {
            value = Probability.getNormalValue(z);
        }
        else{
            value = 1;
        }
    }
    else
    {
        if (z >= (-3.59))
        {
            z = (z * (-1)) + "";
            value = 1 - Probability.getNormalValue(z);
        }
        else{
            value = 0;
        }
    }
    
    return value;
}

/*
*@param beta (float) Promedio de ocurrencias
*@param x (float) Numero de ocurrencias
*@return (float) Valor de la funcion de Probabilidad Exponencial
*/
Probability.exponential = function (beta, x)
{
    return ( 1 - Math.exp( ((-1) * x)/beta ) );
}


//CALCULO DE LAS PROBABILIDADES

/*
*@param n (integer) Tamaño de la muestra
*@param p (float) Proporcion de exitos
*@param x (integer) Cantidad de intentos
*@param direction (String) Valor que determina si la probabilidad debe ser puntual, acumulada a la izquierda o a la derecha.
*@return (float) Valor de la funcion de Probabilidad Binomial
*/
Probability.calculateBinomial = function (n, p, x, direction)
{
    var result = 0;
    
    if (direction == "=")
    {
        result = Probability.binomial(n, p, x);
    }
    else if (direction == "<")
    {
        result = Probability.binomialAccumulated(n, p, x);
    }
    else if (direction == ">")
    {
        result = 1 - Probability.binomialAccumulated(n, p, x-1);
    }
    
    return result.toFixed(3);
}

/*
*@param p (float) Proporcion de exitos
*@param x (integer) Cantidad de intentos
*@param direction (String) Valor que determina si la probabilidad debe ser puntual, acumulada a la izquierda o a la derecha.
*@return (float) Valor de la funcion de Probabilidad Geometrica
*/
Probability.calculateGeometric = function (p, x, direction)
{
    var result = 0;
    
    if (direction == "=")
    {
        result = Probability.geometric(p, x);
    }
    else if (direction == "<")
    {
        result = Probability.geometricAccumulated(p, x);
    }
    else if (direction == ">")
    {
        result = 1 - Probability.geometricAccumulated(p, x-1);
    }
    
    return result.toFixed(3);
}

/*
*@param k (integer) Cantidad de exitos
*@param p (float) Proporcion de exitos
*@param x (integer) Cantidad de intentos
*@param direction (String) Valor que determina si la probabilidad debe ser puntual, acumulada a la izquierda o a la derecha.
*@return (float) Valor de la funcion de Probabilidad Binomial Negativa
*/
Probability.calculateNegativeBinomial = function (k, p, x, direction)
{
    var result = 0;
    
    if (direction == "=")
    {
        result = Probability.negativeBinomial(k, p, x);
    }
    else if (direction == "<")
    {
        result = Probability.negativeBinomialAccumulated(k, p, x);
    }
    else if (direction == ">")
    {
        result = 1 - Probability.negativeBinomialAccumulated(k, p, x-1);
    }
    
    return result.toFixed(3);
}

/*
*@param N (integer) Tamaño de la poblacion
*@param n (integer) Tamaño de la muestra
*@param k (integer) Cantidad de exitos en la poblacion
*@param x (integer) Cantidad de exitos en la muestra
*@param direction (String) Valor que determina si la probabilidad debe ser puntual, acumulada a la izquierda o a la derecha.
*@return (float) Valor de la funcion de Probabilidad HiperGeometrica
*/
Probability.calculateHyperGeometric = function (N, n, k, x, direction)
{
    var result = 0;
    
    if (parseInt(x) <= parseInt(k))
    {
        if (direction == "=")
        {
            result = Probability.hyperGeometric(N, n, k, x);
        }
        else if (direction == "<")
        {
            result = Probability.hyperGeometricAccumulated(N, n, k, x);
        }
        else if (direction == ">")
        {
            result = 1 - Probability.hyperGeometricAccumulated(N, n, k, x-1);
        }
    }
    
    return result.toFixed(3);
}

/*
*@param lambda (float) Promedio de ocurrencias
*@param x (integer) Numero de ocurrencias
*@param direction (String) Valor que determina si la probabilidad debe ser puntual, acumulada a la izquierda o a la derecha.
*@return (float) Valor de la funcion de Probabilidad de Poisson
*/
Probability.calculatePoisson = function (lambda, x, direction)
{
    var result = 0;
    
    if (direction == "=")
    {
        result = Probability.poisson(lambda, x);
    }
    else if (direction == "<")
    {
        result = Probability.poissonAccumulated(lambda, x);
    }
    else if (direction == ">")
    {
        result = 1 - Probability.poissonAccumulated(lambda, x-1);
    }
        
    return result.toFixed(3);
}

/*
*@param k (integer) Numero de valores posibles de la variable discreta
*@param x (integer) Numero de exitos
*@param direction (String) Valor que determina si la probabilidad debe ser puntual, acumulada a la izquierda o a la derecha.
*@return (float) Valor de la funcion de Probabilidad Uniforme Discreta
*/
Probability.calculateDiscreteUniform = function (k, x, direction)
{
    var result = 0;
    
    if (direction == "=")
    {
        result = Probability.discreteUniform(k);
    }
    else if (direction == "<")
    {
        result = Probability.discreteUniformAccumulated(x, k);
    }
    else if (direction == ">")
    {
        result = 1 - Probability.discreteUniformAccumulated(x, k);
    }
    
    return result.toFixed(3);
}

/*
*@param m (float) Valor de la media miu
*@param s (float) Valor de la desviacion estandar sigma
*@param lower (float) Valor del dato inferior con el que se va a estandarizar
*@param upper (float) Valor del dato superior con el que se va a estandarizar
*@param interval (String) Valor que determina si la probabilidad debe ser para un valor a la izquierda, entre dos valores o un valor a la derecha.
*@return (float) Valor de la funcion de Probabilidad Normal
*/
Probability.calculateNormal = function (m, s, lower, upper, interval)
{
    var result = 0;
    
    if (interval == "<")
    {
        result = Probability.normal(m, s, upper);
    }
    else if (interval == "<<")
    {
        result = (Probability.normal(m, s, upper) - Probability.normal(m, s, lower));
    }
    else if (interval == ">")
    {
        result = 1 - Probability.normal(m, s, lower);
    }
    
    return result.toFixed(3);
}

/*
*@param z (float) Valor estandar
*@param interval (String) Valor que determina si la probabilidad debe ser para un valor a la izquierda a la derecha.
*@return (float) Valor de la funcion de Probabilidad Normal Estandar
*/
Probability.calculateStandardNormal = function (z, interval)
{
    var result = 0;
    
    if (interval == "<")
    {
        result = Probability.standardNormal(z);
    }
    else if (interval == ">")
    {
        result = 1 - Probability.standardNormal(z);
    }
    
    return result.toFixed(3);
}

/*
*@param a Valor del limite inferior 
*@param b Valor del limite superior
*@param x Numero de exitos
*@param direction (String) Valor que determina si la probabilidad debe ser puntual, acumulada a la izquierda o a la derecha.
*@return (float) Valor de la funcion de Probabilidad Uniforme Continua
*/
Probability.calculateContinuousUniform = function (a, b, x, direction)
{
    var result = 0;
    var k = (b - a);
    if (direction == "=")
    {
        result = Probability.discreteUniform(k);
    }
    else if (direction == "<")
    {
        result = Probability.discreteUniformAccumulated(x, k);
    }
    else if (direction == ">")
    {
        result = 1 - Probability.discreteUniformAccumulated(x, k);
    }
        
    return result.toFixed(3);
}

/*
*@param beta (float) Promedio de ocurrencias
*@param lower (float) Valor del dato inferior para el numero de ocurrencias
*@param upper (float) Valor del dato superior para el numero de ocurrencias
*@param interval (String) Valor que determina si la probabilidad debe ser para un valor a la izquierda o entre dos valores.
*@return (float) Valor de la funcion de Probabilidad Exponencial
*/
Probability.calculateExponential = function (beta, lower, upper, interval)
{
    var result = 0;
    
    if (interval == "<")
    {
        result = Probability.exponential(beta, upper);
    }
    else if (interval == "<<")
    {
        result = (Probability.exponential(beta, upper) - Probability.exponential(beta, lower));
    }

    return result.toFixed(3);
}
