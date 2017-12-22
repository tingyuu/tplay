<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"E:\phpStudy\WWW\tplay\public/../application/admin\view\admin\log.html";i:1513412098;}*/ ?>
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

<table class="layui-table" lay-even="" lay-skin="row" lay-size="sm" style="margin-top: 20px;">
  <!-- <colgroup>
    <col width="50">
    <col width="80">
    <col width="100">
    <col width="150">
    <col width="150">
    <col width="200">
    <col width="200">
    <col width="200">
    <col width="100">
  </colgroup> -->
  <thead>
    <tr>
      <th>编号</th>
      <th>操作</th>
      <th>路径</th>
      <th>节点备注</th>
      <th>返回对象</th>
      <th>操作者</th>
      <th>记录时间</th>
      <th>记录IP</th>
    </tr> 
  </thead>
  <tbody>
    <?php if(is_array($log) || $log instanceof \think\Collection || $log instanceof \think\Paginator): $i = 0; $__LIST__ = $log;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <tr>
      <td><?php echo $vo['id']; ?></td>
      <td><?php if(empty($vo['name']) || (($vo['name'] instanceof \think\Collection || $vo['name'] instanceof \think\Paginator ) && $vo['name']->isEmpty())): ?><?php echo $vo['menu']['name']; else: ?><?php echo $vo['name']; endif; ?></td>
      <td><?php echo $vo['menu']['module']; ?>/<?php echo $vo['menu']['controller']; ?>/<?php echo $vo['menu']['function']; if(!(empty($vo['menu']['parameter']) || (($vo['menu']['parameter'] instanceof \think\Collection || $vo['menu']['parameter'] instanceof \think\Paginator ) && $vo['menu']['parameter']->isEmpty()))): ?>/<?php echo $vo['menu']['parameter']; endif; ?></td>
      <td><?php if(!(empty($vo['menu']['description']) || (($vo['menu']['description'] instanceof \think\Collection || $vo['menu']['description'] instanceof \think\Paginator ) && $vo['menu']['description']->isEmpty()))): ?><?php echo $vo['menu']['description']; endif; ?></td>
      <td><?php if(!(empty($vo['operation_id']) || (($vo['operation_id'] instanceof \think\Collection || $vo['operation_id'] instanceof \think\Paginator ) && $vo['operation_id']->isEmpty()))): ?><?php echo $vo['operation_id']; else: ?>无<?php endif; ?></td>
      <td><?php echo $vo['admin']['nickname']; ?> <<?php if(is_array($admin_cate) || $admin_cate instanceof \think\Collection || $admin_cate instanceof \think\Paginator): $i = 0; $__LIST__ = $admin_cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;if($vo['admin']['admin_cate_id'] == $cate['id']): ?><?php echo $cate['name']; endif; endforeach; endif; else: echo "" ;endif; ?>></td>
      <td><?php echo $vo['create_time']; ?></td>
      <td><?php echo $vo['ip']; ?></td>
    </tr>
    <?php endforeach; endif; else: echo "" ;endif; ?>
  </tbody>
</table>
<div style="padding:0 20px;"><?php echo $log->render(); ?></div>
        
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
$(function(){
  var x = 10;
  var y = 20;
  $(".tooltip").mouseover(function(e){ 
    var tooltip = "<div id='tooltip'><img src='"+ this.href +"' alt='预览图' height='200'/>"+"<\/div>"; //创建 div 元素
    $("body").append(tooltip);  //把它追加到文档中             
    $("#tooltip")
      .css({
        "top": (e.pageY+y) + "px",
        "left":  (e.pageX+x)  + "px"
      }).show("fast");    //设置x坐标和y坐标，并且显示
    }).mouseout(function(){  
    $("#tooltip").remove();  //移除 
    }).mousemove(function(e){
    $("#tooltip")
      .css({
        "top": (e.pageY+y) + "px",
        "left":  (e.pageX+x)  + "px"
      });
  });
})

$('.delete').click(function(){
  var id = $(this).attr('id');
  layer.confirm('确定要删除?', function(index) {
    $.ajax({
      url:"<?php echo url('admin/attachment/delete'); ?>",
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
    $('.open').click(function(){
      var id = $(this).attr('data-id');
      layer.msg('文件审核',{
        time:20000
        ,btn: ['仁慈通过', '残忍拒绝', '再想想']
        ,yes: function(index, layero){
          $.ajax({
            url:"<?php echo url('admin/attachment/audit'); ?>"
            ,type:'post'
            ,data:{id:id,status:'1'}
            ,success:function(res){
              layer.msg(res.msg);
              if(res.code == 1){
                setTimeout(function(){
                  location.href = res.url;
                },1500)
              }
            }
          })
        }
        ,btn2: function(index, layero){
          $.ajax({
            url:"<?php echo url('admin/attachment/audit'); ?>"
            ,type:'post'
            ,data:{id:id,status:'-1'}
            ,success:function(res){
              layer.msg(res.msg);
              if(res.code == 1){
                setTimeout(function(){
                  location.href = res.url;
                },1500)
              }
            }
          })
        }
      })
    })
  });              
</script>
</body>
</html>
