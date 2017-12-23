<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:63:"E:\phpStudy\WWW\tplay\public/../app/admin\view\index\index.html";i:1513993331;s:55:"E:\phpStudy\WWW\tplay\app\admin\view\public\header.html";i:1513996211;s:53:"E:\phpStudy\WWW\tplay\app\admin\view\public\left.html";i:1513993331;s:55:"E:\phpStudy\WWW\tplay\app\admin\view\public\footer.html";i:1513994581;}*/ ?>
<!-- 头部公共文件 -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Tplay后台管理框架</title>
    <link rel="stylesheet" href="__PUBLIC__/layui/css/layui.css" media="all" />
    <link rel="stylesheet" href="__PUBLIC__/font-awesome/css/font-awesome.min.css" media="all" />
    <link rel="stylesheet" href="__CSS__/app.css" media="all" />
    <link rel="stylesheet" href="__CSS__/themes/default.css" media="all" id="skin" kit-skin />
    <link rel="stylesheet" href="__CSS__/index.css" />
</head>

<body class="kit-theme">
    <div class="layui-layout layui-layout-admin kit-layout-admin">
        <div class="layui-header">
            <div class="layui-logo">Tplay后台管理框架</div>
            <div class="layui-logo kit-logo-mobile">K</div>
            <ul class="layui-nav layui-layout-left kit-nav">
                <!-- <li class="layui-nav-item"><a href="javascript:;" data-url="<?php echo url('main/index'); ?>" data-title="控制台" kit-target><i class="fa fa-home" aria-hidden="true"></i> <span>控制台</span></a></li> -->
                <!-- <li class="layui-nav-item"><a href="javascript:;">内容管理</a></li> -->
                <!-- <li class="layui-nav-item">
                    <a href="javascript:;">其它系统</a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;">文件管理</a></dd>
                        <dd><a href="javascript:;">菜单管理</a></dd>
                        <dd><a href="javascript:;">权限管理</a></dd>
                    </dl>
                </li> -->
            </ul>
            <ul class="layui-nav layui-layout-right kit-nav">
                <li class="layui-nav-item">
                    <a href="javascript:;">
                        <i class="layui-icon">&#xe63f;</i> 皮肤</a>
                    </a>
                    <dl class="layui-nav-child skin">
                        <dd><a href="javascript:;" data-skin="default" style="color:#393D49;"><i class="layui-icon">&#xe658;</i> 默认</a></dd>
                        <dd><a href="javascript:;" data-skin="orange" style="color:#ff6700;"><i class="layui-icon">&#xe658;</i> 橘子橙</a></dd>
                        <dd><a href="javascript:;" data-skin="green" style="color:#00a65a;"><i class="layui-icon">&#xe658;</i> 原谅绿</a></dd>
                        <dd><a href="javascript:;" data-skin="pink" style="color:#FA6086;"><i class="layui-icon">&#xe658;</i> 少女粉</a></dd>
                        <dd><a href="javascript:;" data-skin="blue.1" style="color:#00c0ef;"><i class="layui-icon">&#xe658;</i> 天空蓝</a></dd>
                        <dd><a href="javascript:;" data-skin="red" style="color:#dd4b39;"><i class="layui-icon">&#xe658;</i> 枫叶红</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a href="javascript:;">
                        <img src="<?php echo geturl($cookie['thumb']); ?>" class="layui-nav-img"> <?php if(empty($cookie['nickname']) || (($cookie['nickname'] instanceof \think\Collection || $cookie['nickname'] instanceof \think\Paginator ) && $cookie['nickname']->isEmpty())): ?><?php echo $cookie['name']; else: ?><?php echo $cookie['nickname']; endif; ?>
                    </a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;" data-url="<?php echo url('admin/admin/personal',['id'=>$cookie['id']]); ?>" data-icon="fa-asterisk" data-title="个人信息" kit-target data-id='1'><span>基本资料</span></a></dd>
                        <dd><a href="javascript:;"  data-url="<?php echo url('admin/admin/editPassword'); ?>" data-icon="fa-edit" data-title="修改密码" kit-target data-id='2'><span>修改密码</span></a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item"><a href="javascript:;" id="logout"><i class="fa fa-sign-out" aria-hidden="true"></i> 退了</a></li>
            </ul>
        </div>
<!-- 左侧公共菜单文件 -->
        <div class="layui-side layui-bg-black kit-side">
            <div class="layui-side-scroll">
                <div class="kit-side-fold" style="font-size: 14px;"> 
                  <span>
                  <i class="fa fa-home" aria-hidden="true" id="home"></i>
                  <i class="fa fa-trash" aria-hidden="true" id="clear"></i> 
                  </span>                
                  <i class="fa fa-navicon" aria-hidden="true" id="kit-side-fold"></i>
                </div>
                <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
                <ul class="layui-nav layui-nav-tree" lay-filter="kitNavbar" kit-navbar>
                <?php if(is_array($menus) || $menus instanceof \think\Collection || $menus instanceof \think\Paginator): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>

                    <li class="layui-nav-item <?php if($data['is_open'] == 1): ?>layui-nav-itemed<?php endif; ?>">
                        <a href="javascript:;"><i class="fa <?php echo $data['icon']; ?>" aria-hidden="true"></i><span> <?php echo $data['name']; ?></span></a>
                        <dl class="layui-nav-child">
                        <?php if(!(empty($data['list']) || (($data['list'] instanceof \think\Collection || $data['list'] instanceof \think\Paginator ) && $data['list']->isEmpty()))): if(is_array($data['list']) || $data['list'] instanceof \think\Collection || $data['list'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <dd>
                                <a href="javascript:;" data-url="<?php echo $vo['url']; ?>" data-icon="<?php echo $vo['icon']; ?>" data-title="<?php echo $vo['name']; ?>" kit-target data-id='<?php echo $vo['id']; ?>'><i class="fa <?php echo $vo['icon']; ?>" aria-hidden="true"></i><span> <?php echo $vo['name']; ?></span></a>
                            </dd>
                        <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                        </dl>
                    </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
        </div>
<div class="layui-body" id="container" style="padding:0 2px;">
    <!-- 内容主体区域 -->
    <div style="padding: 15px;"><i class="layui-icon layui-anim layui-anim-rotate layui-anim-loop">&#xe63e;</i> 正在拼命加载...</div>
</div>
<!-- 底部固定区域 -->
        <div class="layui-footer">
            <!-- 底部固定区域 -->
            2017 &copy;
            <a href="javascript:;">Tplay后台基础框架</a> tplay.pengyichen.cn
        </div>
    </div>
    <script src="__PUBLIC__/layui/layui.js"></script>
    <script>
        var message;
        layui.config({
            base: '__JS__/',
            version: '1.0.1'
        }).use(['app', 'message'], function() {
            var app = layui.app,
                $ = layui.jquery,
                layer = layui.layer;
            //将message设置为全局以便子页面调用
            message = layui.message;
            //主入口
            app.set({
                type: 'iframe'
            }).init();
            
            $('dl.skin > dd').on('click', function() {
                var $that = $(this);
                var skin = $that.children('a').data('skin');
                switchSkin(skin);
            });
            var setSkin = function(value) {
                    layui.data('kit_skin', {
                        key: 'skin',
                        value: value
                    });
                },
                getSkinName = function() {
                    return layui.data('kit_skin').skin;
                },
                switchSkin = function(value) {
                    var _target = $('link[kit-skin]')[0];
                    _target.href = _target.href.substring(0, _target.href.lastIndexOf('/') + 1) + value + _target.href.substring(_target.href.lastIndexOf('.'));
                    setSkin(value);
                },
                initSkin = function() {
                    var skin = getSkinName();
                    switchSkin(skin === undefined ? 'default' : skin);
                }();
        });
    </script>
    <script src="__PUBLIC__/jquery/jquery.min.js"></script>
    <script type="text/javascript">
    
        layui.use('jquery', function() {
            var $ = layui.jquery;
            $('#clear').on('click', function() {
                $(this).attr("class","fa fa-spinner");
                $.ajax({
                  url:"<?php echo url('common/clear'); ?>"
                  ,success:function(res) {
                    if(res.code == 1) {
                        setTimeout(function(){
                            parent.message.show({
                                skin: 'cyan',
                                msg:res.msg
                            });
                            $('#clear').attr("class","fa fa-trash");
                        },1000)
                    }
                  }
                })
            });
        });
      // $('#clear').click(function() {
      //   $.ajax({
      //     url:"<?php echo url('common/clear'); ?>"
      //     ,success:function(res) {
      //       layer.msg(res.msg,{offset: '250px',anim: 1});
      //     }
      //   })
      // })

      $('#home').click(function(){
        location.href = "<?php echo url('admin/index/index'); ?>";
      })

      $('#logout').click(function(){
        layer.confirm('真的要退出?',{icon: 3, title:'提示',anim: 2}, function(index){
            $.ajax({
              url:"<?php echo url('admin/common/logout'); ?>"
              ,success:function(res) {
                layer.msg(res.msg,{offset: '250px',anim: 4});
                if(res.code == 1) {
                    setTimeout(function(){
                        location.href = res.url;
                    },2000)
                }
              }
            })
        }) 
      })
    </script>
</body>
</html>