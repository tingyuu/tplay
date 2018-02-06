<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:68:"E:\phpStudy\WWW\tplay\public/../app/admin\view\attachment\index.html";i:1517625807;s:53:"E:\phpStudy\WWW\tplay\app\admin\view\public\foot.html";i:1517625496;}*/ ?>
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
    <div class="layui-tab">
      <ul class="layui-tab-title">
        <li class="layui-this">附件管理</li>
        <li><a href="javascript:;" class="a_menu" id="test">上传压缩文件</a></li>
      </ul>
    </div> 
    <form class="layui-form serch" action="<?php echo url('admin/attachment/index'); ?>" method="post">
        <div class="layui-form-item" style="float: left;">
          <div class="layui-input-inline">
            <input type="text" name="keywords" lay-verify="title" autocomplete="off" placeholder="请输入关键词" class="layui-input layui-btn-sm">
          </div>
          <div class="layui-input-inline">
            <div class="layui-inline">
                <select name="status" lay-search="">
                  <option value="">状态</option>
                  <option value="0">待审核</option>
                  <option value="1">已审核</option>
                  <option value="-1">已拒绝</option>
                </select>
            </div>
          </div>
          <div class="layui-input-inline">
            <div class="layui-inline">
              <div class="layui-input-inline">
                <input type="text" class="layui-input" id="create_time" placeholder="上传时间" name="create_time">
              </div>
            </div>
          </div>
          <button class="layui-btn layui-btn-danger layui-btn-sm" lay-submit="" lay-filter="serch">立即提交</button>
        </div>
      </form>
    <table class="layui-table" lay-size="sm">
      <thead>
        <tr>
          <th>ID</th>
          <th>预览</th>
          <th>模块</th>
          <th>用途</th>
          <th>路径+名称</th>
          <th>大小</th>
          <th>格式</th>
          <th>上传id</th>
          <th>上传IP</th>
          <th>上传时间</th>
          <th>状态</th>
          <th>审核者</th>
          <th>审核时间</th>
          <th>已下载</th>
          <th>操作</th>
        </tr> 
      </thead>
      <tbody>
        <?php if(is_array($attachment) || $attachment instanceof \think\Collection || $attachment instanceof \think\Paginator): $i = 0; $__LIST__ = $attachment;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <tr>
          <td><?php echo $vo['id']; ?></td>
          <td><?php if($vo['fileext'] == 'zip'): ?><i class="fa fa-file"></i><?php else: ?><a href="<?php echo $vo['filepath']; ?>" class="tooltip"><img src="<?php echo $vo['filepath']; ?>" width="20" height="20"></a><?php endif; ?></td>
          <td><?php echo $vo['module']; ?></td>
          <td><?php echo $vo['use']; ?></td>
          <td><?php echo $vo['filepath']; ?></td>
          <td><?php echo round($vo['filesize']/1024,2); ?>KB</td>
          <td><?php echo $vo['fileext']; ?></td>
          <td><?php echo $vo['user_id']; ?></td>
          <td><?php echo $vo['uploadip']; ?></td>
          <td><?php echo $vo['create_time']; ?></td>
          <td><?php if($vo['status'] == 0): ?><span class="layui-badge layui-bg-orange">待审核</span><?php elseif($vo['status'] == 1): ?><span class="layui-badge">已审核</span><?php else: ?><span class="layui-badge layui-bg-gray">已拒绝</span><?php endif; ?></td>
          <td><?php echo $vo['admin']['nickname']; ?></td>
          <td><?php echo date("Y-m-d",$vo['audit_time']); ?></td>
          <td><?php echo $vo['download']; ?></td>
          <td class="operation-menu">
            <div class="layui-btn-group">
              <a class="layui-btn layui-btn-xs open layui-btn-primary" data-id="<?php echo $vo['id']; ?>" style="margin-right: 0;font-size:12px;"><i class="fa <?php if($vo['status'] == 1): ?>fa-toggle-on<?php else: ?>fa-toggle-off<?php endif; ?>"></i></a>
              <a class="layui-btn layui-btn-xs download layui-btn-primary" data-id="<?php echo $vo['id']; ?>" id="download<?php echo $vo['id']; ?>" style="margin-right: 0;font-size:12px;"><i class="fa fa-download"></i></a>
              <button class="layui-btn layui-btn-xs layui-btn-primary delete" id="<?php echo $vo['id']; ?>" style="margin-right: 0;font-size:12px;"><i class="layui-icon"></i></button>
            </div>
          </td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
      </tbody>
    </table>
    <div style="padding:0 20px;"><?php echo $attachment->render(); ?></div>
            
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


    $('.download').on('click',function(event){
        var data_id = $(this).attr('data-id');
        var id = $(this).attr('id');
        var download = document.getElementById(id);
        $.ajax({
          url:"<?php echo url('admin/attachment/download'); ?>",
          data:{id:data_id},
          async:false,
          success:function(res) {
            console.log('res:'+res.code);
            if(res.code == 1) {
              download.setAttribute('href',res.data);
              download.setAttribute('download',res.name);
              // download.click();
              i++;
            } else {
              layer.msg(res.msg);
            }
          }
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
    layui.use('upload', function(){
      var $ = layui.jquery
      ,upload = layui.upload;
      
      //指定允许上传的文件类型
      upload.render({
        elem: '#test'
        ,url: "<?php echo url('admin/attachment/upload'); ?>"
        ,accept: 'file' //普通文件
        ,exts: 'zip|rar|7z' //只允许上传压缩文件
        ,done: function(res){
          layer.msg(res.msg);
          if(res.code == 1) {
            setTimeout(function(){
              location.href = res.url;
            },1500)
          }
        }
      }); 
    });
    </script>
  </div>
</body>
</html>
