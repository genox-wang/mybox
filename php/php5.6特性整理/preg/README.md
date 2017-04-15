#php&正则表达式 简洁整理


>该系列我只写我的理解，非官方解释，如不够专业请见谅

***
正则表达式是php中一个非常重要的知识点，通常用来查找和替换字符串，最常用的就是验证用户输入的信息格式是否正确，如邮件格式、电话格式等等。还有比如采集器之类的软件中，正则也是必用不可！

####基本语法
- 定界符 `/.../`  中间是正则表达式
- 元字符
	- `+` 之前字符出现一次或多次
	- `*`之前字符出现零次或多次
	- `?`之前字符出现零次或一次
	- `\s`单个空格，包括tab键或换行
	- `\S`单个空格之外的所有字符
	- `\d`0~9的数字
	- `\w`字母 数字或下划线字符
	- `\W`所有与\w不匹配的字符
	- `.`匹配所有换行符之外的字符
- 定位符
	-  `^`以...开头
	-  `$`以...结尾
	-  `\b`出现在开头或结尾
	-  `\B`出现在非开头结尾
- 区间符 `-` 例如：`/([a-z][A-Z][0-9])+/`
- 否定符`[^]` 例如：`[^tes]` 表示tes字符外所有
- 或`|` 例如：`/A|B|C/`可以与"A","B","C"都匹配

####php相关函数
- `preg_match`判断字符串是否匹配
```php
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
```
- `preg_quote` 在每个有正则表达式语法加入转移字符即\

```php
//preg_quote("字符串") 在每个有正则表达式语法前面加入一个转义字符即\
 
$textbody = "This book is *very* difficult to find.";
$word = "*very*";
$preg = "/" . preg_quote($word) . "/";
print $preg."\n";#/\*very\*/
print preg_replace ($preg,"<i>" . $word . "</i>",$textbody)."\n";//This book is <i>*very*<i> difficult to find.
```

- `preg_split` 分割字符串

```php
//preg_split("正则","字符串")分割字符串
$php = "+A++B++++C";
$field = preg_split("/\+{1,}/",$php);
foreach($field as $f){
	print $f." ";//A B C
}
print "\n";
```

- `preg_grep` 与数组匹配后返回新数组

```php
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
```

- `preg_replace` 替换匹配字符串

```php
//preg_replace("正则","替换内容","原字符串")    很重要，很常用
$a = "百度http://www.baidu.com/";  //给http开头的加上超链接
echo preg_replace("/http:\/\/(.*)\//","<a href=\"\${0}\">\${0}</a>","$a")."\n";//百度<a href="http://www.baidu.com/">http://www.baidu.com/</a>
```