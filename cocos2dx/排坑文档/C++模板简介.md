#C++模板简介

##简介

模板是泛型编程的基础，泛型编程即以一种独立于任何特定类型的方式编写代码。
模板是**创建泛型类或函数的蓝图或公式。库容器**，比如迭代器和算法，都是泛型编程的例子，它们都使用了模板的概念。

##函数模板

```C++
template <class type> ret-type func-name(parameter list)
{
   // 函数的主体
} 
```

##类模板

```C++
template <class type> class class-name {
.
.
.
}
```

在这里，type 是占位符类型名称，可以在类被实例化的时候进行指定。**您可以使用一个逗号分隔的列表来定义多个泛型数据类型**。

##模板特殊化

```C++

template <class T>  
inline T square(T x)  
{  
   T result;  
   result = x * x;  
   return result;  
};  
  
// 模板特殊化  
template <>  
string square<string>(string ss)  
{  
   return (ss+ss);  
};  
   
```

##C++ 模板默认类型参数以及无类型参数

```C++

template <typename T=float, int count=3>  
T multIt(T x)  
{  
   for(int ii=0; ii<count; ii++)  
   {  
       x = x * x;  
   }  
   return x;  
};  
  
```

##C++ 静态成员初始化

```C++

template <class T>   
class XYZ  
{  
public:  
    static T ipub;  
private:  
    static T ipri;  
};  
  
// 静态成员初始化:  
template <class T> T XYZ<T>::ipub = 1;  
template <class T> T XYZ<T>::ipri = 1.2; 

```


