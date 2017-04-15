<?php
class A
{
    static public function callFuncXXOO()
    {
        print self::funcXXOO();
    }

    static public function funcXXOO()
    {
        return "A::funcXXOO()";
    }
}

class B extends A
{
    static public function funcXXOO()
    {
        return "B::funcXXOO";
    }
}

$b = new B;
$b->callFuncXXOO();//A::funcXXOO()

class C
{
    static public function callFuncXXOO()
    {
        print self::funcXXOO();
    }

    static public function funcXXOO()
    {
        return "C::funcXXOO()";
    }
}

class D extends C
{
    static public function funcXXOO()
    {
        return "D::funcXXOO";
    }
}

$d = new D;
$d->callFuncXXOO();//C::funcXXOO()