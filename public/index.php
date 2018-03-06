<?php
// +----------------------------------------------------------------------
// | Tplay [ WE ONLY DO WHAT IS NECESSARY ]
// +----------------------------------------------------------------------
// | Copyright (c) 2017 http://tplay.pengyichen.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 听雨 < 389625819@qq.com >
// +----------------------------------------------------------------------

// [ 应用入口文件 ]

// 定义应用目录
define('APP_PATH', __DIR__ . '/../app/');
// 定义版本号
define('TPLAY_VERSION', '1.3.3');
//重定义扩展类库目录
define('EXTEND_PATH', __DIR__ . '/../extend/');
//重定义第三方类库目录
define('VENDOR_PATH', __DIR__ . '/../vendor/');
// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';