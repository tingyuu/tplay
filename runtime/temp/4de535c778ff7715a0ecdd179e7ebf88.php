<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:70:"E:\phpStudy\WWW\tplay\public/../app/admin\view\urlsconfig\publish.html";i:1513993331;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>layui</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="__PUBLIC__/layui/css/layui.css"  media="all">
  <link rel="stylesheet" href="__PUBLIC__/font-awesome/css/font-awesome.min.css" media="all" />
  <!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
</head>
<body>
<div style="margin-top: 20px;">
</div>
<form class="layui-form" id="admin">

  <div class="layui-form-item">
    <label class="layui-form-label">美化前url</label>
    <div class="layui-input-inline">
      <input name="url" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input" type="text" <?php if(!(empty($urlconfig['url']) || (($urlconfig['url'] instanceof \think\Collection || $urlconfig['url'] instanceof \think\Paginator ) && $urlconfig['url']->isEmpty()))): ?>value="<?php echo $urlconfig['url']; ?>"<?php endif; ?>>
    </div>
    <div class="layui-form-mid layui-word-aux">例：admin/common/login</div>
  </div>

  <div class="layui-form-item">
    <label class="layui-form-label">美化后url</label>
    <div class="layui-input-inline">
      <input name="aliases" autocomplete="off" placeholder="请输入" class="layui-input" type="text" <?php if(!(empty($urlconfig['aliases']) || (($urlconfig['aliases'] instanceof \think\Collection || $urlconfig['aliases'] instanceof \think\Paginator ) && $urlconfig['aliases']->isEmpty()))): ?>value="<?php echo $urlconfig['aliases']; ?>"<?php endif; ?>>
    </div>
    <div class="layui-form-mid layui-word-aux">例：login(如有参数：login/:id)</div>
  </div>

  <div class="layui-form-item layui-form-text">
    <label class="layui-form-label">备注</label>
    <div class="layui-input-block" style="max-width:400px;">
      <textarea placeholder="请输入内容" class="layui-textarea" name="desc"><?php if(!(empty($urlconfig['desc']) || (($urlconfig['desc'] instanceof \think\Collection || $urlconfig['desc'] instanceof \think\Paginator ) && $urlconfig['desc']->isEmpty()))): ?><?php echo $urlconfig['desc']; endif; ?></textarea>
    </div>
  </div>
  
  <?php if(!(empty($urlconfig) || (($urlconfig instanceof \think\Collection || $urlconfig instanceof \think\Paginator ) && $urlconfig->isEmpty()))): ?>
  <input type="hidden" name="id" value="<?php echo $urlconfig['id']; ?>">
  <?php endif; ?>
  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit lay-filter="admin">立即提交</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
  </div>
  
</form>


<script src="__PUBLIC__/layui/layui.js"></script>
<script src="__PUBLIC__/jquery/jquery.min.js"></script>
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
                  url:"<?php echo url('admin/urlsconfig/publish'); ?>",
                  data:$('#admin').serialize(),
                  type:'post',
                  async: false,
                  success:function(res) {
                      layer.msg(res.msg);
                  }
              })
              return false;
          });
      });
  });
</script>
</body>
</html>