Tplay 1.3
===============

更新说明：

1.增加选项卡最右侧的关闭全部选项卡和关闭其它选项卡的快捷菜单

2.将便签改为js存储，且移到了header部分通过按钮触发

3.修改了皮肤选择按钮的弹起方式

4.header最右侧增加了版本详情按钮，且将退出按钮合并到了头像信息下

5.管理员列表、角色列表、日志列表、上传文件列表、文章列表及留言列表分别增加了一些搜索条件，更方便操作

6.修复了添加及修改文章时不选择分类也能通过的bug

7.现在当你展开左侧的某个菜单时会同时关闭其它已展开的菜单了

8.数据表增加部分索引

9.增加index模块且增加了相应的提示，避免不看安装说明的同学获得懵逼BUFF

Tplay 1.2
===============

更新说明：

1.将清除缓存按钮移到了header区域

2.去除了选项卡区域最右侧的菜单

3.header区域增加刷新当前选项卡的按钮

4.部分驼峰方式命名的模板文件统一改成了小写

5.增加git安装

6.增加服务器部署参考

Tplay 1.1
===============

更新说明：

1.新增部分索引

2.新增便签功能

3.新增置顶和审核文章的功能

4.优化部分按钮和表格的表现

5.调整部分页面的打开方式为iframe弹窗

6.重做了新增和修改管理员角色时分配权限的页面部分

7.部分表单页面增加了相应的注释

8.实装了登录后台时记住账号的功能

9.layui版本提升到2.2.5

10.thinkphp版本提升到5.0.14

Tplay 1.0
===============

Tplay是一款基于ThinkPHP5.0.13 + layui2.2.45 + Mysql开发的后台管理框架，PHP版本要求提升到5.5。Tplay集成了一般应用所必须的基础性功能，为开发者减少重复性的工作，提升开发速度，规范团队开发模式。

> Tplay的运行环境要求PHP >= 5.5，推荐使用PHP7，其余要求参考thinkPHP5的配置要求。

二次开发请参考 [ThinkPHP5完全开发手册](http://www.kancloud.cn/manual/thinkphp5)

## 目录结构

初始的目录结构如下：

~~~
www  WEB部署目录（或者子目录）
├─app           		应用目录
│  ├─admin              Tplay核心目录
│  │  ├─config.php      模块配置文件
│  │  ├─common.php      模块函数文件
│  │  ├─controller      控制器目录
│  │  ├─model           模型目录
│  │  ├─view            视图模板目录
│  │
│  ├─command.php        命令行工具配置文件
│  ├─common.php         公共函数文件
│  ├─config.php         公共配置文件
│  ├─route.php          路由配置文件
│  ├─tags.php           应用行为扩展定义文件
│  └─database.php       数据库配置文件
│
├─public                WEB目录（对外访问目录）
│  ├─static          	css、js等资源目录
│  │   ├─admin          	Tplay后台css、js文件
│  │   ├─public         	公共css、js文件
│  ├─uploads          图片等资源文件
│  ├─index.php          入口文件
│  ├─router.php         快速测试文件
│  └─.htaccess          用于apache的重写
│
├─thinkphp              框架系统目录
│  ├─lang               语言文件目录
│  ├─library            框架类库目录
│  │  ├─think           Think类库包目录
│  │  └─traits          系统Trait目录
│  │
│  ├─tpl                系统模板目录
│  ├─base.php           基础定义文件
│  ├─console.php        控制台入口文件
│  ├─convention.php     框架惯例配置文件
│  ├─helper.php         助手函数文件
│  ├─phpunit.xml        phpunit配置文件
│  └─start.php          框架入口文件
│
├─extend                扩展类库目录
├─runtime               应用的运行时目录（可写，可定制）
├─vendor                第三方类库目录（Composer依赖库）
├─build.php             自动生成定义文件（参考）
├─composer.json         composer 定义文件
├─LICENSE.txt           授权说明文件
├─README.md             README 文件
├─think                 命令行入口文件
├─tplay.sql             Tplay框架sql文件
~~~

## 安装使用

1. 首先克隆下载应用项目仓库（或者直接下载最新[发布版本包](https://github.com/tingyuu/tplay/releases)）
    
    ```bash
    git clone https://github.com/tingyuu/tplay.git
    ```
2. 然后切换到`tplay`目录下面，再使用`composer`自动安装更新依赖库

    ```bash
    composer install 
    ```
3. 将根目录下的`tlay.sql`文件导入`mysql`数据库

    ```mysql
    mysql>source 你的(磁盘)路径/tplay.sql
    ```
4. 修改项目`/app/database.php`文件中的数据库配置信息

5. 将你的域名指向根目录下的public目录（重要）,详情请看这里 [服务环境部署](#服务环境部署)

6. 浏览器访问：`你的域名/admin`，默认管理员账户：`admin` 密码：`tplay`

7. 如果你用到了短信配置，请前往阿里大鱼官网申请下载自己的sdk文件，替换/extend/dayu下的文件，在后台配置自己的appkey即可

> 如遇问题可在QQ群221470096交流。

## 服务环境部署 
####  Nginx 虚拟主机配置参考

```bash
server {
    listen 80;
    server_name tplay.tinywan.com; # 这里修改为你的域名或者公网IP地址

    set $root_path $path/tplay/public; # $path 为你的web项目绝对路径
    root $root_path;
    index index.php index.html index.htm;

    location / {
        if (!-e $request_filename) {
            rewrite  ^(.*)$  /index.php?s=/$1  last;
            break;
        }
    }

    location ~ \.php$ {
        fastcgi_pass   unix:/var/run/php7.1.9-fpm.sock;
        fastcgi_index  index.php;
        fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
        include        fastcgi_params;
        fastcgi_buffer_size 128k;
        fastcgi_buffers 4 256k;
        fastcgi_busy_buffers_size 256k;
    }

    location ~ .*\.(gif|jpg|jpeg|png|bmp|swf)$ {
        access_log  off;
        error_log   off;
        expires     30d;
    }

    location ~ .*\.(js|css)?$ {
        access_log   off;
        error_log    off;
        expires      12h;
    }
}
```
> 重新启动 Nginx 即可生效，浏览器输入地址：[http://tplay.tinywan.com/admin/](http://tplay.tinywan.com/admin/)

####  Apache 配置参考
在项目根目录加入.htaccess文件，只需开启rewrite模块
```bash
<IfModule mod_rewrite.c>
  Options +FollowSymlinks -Multiviews
  RewriteEngine On
  RewriteCond %{REQUEST_FILENAME} !-d
  RewriteCond %{REQUEST_FILENAME} !-f
  RewriteRule ^(.*)$ index.php/$1 [QSA,PT,L]
</IfModule>
```
> 重新启动 Apache 即可生效

## 版权信息

Tplay同ThinkPHP一样，遵循Apache2开源协议发布，并提供免费使用。

本项目包含的第三方源码和二进制文件之版权信息另行标注。

版权所有Copyright © 2017 by Tplay (http://tplay.pengyichen.cn/public/admin)

All rights reserved。
