#综合整理

***

##文档

-  [官方文档](https://nodejs.org/en/)

##工具
###编辑器
[Brackets](http://brackets.io/)
####扩展
- [NodeJS-Integration](https://github.com/yacut/brackets-nodejs-integration)
***
**用于在编辑器里调试NodeJS,Mocha等**
>遇到的问题及解决：
>1. [Cannot find module 'tree-kill'](https://github.com/yacut/brackets-nodejs-integration/issues/12)
>2. bin/sh:npm:command not found：配置Path到usr/local/bin/ (因为我用brew安装的NodeJS)
>3. 相对路劲在根目录 https://github.com/yacut/brackets-nodejs-integration/issues/18

- [Brackets-Ternific](https://github.com/MiguelCastillo/Brackets-Ternific)
***
TernJS，实现NodeJS的联想功能
>在项目根目录添加`.tern-project`文件

- JSLint
***
>JavaScript纠错，在js文件头添加`/*jslint node: true */`这段代码实现NodeJS纠错。
>参考[《Issue:Auto Suggestion and JSLint warnings with Node.js》](https://github.com/adobe/brackets/issues/6376)
>添加.bracket.json在项目目录(注意是你Brackets打开个文件夹的根目录)。
```Json
{
    "jslint.options": {
        "node": true
    }
}
```
