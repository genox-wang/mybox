<?php

trait Trait1 {
    public function hello() {
        echo "Trait1::hello\n";
    }
    public function hi() {
        echo "Trait1::hi\n";
    }
}
trait Trait2 {
    public function hello() {
        echo "Trait2::hello\n";
    }
    public function hi() {
        echo "Trait2::hi\n";
    }
}
class Class1 {
    use Trait1, Trait2 {
        Trait2::hello insteadof Trait1;//用insteadof解决冲突
        Trait1::hi insteadof Trait2;
    }
}
class Class2 {
    use Trait1, Trait2 {
        Trait2::hello insteadof Trait1;
        Trait1::hi insteadof Trait2;
        Trait2::hi as hei;//用as修改别名
        Trait1::hello as hehe;
    }
}
$Obj1 = new Class1();
$Obj1->hello();//Trait2::hello
$Obj1->hi();//Trait1::hi
echo "\n";
$Obj2 = new Class2();
$Obj2->hello();//Trait2::hello
$Obj2->hi();//Trait1::hi
$Obj2->hei();//Trait2::hi
$Obj2->hehe();//Trait1::hello
