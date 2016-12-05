<?php
class Fraction
{
    protected $numerator = 0;
    protected $denominator = 1;

    public function __construct($numerator, $denominator)
    {
        try {

            if ($denominator == 0) {
                throw new Exception('Div on zero!<br>');
            }
            $this->numerator = $numerator;
            $this->denominator =$denominator;
            echo 'New fraction: '.$numerator.'/'.$denominator.'<br>';
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    public function fractionsReduction()
    {
        $n = $this->numerator;
        $d = $this->denominator;
        $whole = intval($n/$d); //выделить целую чать
        $n = $n%$d;
        $gcd = gmp_gcd($n, $d); //наибольший общий делитель
        echo 'Reduced fraction: ';
        if ($whole > 0){
                if ((($n/$gcd)) != ($d/$gcd)) {
                    echo $whole.'*'.($n/$gcd).'/'.$d/$gcd;
                }
        }
        else if(($n/$gcd)%($d/$gcd) != 0){
            echo $n/$gcd.'/'.$d/$gcd;
        }
        echo '<br>';
    }

    public function decimalFraction ()
    {
        $n = $this->numerator;
        $d = $this->denominator;
        $df = (double) $n/$d;
        echo 'Decimal fraction: '.$df.'<br>' ;
    }

    static public function addition($n1, $d1, $n2, $d2)
    {
        try {

            if ($d1 == 0 || $d2 == 0) {
                throw new Exception('Div on zero!<br>');
            }
        $numerator = $n1 * $d2 + $n2 * $d1;
        $denominator =   $d1 * $d2;
        echo 'Addition: '.$n1.'/'.$d1.'+'.$n2.'/'.$d2.'='.$numerator.'/'.$denominator.'<br>';
        return array($numerator, $denominator);
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    static public function subtraction($n1, $d1, $n2, $d2)
    {
        try {

            if ($d1 == 0 || $d2 == 0) {
                throw new Exception('Div on zero!<br>');
            }
        $numerator = $n1 * $d2 - $n2 * $d1;
        $denominator =   $d1 * $d2;
        echo 'Subtraction: '.$n1.'/'.$d1.'-'.$n2.'/'.$d2.'='.$numerator.'/'.$denominator.'<br>';
        return array($numerator, $denominator);
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }
    static public function mult($n1, $d1, $n2, $d2)
    {
        try {

            if ($d1 == 0 || $d2 == 0) {
                throw new Exception('Div on zero!<br>');
            }
            $numerator = $n1 * $n2 ;
            $denominator =   $d1 * $d2;
            echo 'Multiply: ('.$n1.'/'.$d1.')*('.$n2.'/'.$d2.')='.$numerator.'/'.$denominator.'<br>';
            return array($numerator, $denominator);
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }
    static public function div($n1, $d1, $n2, $d2)
    {
        try {

        if ($d1 == 0 || $d2 == 0) {
            throw new Exception('Div on zero!<br>');
        }
        $numerator = $n1 / $n2;
        $denominator =   $d1 / $d2;
        echo 'Division: ('.$n1.'/'.$d1.')/('.$n2.'/'.$d2.')='.$numerator.'/'.$denominator.'<br>';
        return array($numerator, $denominator);
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }
}

$drob = new Fraction(14, 0);
echo $drob->fractionsReduction();
echo $drob->decimalFraction();

$addition = Fraction::addition(14, 3, 3, 4);
$drob = new Fraction($addition[0], $addition[1]);
echo $drob->fractionsReduction();

$sub = Fraction::subtraction(3, 4, 2, 5);
$drob = new Fraction($sub[0], $sub[1]);
echo $drob->fractionsReduction();

