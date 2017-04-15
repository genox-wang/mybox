"use strict";
process.on('message', function (m) { //接收到父线程的消息
    console.log('CHILD got message:', m);
});

process.send({ //给父线程发送消息
    foo: 'bar'
});
