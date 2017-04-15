<?php
//多个Trait包含同名属性或者方法
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
    use Trait1, Trait2;
}
//产生致命错误
//Fatal error: Trait method hello has not been applied, because there are collisions with other trait methods on Class1 in /Users/wilford/Sites/phpTutorial/traits/example3.php on line 19