<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:61:"E:\phpStudy\WWW\tplay\public/../app/admin\view\admin\log.html";i:1517623535;}*/ ?>
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
      <form class="layui-form serch" action="<?php echo url('admin/admin/log'); ?>" method="post">
        <div class="layui-form-item" style="float: left;">
          <div class="layui-input-inline">
            <div class="layui-inline">
                <select name="admin_menu_id" lay-search="">
                  <option value="">操作</option>
                  <?php if(is_array($info['menu']) || $info['menu'] instanceof \think\Collection || $info['menu'] instanceof \think\Paginator): $i = 0; $__LIST__ = $info['menu'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                  <option value="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></option>
                  <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
          </div>
          <div class="layui-input-inline">
            <div class="layui-inline">
                <select name="admin_id" lay-search="">
                  <option value="">操作人</option>
                  <?php if(is_array($info['admin']) || $info['admin'] instanceof \think\Collection || $info['admin'] instanceof \think\Paginator): $i = 0; $__LIST__ = $info['admin'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                  <option value="<?php echo $vo['id']; ?>"><?php echo $vo['nickname']; ?></option>
                  <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
          </div>
          <div class="layui-input-inline">
            <div class="layui-inline">
              <div class="layui-input-inline">
                <input type="text" class="layui-input" id="create_time" placeholder="操作时间" name="create_time">
              </div>
            </div>
          </div>
          <button class="layui-btn layui-btn-danger layui-btn-sm" lay-submit="" lay-filter="serch">立即提交</button>
        </div>
      </form> 
      
    </fieldset>
    <table class="layui-table" lay-size="sm">
      <thead>
        <tr>
          <th>ID</th>
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
    <script>
    layui.use('laydate', function(){
      var laydate = layui.laydate;
      
      //常规用法
      laydate.render({
        elem: '#create_time'
      });
    });
    </script>
</div>
</body>
</html>
