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
