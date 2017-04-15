#Android通过url启动apk

>以下示范的功能是：在一个Activity使用WebView加载网页，通过网页跳转按钮激活另一个Activity，其核心就是通过符合规范的Url激活有对应<intent>属性的Activity。这里示范是使用apk内部的WebView。其实用外部浏览器访问网页是一样的效果，可以直接启动apk。

##Manifest

**添加intent**
1. **`<category>`必须包含`android.intent.category.BROWSABLE`才能允许浏览器访问。**
2. **配置`<data>`的`scheme`,`host`,`path`值,浏览器打开url：`scheme://host/path`,如下配置的访问路径为`pangpang://com.happygod.pangpang/openApk?userID=2001`,可以看到url后面可以添加`GET`参数。**

```xml
 <activity
    android:name="org.cocos2dx.cpp.AppActivity"
    android:screenOrientation="landscape"
    android:configChanges="orientation|keyboardHidden|screenSize"
    android:label="@string/app_name"
    android:theme="@android:style/Theme.NoTitleBar.Fullscreen" >
    <!-- 浏览器URL打开必须添加次intent  BROWSTABLE针对浏览器 ,data 配置 scheme host path -->
    <intent-filter>
        <action android:name="android.intent.action.VIEW"/>
        <category android:name="android.intent.category.DEFAULT" />
        <category android:name="android.intent.category.BROWSABLE" />
        <data android:scheme="pangpang" android:host="com.happygod.pangpang" android:pathPrefix="/openApk"/>
    </intent-filter>
    <!-- 浏览器打开结束 -->
</activity>
 <!-- 全屏去状态栏 横屏 这个作为锁屏Activity-->
<activity
    android:name="org.cocos2dx.cpp.LockActivity"
    android:theme="@android:style/Theme.NoTitleBar.Fullscreen"
    android:screenOrientation="landscape">
    <intent-filter>
        <action android:name="android.intent.action.MAIN" />
        <category android:name="android.intent.category.LAUNCHER" />
    </intent-filter>
</activity>
```

##加载网页的Activity

```Java
public class LockActivity extends Activity {
@Override
protected void onCreate(Bundle savedInstanceState) {
    super.onCreate(savedInstanceState);
    setContentView(R.layout.webview);
    WebView webView = (WebView) findViewById(R.id.webView);
    // 获取webview的相关配置
    WebSettings webSettings = webView.getSettings();
    //允许与js交互
    webSettings.setJavaScriptEnabled(true);
    //设置默认的字符编码
    webSettings.setDefaultTextEncodingName("utf-8");
    webView.loadUrl("http://www.happygod.cn/openApk.html");
}

}
```

>这里指的注意的是,AndroidStudio生成R.java的位置是`工程目录/build/generated/source/r`，注意对应生成的包名进行引用，由于无法找到`R`这个变量卡了好久。如果包名引用没问题还是无法找到R的话，那尝试下`Build/Clear Project`，然后`Tools/Android/Sync Project with Gradle Files`。

webview.xml
```
<?xml version="1.0" encoding="utf-8"?>
<RelativeLayout xmlns:android="http://schemas.android.com/apk/res/android"
    xmlns:tools="http://schemas.android.com/tools"
    android:layout_width="fill_parent"
    android:layout_height="fill_parent">

    <WebView
        android:id="@+id/webView"
        android:layout_width="fill_parent"
        android:layout_height="fill_parent" />

</RelativeLayout>
```

##激活Apk网页

**该页面通过符合规范的url来激活Activity**

```html

<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<head>
	<title></title>
</head>
<body>
<a href="pangpang://com.happygod.pangpang/openApk?userID=2001">启动应用程序</a>
</body>
</html>

```

##目标Activity

**被激活的Activity可以通过`intent.action`来判断是否是网页激活，如果是可以通过`intent.getData()`获取Url信息，通过Url的`getQueryParameter(name)`方法获取参数值**
```Java
//获取Intent
Intent i_getvalue = getIntent();
String action = i_getvalue.getAction();

//确定是浏览器打开
if(Intent.ACTION_VIEW.equals(action)){
    Uri uri = i_getvalue.getData();
    if(uri != null){
        //获取url参数
         userID = uri.getQueryParameter("userID");
    }
}
```


##Android WebView

###加载链接

```Java
    webView.loadUrl(url);
```

###WebViewClient

```Java
webView.setWebViewClient(new WebViewClient(){
    /*当希望WebView既想调用Activity Manager又想直接在webview内加载url，需要在这里进行处理*/
    @Override
    public boolean shouldOverrideUrlLoading(WebView view, String url) {
        if (url.startsWith("http")) {
            return false;//返回false表示当前webview处理url
        }else {
            // 调用系统默认浏览器处理url
            view.stopLoading();
            view.getContext().startActivity(new Intent(Intent.ACTION_VIEW, Uri.parse(url)));
            return true;//返回true表示应用自己处理url
        }
    }
});
```


###WebView Settings

```Java

// 获取webview的相关配置
WebSettings webSettings = webView.getSettings();
//允许与js交互
webSettings.setJavaScriptEnabled(true);

//支持屏幕缩放
webSettings.setSupportZoom(true);
webSettings.setBuiltInZoomControls(true);

//扩大比例的缩放
webSettings.setUseWideViewPort(true);

//自适应屏幕
webSettings.setLoadWithOverviewMode(true);

//设置默认的字符编码
webSettings.setDefaultTextEncodingName("utf-8");

```


