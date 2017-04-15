#fs模块
***

##概述

fs模块用于对系统文件及目录进行读写操作,使用需要添加引用`require('fs')`，存在**同步**和**异步**两种模式

##方法
***
###文件操作

####文件直接读取
***
- **fs.readFile(filename, [options], callback)** 异步读取文件
```JavaScript
"use strict";
var fs = require("fs");
fs.readFile("./test.txt", {
    "encoding": "utf-8",
    "flag": "r"
}, function (err, data) {
    if (err) {
        throw err;
    }
    console.log(data);
});
```
- **fs.readFileSync(file[, options])** 同步文件读取

####文件直接写入
- **fs.writeFile(file, data[, options], callback)**

```JavaScript
//写入文件
fs.writeFile("./test.txt", "add", {
    "encoding": "utf-8",
    "mode": 438,
    "flag": "a"
}, function (err) {
    if (err) {
        throw err;
    }
    console.log("It's saved");
    //写入成功后读取测试
    fs.readFile("./test.txt", {
        "encoding": "utf-8",
        "flag": "r"
    }, function (err, data) {
        if (err) {
            throw err;
        }
        console.log(data); //>hello word! add
    });
});
```

- **fs.writeFileSync(file, data[, options])**

####文件打开|读取|写入|关闭
- **fs.open(path, flags, [mode], callback)**
- **fs.close(fd, [callback])**
- **fs.read(fd, buffer, offset, length, position, callback)**

```JavaScript
// 读取文件
fs.open('./test.txt', 'r', function (err, fd) {
    if (err) {
        throw err;
    }
    console.log('open file success.');

    var buffer = new Buffer(255);


    // 读取文件
    fs.read(fd, buffer, 0, 10, 0, function (err, bytesRead, buffer) {
        if (err) {
            throw err;
        }
        // 打印出buffer中存入的数据
        console.log(bytesRead, buffer.slice(0, bytesRead).toString()); //>10 'hello word'

        // 关闭文件
        fs.close(fd);
    });
});
```

- **fs.write(fd, buffer, offset, length, position, callback)**
```JavaScript
// 写入文件
fs.open('./test.txt', 'w', function (err, fd) {
    if (err) {
        throw err;
    }
    console.log('open file success.');

    var wbuffer = new Buffer('shiyanlou');

    // 写入文件
    fs.write(fd, wbuffer, 0, 6, 0, function (err, written, buffer) {
        if (err) {
            throw err;
        }

        console.log('write success.');

        // 打印出buffer中存入的数据
        var byteLength = buffer.byteLength;
        console.log(written, buffer.slice(0, byteLength).toString());

        // 关闭文件
        fs.close(fd);
    });
});
```
***
###目录操作
####创建删除目录
- **fs.mkdir(path, [mode], callback)** 创建目录 mode默认0777
- **fs.rmdir(path,callback)** 删除目录 只能删除空目录

```JavaScript
//// 创建目录
//fs.mkdir("test", function (err) {
//    if (err) {
//        throw err;
//    }
//    console.log("create dir successed");
//});

//删除目录
fs.rmdir("test", function (err) {
    if (err) {
        throw err;
    }
    console.log("delete dir successed");
});
```
####读取目录
**fs.readdir(path, callback)**

```JavaScript
//读取目录
fs.readdir("./", function (err, files) {
    if (err) {
        throw err;
    }
    //files数组，包含文件夹和文件名
    console.log(files);
});
```