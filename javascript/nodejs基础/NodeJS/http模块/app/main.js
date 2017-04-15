var route = require("./route");
var reqhandle = require('./handle');
var server = require('./server');

//定义可跳转的路由
var handle = {};
handle['/'] = reqhandle.home;
handle['/about'] = reqhandle.about;

//开启服务,传送路由方法和配置
server.start(route.route, handle);
