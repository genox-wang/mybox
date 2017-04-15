#网络编程
***

##TCP

- **net.createServer**
- **net.connect**

**聊天室**

TcpServer.js

```JavaScript
var net = require("net");
//创建Tcp服务
var server = net.createServer();

var sockets = [] //简易聊天保存所有socket连接

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
    })

    socket.on("close", function () {
        console.log("A Client has closed");
        var index = sockets.indexOf(socket);
        sockets.splice(index, 1); //客户端关闭连接 从数组中去除
    })
});


server.on("error", function (err) {
    console.log("Server err: " + err);
});

server.on("close", function () {
    console.log("Server close");
})

//监听端口
server.listen(1337, function () {
    console.log("server open in 1337");
})

```

TcpClient.js
```JavaScript
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
        if (data == "close") {
            client.end(); //终端输入close断开连接
        }
    });

});

client.on("data", function (data) {
    //data为string
    console.log("Other user said:" + data.toString());
});

```

##UDP
- **dgram.createSocket**
- **socket.bind**
- **socket.send**

UdpServer.js
```JavaScript

// udpServer.js

var dgram = require("dgram");

var server = dgram.createSocket("udp4");

server.on("error", function (err) {
    console.log("server error:\n" + err.stack);
    server.close();
});

// 接收来自客户端的消息
server.on("message", function (msg, rinfo) {
    console.log("server got: " + msg.toString() + " from " + rinfo.address + ":" + rinfo.port);
});

// 监听服务
server.on("listening", function () {
    var address = server.address();
    console.log("server listening on " + address.address + ":" + address.port);
});

server.bind(41234);
// server listening 0.0.0.0:41234
```

UdpClient.js

```JavaScript
// udpClient.js

var dgram = require('dgram');

var client = dgram.createSocket('udp4');
var message = new Buffer('hello shiyanlou');

client.send(message, 0, message.length, 41234, 'localhost', function (err, bytes) {
    client.close();
});

```