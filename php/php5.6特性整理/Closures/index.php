<?php
	function arrayPlus($array, $num)
	{
	    array_walk($array, function(&$v) use($num){
	        $v += $num;
	    });
	    print var_dump($array);//输出array(3) { [0]=> int(6) [1]=> int(7) [2]=> int(8) }
	}

	arrayPlus([1,2,3],5);
	
	

