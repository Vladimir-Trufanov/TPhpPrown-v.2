## [browscap - сведения по 'HTTP_USER_AGENT'](https://browscap.org/) 

#### Из браузера Яндекс на моноблоке:
```
$UserAgent
Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 YaBrowser/24.7.0.0 Safari/537.36
Array
(
    [browser_name_regex] => ~^mozilla/5\.0 \(.*windows nt 10\.0.*\) applewebkit.* \(.*khtml.*like.*gecko.*\) chrome/126\.0.*safari/.*$~
    [browser_name_pattern] => Mozilla/5.0 (*Windows NT 10.0*) applewebkit* (*khtml*like*gecko*) Chrome/126.0*Safari/*
    [parent] => Chrome 126.0
    [platform] => Win10
    [comment] => Chrome 126.0
    [browser] => Chrome
    [version] => 126.0
    [device_type] => Desktop
    [ismobiledevice] => 
    [istablet] => 
)

```

#### Из браузера Edge на моноблоке:
```
$UserAgent
Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36 Edg/129.0.0.0
Array
(
    [browser_name_regex] => ~^mozilla/5\.0 \(.*windows nt 10\.0.*\) applewebkit.* \(.*khtml.*like.*gecko.*\) chrome/.* safari/.* edg/129\..*$~
    [browser_name_pattern] => Mozilla/5.0 (*Windows NT 10.0*) applewebkit* (*khtml*like*gecko*) Chrome/* Safari/* Edg/129.*
    [parent] => Edge 129.0
    [platform] => Win10
    [comment] => Edge 129.0
    [browser] => Edge
    [version] => 129.0
    [device_type] => Desktop
    [ismobiledevice] => 
    [istablet] => 
)
```


#### Из браузера Chrome на смартфоне:
```
$UserAgent
Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Mobile Safari/537.36
Array
(
    [browser_name_regex] => ~^mozilla/5\.0 \(.*linux.*android.*\) applewebkit.* \(.*khtml.*like.*gecko.*\) chrome/129\.0.*mobile safari/.*$~
    [browser_name_pattern] => Mozilla/5.0 (*Linux*Android*) applewebkit* (*khtml*like*gecko*) Chrome/129.0*Mobile Safari/*
    [parent] => Chrome 129.0 for Android
    [comment] => Chrome 129.0
    [browser] => Chrome
    [version] => 129.0
    [platform] => Android
    [ismobiledevice] => 1
    [device_type] => Mobile Phone
    [istablet] => 
)
```

#### Из ESP32-CAM:
```
$UserAgent
ESP32HTTPClient
Array
(
    [browser_name_regex] => ~^.*$~
    [browser_name_pattern] => *
    [parent] => DefaultProperties
    [comment] => Default Browser
    [browser] => Default Browser
    [version] => 0.0
    [platform] => unknown
    [ismobiledevice] => 
    [istablet] => 
    [device_type] => unknown
)
```

