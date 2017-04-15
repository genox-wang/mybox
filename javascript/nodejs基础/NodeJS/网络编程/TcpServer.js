"use strict";
var net = require("net");
//创建Tcp服务
var server = net.createServer();

var sockets = []; //简易聊天保存所有socket连接

server.on("connection", function (socket) { //获得客户端连接
    console.log("Got a new connect");
    //加入到socket数组中来维护
    sockets.push(socket);

    socket.on("data", function (data) {
        console.log('Got Data:', data); //data被buffer
        sockets.forEach(function (otherSocket) {
            if (otherSocket !== socket) {
                otherSocket.write(data); //给其他客户端广播消息
            }
        });
    });

    socket.on("close", function () {
        console.log("A Client has closed");
        var index = sockets.indexOf(socket);
        sockets.splice(index, 1); //客户端关闭连接 从数组中去除
    });
});


server.on("error", function (err) {
    console.log("Server err: " + err);
});

server.on("close", function () {
    console.log("Server close");
});

//监听端口
server.listen(1337, function () {
    console.log("server open in 1337");
});
