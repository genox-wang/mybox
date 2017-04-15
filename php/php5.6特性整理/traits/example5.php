<?php
    trait Hello {
        public function hello() {
            echo "hello,trait\n";
        }
    }
    class Class1 {
        use Hello {
            hello as protected; //as修改方法访问权限
        }
    }
    class Class2 {
        use Hello {
            Hello::hello as private hi;
        }
    }
    $Obj1 = new Class1();
    // $Obj1->hello(); # 报致命错误，因为hello方法被修改成受保护的
    $Obj2 = new Class2();
    $Obj2->hello(); # 原来的hello方法仍然是公共的
    //$Obj2->hi();  # 报致命错误，因为别名hi方法被修改成私有的
