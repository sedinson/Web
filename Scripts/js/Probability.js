
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


//CASOS CONTINUOS

Probability.normal = function (m, s, x)
{
    return ( (1/Math.sqrt(2 * Math.PI * s)) * Math.exp((-1) * (1/2) * Math.pow((x - m)/s, 2)) );
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
    return ( (1/beta) * Math.exp( ((-1) * x)/beta ) );
}


//CALCULO DE DISTRIBUCIONES DE PROBABILIDAD ACUMULADAS

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
    for(var i=0; i<=x; i++)
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
    for(var i=0; i<=k; i++)
    {
        sum += Probability.discreteUniform(i);
    }
    return sum;
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
    
    result = result.toFixed(3);

    return result;
}

Probability.calculateGeometric = function (p, x, direction)
{
    var result = 0;
    
    if (Validate.geometric(p, x))
    {
        if (direction == "=")
        {
            result = Probability.geometric(p, x);
        }
        else if (direction == "<=")
        {
            result = Probability.geometricAccumulated(p, x);
        }
        else if (direction == "<")
        {
            result = Probability.geometricAccumulated(p, x-1);
        }
        else if (direction == ">=")
        {
            result = 1 - Probability.geometricAccumulated(p, x-1);
        }
        else if (direction == ">")
        {
            result = 1 - Probability.geometricAccumulated(p, x);
        }
    }
    
    result = result.toFixed(3);

    return result;
}

Probability.calculateNegativeBinomial = function (k, p, x, direction)
{
    var result = 0;
    
    if (Validate.negativeBinomial(k, p, x))
    {
        if (direction == "=")
        {
            result = Probability.negativeBinomial(k, p, x);
        }
        else if (direction == "<=")
        {
            result = Probability.negativeBinomialAccumulated(k, p, x);
        }
        else if (direction == "<")
        {
            result = Probability.negativeBinomialAccumulated(k, p, x-1);
        }
        else if (direction == ">=")
        {
            result = 1 - Probability.negativeBinomialAccumulated(k, p, x-1);
        }
        else if (direction == ">")
        {
            result = 1 - Probability.negativeBinomialAccumulated(k, p, x);
        }
    }
    
    result = result.toFixed(3);

    return result;
}

Probability.calculateHyperGeometric = function (N, n, k, x, direction)
{
    var result = 0;
    
    if (Validate.hyperGeometric(N, n, k, x))
    {
        if (direction == "=")
        {
            result = Probability.hyperGeometric(N, n, k, x);
        }
        else if (direction == "<=")
        {
            result = Probability.hyperGeometricAccumulated(N, n, k, x);
        }
        else if (direction == "<")
        {
            result = Probability.hyperGeometricAccumulated(N, n, k, x-1);
        }
        else if (direction == ">=")
        {
            result = 1 - Probability.hyperGeometricAccumulated(N, n, k, x-1);
        }
        else if (direction == ">")
        {
            result = 1 - Probability.hyperGeometricAccumulated(N, n, k, x);
        }
    }
    
    result = result.toFixed(3);

    return result;
}

Probability.calculatePoisson = function (lambda, x, direction)
{
    var result = 0;
    
    if (Validate.poisson(lambda, x))
    {
        if (direction == "=")
        {
            result = Probability.poisson(lambda, x);
        }
        else if (direction == "<=")
        {
            result = Probability.poissonAccumulated(lambda, x);
        }
        else if (direction == "<")
        {
            result = Probability.poissonAccumulated(lambda, x-1);
        }
        else if (direction == ">=")
        {
            result = 1 - Probability.poissonAccumulated(lambda, x-1);
        }
        else if (direction == ">")
        {
            result = 1 - Probability.poissonAccumulated(lambda, x);
        }
    }
    
    result = result.toFixed(3);

    return result;
}

Probability.calculateDiscreteUniform = function (k, direction)
{
    var result = 0;
    
    if (Validate.discreteUniform(k))
    {
        if (direction == "=")
        {
            result = Probability.discreteUniform(k);
        }
        else if (direction == "<=")
        {
            result = Probability.discreteUniformAccumulated(k);
        }
        else if (direction == "<")
        {
            result = Probability.discreteUniformAccumulated(k);
        }
        else if (direction == ">=")
        {
            result = 1 - Probability.discreteUniformAccumulated(k);
        }
        else if (direction == ">")
        {
            result = 1 - Probability.discreteUniformAccumulated(k);
        }
    }
    
    result = result.toFixed(3);

    return result;
}

Probability.calculateNormal = function (m, s, x)
{
    var result = 0;
    
    if (Validate.normal(m, s, x))
    {
        result = Probability.normal(m, s, x);
    }
    
    result = result.toFixed(3);

    return result;
}

Probability.calculateStandardNormal = function (x)
{
    var result = 0;
    
    if (Validate.standardNormal(x))
    {
        result = Probability.standardNormal(x);
    }
    
    result = result.toFixed(3);

    return result;
}

Probability.calculateContinuousUniform = function (a, b)
{
    var result = 0;
    
    if (Validate.continuousUniform(a, b))
    {
        result = Probability.continuousUniform(a, b);
    }
    
    result = result.toFixed(3);

    return result;
}

Probability.calculateExponential = function (beta, x)
{
    var result = 0;
    
    if (Validate.exponential(beta, x))
    {
        result = Probability.exponential(beta, x);
    }
    
    result = result.toFixed(3);

    return result;
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
