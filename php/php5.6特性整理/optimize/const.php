<?php

//旧风格define('constVar','Value');
const constVar = 'Value';

//不适用于运行时才能求值的表达式
//const constVar = 2 * 617;

//但允许使用之前定义的常量进行计算
const A = 2;
const B = A + 1;

class C
{
    const STR = "hello";
    const STR2 = self::STR." world";
}
//允许常量作为函数参数默认值
function func($arg = C::STR2){
 	echo $arg;
}
func();
//hello world
?>
