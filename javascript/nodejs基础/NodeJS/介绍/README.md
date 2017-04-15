#NodeJS介绍

---

##一 介绍
###1. 概述
- 基于**Chrome JavaScript运行时**建立的平台
- **Google Chrome V8**引擎进行了封装
- 主要用于创建快速的、可扩展的网络应用
- **事件驱动**和**非阻塞I/O模型**，非常适合构建运行在分布式设备的**数据密集型**的实时应用。
- 服务器端JavaScript的**代码解析器**
- Node.js为JavaScript提供了**操作文件**、**创建HTTP服务**、 **创建TCP/UDP服务**等的接口

###2. 交互式运行环境:PEPL
- 输入`node`或`nodejs`进入Node.js的交互式运行环境（老版本的Node.js，不支持`node`命令，只能使用`nodejs`命令）
- `Ctrl+d`组合键可以退出此环境。

直接运行JavaScript代码
```bash
$ node
> console.log('shiyanlou');
```

运行外部文件

```bash
$ cd Desktop
Desktop$ node test.js
```

---
##模块和包

###1. 模块
- 操作文件模块`fs`
- 构建http服务的模块`http`
- 可以自己编写模块

###2. 包
- CommonJS规范：一个JavaScript文件就是一个模块，而包是一个文件夹，包内必须包含一个JSON文件，命名为**package.json**
- 包命名一般规则：bin->二进制文件  lib->JavaScript文件 doc->文档 test->单元测试

###3. npm包管理工具
npm是Node.js的**包管理工具**，npm定义了**包依赖关系标准**，我们使用npm主要用来**下载第三方包**和**管理本地下载的第三方包**。
