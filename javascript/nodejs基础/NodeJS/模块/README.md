#NodeJs的模块

---
##模块
**每一个Node.js都是一个Node.js模块**，包括JavaScript文件（.js）、JSON文本文件（.json）和二进制模块文件（.node）。

- `exports`是`module.exports`的引用,`module`是一个对象，每个模块都有一个`module`
- `require`引用的是`module.exports`
- `exports`不是始终等于 `module.exports`

**声明和引用模块方法**

```JavaScript
//mymodule.js start
function hello() {
    console.log('Hello');
}

function world() {
    console.log('World');
}

exports.hello = hello;//或module.exports.hello = hello;
exports.world = world;//或module.exports.world = world;
//mymodule.js end

//index.js start
var hello = require('./mymodule'); // 也可以写作 var hello = require('./mymodule.js');

// 现在就可以使用mymodule.js中的函数了
hello.hello(); // >> Hello
hello.world(); // >> World
//index.js end
```

**exports和module.exports值不同的情况

```JavaScript
// module.exports和exports不同的情况
var m = {};        // 表示 module
var e = m.e = {};  // e 表示 exports， m.e 表示 module.exports

m.e = { c: 9 };    // m.e（module.exports）引用的对象被改了
e.d = 10;

console.log(m.e);  // Object { c: 9 }
console.log(e);    // Object { d: 10 }
```

上例可以看到，`exports`只是`module.exports`的引用，如果对象引用被修改，那他们的值就不同了，这时候对`exports`的引用做修改不会引导到`require`引入的`module.exports`的值。比如在mymodule.js里做如下修改

```JavaScript
exports = {}; //exports的引用改变 不在指向module.exports
exports.hello = hello;
exports.world = world;
```

再运行index.js就报错

```bash
hello.hello();
      ^
TypeError: hello.hello is not a function
```
***
##包

- package.json
- CommonJS规范
- npm包管理工具

```json
{
    "name": "shiyanlou",//包名。包名是唯一的，只能包含小写字母、数字和下划线
    "description": "Shiyanlou test package.",//包说明
    "version": "0.1.0",//包版本号
    "keywords": [
        "shiyanlou",
        "nodejs"
     ],//关键字数组。用于搜索
    "maintainers": [{
        "name": "test",
        "email": "test@shiyanlou.com"
    }],//维护者数组
    "contributors": [{
        "name": "test",
        "web": "http://www.shiyanlou.com/"
    }],//贡献者数组
    "bugs": {
        "mail": "test@shiyanlou.com",
        "web": "http://www.shiyanlou.com/"
    },//提交bug的地址
    "licenses": [{
        "type": "Apache License v2",
        "url": "http://www.apache.org/licenses/apache2.html"
    }],//许可证
    "repositories": [{
        "type": "git",
        "url": "http://github.com/test/test.git"
    }],//项目仓库托管地址数组
    "dependencies": { 
        "webkit": "1.2",
        "ssl": { 
            "gnutls": ["1.0", "2.0"],
            "openssl": "0.9.8"
        }
    }//包依赖
}
```
**npm使用**
```bash
npm search express//搜索包
npm install -g express//安装包
npm update express//更新包
npm uninstall express//卸载包
```

