"use strict";
process.on('exit', function (code) {
    setTimeout(function () { //异步方法不会执行
        console.log('This will not run');
    }, 0);

    console.log('exit code: ', code);
});
