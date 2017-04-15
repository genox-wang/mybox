#http模块
---
- **http.createServer([requestListener])** 创建一个服务
- **server.listen([port][, hostname][, backlog][, callback])** 监听服务
- **response.writeHead(statusCode[, statusMessage][, headers])** 写入文件头和状态(404等)
- **response.end([data][, encoding][, callback])** 表示所有的head和body被发送，请求结束

###实践
>实现简单的路由定义个跳转

server.js

```JavaScript
var http = require("http");
var url = require("url");

var host = '127.0.0.1',
    port = 8080;

function start(route, handle) {
    function onRequest(req, resp) {
        //url.parse把url从String转换成Object，方便提取host,port,pathname等属性
        var pathname = url.parse(req.url).pathname; //获取请求的pathname
        console.log("Request for " + pathname + " Received");
        route(handle, pathname, req, resp); //调用路由方法进行跳转
    }
    //开启服务
    http.createServer(onRequest).listen(port, host);
}

exports.start = start;
```

route.js

```JavaScript
var fs = require("fs");

//定义路由规则
function route(handle, pathname, req, resp) {
    console.log("Route for pathname " + pathname);
    if (typeof handle[pathname] == "function") { //如果对应路径路由方法存在，则调用对应路由方法
        handle[pathname](req, resp);
    } else { //否则跳转到404页面
        console.log("No Request handle for " + pathname);
        var content = fs.readFileSync('./view/404.html');
        resp.writeHead(404, {
            'Content-Type': 'text/html'
        });
        resp.end(content);
    }
}

exports.route = route;

```

handle.js

```JavaScript
var fs = require('fs');

//打开主页方法
function home(req, resp) {
    var content = fs.readFileSync('./view/home.html');
    resp.writeHead(200, {
        "Content-Type": "text/html"
    });
    resp.end(content);
}

//打开About方法
function about(req, resp) {
    var content = fs.readFileSync('./view/about.html');
    resp.writeHead(200, {
        "Content-Type": "text/html"
    });
    resp.end(content);
}

exports.home = home;
exports.about = about;

```

main.js

```JavaScript
var route = require("./route");
var reqhandle = require('./handle');
var server = require('./server');

//定义可跳转的路由
var handle = {};
handle['/'] = reqhandle.home;
handle['/about'] = reqhandle.about;

//开启服务,传送路由方法和配置
server.start(route.route, handle);

```