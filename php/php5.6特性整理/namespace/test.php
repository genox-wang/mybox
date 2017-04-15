<?php
//test3.php
	require_once('test2.php');

	use \NameC\Test\C as ClassC;

	$c = new ClassC;
	$c->show();
	//输出 \NameB\Test\B\NameA\Test\A