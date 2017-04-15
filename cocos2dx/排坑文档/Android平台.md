#Android平台

##Mac的JDK版本

苹果系统已经包含完整的J2SE，其中就有JDK和JVM（苹果叫VM）。当然如果要升级JDK，那当然要自己下载安装了。在MAC系统中，jdk的安装路径与windows不同，默认目录是：`/System/Libray/Frameworks/JavaVM.Framwork/`。在这个目录下有个`Versions`目录，里面有不同版本的jdk。

>注:Jdk1.7开始jdk版本目录改为了`/Library/Java/JavaVirtualMachines/`。我jdk1.8的目录就在下面找到的

详细：http://blog.csdn.net/azhou_hui/article/details/46636769



##Cocos2dxActivity

###入口函数

```Java
@Override
protected void onCreate(final Bundle savedInstanceState) {
     super.onCreate(savedInstanceState);
}
```

###Activity切换

```Java
    Intent in = new Intent();
    in.setClassName(getContext(),"org.cocos2dx.cpp.LockActivity");//目标Activiy类名
    startActivity(in);
```

##Java8新特征
###Lambda
```Java
(params) -> expression
(params) -> statement
(params) -> { statements }
```
>用Lambda简化Runable

```Java
// Java 8之前：
new Thread(new Runnable() {
    @Override
    public void run() {
    System.out.println("Before Java8, too much code for too little to do");
    }
}).start();

//Java 8方式：
new Thread( () -> System.out.println("In Java8, Lambda expression rocks !!") ).start();
```

>Lambda需要jdk1.8特征，遇到`Lambda expressions are not support at this Language level`，就应该升级并且配置jdk版本到1.8

```json
//build.gradle
  defaultConfig {
        applicationId "com.happygod.giveup"
        minSdkVersion 16
        targetSdkVersion 22
        versionCode 1
        versionName "1.0"
        jackOptions {//添加Jack支持
            enabled true
        }
    }
    compileOptions {//JAVA版本
        targetCompatibility 1.8
        sourceCompatibility 1.8
    }
```

##JNI

###介绍
**JNI是JVM实现中的一部分，因此Native语言和Java代码都运行在JVM的宿主环境**。JNI的出现使得开发者既可以利用Java语言跨平台、类库丰 富、开发便捷等特点，又可以利用Native语言的高效。

JNI是一个双向的接口：**开发者不仅可以通过JNI在Java代码中访问Native模块，还可以在 Native代码中嵌入一个JVM，并通过JNI访问运行于其中的Java模块**。可见，JNI担任了一个桥梁的角色，它将JVM与Native模块联系起来，从而实现了Java代码与Native代码的互访。

![](http://www.cocos.com/docs/native/v2/sdk-integration/android-jni/res/jni_readmind.png)

缺点：由于Native模块的使用，Java代码会丧失其原有的跨平台性和类型安全等特性。但是这不是我们应该担心的，不是吗？哈哈

也就是说，**JNI是帮助游戏在Java代码中调用Native接口和在Native代码中调用Java接口**。

###引用
```C++
 #include "platform/android/jni/JniHelper.h"
```

###Java调用C++代码
**Java代码**
```Java
    //MethodModifiers native ResultType	MethodDeclarator
	private native void setUserID(String userID);
```
**C++代码**
```C++
#ifdef __cplusplus
extern "C" {
#endif
    //ResultType Java_classpath_functionName(JNIEnv *env, jobject thiz, other parameters)
    void Java_org_cocos2dx_cpp_AppActivity_setUserID(JNIEnv *env, jobject thiz, jstring userID)
    {
        
        const char* id =  env->GetStringUTFChars(userID,NULL);
        log("userID %s",id);
    }
    
#ifdef __cplusplus
}
#endif
```

###C++调用Java代码
**C++代码**
```C++
const char* java_className = "org/cocos2dx/cpp/AppActivity";

//开启锁屏(二维码解锁)界面
inline void java_openLockUI(){
	//此类型主要用户保存类结构体，可以通过JniHelper类的getStaticMethodInfo函数实例化JniMethodInfo对象，从而使用实例的env属性调用CallStaticVoidMethod，CallVoidMethod，CallStaticIntMethod等函数进行对保存的类结构调用函数；
    JniMethodInfo t;
    //getStaticMethodInfo(JniMethodInfo &methodinfo, const char *className, const char *methodName, const char *paramCode)
    if (JniHelper::getStaticMethodInfo(t,java_className,"openLockUI","()V")) {
        t.env->CallStaticVoidMethod(t.classID,t.methodID);
    }
}

```

**Java代码**
```Java
   public static void openLockUI(){
        Log.d("OpenLockUI","Open");
    }
```

####参数类型签名
`(II)V`表示 方法参数为2个int类型返回值void,也就是格式是`(参数)返回值`，对应参数类型签名
```C++
#define jni_int     "I"
#define jni_string  "Ljava/lang/String;"
#define jni_float   "F"
#define int_double  "D"
#define jni_void    "V"
#define jni_bool    "Z"
#define jni_byte    "B"
#define jni_short   "S"
#define jni_long    "J"
```
这是我以前做的一个宏定义，现在不用了，将就着对照看吧


>在使用过程中我试图把JNI有关代码放在.h内，不过在经过ndk编译的时候报`java_className`和`Java_org_cocos2dx_cpp_AppActivity_setUserID`重复声明，但我.h里做了`#ifdef`保护，不知道为什么，暂时只能妥协放在cpp里了

###类型转化
####char*和jstring
```C++
	char* mychar = env->GetStringUTFChars(myJstring,NULL);//jstring转char*
	env->ReleaseStringUTFChars(myJstring,mychar);

	jstring myJstring = env->NewStringUTF(mychar);//char*转jstring
```


##Android Studio

###JDK路劲

默认路劲是`/Applications/Android Studio.app/Contents/jre/jdk/Contents/Home`

可以在File-Project Structure面板里修改`JDK Location`

>注：要使用Java8的Lambda功能必须使用Jdk1.8以上，但修改java版本后编译会报错：

>**Error:Jack is required to support Java 8 language features. Either enable Jack or remove sourceCompatibility JavaVersion.VERSION_1_8.**

>这是由于AS新版本java8新特性需要jack工具链
>解决办法：修改`build.gradle`文件

```
android { 
…… 
defaultConfig {

    jackOptions {
        enabled true
    }

}
```

>参照：http://blog.csdn.net/yuhanghate/article/details/51490214

###打开项目

打开项目如果卡在**Building**,那就修改`gradle/wrapper/gradle-wrapper.properties`文件

```

distributionBase=GRADLE_USER_HOME
distributionPath=wrapper/dists
zipStoreBase=GRADLE_USER_HOME
zipStorePath=wrapper/dists
distributionUrl=https\://services.gradle.org/distributions/gradle-2.14.1-all.zip//修改这一行到你可以下载的指定版本

```

###编译项目

android studio 暂时没有自动编译so的功能，需要到proj.android-studio文件夹用命令行输入

```
cocos run/compile -p android --android-studio//注意android-stuido前面是两个"-"符号，只打一个会忽略该选项直接编译proj.android工程的so！！！一定要注意

```

编译完后`app`目录下应该会多一个`libs`目录，里面存放的是编译完的so，上面命令会在项目gen'mu'lu的bin/debug/android文件夹下生成apk，可以安装到手机利用Android-studio的Run/Attack debugger to Android process来调试。
你还可以直接用Android studio的Run/Debug来调试。

>遇到的那些坑：

>1. 打编译命令的时候把 `--android-studio` 输成了 `-android-studio` 导致这个选项没无视了，直接编译了proj.android项目
>2. 编译过程中对应的 Android sdk版本是~/.bash_profile里定义的环境变量，那时候位置给错了，导致跑错了sdk库
>3. 由于开始编译用错了 Android sdk版本，gradle编译出了点问题，虽然最后修改过来，用命令行编译成功生成了apk,但不知道为什么工程中的gradle还是报错了，报的错找寻半天还是没有头绪，后来莫名其妙好了。。。Android Studio学好Gradle还是很重要的，要不会出很多莫名其妙问题，没法解决

##Gradle

留坑

##关于C++11和NDK的一些不兼容

### std::to_string 不支持，需要自己实现

```C++
#include <sstream>

template <typename T>
std::string to_string(T value)
{
    std::ostringstream os ;
    os << value ;
    return os.str() ;
}

```

##Android实用配置

###隐藏导航栏和状态栏

需要Android 4.1以上

```Java
//隐藏导航栏
View decorView = getWindow().getDecorView();
// Hide both the navigation bar and the status bar.
// SYSTEM_UI_FLAG_FULLSCREEN is only available on Android 4.1 and higher, but as
// a general rule, you should design your app to hide the status bar whenever you
// hide the navigation bar.
int uiOptions = View.SYSTEM_UI_FLAG_HIDE_NAVIGATION
        | View.SYSTEM_UI_FLAG_FULLSCREEN;
decorView.setSystemUiVisibility(uiOptions);

```

###隐藏标题栏

```Java
this.requestWindowFeature(Window.FEATURE_NO_TITLE);
```

或

```xml
android:theme="@android:style/Theme.NoTitleBar"
```

###隐藏状态栏

####Android4.0以下

```Java
// If the Android version is lower than Jellybean, use this call to hide  
// the status bar.  
if (Build.VERSION.SDK_INT < 16) {  
    getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN,  
            WindowManager.LayoutParams.FLAG_FULLSCREEN);  
}  
setContentView(R.layout.activity_main);
```
####Android4.1以上

```Java
View decorView = getWindow().getDecorView();  
// Hide the status bar.  
int uiOptions = View.SYSTEM_UI_FLAG_FULLSCREEN;  
decorView.setSystemUiVisibility(uiOptions);  
// Remember that you should never show the action bar if the  
// status bar is hidden, so hide that too if necessary.  
ActionBar actionBar = getActionBar();  
actionBar.hide();  
```

或

```xml
android:theme="@android:style/Theme.NoTitleBar.Fullscreen"
```


##问题总汇

###failed: cannot locate symbol "atof" referenced by "libMyGame.so"...

原因：在Android4.4版本的机顶盒上运行，报这个错。意思是找不到atof()方法，这是一个C标准库里的一个函数。最新的NDK默认编译最新版Android设备自己的C标准库包括atof函数(lib.so)。这就意味着如果运行在老版本的设备上，它会报找不到atof()函数错误

解决方法：
```
cocos run/compile -p android --android-studio --ap ‘android-19’
```
用版本编译so，或者修改`project.properties`文件`target=android-19`。

修改build.gradle

```json

android {
    compileSdkVersion 19//需要改编译版
    buildToolsVersion "24.0.2"

    defaultConfig {
        applicationId "c.happygod.pangpang"
        minSdkVersion 11
        targetSdkVersion 19//修改目标版本
        versionCode 1
        versionName "1.0"
        jackOptions {
            enabled true
        }
    }
}

```
Application.mk
```
APP_PLATFORM := android-9
```
