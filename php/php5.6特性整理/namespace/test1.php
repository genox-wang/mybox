<?php

//test1.php
// 命名空间的分隔符是反斜杠，该声明语句必须在文件第一行。
// 命名空间中可以包含任意代码，但只有 **类, 函数, 常量** 受命名空间影响。
namespace NameA\Test;

// 该类的完整限定名是 \NameA\Test\A , 其中第一个反斜杠表示全局命名空间。
class A{
	public function show(){
		echo '\NameA\Test\A';
	}
}

// 你还可以在文件中定义第二个命名空间，接下来的代码将都位于 \NameB\Test .
namespace NameB\Test;

class B{
	public function show(){
		echo '\NameB\Test\B';
	}
}

