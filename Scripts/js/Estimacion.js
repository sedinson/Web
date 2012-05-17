/*Todas las funciones inversas aqui presentadas NORMSINV, tStudentICDF. fisherICDF, critchi
 *son funciones adaptadas para que tiren el resultado de una grafica acumulada a la derecha
 *
 *Andrés A. Pérez L.
 */
////
// Lower tail quantile for standard normal distribution function.
//
// This function returns an approximation of the inverse cumulative
// standard normal distribution function.  I.e., given P, it returns
// an approximation to the X satisfying P = Pr{Z <= X} where Z is a
// random variable from the standard normal distribution.
//
// The algorithm uses a minimax approximation by rational functions
// and the result has a relative error whose absolute value is less
// than 1.15e-9.
//
// Author:      Peter John Acklam
// (Javascript version by Alankar Misra @ Digital Sutras (alankar@digitalsutras.com))
// (Right comulative Mod: Andr�s P�rez
// Time-stamp:  2003-05-05 05:15:14
// E-mail:      pjacklam@online.no
// WWW URL:     http://home.online.no/~pjacklam

// An algorithm with a relative error less than 1.15*10-9 in the entire region.

function NORMSINV(p)
{
    // Coefficients in rational approximations
    var a = new Array(-3.969683028665376e+01,  2.209460984245205e+02,
                      -2.759285104469687e+02,  1.383577518672690e+02,
                      -3.066479806614716e+01,  2.506628277459239e+00);

    var b = new Array(-5.447609879822406e+01,  1.615858368580409e+02,
                      -1.556989798598866e+02,  6.680131188771972e+01,
                      -1.328068155288572e+01 );

    var c = new Array(-7.784894002430293e-03, -3.223964580411365e-01,
                      -2.400758277161838e+00, -2.549732539343734e+00,
                      4.374664141464968e+00,  2.938163982698783e+00);

    var d = new Array (7.784695709041462e-03, 3.224671290700398e-01,
                       2.445134137142996e+00,  3.754408661907416e+00);

    // Define break-points.
    var plow  = 0.02425;
    var phigh = 1 - plow;
    var q;
    // Rational approximation for lower region:
    if ( p < plow ) {
             q  = Math.sqrt(-2*Math.log(p));
             return -1*(((((c[0]*q+c[1])*q+c[2])*q+c[3])*q+c[4])*q+c[5]) /
                                             ((((d[0]*q+d[1])*q+d[2])*q+d[3])*q+1);
    }
    

    // Rational approximation for upper region:
    if ( phigh < p ) {
             q  = Math.sqrt(-2*Math.log(1-p));
             return -1*(((((c[0]*q+c[1])*q+c[2])*q+c[3])*q+c[4])*q+c[5]) /
                                                    ((((d[0]*q+d[1])*q+d[2])*q+d[3])*q+1);
    }

    // Rational approximation for central region:
    q = p - 0.5;
    var r = q*q;
    return -1*(((((a[0]*r+a[1])*r+a[2])*r+a[3])*r+a[4])*r+a[5])*q /
                             (((((b[0]*r+b[1])*r+b[2])*r+b[3])*r+b[4])*r+1);
}

/**    
  * Copyright (C) 2006, Laboratorio di Valutazione delle Prestazioni - Politecnico di Milano

  * This program is free software; you can redistribute it and/or modify
  * it under the terms of the GNU General Public License as published by
  * the Free Software Foundation; either version 2 of the License, or
  * (at your option) any later version.

  * This program is distributed in the hope that it will be useful,
  * but WITHOUT ANY WARRANTY; without even the implied warranty of
  * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  * GNU General Public License for more details.

  * You should have received a copy of the GNU General Public License
  * along with this program; if not, write to the Free Software
  * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
  */

/*
 * FDistribution.java
 *
 * Created on 1 novembre 2002, 0.24
 * Javascript Adaptation by Andrés A. Pérez L.
 * Mod on May 15 2012
 */
var T_STUDENT_TABLE = [ [ 0.60, 0.75, 0.90, 0.95, 0.975, 0.99, 0.995, 0.9995 ],
	[ 0.324920, 1.000000, 3.077684, 6.313752, 12.70620, 31.82052, 63.65674, 636.6192 ],
	[ 0.288675, 0.816497, 1.885618, 2.919986, 4.30265, 6.96456, 9.92484, 31.5991 ],
	[ 0.276671, 0.764892, 1.637744, 2.353363, 3.18245, 4.54070, 5.84091, 12.9240 ],
	[ 0.270722, 0.740697, 1.533206, 2.131847, 2.77645, 3.74695, 4.60409, 8.6103 ],
	[ 0.267181, 0.726687, 1.475884, 2.015048, 2.57058, 3.36493, 4.03214, 6.8688 ],
	[ 0.264835, 0.717558, 1.439756, 1.943180, 2.44691, 3.14267, 3.70743, 5.9588 ],
	[ 0.263167, 0.711142, 1.414924, 1.894579, 2.36462, 2.99795, 3.49948, 5.4079 ],
	[ 0.261921, 0.706387, 1.396815, 1.859548, 2.30600, 2.89646, 3.35539, 5.0413 ],
	[ 0.260955, 0.702722, 1.383029, 1.833113, 2.26216, 2.82144, 3.24984, 4.7809 ],
	[ 0.260185, 0.699812, 1.372184, 1.812461, 2.22814, 2.76377, 3.16927, 4.5869 ],
	[ 0.259556, 0.697445, 1.363430, 1.795885, 2.20099, 2.71808, 3.10581, 4.4370 ],
	[ 0.259033, 0.695483, 1.356217, 1.782288, 2.17881, 2.68100, 3.05454, 4.3178 ],
	[ 0.258591, 0.693829, 1.350171, 1.770933, 2.16037, 2.65031, 3.01228, 4.2208 ],
	[ 0.258213, 0.692417, 1.345030, 1.761310, 2.14479, 2.62449, 2.97684, 4.1405 ],
	[ 0.257885, 0.691197, 1.340606, 1.753050, 2.13145, 2.60248, 2.94671, 4.0728 ],
	[ 0.257599, 0.690132, 1.336757, 1.745884, 2.11991, 2.58349, 2.92078, 4.0150 ],
	[ 0.257347, 0.689195, 1.333379, 1.739607, 2.10982, 2.56693, 2.89823, 3.9651 ],
	[ 0.257123, 0.688364, 1.330391, 1.734064, 2.10092, 2.55238, 2.87844, 3.9216 ],
	[ 0.256923, 0.687621, 1.327728, 1.729133, 2.09302, 2.53948, 2.86093, 3.8834 ],
	[ 0.256743, 0.686954, 1.325341, 1.724718, 2.08596, 2.52798, 2.84534, 3.8495 ],
	[ 0.256580, 0.686352, 1.323188, 1.720743, 2.07961, 2.51765, 2.83136, 3.8193 ],
	[ 0.256432, 0.685805, 1.321237, 1.717144, 2.07387, 2.50832, 2.81876, 3.7921 ],
	[ 0.256297, 0.685306, 1.319460, 1.713872, 2.06866, 2.49987, 2.80734, 3.7676 ],
	[ 0.256173, 0.684850, 1.317836, 1.710882, 2.06390, 2.49216, 2.79694, 3.7454 ],
	[ 0.256060, 0.684430, 1.316345, 1.708141, 2.05954, 2.48511, 2.78744, 3.7251 ],
	[ 0.255955, 0.684043, 1.314972, 1.705618, 2.05553, 2.47863, 2.77871, 3.7066 ],
	[ 0.255858, 0.683685, 1.313703, 1.703288, 2.05183, 2.47266, 2.77068, 3.6896 ],
	[ 0.255768, 0.683353, 1.312527, 1.701131, 2.04841, 2.46714, 2.76326, 3.6739 ],
	[ 0.255684, 0.683044, 1.311434, 1.699127, 2.04523, 2.46202, 2.75639, 3.6594 ],
	[ 0.255605, 0.682756, 1.310415, 1.697261, 2.04227, 2.45726, 2.75000, 3.6460 ],
	[ 0.253347, 0.674490, 1.281552, 1.644854, 1.95996, 2.32635, 2.57583, 3.2905 ] ];

var MACHEP = 1.11022302462515654042E-16;
var MAXLOG = 7.09782712893383996732E2;
var MINLOG = -7.451332191019412076235E2;
var MAXGAM = 171.624376956302725;
var SQTPI = 2.50662827463100050242E0;
var SQRTH = 7.07106781186547524401E-1;
var LOGPI = 1.14472988584940017414;
var big = 4.503599627370496e15;
var biginv = 2.22044604925031308085e-16;

function fisherICDF(p,den,num){
    var precision = 0.0001;
    var max = p + precision;
    var min = p - precision;
    var z1 = 1;
    var z2 = 10;
    var zs;
    var sol;
    while (FisherCDF(z2, num, den) < p) {
            z2 *= 2;
    }
    while (FisherCDF(z1, num, den) > p) {
            z1 /= 2;
    }

    zs = z2 / 2;
    sol = FisherCDF(zs, num, den);
    while (sol > max || sol < min) {
            /* False position iteration. */
            zs = z1 + (z2 - z1) * (-(p - FisherCDF(z1, num, den))) / ((p - FisherCDF(z2, num, den)) - (p - FisherCDF(z1, num, den)));
            if ((p - FisherCDF(zs, num, den)) * (p - FisherCDF(z1, num, den)) > 0) {
                    z1 = zs;
            } else {
                    z2 = zs;
            }
            sol = FisherCDF(zs, num, den);
    }
    return 1/zs;
}
function FisherCDF(f,num,den) {
    var df1 = num;
    var df2 = den;
    return betaInv(df1 * f / (df1 * f + df2), 0.5 * df1, 0.5 * df2);
}
function betaInv(x1,p,q) {
    // ALGORITHM AS 63 APPL. STATIST. VOL.32, NO.1
    // Computes P(Beta>x)
    var beta, acu, psq, cx, x2, pp, qq, term, ai, betain, ns, rx, temp;
    var indx;
    beta = lnBeta(p, q);
    acu = 1e-14;
    psq = p + q;
    cx = 1 - x1;
    if (p < psq * x1) {
            x2 = cx;
            cx = x1;
            pp = q;
            qq = p;
            indx = true;
    } else {
            x2 = x1;
            pp = p;
            qq = q;
            indx = false;
    }
    term = 1;
    ai = 1;
    betain = 1;
    ns = qq + cx * psq;
    rx = x2 / cx;
    temp = qq - ai;
    if (ns == 0) {
            rx = x2;
    }
    while (temp > acu && temp > acu * betain) {
            term = term * temp * rx / (pp + ai);
            betain = betain + term;
            temp = Math.abs(term);
            if (temp > acu && temp > acu * betain) {
                    ai++;
                    ns--;
                    if (ns >= 0) {
                            temp = qq - ai;
                            if (ns == 0) {
                                    rx = x2;
                            }
                    } else {
                            temp = psq;
                            psq += 1;
                    }
            }
    }
    betain *= Math.exp(pp * Math.log(x2) + (qq - 1) * Math.log(cx) - beta) / pp;
    if (indx) {
            betain = 1 - betain;
    }
    return betain;
}
function lnBeta(a,b) {
    return (lnGamma(a) + lnGamma(b) - lnGamma(a + b));
}
function lnGamma(c) {
    var cof = [76.18009172947146, -86.50532032941677, 24.01409824083091, -1.231739572450155, 0.1208650973866179e-2, -0.5395239384953e-5];
    var xx = c;
    var yy = c;
    var tmp = xx + 5.5 - (xx + 0.5) * Math.log(xx + 5.5);
    var ser = 1.000000000190015;
    for (var j = 0; j <= 5; j++) {
            ser += (cof[j] / ++yy);
    }
    return (Math.log(2.5066282746310005 * ser / xx) - tmp);
}

function tStudentICDF(quantile,freedomDegrees) {
    var t = 0;
    var j = 0;
    quantile *= 2;
    freedomDegrees++;
    var p = 1 - (quantile / 2);
    if (p == .6) {
            j = 0;
    } else if (p == .75) {
            j = 1;
    } else if (p == .90) {
            j = 2;
    } else if (p == .95) {
            j = 3;
    } else if (p == .975) {
            j = 4;
    } else if (p == .99) {
            j = 5;
    } else if (p == .995) {
            j = 6;
    } else if (p == .9995) {
            j = 7;
    } else {
            return tStudent(quantile, freedomDegrees, false);
    }
    if (freedomDegrees <= 30) {
            t = T_STUDENT_TABLE[freedomDegrees - 1][j];
    } else {
            t = T_STUDENT_TABLE[30][j] - (1 - 30 / freedomDegrees) * (T_STUDENT_TABLE[30][j] - T_STUDENT_TABLE[31][j]);
    }
    return t;
}
function tStudent(p,ndf,lower_tail) {
    // Algorithm 396: Student's t-quantiles by
    // G.W. Hill CACM 13(10), 619-620, October 1970
    var eps = 1e-12;
    var M_PI_2 = 1.570796326794896619231321691640; // pi/2
    var neg;
    var P, q, prob, a, b, c, d, y, x;
    if ((lower_tail && p > 0.5) || (!lower_tail && p < 0.5)) {
            neg = false;
            P = 2 * (lower_tail ? (1 - p) : p);
    } else {
            neg = true;
            P = 2 * (lower_tail ? p : (1 - p));
    }

    if (Math.abs(ndf - 2) < eps) { /* df ~= 2 */
            q = Math.sqrt(2 / (P * (2 - P)) - 2);
    } else if (ndf < 1 + eps) { /* df ~= 1 */
            prob = P * M_PI_2;
            q = Math.cos(prob) / Math.sin(prob);
    } else { /*-- usual case;  including, e.g.,  df = 1.1 */
            a = 1 / (ndf - 0.5);
            b = 48 / (a * a);
            c = ((20700 * a / b - 98) * a - 16) * a + 96.36;
            d = ((94.5 / (b + c) - 3) / b + 1) * Math.sqrt(a * M_PI_2) * ndf;
            y = Math.pow(d * P, 2 / ndf);
            if (y > 0.05 + a) {
                    /* Asymptotic inverse expansion about normal */
                    x = qnorm(0.5 * P, false);
                    y = x * x;
                    if (ndf < 5) {
                            c += 0.3 * (ndf - 4.5) * (x + 0.6);
                    }
                    c = (((0.05 * d * x - 5) * x - 7) * x - 2) * x + b + c;
                    y = (((((0.4 * y + 6.3) * y + 36) * y + 94.5) / c - y - 3) / b + 1) * x;
                    y = a * y * y;
                    if (y > 0.002) {
                            y = Math.exp(y) - 1;
                    } else { /* Taylor of    e^y -1 : */
                            y = (0.5 * y + 1) * y;
                    }
            } else {
                    y = ((1 / (((ndf + 6) / (ndf * y) - 0.089 * d - 0.822) * (ndf + 2) * 3) + 0.5 / (ndf + 4)) * y - 1) * (ndf + 1) / (ndf + 2) + 1 / y;
            }
            q = Math.sqrt(ndf * y);
    }
    if (neg) {
            q = -q;
    }
    return q;
}
function qnorm(p,upper) {
    /* Reference:
        J. D. Beasley and S. G. Springer
        Algorithm AS 111: "The Percentage Points of the Normal Distribution"
        Applied Statistics
    */
    var split = 0.42, a0 = 2.50662823884, a1 = -18.61500062529, a2 = 41.39119773534, a3 = -25.44106049637, b1 = -8.47351093090, b2 = 23.08336743743, b3 = -21.06224101826, b4 = 3.13082909833, c0 = -2.78718931138, c1 = -2.29796479134, c2 = 4.85014127135, c3 = 2.32121276858, d1 = 3.54388924762, d2 = 1.63706781897, q = p - 0.5;
    var r, ppnd;
    if (Math.abs(q) <= split) {
            r = q * q;
            ppnd = q * (((a3 * r + a2) * r + a1) * r + a0) / ((((b4 * r + b3) * r + b2) * r + b1) * r + 1);
    } else {
            r = p;
            if (q > 0) {
                    r = 1 - p;
            }
            if (r > 0) {
                    r = Math.sqrt(-Math.log(r));
                    ppnd = (((c3 * r + c2) * r + c1) * r + c0) / ((d2 * r + d1) * r + 1);
                    if (q < 0) {
                            ppnd = -ppnd;
                    }
            } else {
                    ppnd = 0;
            }
    }
    if (upper) {
            ppnd = 1 - ppnd;
    }
    return (ppnd);
}
/*  The following JavaScript functions for calculating normal and
    chi-square probabilities and critical values were adapted by
    John Walker from C implementations
    written by Gary Perlman of Wang Institute, Tyngsboro, MA
    01879.  Both the original C code and this JavaScript edition
    are in the public domain.  */

/*  POZ  --  probability of normal z value

    Adapted from a polynomial approximation in:
            Ibbetson D, Algorithm 209
            Collected Algorithms of the CACM 1963 p. 616
    Note:
            This routine has six digit accuracy, so it is only useful for absolute
            z values < 6.  For z values >= to 6.0, poz() returns 0.0.
*/

function poz(z) {
    var y, x, w;
    var Z_MAX = 6.0;              /* Maximum meaningful z value */

    if (z == 0.0) {
        x = 0.0;
    } else {
        y = 0.5 * Math.abs(z);
        if (y >= (Z_MAX * 0.5)) {
            x = 1.0;
        } else if (y < 1.0) {
            w = y * y;
            x = ((((((((0.000124818987 * w
                        - 0.001075204047) * w + 0.005198775019) * w
                        - 0.019198292004) * w + 0.059054035642) * w
                        - 0.151968751364) * w + 0.319152932694) * w
                        - 0.531923007300) * w + 0.797884560593) * y * 2.0;
        } else {
            y -= 2.0;
            x = (((((((((((((-0.000045255659 * y
                            + 0.000152529290) * y - 0.000019538132) * y
                            - 0.000676904986) * y + 0.001390604284) * y
                            - 0.000794620820) * y - 0.002034254874) * y
                            + 0.006549791214) * y - 0.010557625006) * y
                            + 0.011630447319) * y - 0.009279453341) * y
                            + 0.005353579108) * y - 0.002141268741) * y
                            + 0.000535310849) * y + 0.999936657524;
        }
    }
    return z > 0.0 ? ((x + 1.0) * 0.5) : ((1.0 - x) * 0.5);
}


var BIGX = 20.0;                  /* max value to represent exp(x) */

function ex(x) {
    return (x < -BIGX) ? 0.0 : Math.exp(x);
}   

/*  POCHISQ  --  probability of chi-square value

            Adapted from:
                    Hill, I. D. and Pike, M. C.  Algorithm 299
                    Collected Algorithms for the CACM 1967 p. 243
            Updated for rounding errors based on remark in
                    ACM TOMS June 1985, page 185
*/

function pochisq(x, df) {
    var a, y, s;
    var e, c, z;
    var even;                     /* True if df is an even number */

    var LOG_SQRT_PI = 0.5723649429247000870717135; /* log(sqrt(pi)) */
    var I_SQRT_PI = 0.5641895835477562869480795;   /* 1 / sqrt(pi) */

    if (x <= 0.0 || df < 1) {
        return 1.0;
    }

    a = 0.5 * x;
    even = !(df & 1);
    if (df > 1) {
        y = ex(-a);
    }
    s = (even ? y : (2.0 * poz(-Math.sqrt(x))));
    if (df > 2) {
        x = 0.5 * (df - 1.0);
        z = (even ? 1.0 : 0.5);
        if (a > BIGX) {
            e = (even ? 0.0 : LOG_SQRT_PI);
            c = Math.log(a);
            while (z <= x) {
                e = Math.log(z) + e;
                s += ex(c * z - a - e);
                z += 1.0;
            }
            return s;
        } else {
            e = (even ? 1.0 : (I_SQRT_PI / Math.sqrt(a)));
            c = 0.0;
            while (z <= x) {
                e = e * (a / z);
                c = c + e;
                z += 1.0;
            }
            return c * y + s;
        }
    } else {
        return s;
    }
}

/*  CRITCHI  --  Compute critical chi-square value to
                    produce given p.  We just do a bisection
                    search for a value within CHI_EPSILON,
                    relying on the monotonicity of pochisq().  */

function critchi(p, df) {
    var CHI_EPSILON = 0.000001;   /* Accuracy of critchi approximation */
    var CHI_MAX = 99999.0;        /* Maximum chi-square value */
    var minchisq = 0.0;
    var maxchisq = CHI_MAX;
    var chisqval;

    if (p <= 0.0) {
        return maxchisq;
    } else {
        if (p >= 1.0) {
            return 0.0;
        }
    }

    chisqval = df / Math.sqrt(p);    /* fair first value */
    while ((maxchisq - minchisq) > CHI_EPSILON) {
        if (pochisq(chisqval, df) < p) {
            maxchisq = chisqval;
        } else {
            minchisq = chisqval;
        }
        chisqval = (maxchisq + minchisq) * 0.5;
    }
    return chisqval;
}

//	TRIMFLOAT  --  Trim a floating point number to maximum number of digits

function trimfloat(ov, d) {
    var o = "", v = ov.toString();
    var c, i, n = 0, indec = false, aftdec = false;

    for (i = 0; i < v.length; i++) {
        c = v.charAt(i);
        if (!indec) {
            if (c == '.') {
                indec = true;
            }
            o += c;
        } else {
            if (aftdec) {
                o += c;
            } else {
                if ((c >= '0') && (c <= '9')) {
                    if (n < d) {
                        o += c;
                    }
                    n++;
                } else {
                    aftdec = true;
                    o += c;
                }
            }
        }
    }
    return o;
}


