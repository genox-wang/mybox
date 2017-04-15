<?php

class A
 {
    public function __invoke($str)
    {
        print "A::__invoke(): {$str}";
    }
 }
$a = new A;
$a("Hello World");//输出'HelloWorld'


class ActiveRecordBase {
    /**  As of PHP 5.3.0  */
    public static function __callStatic($name, $arguments) {
        if ($name == 'getById') {
            $id= $arguments[0];
            return get_called_class() . '('. $id . ')';
        }
 
        throw new Exception('Invalid method : '.$name);
    }
 }
 
class Person extends ActiveRecordBase { 
  
}
 
// output: Person(123)
echo Person::getById(123);

