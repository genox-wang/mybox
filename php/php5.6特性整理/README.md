#「php化零为整」那些被忽略了的版本优化

>我写过一个《php化整为零系列》，这篇是它们的整合版，当做目录和回忆使用，文中我大部分只列出关键词简单语法，不会详加说明，需要详细说明的点对应链接详看
>本篇中也不包含版本时间轴，需要知道对应版本特性的请参考[PHP 自 5.2 到 5.6 中新增的功能详解](https://segmentfault.com/a/1190000000403307#articleHeader13)，这也是我系列的主要参考文章

-------
>本篇中没有加入PDO与MySQLi的介绍，因为后面会有关于`Laveral`系列，它有自己封装的数据库函数。所以这里就先不研究了，了解php的新特征也是为了能大致读懂`Laveral`框架
>还有XDebug，个人感觉过于繁琐，利用var_dump等输出已经足够调试了，而且`Laveral`自带错误堆栈信息。

#### autoload
>自动加载 
>老版本 `__autoload`
>新版本 `spl_autoload`

[「php化整为零系列」一、autoload](http://www.jianshu.com/p/ad4fcdd323f3)

####  Closures
>闭包又称匿名函数，PHP增加这一特性，也是为了让代码更简洁，尤其`use`对于外部变量的引用尤其关键

[「php化整为零系列」二、Closures(闭包)](http://www.jianshu.com/p/606719159b6e)

#### Magic(魔术方法)
>PHP5.3新增了一个叫做`__invoke`的魔术方法，这样在创建实例后，可以直接调用对象
>`__call` 当要调用的方法不存在或权限不足时，会自动调用`__call` 方法。
`__callStatic` 当调用的静态方法不存在或权限不足时，会自动调用`__callStatic`方法

[「php化整为零系列」三、Magic(魔术方法)](http://www.jianshu.com/p/c825de3a1baa)

#### 内置Web服务器
> 基本用法`php -S localhost:8000`
> 根目录 `php -S localhost:8000 -t magic/`
> 路由脚本 `php -S localhost:8000  webServer/router.php`
> 远程访问 `php -S 0.0.0.0:8000`

[「php化整为零系列」四、内置Web服务器](http://www.jianshu.com/p/6f315328c6ef)

#### 命名空间
>同文件中可**多命名空间**
>**大括号**可包裹命名空间
>`use`命名空间与别名定义`as`
>引用的时候需要在命名空间前加`\\`
>php5.6以后对命名空间有一定的优化可以直接通过命名空间**引用常量和函数**

[「php化整为零系列」五、命名空间](http://www.jianshu.com/p/2d1a813c4b1c)

#### 后期静态绑定
>在继承过程中引入static关键字替代self来达到静态方法的继承目的

[「php化整为零系列」六、后期静态绑定](http://www.jianshu.com/p/5c84d7b77dde)

#### Heredoc&Nowdoc

```
//标示可以是自定义字符，前后字符一致，且不能在文章中出现 Heredoc中可以嵌入变量
<<<标示
文章
标示;
```

```
//标示可以是自定义字符，前后字符一致，且不能在文章中出现 Nowdoc中不能嵌入变量
<<<'标示'
文章
标示;
```

[「php化整为零系列」七、Heredoc&Nowdoc](http://www.jianshu.com/p/92f2e3b24b39)

#### 语法优化
>1. const 允许使用**之前定义的常量进行计算**、允许常量作为**函数参数默认值**
>2. 数组简写
>3. 可变函数参数优化
>4. 三元运算符简写
>5. 类名通过::class可以获取
>6. 非变量array和string也能支持下标获取
>7. 用foreach+list简化二位数组的迭代
>8. yield

[「php化整为零系列」八、语法优化](http://www.jianshu.com/p/4076b6910e2f)

#### Traits
>1. `trait`  Trait不能直接实例化
>2. 当方法或属性同名时，当前类中的方法会覆盖 trait的 方法，而 trait 的方法又覆盖了基类中的方法。
>3. 使用`insteadof`和`as`操作符来解决冲突，`insteadof`是使用某个方法替代另一个，而`as`是给方法取一个**别名**
>4. `as`关键词还有另外一个用途，那就是**修改方法的访问控制**：
>5. Trait 也能组合Trait，Trait中支持**抽象方法**、**静态属性**及**静态方法**

[「php化整为零系列」九、Traits](http://www.jianshu.com/p/3a2401bd126f)

#### Phar
>- 配置php.ini `phar.readonly = Off`
>- 打包
    

```php
new Phar(包名)
$phar->buildFromDirectory(打包目录, 正则筛选);
$phar->compressFiles( Phar::GZ |PHAR::BZ2);//压缩方式
$phar->setStub( $phar->createDefaultStub(入口文件) );
```

>- 加载

```php
require_once 'phar:://包名/文件';
```

[「php化整为零系列」十、Phar](http://www.jianshu.com/p/922a97025eed)