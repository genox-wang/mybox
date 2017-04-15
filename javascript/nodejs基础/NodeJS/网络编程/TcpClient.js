"use strict";
var net = require("net");

//标准输入流
process.stdin.resume();
process.stdin.setEncoding('utf8');

var client = net.connect({
    port: 1337
}, function () {
    console.log("Connect to Server");
    console.log("input: ");
    process.stdin.on("data", function (data) {
        //发送输入的字符串
        client.write(data);
        if (data === "close") {
            client.end(); //终端输入close断开连接
        }
    });

});

client.on("data", function (data) {
    //data为string
    console.log("Other user said:" + data.toString());
});
