<?php
//类名通过::class可以获取
namespace Name\Space;
class ClassName {}
echo ClassName::class;//Name\Space\ClassName

// 原来的数组写法
$arr = array("key" => "value", "key2" => "value2");
// 简写形式
$arr = ["key" => "value", "key2" => "value2"];

//可变函数参数代替func_get_args()
function add(...$args)
{
    $result = 0;
    foreach($args as $arg)
        $result += $arg;
    echo $result;
}

//可以在调用函数时，把数组展开为函数参数
$arr = [2,3];
add(1,...$arr);

//三元运算符的简写形式
$a = 'A';
echo $a ?: "No Value";//A

//非变量array和string也能支持下标获取
echo array(1, 2, 3)[0];//1
echo [1, 2, 3][0]; //1
echo "foobar"[2];//o

//用foreach+list简化二位数组的迭代
$array = [
    [1, 2],
    [3, 4],
];
 
foreach ($array as list($a, $b)) {
    echo "A: $a; B: $b\n";//A: 1; B: 2 A: 3; B: 4
}

//用yield 返回一个迭代，注意返回的是一个迭代而不是直接就是一个数组
function number10()
{
    for($i = 1; $i <= 10; $i += 1)
        yield $i;
}

foreach (number10() as $number) {
    echo "$number ";//1 2 3 4 5 6 7 8 9 10
}

?>

<?= 'test' ?>
