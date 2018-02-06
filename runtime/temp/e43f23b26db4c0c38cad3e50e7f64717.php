<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:71:"E:\phpStudy\WWW\tplay\public/../app/admin\view\articlecate\publish.html";i:1517623883;}*/ ?>
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
        <li><a href="<?php echo url('admin/articlecate/index'); ?>" class="a_menu">分类管理</a></li>
        <li class="layui-this">新增分类</li>
      </ul>
    </div>
    <div style="margin-top: 20px;">
    </div>
    <form class="layui-form" id="admin">
      
      <div class="layui-form-item">
        <label class="layui-form-label">上级分类</label>
        <div class="layui-input-inline">
          <select name="pid" lay-filter="aihao">
            <option value="0">作为顶级分类</option>
            <?php if(is_array($cates) || $cates instanceof \think\Collection || $cates instanceof \think\Paginator): $i = 0; $__LIST__ = $cates;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <option value="<?php echo $vo['id']; ?>" <?php if(!(empty($cate['pid']) || (($cate['pid'] instanceof \think\Collection || $cate['pid'] instanceof \think\Paginator ) && $cate['pid']->isEmpty()))): if($cate['pid'] == $vo['id']): ?> selected=""<?php endif; else: if(!(empty($pid) || (($pid instanceof \think\Collection || $pid instanceof \think\Paginator ) && $pid->isEmpty()))): if($pid == $vo['id']): ?> selected=""<?php endif; endif; endif; ?>><?php echo $vo['str']; ?><?php echo $vo['name']; ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
          </select>
        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">名称</label>
        <div class="layui-input-inline">
          <input name="name" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input" type="text" <?php if(!(empty($cate['name']) || (($cate['name'] instanceof \think\Collection || $cate['name'] instanceof \think\Paginator ) && $cate['name']->isEmpty()))): ?>value="<?php echo $cate['name']; ?>"<?php endif; ?>>
        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">标签</label>
        <div class="layui-input-block" style="max-width:500px;">
          <input name="tag" autocomplete="off" placeholder="标签之间用,隔开" class="layui-input" type="text" <?php if(!(empty($cate['tag']) || (($cate['tag'] instanceof \think\Collection || $cate['tag'] instanceof \think\Paginator ) && $cate['tag']->isEmpty()))): ?>value="<?php echo $cate['tag']; ?>"<?php endif; ?>>
        </div>
      </div>

      <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">备注</label>
        <div class="layui-input-block" style="max-width:500px;">
          <textarea placeholder="请输入内容" class="layui-textarea" name="description"><?php if(!(empty($cate['description']) || (($cate['description'] instanceof \think\Collection || $cate['description'] instanceof \think\Paginator ) && $cate['description']->isEmpty()))): ?><?php echo $cate['description']; endif; ?></textarea>
        </div>
      </div>
      
      <?php if(!(empty($cate) || (($cate instanceof \think\Collection || $cate instanceof \think\Paginator ) && $cate->isEmpty()))): ?>
      <input type="hidden" name="id" value="<?php echo $cate['id']; ?>">
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
                      url:"<?php echo url('admin/articlecate/publish'); ?>",
                      data:$('#admin').serialize(),
                      type:'post',
                      async: false,
                      success:function(res) {
                          layer.msg(res.msg);
                          if(res.code == 1) {
                              setTimeout(function(){
                                var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                                parent.layer.close(index); //再执行关闭
                              },1500) 
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