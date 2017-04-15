<?php
namespace Name\Space {
    const FOO = 42;
    function f() { echo __FUNCTION__."\n"; }
}

namespace {
	//支持对常量的引用
    use const Name\Space\FOO;
    //支持对函数的引用
    use function Name\Space\f;

    echo FOO."\n";//42
    f();//Name\Space\f
}