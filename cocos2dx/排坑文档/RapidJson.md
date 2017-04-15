#RapidJson

***

##头文件

```C++
#include "json/document.h"
#include "json/stringbuffer.h"
#include "json/writer.h"
```

##实践代码

```C++
/**
 RapidJson样例
 */
inline void RapidJsonExample(){
    //解析Json
    std::string  mJson = "{\"mArray\":[{ \"mInt\":10,\"mBool\":true}],\"mObject\":{\"mString\":\"hello\",\"mDouble\":1.2}}";
    rapidjson::Document doc;
    doc.Parse<0>(mJson.c_str());
    if(!doc.HasParseError()){
        log("RapidJson:mInt:%d",doc["mArray"][0]["mInt"].GetInt());
        log("RapidJson:mBool:%d",doc["mArray"][0]["mBool"].GetBool());
        log("RapidJson:mString:%s",doc["mObject"]["mString"].GetString());
        log("RapidJson:mDouble:%.0f",doc["mObject"]["mDouble"].GetDouble());
    }else{
        log("doc.parseCode:  %d",doc.GetParseError());
    }
    
    //写入Json
    doc.SetObject();
    rapidjson::Document::AllocatorType& allocator = doc.GetAllocator();
    rapidjson::Value array(rapidjson::kArrayType);
    rapidjson::Value arrayObj(rapidjson::kObjectType);
    rapidjson::Value object(rapidjson::kObjectType);
    arrayObj.AddMember("mInt", 10, allocator);
    arrayObj.AddMember("mBool", true, allocator);
    object.AddMember("mString", "hello", allocator);
    object.AddMember("mDouble", 1.2,allocator);
    array.PushBack(arrayObj, allocator);
    doc.AddMember("mArray", array, allocator);
    doc.AddMember("mObject", object, allocator);
    
    rapidjson::StringBuffer buffer;
    rapidjson::Writer<rapidjson::StringBuffer> writer(buffer);
    
    doc.Accept(writer);
    
    log("%s",buffer.GetString());
}

```
**输出**

```
RapidJson:mInt:10
RapidJson:mBool:1
RapidJson:mString:hello
RapidJson:mDouble:1
{"mArray":[{"mInt":10,"mBool":true}],"mObject":{"mString":"hello","mDouble":1.2}}
```

##错误代码
```C++
//! Error code of parsing.
/*! \ingroup RAPIDJSON_ERRORS
    \see GenericReader::Parse, GenericReader::GetParseErrorCode
*/
enum ParseErrorCode {
    kParseErrorNone = 0,                        //!< No error.

    kParseErrorDocumentEmpty,                   //!< The document is empty.
    kParseErrorDocumentRootNotSingular,         //!< The document root must not follow by other values.

    kParseErrorValueInvalid,                    //!< Invalid value.

    kParseErrorObjectMissName,                  //!< Missing a name for object member.
    kParseErrorObjectMissColon,                 //!< Missing a colon after a name of object member.
    kParseErrorObjectMissCommaOrCurlyBracket,   //!< Missing a comma or '}' after an object member.

    kParseErrorArrayMissCommaOrSquareBracket,   //!< Missing a comma or ']' after an array element.

    kParseErrorStringUnicodeEscapeInvalidHex,   //!< Incorrect hex digit after \\u escape in string.
    kParseErrorStringUnicodeSurrogateInvalid,   //!< The surrogate pair in string is invalid.
    kParseErrorStringEscapeInvalid,             //!< Invalid escape character in string.
    kParseErrorStringMissQuotationMark,         //!< Missing a closing quotation mark in string.
    kParseErrorStringInvalidEncoding,           //!< Invalid encoding in string.

    kParseErrorNumberTooBig,                    //!< Number too big to be stored in double.
    kParseErrorNumberMissFraction,              //!< Miss fraction part in number.
    kParseErrorNumberMissExponent,              //!< Miss exponent in number.

    kParseErrorTermination,                     //!< Parsing was terminated.
    kParseErrorUnspecificSyntaxError            //!< Unspecific syntax error.
};
```

##深入学习

https://code.csdn.net/Tencent/rapidjson/tree/license/doc/dom.zh-cn.md