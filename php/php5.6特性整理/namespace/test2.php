<?php

//test2.php
// 你还可以用花括号定义命名空间
namespace NameC\Test{

	require_once('test1.php');
	 // 导入来自其他命名空间的名称，并重命名，
    // 注意只能导入类，不能用于函数和常量
	use \NameA\Test\A as ClassA;

	class C{
	
		public function show(){
			// 实例化来自子命名空间的对象：
			$b = new \NameB\Test\B;
			$b->show();
			$a = new ClassA;
			$a->show();
		}
	}

}
