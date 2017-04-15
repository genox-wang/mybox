<?php
 
//preg_match("正则表达式","字符串")用于在字符串中查找匹配项
# ^ 开头 
# \w 字符数字下划线 
# () 组|[]允许出现其中任意一个字符|?
# ? 出现一次或不出现
# * 出现多次或不出现
# + 出现一次或不出现
# {} 条目出现的次数
# $ 结尾
# 语义:只能以字符数字下划线开头，后面的可以是_xxx或者.xxx组合 中间必须有@符号
# @后面类似@前的 但必须以为.xxx结尾，xxx必须2~3个字符，可以下划线
# 
$email = "987044391@qq.com";

print preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/",$email)?"匹配成功\n":"匹配失败\n";//匹配成功


//preg_quote("字符串") 在每个有正则表达式语法前面加入一个转义字符即\
 
$textbody = "This book is *very* difficult to find.";
$word = "*very*";
$preg = "/" . preg_quote($word) . "/";
print $preg."\n";#/\*very\*/
print preg_replace ($preg,"<i>" . $word . "</i>",$textbody)."\n";//This book is <i>*very*<i> difficult to find.
 
//preg_split("正则","字符串")分割字符串
$php = "+A++B++++C";
$field = preg_split("/\+{1,}/",$php);
foreach($field as $f){
	print $f." ";//A B C
}
print "\n";

//preg_grep("正则","字符串") 与数组匹配后返回新数组
$array = ["perA","perB","perC","shD","ccE"];
$item = preg_grep("/^per/",$array);
print_r($item);
#Array
#(
#    [0] => perA
#    [1] => perB
#    [2] => perC
#)

 print "\n";

//preg_replace("正则","替换内容","原字符串")    很重要，很常用
$a = "百度http://www.baidu.com/";  //给http开头的加上超链接
echo preg_replace("/http:\/\/(.*)\//","<a href=\"\${0}\">\${0}</a>","$a")."\n";//百度<a href="http://www.baidu.com/">http://www.baidu.com/</a>
 
?>