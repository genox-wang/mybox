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
