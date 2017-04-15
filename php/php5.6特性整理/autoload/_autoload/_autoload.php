<?php
	function __autoload($classname){
		$classpath = './'.$classname.'.php';
		if(file_exists($classpath)){
			require_once($classpath);
		}else{
			echo 'class file'.$classpath.' not found';
		}
	}

	new ClassA();//输出 ClassA load success!
	new ClassB();//输出 ClassA load success!ClassB load success!
	new ClassC();//输出 class file./ClassC.php not found
