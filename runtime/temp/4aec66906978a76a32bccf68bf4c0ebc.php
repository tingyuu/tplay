<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:64:"E:\phpStudy\WWW\tplay\public/../app/admin\view\menu\publish.html";i:1517563642;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>layui</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="/static/public/layui/css/layui.css"  media="all">
  <link rel="stylesheet" href="/static/public/font-awesome/css/font-awesome.min.css" media="all" />
  <link rel="stylesheet" href="/static/admin/css/admin.css"  media="all">
</head>
<body style="padding:10px;">
  <div class="tplay-body-div"> 
      <div class="layui-tab">
        <ul class="layui-tab-title">
          <li><a href="<?php echo url('admin/menu/index'); ?>" class="a_menu">系统菜单管理</a></li>
          <li class="layui-this">添加新菜单</li>
        </ul>
      </div>
    <form class="layui-form" id="admin">
      
      <div class="layui-form-item">
        <label class="layui-form-label">上级菜单</label>
        <div class="layui-input-inline">
          <select name="pid" lay-filter="aihao">
            <option value="0">作为顶级菜单</option>
            <?php if(is_array($menus) || $menus instanceof \think\Collection || $menus instanceof \think\Paginator): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <option value="<?php echo $vo['id']; ?>" <?php if(!(empty($menu['pid']) || (($menu['pid'] instanceof \think\Collection || $menu['pid'] instanceof \think\Paginator ) && $menu['pid']->isEmpty()))): if($menu['pid'] == $vo['id']): ?> selected=""<?php endif; else: if(!(empty($pid) || (($pid instanceof \think\Collection || $pid instanceof \think\Paginator ) && $pid->isEmpty()))): if($pid == $vo['id']): ?> selected=""<?php endif; endif; endif; ?>><?php echo $vo['str']; ?><?php echo $vo['name']; ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
          </select>
        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">名称</label>
        <div class="layui-input-inline">
          <input name="name" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input" type="text" <?php if(!(empty($menu['name']) || (($menu['name'] instanceof \think\Collection || $menu['name'] instanceof \think\Paginator ) && $menu['name']->isEmpty()))): ?>value="<?php echo $menu['name']; ?>"<?php endif; ?>>
        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">模块名</label>
        <div class="layui-input-inline">
          <input name="module" placeholder="请输入" autocomplete="off" class="layui-input" type="text" <?php if(!(empty($menu['module']) || (($menu['module'] instanceof \think\Collection || $menu['module'] instanceof \think\Paginator ) && $menu['module']->isEmpty()))): ?>value="<?php echo $menu['module']; ?>"<?php endif; ?>>
        </div>
        <div class="layui-form-mid layui-word-aux">如果仅作为父级菜单，请留空</div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">控制器名</label>
        <div class="layui-input-inline">
          <input name="controller" placeholder="请输入" autocomplete="off" class="layui-input" type="text" <?php if(!(empty($menu['controller']) || (($menu['controller'] instanceof \think\Collection || $menu['controller'] instanceof \think\Paginator ) && $menu['controller']->isEmpty()))): ?>value="<?php echo $menu['controller']; ?>"<?php endif; ?>>
        </div>
        <div class="layui-form-mid layui-word-aux">如果仅作为父级菜单，请留空</div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">方法名</label>
        <div class="layui-input-inline">
          <input name="function" placeholder="请输入" autocomplete="off" class="layui-input" type="text" <?php if(!(empty($menu['function']) || (($menu['function'] instanceof \think\Collection || $menu['function'] instanceof \think\Paginator ) && $menu['function']->isEmpty()))): ?>value="<?php echo $menu['function']; ?>"<?php endif; ?>>
        </div>
        <div class="layui-form-mid layui-word-aux">如果仅作为父级菜单，请留空</div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">参数</label>
        <div class="layui-input-inline">
          <input name="parameter" placeholder="请输入" autocomplete="off" class="layui-input" type="text" <?php if(!(empty($menu['parameter']) || (($menu['parameter'] instanceof \think\Collection || $menu['parameter'] instanceof \think\Paginator ) && $menu['parameter']->isEmpty()))): ?>value="<?php echo $menu['parameter']; ?>"<?php endif; ?>>
        </div>
        <div class="layui-form-mid layui-word-aux">请用'&'隔开，例如：name=tingyu&id=10</div>
      </div>

      <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">备注</label>
        <div class="layui-input-block" style="max-width:600px;">
          <textarea placeholder="请输入内容" class="layui-textarea" name="description"><?php if(!(empty($menu['description']) || (($menu['description'] instanceof \think\Collection || $menu['description'] instanceof \think\Paginator ) && $menu['description']->isEmpty()))): ?><?php echo $menu['description']; endif; ?></textarea>
        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">图标</label>
        <div class="layui-input-inline">
          <input name="icon" placeholder="请输入" autocomplete="off" class="layui-input" type="text" <?php if(!(empty($menu['icon']) || (($menu['icon'] instanceof \think\Collection || $menu['icon'] instanceof \think\Paginator ) && $menu['icon']->isEmpty()))): ?>value="<?php echo $menu['icon']; ?>"<?php endif; ?>>
        </div>
        <div class="layui-form-mid layui-word-aux">例如：fa-asterisk，图标参考：<a href="http://code.zoomla.cn/boot/font.html" target="_block">点击查看</a></div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">状态</label>
        <div class="layui-input-inline">
          <select name="is_display" lay-filter="aihao">
            <option value="1" <?php if(!(empty($menu['is_display']) || (($menu['is_display'] instanceof \think\Collection || $menu['is_display'] instanceof \think\Paginator ) && $menu['is_display']->isEmpty()))): if($menu['is_display'] == '1'): ?> selected=""<?php endif; endif; ?>>显示在左侧菜单</option>
            <option value="2" <?php if(!(empty($menu['is_display']) || (($menu['is_display'] instanceof \think\Collection || $menu['is_display'] instanceof \think\Paginator ) && $menu['is_display']->isEmpty()))): if($menu['is_display'] == '2'): ?> selected=""<?php endif; endif; ?>>只做为操作节点</option>
          </select>
        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">类型</label>
        <div class="layui-input-inline">
          <select name="type" lay-filter="aihao">
            <option value="1" <?php if(!(empty($menu['type']) || (($menu['type'] instanceof \think\Collection || $menu['type'] instanceof \think\Paginator ) && $menu['type']->isEmpty()))): if($menu['type'] == '1'): ?> selected=""<?php endif; endif; ?>>权限节点</option>
            <option value="2" <?php if(!(empty($menu['type']) || (($menu['type'] instanceof \think\Collection || $menu['type'] instanceof \think\Paginator ) && $menu['type']->isEmpty()))): if($menu['type'] == '2'): ?> selected=""<?php endif; endif; ?>>普通节点</option>
          </select>
        </div>
        <div class="layui-form-mid layui-word-aux">注意：如果是菜单+权限节点，那么该菜单将对没有权限的角色隐藏</div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">默认展开</label>
        <div class="layui-input-block">
            <div class="layui-input-inline">
              <input type="checkbox" name="is_open" lay-skin="switch" lay-text="ON|OFF" value="1" <?php if(!(empty($menu['is_open']) || (($menu['is_open'] instanceof \think\Collection || $menu['is_open'] instanceof \think\Paginator ) && $menu['is_open']->isEmpty()))): if($menu['is_open'] == '1'): ?>checked=""<?php endif; endif; ?>>
            </div>
            <div class="layui-form-mid layui-word-aux">仅支持到二级菜单</div>
        </div>
      </div>
      
      <?php if(!(empty($menu) || (($menu instanceof \think\Collection || $menu instanceof \think\Paginator ) && $menu->isEmpty()))): ?>
      <input type="hidden" name="id" value="<?php echo $menu['id']; ?>">
      <?php endif; ?>
      <div class="layui-form-item">
        <div class="layui-input-block">
          <button class="layui-btn" lay-submit lay-filter="admin">立即提交</button>
          <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
      </div>
      
    </form>


    <script src="/static/public/layui/layui.js"></script>
    <script src="/static/public/jquery/jquery.min.js"></script>
    <script>
        var message;
        layui.config({
            base: '/static/admin/js/',
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
        });
    </script>
    <script>
      layui.use(['layer', 'form'], function() {
          var layer = layui.layer,
              $ = layui.jquery,
              form = layui.form;
          $(window).on('load', function() {
              form.on('submit(admin)', function(data) {
                  $.ajax({
                      url:"<?php echo url('admin/menu/publish'); ?>",
                      data:$('#admin').serialize(),
                      type:'post',
                      async: false,
                      success:function(res) {
                          if(res.code == 1) {
                              layer.alert(res.msg, function(index){
                                location.href = res.url;
                              })
                          } else {
                              layer.msg(res.msg);
                          }
                      }
                  })
                  return false;
              });
          });
      });
    </script>
    </div>
</body>
</html>