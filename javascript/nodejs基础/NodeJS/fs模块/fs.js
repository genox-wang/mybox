"use strict";
var fs = require("fs");


//写入文件
//fs.writeFile("./test.txt", "add", {
//    "encoding": "utf-8",
//    "mode": 438,
//    "flag": "a"
//}, function (err) {
//    if (err) {
//        throw err;
//    }
//    console.log("It's saved");
//    //写入成功后读取测试
//    fs.readFile("./test.txt", {
//        "encoding": "utf-8",
//        "flag": "r"
//    }, function (err, data) {
//        if (err) {
//            throw err;
//        }
//        console.log(data); //>hello word! add
//    });
//});


//// 读取文件
//fs.open('./test.txt', 'r', function (err, fd) {
//    if (err) {
//        throw err;
//    }
//    console.log('open file success.');
//
//    var buffer = new Buffer(255);
//
//
//    // 读取文件
//    fs.read(fd, buffer, 0, 10, 0, function (err, bytesRead, buffer) {
//        if (err) {
//            throw err;
//        }
//        // 打印出buffer中存入的数据
//        console.log(bytesRead, buffer.slice(0, bytesRead).toString()); //>10 'hello word'
//
//        // 关闭文件
//        fs.close(fd);
//    });
//});

//// 写入文件
//fs.open('./test.txt', 'w', function (err, fd) {
//    if (err) {
//        throw err;
//    }
//    console.log('open file success.');
//
//    var wbuffer = new Buffer('shiyanlou');
//
//    // 写入文件
//    fs.write(fd, wbuffer, 0, 6, 0, function (err, written, buffer) {
//        if (err) {
//            throw err;
//        }
//
//        console.log('write success.');
//
//        // 打印出buffer中存入的数据
//        var byteLength = buffer.byteLength;
//        console.log(written, buffer.slice(0, byteLength).toString());
//
//        // 关闭文件
//        fs.close(fd);
//    });
//});

//// 创建目录
//fs.mkdir("test", function (err) {
//    if (err) {
//        throw err;
//    }
//    console.log("create dir successed");
//});

////删除目录
//fs.rmdir("test", function (err) {
//    if (err) {
//        throw err;
//    }
//    console.log("delete dir successed");
//});

//读取目录
fs.readdir("./", function (err, files) {
    if (err) {
        throw err;
    }
    //files数组，包含文件夹和文件名
    console.log(files);
});
