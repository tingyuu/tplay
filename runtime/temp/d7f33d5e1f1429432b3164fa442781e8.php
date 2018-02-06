<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:65:"E:\phpStudy\WWW\tplay\public/../app/admin\view\admin\preview.html";i:1517620309;}*/ ?>
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
</head>
<body>
<div style="margin-top: 20px;">
</div>

<div class="layui-form-item">
  <div class="layui-collapse" lay-accordion="" style="width:500px;margin-left:20px;">
    <?php if(is_array($info['menu']) || $info['menu'] instanceof \think\Collection || $info['menu'] instanceof \think\Paginator): $i = 0; $__LIST__ = $info['menu'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;if(!(empty($data['list']) || (($data['list'] instanceof \think\Collection || $data['list'] instanceof \think\Paginator ) && $data['list']->isEmpty()))): ?>
    <div class="layui-colla-item" style="">
      <h2 class="layui-colla-title" style="background:0;"><?php echo $data['name']; ?></h2>
      <div class="layui-colla-content">
        <table>
          <tbody>
            <?php if($data['type'] == '1'): ?>
            <tr>
              <td>
                <?php echo $data['str']; ?><input type="checkbox" lay-ignore lay-skin="primary" name="admin_menu_id[]" value="<?php echo $data['id']; ?>" <?php if(!(empty($info['cate']['permissions']) || (($info['cate']['permissions'] instanceof \think\Collection || $info['cate']['permissions'] instanceof \think\Paginator ) && $info['cate']['permissions']->isEmpty()))): if(is_array($info['cate']['permissions']) || $info['cate']['permissions'] instanceof \think\Collection || $info['cate']['permissions'] instanceof \think\Paginator): $i = 0; $__LIST__ = $info['cate']['permissions'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$datas): $mod = ($i % 2 );++$i;if($datas == $data['id']): ?>checked<?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>><?php echo $data['name']; ?>
              </td>
            </tr>
            <?php endif; if(is_array($data['list']) || $data['list'] instanceof \think\Collection || $data['list'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr>
              <?php if($vo['is_display'] == '1'): ?> 
              <td>
                <?php echo $vo['str']; ?><input type="checkbox" lay-ignore lay-skin="primary" name="admin_menu_id[]" value="<?php echo $vo['id']; ?>" <?php if(!(empty($info['cate']['permissions']) || (($info['cate']['permissions'] instanceof \think\Collection || $info['cate']['permissions'] instanceof \think\Paginator ) && $info['cate']['permissions']->isEmpty()))): if(is_array($info['cate']['permissions']) || $info['cate']['permissions'] instanceof \think\Collection || $info['cate']['permissions'] instanceof \think\Paginator): $i = 0; $__LIST__ = $info['cate']['permissions'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$datas): $mod = ($i % 2 );++$i;if($datas == $vo['id']): ?>checked <?php else: if($vo['type'] == '2'): ?>checked disabled<?php endif; endif; endforeach; endif; else: echo "" ;endif; else: if($vo['type'] == '2'): ?>checked disabled<?php endif; endif; ?>><?php echo $vo['name']; ?>
              </td>
              <?php else: if($vo['type'] == '1'): ?> 
              <td>
                <?php echo $vo['str']; ?><input type="checkbox" lay-ignore lay-skin="primary" name="admin_menu_id[]" value="<?php echo $vo['id']; ?>" <?php if(!(empty($info['cate']['permissions']) || (($info['cate']['permissions'] instanceof \think\Collection || $info['cate']['permissions'] instanceof \think\Paginator ) && $info['cate']['permissions']->isEmpty()))): if(is_array($info['cate']['permissions']) || $info['cate']['permissions'] instanceof \think\Collection || $info['cate']['permissions'] instanceof \think\Paginator): $i = 0; $__LIST__ = $info['cate']['permissions'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$datas): $mod = ($i % 2 );++$i;if($datas == $vo['id']): ?>checked <?php else: if($vo['type'] == '2'): ?>checked disabled<?php endif; endif; endforeach; endif; else: echo "" ;endif; else: if($vo['type'] == '2'): ?>checked disabled<?php endif; endif; ?>><?php echo $vo['name']; ?>
              </td>
              <?php endif; endif; ?>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
          </tbody>
        </table>
      </div>
    </div>
    <?php else: if($data['type'] == '1'): ?>
    <div class="layui-colla-item" style="border:0;">
      <h2 class="layui-colla-title" style="background:0;"><?php echo $data['name']; ?></h2>
      <div class="layui-colla-content">
        <table>
          <tbody>
            <tr>
              <td>
                <?php echo $data['str']; ?><input type="checkbox" lay-ignore lay-skin="primary" name="admin_menu_id[]" value="<?php echo $data['id']; ?>" <?php if(!(empty($info['cate']['permissions']) || (($info['cate']['permissions'] instanceof \think\Collection || $info['cate']['permissions'] instanceof \think\Paginator ) && $info['cate']['permissions']->isEmpty()))): if(is_array($info['cate']['permissions']) || $info['cate']['permissions'] instanceof \think\Collection || $info['cate']['permissions'] instanceof \think\Paginator): $i = 0; $__LIST__ = $info['cate']['permissions'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$datas): $mod = ($i % 2 );++$i;if($datas == $data['id']): ?>checked<?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>><?php echo $data['name']; ?>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <?php endif; endif; endforeach; endif; else: echo "" ;endif; ?>
  </div>
</div>


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
</body>
</html>