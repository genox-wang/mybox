#Events模块
***

- `require('events').EventEmitter` 得到EventEmitter类
- `emitter.addListener(event,listener)`或`emitter.on(event,listener)`为事件绑定事件处理程序
- `emitter.once(event,listener)`移除事件
- `emitter.removeListener(event, listener)`移除所有事件
- `emitter.removeAllListeners([event])`
- `emitter.setMaxListeners(n)` 设置同一事件的监听器最大绑定数
- `emitter.emit(event, [arg1], [arg2], [...])` 设置自定义事件
- `EventEmitter.listenerCount(emitter, event)` 查看事件监听器数量

**绑定事件**
```JavaScript
'use strict';
var http = require('http');
var server = http.createServer();

server.on('request', function (req, res) {
    res.writeHead(200, {
        'Content-Type': 'text/plain'
    });
    res.write('shiyanlou');
    console.log('shiyanlou');
    res.end();
});

server.listen(1337, '127.0.0.1');
console.log("Server running at http://127.0.0.1:1337/");

```
**自定义事件**

```JavaScript
var http = require('http');
var server = http.createServer();

// 绑定自定义事件myevent
server.on('myevent', function(arg,arg1) {
    console.log(arg);
    console.log(arg1);
});

// 触发自定义事件
server.emit('myevent', 'shiyanlou','hello world');

server.listen(1337, '127.0.0.1');
console.log('Server running at http://127.0.0.1:1337/');
```

**查看监听器数量**
```JavaScript
var events = require('events');

// 查看server绑定的'request'事件的监听器个数
var num = events.EventEmitter.listenerCount(server, 'request');
console.log(num);
```