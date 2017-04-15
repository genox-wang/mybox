//
//  QRSprite.cpp
//  CGame
//
//  Created by neo on 15/12/16.
//
//

#include "QRSprite.hpp"
#include "qrencode.h"
using namespace cocos2d;


bool QRSprite::initWithString(const std::string& code)
{
    //给字符串QR编码
    QRcode* _qrcode = QRcode_encodeString(code.c_str(), 0, QR_ECLEVEL_H, QR_MODE_8, 1);
    if (_qrcode != nullptr) {
        int w = _qrcode->width*3;
        //二维码底部白色
        LayerColor::initWithColor(Color4B(255, 255, 255, 255),w+20,w+20);
        Texture2D* _texture = new Texture2D;
        Size s = Size(_qrcode->width, _qrcode->width);
        //为1的点填充白色
        for (int i =0; i<_qrcode->width; ++i) {
            for (int j = 0; j<_qrcode->width; ++j) {
               int idx = i * _qrcode->width +j;
               if( (_qrcode->data[idx] & 1) == 1)
               {
                   _qrcode->data[idx] = 255;
               }
               else
               {
                   _qrcode->data[idx] = 0;
               }
            }
        }
        //用生成的数据生成二维码图片
        _texture->initWithData(_qrcode->data, sizeof(_qrcode->data), Texture2D::PixelFormat::A8, _qrcode->width, _qrcode->width, s);
        Sprite* sprite = Sprite::createWithTexture(_texture);
        this->addChild(sprite);
        sprite->setPosition(Vec2(w/2+10,w/2+10));
        sprite->setScale(3.0f);

        CC_SAFE_RELEASE(_texture);
        QRcode_free(_qrcode);
        return true;
    }
    return false;
}



QRSprite* QRSprite::create(const std::string& code)
{
    QRSprite* s = new QRSprite;
    s->autorelease();
    if(s->initWithString(code))
    {
        return s;
    }
    return nullptr;
}

