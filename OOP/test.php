<?php
class A
{
    private function __construct()
    {
        echo 'Hello';
    }
}
class B extends A{

}

$test = new B();
$test->test()
?>