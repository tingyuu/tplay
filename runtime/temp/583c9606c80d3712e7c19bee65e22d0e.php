<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:67:"E:\phpStudy\WWW\tplay\public/../app/admin\view\webconfig\index.html";i:1517625334;}*/ ?>
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
    <div style="margin-top: 20px;">
    </div>
    <form class="layui-form" id="admin">
      
     
      <div class="layui-form-item">
        <label class="layui-form-label">网站名称</label>
        <div class="layui-input-block" style="max-width: 400px">
          <input name="name" lay-verify="pass" placeholder="请输入" autocomplete="off" class="layui-input" type="text" value="<?php echo $web_config['name']; ?>">
        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">关键词</label>
        <div class="layui-input-block" style="max-width: 600px">
          <input name="keywords" lay-verify="pass" placeholder="请用','隔开" autocomplete="off" class="layui-input" type="text" value="<?php echo $web_config['keywords']; ?>">
        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">描述</label>
        <div class="layui-input-block" style="max-width: 600px">
          <textarea placeholder="请输入内容" class="layui-textarea" name="desc"><?php echo $web_config['desc']; ?></textarea>
        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">开启日志</label>
        <div class="layui-input-block">
          <input name="is_log" lay-skin="switch" lay-filter="switchTest" lay-text="ON|OFF" type="checkbox" <?php if($web_config['is_log'] == 1): ?>checked=""<?php endif; ?> value="1">
        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">上传类型</label>
        <div class="layui-input-inline" style="max-width: 600px">
          <input name="file_type" lay-verify="pass" placeholder="请用','隔开" autocomplete="off" class="layui-input" type="text" value="<?php echo $web_config['file_type']; ?>">
        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">最大上传值</label>
        <div class="layui-input-inline" style="max-width: 600px">
          <input name="file_size" lay-verify="pass" placeholder="单位kb" autocomplete="off" class="layui-input" type="text" value="<?php echo $web_config['file_size']; ?>">
        </div>
        <div class="layui-form-mid layui-word-aux">单位KB</div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">统计代码</label>
        <div class="layui-input-block" style="max-width: 600px">
          <textarea placeholder="请输入完整的统计代码" class="layui-textarea" name="statistics"><?php echo $web_config['statistics']; ?></textarea>
        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">IP黑名单</label>
        <div class="layui-input-block" style="max-width: 600px">
          <textarea placeholder="用','隔开" class="layui-textarea" name="black_ip"><?php echo $web_config['black_ip']; ?></textarea>
        </div>
      </div>

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
                      url:"<?php echo url('admin/webconfig/publish'); ?>",
                      data:$('#admin').serialize(),
                      type:'post',
                      async: false,
                      success:function(res) {
                        layer.msg(res.msg);
                          if(res.code == 1) {
                            setTimeout(function(){
                              location.href = res.url;
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