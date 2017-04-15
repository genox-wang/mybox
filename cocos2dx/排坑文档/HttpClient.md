#HttpClient

***

##引用

```C++
#include "network/HttpCLient.h"

using namespace network;
```

##使用
```C++

HttpRequest* request = new HttpRequest();//创建请求
request->setRequestType(HttpRequest::Type::GET);//设置请求类型
std::string url = "http://www.happygod.cn/cinema/cinemaCSTest.php?payid="+std::to_string(id);
request->setUrl(url.c_str());//设置URL
request->setTag("PayRequest");//设置请求Tag
request->setResponseCallback([=](HttpClient* c,HttpResponse* r){
    if (0 != strlen(r->getHttpRequest()->getTag()))//可以通过response->request->getTag()方法获取request的Tag
    {
        log("%s completed", r->getHttpRequest()->getTag());
    }

    if (!r->isSucceed())//请求失败
    {
        log("response failed");
        log("error buffer: %s", r->getErrorBuffer());//显示错误字符串
        return; 
    }

    // dump data
    std::vector<char> *buffer = r->getResponseData();//获取返回数据 vector<char>*

    std::string data;
    data.clear();
    data.assign(buffer->begin(),buffer->end());//通过string.assign方法把vector<char>转化为string

    log("responseData : %s",data.c_str());

    if(data=="success"){
        hide();
    }else{
        this->getParent()->addChild(NoCoinUI::create(),120);
    }
});
HttpClient::getInstance()->send(request);//发送请求
request->release();//释放请求

```