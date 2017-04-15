<?php
$name = "MyName";

//Heredoc 语法<<<标记...标记，可以插入变量 标记后不能有空格
echo <<<TEST1
My name is "{$name}"
TEST1;
//My name is "MyName"


//作为方法参数
echo var_dump(<<<EOD
Hello World
EOD
);
//string(11) "Hello World" 

//常量变量赋值
class A
{
    const xx = <<< EOD
constXX
EOD;

    public $oo = <<< EOD
var_oo
EOD;
}

$a = new A;
echo $a::xx;//constXX
echo $a->oo;//var_oo

//Nowdoc 语法<<<'标记'...标记，可以插入变量 标记后不能有空格
echo <<< 'TEST2'
My name is "{$name}".
TEST2;
//My name is "{$name}".

?>