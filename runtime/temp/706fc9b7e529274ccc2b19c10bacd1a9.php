<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:68:"E:\phpStudy\WWW\tplay\public/../app/admin\view\tomessages\index.html";i:1517626424;s:53:"E:\phpStudy\WWW\tplay\app\admin\view\public\foot.html";i:1517625496;}*/ ?>
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
<body style="padding:10px;">
  <div class="tplay-body-div">
    <fieldset class="layui-elem-field site-demo-button" style="margin-top: 30px;border:0">
      <form class="layui-form serch" action="<?php echo url('admin/tomessages/index'); ?>" method="post">
        <div class="layui-form-item" style="float: left;">
          <div class="layui-input-inline">
            <input type="text" name="keywords" lay-verify="title" autocomplete="off" placeholder="请输入关键词" class="layui-input layui-btn-sm">
          </div>
          <div class="layui-input-inline">
            <div class="layui-inline">
                <select name="is_look" lay-search="">
                  <option value="">状态</option>
                  <option value="0">待处理</option>
                  <option value="1">已处理</option>
                </select>
            </div>
          </div>
          <div class="layui-input-inline">
            <div class="layui-inline">
              <div class="layui-input-inline">
                <input type="text" class="layui-input" id="create_time" placeholder="留言时间" name="create_time">
              </div>
            </div>
          </div>
          <button class="layui-btn layui-btn-danger layui-btn-sm" lay-submit="" lay-filter="serch">立即提交</button>
        </div>
      </form> 
      
    </fieldset>
    <table class="layui-table" lay-size="sm">
      <colgroup>
        <col width="50">
        <col width="100">
        <col width="100">
        <col width="600">
        <col width="150">
        <col width="100">
      </colgroup>
      <thead>
        <tr>
          <th>编号</th>
          <th>留言时间</th>
          <th>留言IP</th>
          <th>留言内容</th>
          <th>状态</th>
          <th>操作</th>
        </tr> 
      </thead>
      <tbody>
        <?php if(is_array($message) || $message instanceof \think\Collection || $message instanceof \think\Paginator): $i = 0; $__LIST__ = $message;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <tr>
          <td><?php echo $vo['id']; ?></td>
          <td><?php echo $vo['create_time']; ?></td>
          <td><?php echo $vo['ip']; ?></td>
          <td><?php echo $vo['message']; ?></td>
          <td><?php if($vo['is_look'] == 1): ?><span class="layui-badge">管理员已阅</span><?php else: ?><span class="layui-badge layui-bg-orange">管理员待阅</span><?php endif; ?></td>
          <td class="operation-menu">
            <div class="layui-btn-group">
              <a href="javascript:;" class="layui-btn layui-btn-xs look layui-btn-primary" data-id="<?php echo $vo['id']; ?>" style="margin-right: 0;font-size:12px;"><i class="fa <?php if($vo['is_look'] == 1): ?>fa-toggle-on<?php else: ?>fa-toggle-off<?php endif; ?>"></i></a>
              <a href="javascript:;" class="layui-btn layui-btn-xs layui-btn-primary delete" id="<?php echo $vo['id']; ?>" style="margin-right: 0;font-size:12px;"><i class="layui-icon"></i></a>
            </div>
          </td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
      </tbody>
    </table>
        <?php echo $message->render(); ?>
            
        <script src="/static/public/layui/layui.js" charset="utf-8"></script>
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
    <script type="text/javascript">
    $(function(){
      var x = 10;
      var y = 20;
      $(".tooltip").mouseover(function(e){ 
        var tooltip = "<div id='tooltip'><img src='"+ this.href +"' alt='产品预览图' height='200'/>"+"<\/div>"; //创建 div 元素
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
    </script>
    <script type="text/javascript">
    $('.a_menu').click(function(){
      var url = $(this).attr('href');
      var id = $(this).attr('id');
      var a = true;
      if(id) {
        $.ajax({
          url:url
          ,async:false
          ,data:{id:id}
          ,success:function(res){
            if(res.code == 0) {
              layer.msg(res.msg);
              a = false;
            }
          }
        })
      } else {
        $.ajax({
          url:url
          ,async:false
          ,success:function(res){
            if(res.code == 0) {
              layer.msg(res.msg);
              a = false;
            }
          }
        })
      }
      return a;
    })
    </script>
    <script>
    layui.use('laydate', function(){
      var laydate = layui.laydate;
      
      //常规用法
      laydate.render({
        elem: '#create_time'
      });
    });
    </script> 
    <script type="text/javascript">

    $('.delete').click(function(){
      var id = $(this).attr('id');
      layer.confirm('确定要删除?', function(index) {
        $.ajax({
          url:"<?php echo url('admin/tomessages/delete'); ?>",
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
        $('.look').click(function(){
          var id = $(this).attr('data-id');
          layer.msg('留言标记',{
            time:20000
            ,btn: ['标记已读', '标记未读', '再想想']
            ,yes: function(index, layero){
              $.ajax({
                url:"<?php echo url('admin/tomessages/mark'); ?>"
                ,type:'post'
                ,data:{id:id,is_look:'1'}
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
                url:"<?php echo url('admin/tomessages/mark'); ?>"
                ,type:'post'
                ,data:{id:id,is_look:'0'}
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
  </div>
</body>
</html>
