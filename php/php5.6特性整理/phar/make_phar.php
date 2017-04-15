<?php
$phar = new Phar('user.phar');#定义压缩包名
//指定压缩的目录，第二个参数可通过正则来制定压缩文件的扩展名
$phar->buildFromDirectory(dirname(__FILE__) . '/user', '/\.php$/');
$phar->setStub($phar->createDefaultStub('test.php'));//设置启动加载的文件
$phar->compressFiles(Phar::GZ);#表示使用gzip来压缩此文件。也支持bz2压缩。参数修改为 PHAR::BZ2即可