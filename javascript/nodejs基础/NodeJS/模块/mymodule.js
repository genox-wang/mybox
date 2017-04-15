'use strict';

var hello = function hello() {
    console.log("Hello");
};

var world = function world() {
    console.log("World");
};

//exports = {}; //exports的引用改变 不在指向module.exports
exports.hello = hello;
exports.world = world;
//module.exports.hello = hello;
//module.exports.world = world;
