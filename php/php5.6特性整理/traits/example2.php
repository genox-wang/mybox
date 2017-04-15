<?php 
    //同名属性或方法 当前类覆盖trait trait覆盖基类
    trait Drive {
        public function hello() {
            echo "hello drive\n";
        }
        public function driving() {
            echo "driving from drive\n";
        }
    }
    class Person {
        public function hello() {
            echo "hello person\n";
        }
        public function driving() {
            echo "driving from person\n";
        }
    }
    class Student extends Person {
        use Drive;
        public function hello() {
            echo "hello student\n";
        }
    }
    $student = new Student();
    $student->hello();//hello student
    $student->driving();//driving from drive