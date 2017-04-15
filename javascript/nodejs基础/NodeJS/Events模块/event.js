'use strict';
var http = require('http');
var events = require('events');
var server = http.createServer();

// 为request事件绑定处理函数
// 也可以使用server.addListener或者on
server.once('request', function (req, res) {
    res.writeHead(200, {
        'Content-Type': 'text/plain'
    });
    res.write('shiyanlou');
    console.log('shiyanlou');
    res.end();
});

//// 绑定自定义事件myevent
//server.on('myevent', function (arg, arg1) {
//    console.log(arg);
//    console.log(arg1);
//});
//
//// 触发自定义事件
//server.emit('myevent', 'shiyanlou', 'hello word');

server.listen(1337, '127.0.0.1');
console.log("Server running at http://127.0.0.1:1337/");

// 查看server绑定的'request'事件的监听器个数
var num = events.EventEmitter.listenerCount(server, 'request');
console.log(num);
