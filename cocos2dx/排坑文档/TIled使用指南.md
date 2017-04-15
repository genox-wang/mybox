#Tiled使用指南.md

***

##简介

**作者: Thorbjørn Lindeijer**

**作者博客:https://www.patreon.com/bjorn**

**Github:https://github.com/bjorn/tiled**

**官网:http://www.mapeditor.org/**

**开发语言：原来是Java. 2008开始用QT**

>Tiled 是一个用来开发游戏的内容部分的2D编辑器。他不仅支持**矩形瓦片层**，还支持等大，交叉的**六边形层**。一个瓦片集合(tileset)可以是一张包含多个瓦片的图片，也可以是包含散图的集合。主要的编辑瓦片层的工具是**印章刷**，他也支持绘制直线和圆等。
>**对象层**原来只能用来添加注释信息，现在还可以添加图片，矩形，椭圆等图形，还有瓦片对象。**它们不受瓦片网格限制，对象还可以缩放和旋转**。
>还有值得注意的是，**通过插件添加自定义地图或者瓦片集格式，瓦片印章记忆，动画支持和碰撞编辑**

##Cocos2dx相关

**issue:**

1. v0.17版本tiled 在cocos2dx v3.13上无法正常显示，切换到v0.10.1仍然不行，后来发现是图集加入大图的关系，让屏幕显示一片绿，去掉大图就显示正常了
2. Cocos2dx 无法显示 对象层的图片，而瓦片层的图片只能网格对齐。那些不对齐网格的图片，在编辑器上配置有问题

###读取tmx

```
 TMXTiledMap* map = TMXTiledMap::create("map/map.tmx");//读取地图集
```

###获得层

``` 
    TMXObjectGroup* elemsgroup = map->getObjectGroup(层名);
```
    
###遍历所有层内对象

```
    std::vector<Value>& objs = elemsgroup->getObjects();//获得对象层所有对象
    
    for(auto obj:objs){//遍历对象
    	...
    }
```

###获取属性

```
     auto o =  obj.asValueMap();//对象转化为ValueMap进行读取
     std::string name = o["name"].asString();//获取对象名
     float x = o["x"].asFloat();//对象x坐标
     float y = o["y"].asFloat();//对象y坐标
     float rotation = o["rotation"].asFloat();//对象旋转角度,为了获取rotation参数需要对TMXLayerInfo这个类做一定修改
     
     if(!o["shape"].isNull()){//自定义属性
         int shape_id = o["shape"].asInt();//
     }
```

###一些特殊属性

####points 多边形

返回`ValueVector`点集合,结构`vector<{x,y}>`

####polylinePoints 折线

返回`ValueVector`点集合,结构`vector<{x,y}>`

###相关类

####TMXMapInfo
可以查看`TMXMapInfo`的`startElement`方法确定以及修改可获取的参数


###案例

```C++
 //
    //解析地图元素初始化地图
    //
    ValueMap v_shapes =  FileUtils::getInstance()->getValueMapFromFile("map/shapes.plist");//读取元素参数集
    
    TMXTiledMap* map = TMXTiledMap::create("map/map.tmx");//读取地图集
    
    TMXObjectGroup* elemsgroup = map->getObjectGroup("elems");//获取元素对象层
    
    std::vector<Value>& objs = elemsgroup->getObjects();//获得对象层所有对象
    
    for(auto obj:objs){//遍历对象
        auto o =  obj.asValueMap();//对象转化为ValueMap进行读取
        std::string name = o["name"].asString();//获取对象名
        float x = o["x"].asFloat();//对象x坐标
        float y = o["y"].asFloat();//对象y坐标
        float rotation = o["rotation"].asFloat();//对象旋转角度
        
        if(name == "edge"){//边界对象单独处理
            
            edge = Node::create();
            node_collides->addChild(edge);
            edge->setPosition(x, y);
            Size size =Size(o["width"].asFloat(),o["height"].asFloat());
            rectEdge = Rect(x,y,size.width,size.height);//初始化游戏边界
            edge->setContentSize(size);//！！！这句很重要，不加边界无法匹配地图正确位置
            edge->setAnchorPoint(Point::ANCHOR_BOTTOM_LEFT);
            edge->setPhysicsBody(PhysicsBody::createEdgeBox(size));//创建边界
            edge->getPhysicsBody()->getShape(0)->setMaterial(PhysicsMaterial(0,1,0.1f));
            continue;
        }
        
        if(!o["shape"].isNull()){//碰撞元素
            int shape_id = o["shape"].asInt();//非边界对象需要有shape_id来识别元素类型
            
            ValueMap shapepropertys = v_shapes["shape_"+to_string(shape_id)].asValueMap();//根据shape_id获取元素参数
            
            Sprite* elem = Sprite::create("map/"+shapepropertys["img"].asString());//加载图片
            
            elem->setTag(TAG_OBSTACLE);
            
            elem->setAnchorPoint(Point::ANCHOR_BOTTOM_LEFT);//tmx地图集里对象锚点在坐下角
            elem->setPosition(x,y);//设置图片位置
            
            std::string type = shapepropertys["type"].asString().c_str();//获取元素形状
            
            if(type == "polygon"){//多边形
                ValueVector points = shapepropertys["points"].asValueVector();
                vector<Vec2> ps;
                for(auto p : points){
                    auto mp = p.asValueMap();
                    ps.push_back(Vec2(mp["x"].asFloat(),mp["y"].asFloat()));
                }
                elem->setPhysicsBody(PhysicsBody::createPolygon(&ps[0], (int)ps.size()));
            }else if(type == "rect"){//矩形
                ValueMap wh = shapepropertys["wh"].asValueMap();
                elem->setPhysicsBody(PhysicsBody::createBox(Size(wh["w"].asFloat(), wh["h"].asFloat())));
            }else if(type == "circle"){//圆形
                float r = shapepropertys["r"].asFloat();
                elem->setPhysicsBody(PhysicsBody::createCircle(r));
            }
            
            PhysicsBody* body = elem->getPhysicsBody();
            if(body){
                body->setContactTestBitmask(CONTACT_MASK_OBSTACLE);
                body->setDynamic(false);//静态物体
                body->getShape(0)->setMaterial(PhysicsMaterial(0.1f,0.5f,0.5f));//PhysicsMaterial(float aDensity, float aRestitution, float aFriction) 三个参数 密度，弹性，摩擦力
            }
            elem->setRotation(rotation);//设置旋转角度
            node_collides->addChild(elem);//元素添加到场景中
        }else if(!o["score"].isNull()){//分数元素
            Node* score_contact = Node::create();//创建分数碰撞快
            int score = o["score"].asInt();
            score_contact->setTag(TAG_SCORE);
            score_contact->setUserObject(new Rewards(score));//给碰撞快添加奖励内容
            Size size =Size(o["width"].asFloat(),o["height"].asFloat());
            score_contact->setPosition(x,y);
            score_contact->setContentSize(size);
            score_contact->setAnchorPoint(Point::ANCHOR_BOTTOM_LEFT);
            score_contact->setPhysicsBody(PhysicsBody::createBox(size));
//            score_contact->getPhysicsBody()->setCategoryBitmask(0);//不发生碰撞
            score_contact->getPhysicsBody()->setContactTestBitmask(CONTACT_MASK_SCORE);//和球体测试掩码与运算不为0，发生碰撞
            score_contact->getPhysicsBody()->setDynamic(false);
            Label* l_r = Label::createWithCharMap("num/num_block.png", 17, 20, '0');
            l_r->setString(to_string(score));
//            Label* l_r = Label::createWithSystemFont(to_string(score), "", 50);//对应分数
            l_r->setPosition(x+size.width/2,y+size.height/2);
            node_collides->addChild(score_contact);
            node_collides->addChild(l_r);
        }
    }
    this->addChild(map,1);//添加地图层
```
