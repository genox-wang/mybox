<?php
trait Hello {
    public function sayHello() {
        echo "Hello\n";
    }
}
trait World {
    use Hello;
    public function sayWorld() {
        echo "World\n";
    }
    abstract public function getWorld();//抽象方法
    public function inc() {
        static $c = 0;//静态变量
        $c = $c + 1;
        echo "$c\n";
    }
    public static function doSomething() {//静态方法
        echo "Doing something\n";
    }
}
class HelloWorld {
    use World;
    public function getWorld() {
        return 'get World';
    }
}
$Obj = new HelloWorld();
$Obj->sayHello();#Hello
$Obj->sayWorld();#World
echo $Obj->getWorld() . "\n";#get World
HelloWorld::doSomething();#Doing something
$Obj->inc();#1
$Obj->inc();#2