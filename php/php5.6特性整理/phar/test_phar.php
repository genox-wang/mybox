<?php
require_once "user.phar";//加载压缩包
#My name is laomeng and my email address is laomeng@163.com.来自入口test.php
require_once "phar://user.phar/user.class.php";//加载压缩包内php文件

$u=new user();
$u->set_name("mengguang");
$u->set_email("mengguang@gmail.com");

$u->introduce();#My name is mengguang and my email address is mengguang@gmail.com.
 
require_once "phar://user.phar/user.func.php";
 
$u=make_user("xiaomeng","xiaomeng@163.com");
dump_user($u);#My name is xiaomeng and my email address is xiaomeng@163.com.
