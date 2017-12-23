<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:68:"E:\phpStudy\WWW\tplay\public/../app/admin\view\urlsconfig\index.html";i:1513993331;}*/ ?>
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
  <link rel="stylesheet" href="__CSS__/admin.css"  media="all">
  <!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
  <style type="text/css">

/* tooltip */
#tooltip{
  position:absolute;
  border:1px solid #ccc;
  background:#333;
  padding:2px;
  display:none;
  color:#fff;
}
</style>
</head>
<body>
<fieldset class="layui-elem-field site-demo-button" style="margin-top: 30px;border:0"> 
<div class="layui-btn-group demoTable">
    <a href="<?php echo url('admin/urlsconfig/publish'); ?>" class="layui-btn layui-btn-sm a_menu">新增美化</a>
</div>
</fieldset>
<table class="layui-table" lay-even="" lay-skin="row" lay-size="sm">
  <colgroup>
    <col width="50">
    <col width="150">
    <col width="100">
    <col width="350">
    <col width="150">
    <col width="100">
    <col width="100">
  </colgroup>
  <thead>
    <tr>
      <th>编号</th>
      <th>美化前</th>
      <th>美化后</th>
      <th>备注</th>
      <th>创建时间</th>
      <th>状态</th>
      <th>操作</th>
    </tr> 
  </thead>
  <tbody>
    <?php if(is_array($urlconfig) || $urlconfig instanceof \think\Collection || $urlconfig instanceof \think\Paginator): $i = 0; $__LIST__ = $urlconfig;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <tr>
      <td><?php echo $vo['id']; ?></td>
      <td><?php echo $vo['url']; ?></td>
      <td><?php echo $vo['aliases']; ?></td>
      <td><?php echo $vo['desc']; ?></td>
      <td><?php echo $vo['create_time']; ?></td>
      <td><?php if($vo['status'] == 1): ?><span class="layui-badge">启用</span><?php else: ?><span class="layui-badge layui-bg-gray">禁用</span><?php endif; ?></td>
      <td class="operation-menu">
        <a class="layui-btn layui-btn-xs a_menu" href="<?php echo url('admin/urlsconfig/publish',['id'=>$vo['id']]); ?>" style="margin-right: 0;font-size:12px;">修改</a>
        <a class="layui-btn layui-btn-xs layui-btn-danger status" <?php if($vo['status'] == 1): ?>data-id="0"<?php else: ?>data-id="1"<?php endif; ?> id="<?php echo $vo['id']; ?>" style="margin-right: 0;font-size:12px;" ><?php if($vo['status'] == 1): ?>禁用<?php else: ?>启用<?php endif; ?></a>
        <a class="layui-btn layui-btn-xs delete" id="<?php echo $vo['id']; ?>" style="margin-right: 0;font-size:12px;">删除</a>
      </td>
    </tr>
    <?php endforeach; endif; else: echo "" ;endif; ?>
  </tbody>
</table>
<div style="padding:0 20px;"><?php echo $urlconfig->render(); ?></div>
        
<script src="__PUBLIC__/layui/layui.js" charset="utf-8"></script>
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
<script type="text/javascript">

$('.delete').click(function(){
  var id = $(this).attr('id');
  layer.confirm('确定要删除?', function(index) {
    $.ajax({
      url:"<?php echo url('admin/urlsconfig/delete'); ?>",
      data:{id:id},
      success:function(res) {
        layer.msg(res.msg);
        if(res.code == 1) {
          setTimeout(function(){
            location.href = res.url;
          },1500)
        }
      }
    })
  })
})

</script>

<script type="text/javascript">
layui.use('layer', function(){
  var layer = layui.layer;
  $('.a_menu').click(function(){
    var url = $(this).attr('href');
    var a = 0;
    $.ajax({
      url:url
      ,async:false
      ,success:function(res){
        if(res.code == 0) {
          layer.msg(res.msg);
          a = 1;
        }
      }
    })
    if(a === 0) {
      layer.open({
        type:2,
        content:[url, 'no'],
        area: ['600px', '400px'],
      });
    }
    return false;
  })
  

  $('.status').click(function(){
    var id = $(this).attr('id');
    var status = $(this).attr('data-id');
    layer.confirm('确定要设置?', function(index) {
      $.ajax({
        url:"<?php echo url('admin/urlsconfig/status'); ?>",
        type:'post',
        data:{id:id,status:status},
        success:function(res) {
          layer.msg(res.msg);
          if(res.code == 1) {
            setTimeout(function(){
              location.href = res.url;
            },1500)
          }
        }
      })
    })
  }) 

}); 
</script>
</body>
</html>
