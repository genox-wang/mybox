# 生成二维码

用[libqrencode](https://github.com/fukuchi/libqrencode)生成二维码

用cocos2dx绘制图片来展示
  
QRCode/QRSprite
```C++
QRSprite* sprite = QRSprite::create("http://www.baidu.com");
this->addChild(sprite);
sprite->setPosition(Vec2(200,100));
```

