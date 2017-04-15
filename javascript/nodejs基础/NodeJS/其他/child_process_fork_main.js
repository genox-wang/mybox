"use strict";
var cp = require('child_process');

var n = cp.fork('./child_process_fork_sub.js'); //启动子线程

n.on('message', function (m) { //接收到子线程发送的消息
    console.log('PARENT got message:', m);
});

n.send({ //给子线程发送消息
    hello: 'world'
});
