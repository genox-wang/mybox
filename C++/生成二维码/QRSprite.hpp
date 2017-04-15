//
//  QRSprite.hpp
//  CGame
//
//  Created by neo on 15/12/16.
//
//

#ifndef QRSprite_hpp
#define QRSprite_hpp

#include "cocos2d.h"

class QRSprite : public cocos2d::LayerColor{
    
public:
    
    bool initWithString(const std::string& code);
    
    static QRSprite* create(const std::string& code);
};


#endif /* QRSprite_hpp */
