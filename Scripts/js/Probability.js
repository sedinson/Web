
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

Math.combinatory = function (a, b)
{
    return ( Math.factorial(a)/( Math.factorial(b) * Math.factorial((a - b)) ) );
}


function Probability () { }


//CASOS DISCRETOS

Probability.binomial = function (n, p, x)
{
    return ( Math.combinatory(n, x) * Math.pow(p, x) * Math.pow((1 - p), (n - x)) );
}

Probability.geometric = function (p, x)
{
    return ( p * Math.pow((1 - p), (x - 1)) );
}

Probability.negativeBinomial = function (k, p, x)
{
    return ( Math.combinatory((x - 1), (k - 1)) * Math.pow(p, k) * Math.pow((1 - p), (x - k)) );
}

Probability.hyperGeometric = function (N, n, k, x)
{
    return ( ( Math.combinatory(k, x) * Math.combinatory((N - k), (n - x)) )/Math.combinatory(N, n) );
}

Probability.poisson = function (lambda, x)
{
    return ( ( Math.pow(lambda, x) * Math.exp((-1)*lambda) )/Math.factorial(x) );
}

Probability.discreteUniform = function (k)
{
    return (1/k);
}


//DISTRIBUCIONES DE PROBABILIDAD ACUMULADAS

Probability.binomialAccumulated = function (n, p, x)
{
    var sum = 0;
    for(var i=0; i<=x; i++)
    {
        sum += Probability.binomial(n, p, i);
    }
    return sum;
}

Probability.geometricAccumulated = function (p, x)
{
    var sum = 0;
    for(var i=1; i<=x; i++)
    {
        sum += Probability.geometric(p, i);
    }
    return sum;
}

Probability.negativeBinomialAccumulated = function (k, p, x)
{
    var sum = 0;
    for(var i=k; i<=x; i++)
    {
        sum += Probability.negativeBinomial(k, p, i);
    }
    return sum;
}

Probability.hyperGeometricAccumulated = function (N, n, k, x)
{
    var sum = 0;
    for(var i=0; i<=x; i++)
    {
        sum += Probability.hyperGeometric(N, n, k, i);
    }
    return sum;
}

Probability.poissonAccumulated = function (lambda, x)
{
    var sum = 0;
    for(var i=0; i<=x; i++)
    {
        sum += Probability.poisson(lambda, i);
    }
    return sum;
}

Probability.discreteUniformAccumulated = function (k)
{
    var sum = 0;
    for(var i=1; i<=k; i++)
    {
        sum += Probability.discreteUniform(i);
    }
    return sum;
}


//CASOS CONTINUOS

Probability.getNormalValue = function (z)
{
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
        
    var zColumn = z.substring(0, 3);
    var zRow = "0.0" + z.substring(3);
    
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
    
    return NormalTable[i][j];
}

Probability.normal = function (m, s, x)
{
    var z = ((x - m)/s).toFixed(2);
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

Probability.standardNormal = function (x)
{
    return ( (1/Math.sqrt(2 * Math.PI)) * Math.exp((-1) * (1/2) * Math.pow(x, 2)) );
}

Probability.continuousUniform = function (a, b)
{
    return ( 1/(b-a) );
}

Probability.exponential = function (beta, x)
{
    return ( 1 - Math.exp( ((-1) * x)/beta ) );
}


//CALCULO DE LAS PROBABILIDADES

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

Probability.calculateHyperGeometric = function (N, n, k, x, direction)
{
    var result = 0;
    
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
    
    return result.toFixed(3);
}

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

Probability.calculateDiscreteUniform = function (k, direction)
{
    var result = 0;
    
    if (direction == "=")
    {
        result = Probability.discreteUniform(k);
    }
    else if (direction == "<")
    {
        result = Probability.discreteUniformAccumulated(k);
    }
    else if (direction == ">")
    {
        result = 1 - Probability.discreteUniformAccumulated(k-1);
    }
    
    return result.toFixed(3);
}

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

Probability.calculateStandardNormal = function (lower, upper, interval)
{
    var result = 0;
    
    result = Probability.standardNormal(x);
    
    return result.toFixed(3);
}

Probability.calculateContinuousUniform = function (a, b)
{
    var result = 0;
    
    result = Probability.continuousUniform(a, b);
        
    return result.toFixed(3);
}

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


//VALIDACIONES PARA LOS DATOS EN CADA CALCULO DE DISTRIBUCIONES

function Validate () { }

Validate.p = function(){return "El parametro p debe ser mayor que 0 y menor que 1. ";}

Validate.nB = function(){return "El parametro n debe ser un entero positivo mayor que 0. ";}
Validate.xB = function(){return "La variable x debe ser un entero positivo menor o igual a n. ";}

Validate.xG = function(){return "La variable x debe ser un entero positivo mayor que 0. ";}

Validate.xNB = function(){return "La variable x debe ser un entero positivo mayor o igual a k. ";}
Validate.kNB = function(){return "El parametro k debe ser un entero positivo mayor que 0. ";}

Validate.NHG = function(){return "El parametro N debe ser un entero positivo mayor o igual a k. ";}
Validate.kHG = function(){return "El parametro k debe ser un entero positivo menor o igual a n. ";}
Validate.nHG = function(){return "El parametro n debe ser un entero positivo menor o igual a N. ";}
Validate.xHG = function(){return "La variable x debe ser un entero positivo menor o igual a k. ";}

Validate.lambdaP = function(){return "El parametro lambda debe ser mayor o igual a 0. ";}
Validate.xP = function(){return "La variable x debe ser un entero positivo. ";}

Validate.kDU = function(){return "El parametro k debe ser un entero positivo mayor que 0. ";}

Validate.mN = function(){return "La media debe ser un valor de tipo numerico. ";}
Validate.sN = function(){return "La desviacion estandar debe ser mayor o igual a 0. ";}
Validate.xN = function(){return "La variable x debe ser un valor de tipo numerico. ";}

Validate.xSN = function(){return "La variable x debe ser un valor de tipo numerico. ";}

Validate.aCU = function(){return "La variable a debe ser un valor de tipo numerico. ";}
Validate.bCU = function(){return "La variable b debe ser un valor de tipo numerico. ";}

Validate.betaE = function(){return "El parametro beta debe ser mayor o igual a 0. ";}
Validate.xE = function(){return "La variable x debe ser un valor de tipo numerico. ";}



Validate.binomial = function (n, p, x)
{
    var value = true;
    var error = "Error: ";
    
    if ( (n > 0) && ((p > 0) && (p < 1)) && ((x >= 0) && (x <= n)) )
    {
        value = true;
    }
    else
    {
        if ((n > 0) == false)
        {
            error += Validate.nB();
        }
        if ( ((p > 0) && (p < 1)) == false )
        {
            error += Validate.p();
        }
        if ( ((x >= 0) && (x <= n)) == false )
        {
            error += Validate.xB();
        }

        value = false;
    }
    
    if (value == false)
    {
        alert(error);
    }
    
    return value;
}

Validate.geometric = function (p, x)
{
    var value = true;
    var error = "Error: ";
    
    if ( ((p > 0) && (p < 1)) && (x >= 1) )
    {
        value = true;
    }
    else
    {
        if ( ((p > 0) && (p < 1)) == false )
        {
            error += Validate.p();
        }
        if ((x >= 1) == false )
        {
            error += Validate.xG();
        }

        value = false;
    }
    
    if (value == false)
    {
        alert(error);
    }
    
    return value;
}

Validate.negativeBinomial = function (k, p, x)
{
    var value = true;
    var error = "Error: ";
    
    if ( (k > 0) && ((p > 0) && (p < 1)) && (x >= k) )
    {
        value = true;
    }
    else
    {
        if ((k > 0) == false)
        {
            error += Validate.kNB();
        }
        if ( ((p > 0) && (p < 1)) == false )
        {
            error += Validate.p();
        }
        if ((x >= k) == false )
        {
            error += Validate.xNB();
        }

        value = false;
    }
    
    if (value == false)
    {
        alert(error);
    }
    
    return value;
}

Validate.hyperGeometric = function (N, n, k, x)
{
    var value = true;
    var error = "Error: ";
    
    if ( (N >= k) && (n <= N) && (k <= n) && (x <= k) )
    {
        value = true;
    }
    else
    {
        if ((N >= k) == false)
        {
            error += Validate.NHG();
        }
        if ((n <= N) == false )
        {
            error += Validate.nHG();
        }
        if((k <= n) == false)
        {
            error += Validate.kHG();
        }
        if ((x <= k) == false )
        {
            error += Validate.xHG();
        }

        value = false;
    }
    
    if (value == false)
    {
        alert(error);
    }
    
    return value;
}

Validate.poisson = function (lambda, x)
{
    var value = true;
    var error = "Error: ";
    
    if ( (lambda >= 0) && (x >= 0) )
    {
        value = true;
    }
    else
    {
        if ((lambda >= 0) == false)
        {
            error += Validate.lambdaP();
        }
        if ((x >= 0) == false )
        {
            error += Validate.xP();
        }

        value = false;
    }
    
    if (value == false)
    {
        alert(error);
    }
    
    return value;
}

Validate.discreteUniform = function (k)
{
    var value = true;
    var error = "Error: ";
    
    if (k > 0)
    {
        value = true;
    }
    else
    {
        if ((k > 0) == false )
        {
            error += Validate.kDU();
        }

        value = false;
    }
    
    if (value == false)
    {
        alert(error);
    }
    
    return value;
}

Validate.normal = function (m, s, x)
{
    var value = true;
    var error = "Error: ";
    
    if ( (isNaN(m) == false) && (s >= 0) && (isNaN(x) == false) )
    {
        value = true;
    }
    else
    {
        if (isNaN(m))
        {
            error += Validate.mN();
        }
        if ((s >= 0) == false)
        {
            error += Validate.sN();
        }
        if (isNaN(x))
        {
            error += Validate.xN();
        }

        value = false;
    }
    
    if (value == false)
    {
        alert(error);
    }
    
    return value;
}

Validate.standardNormal = function (x)
{
    var value = true;
    var error = "Error: ";
    
    if (isNaN(x) == false)
    {
        value = true;
    }
    else
    {
        if (isNaN(x))
        {
            error += Validate.xSN();
        }

        value = false;
    }
    
    if (value == false)
    {
        alert(error);
    }
    
    return value;
}

Validate.continuousUniform = function (a, b)
{
    var value = true;
    var error = "Error: ";
    
    if ( (isNaN(a) == false) && (isNaN(b) == false) )
    {
        value = true;
    }
    else
    {
        if (isNaN(a))
        {
            error += Validate.aCU();
        }
        if (isNaN(b))
        {
            error += Validate.bCU();
        }

        value = false;
    }
    
    if (value == false)
    {
        alert(error);
    }
    
    return value;
}

Validate.exponential = function (beta, x)
{
    var value = true;
    var error = "Error: ";
    
    if ( (beta >= 0) && (isNaN(x) == false) )
    {
        value = true;
    }
    else
    {
        if ((beta >= 0) == false)
        {
            error += Validate.betaE();
        }
        if (isNaN(x))
        {
            error += Validate.xE();
        }

        value = false;
    }
    
    if (value == false)
    {
        alert(error);
    }
    
    return value;
}
