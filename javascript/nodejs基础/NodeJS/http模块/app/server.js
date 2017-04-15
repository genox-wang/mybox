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
