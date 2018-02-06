<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;
use \app\admin\controller\Permissions;
use \databackup\src\Backup;
class Databackup extends Permissions
{
    public function index()
    {
      $db= new Backup();
      return $this->fetch('index',['list'=>$db->dataList()]);
    }
   //备份文件列表
   public function importlist()
   {
        $db= new Backup();
       return $this->fetch('importlist',['list'=>$db->fileList()]);
   }
   public function import($time = 0, $part = null, $start = null)
   {
       $db= new Backup();
       if(is_numeric($time) && is_null($part) && is_null($start)){
           $list  = $db->getFile('timeverif',$time);
           if(is_array($list)){
               session::set('backup_list', $list);
               $this->success('初始化完成！', '', array('part' => 1, 'start' => 0));
           }else{
               $this->error('备份文件可能已经损坏，请检查！');
           }
       }else if(is_numeric($part) && is_numeric($start)){

               $list=session::get('backup_list');
               
               $start= $db->setFile($list)->import($start);
              
               if( false===$start){
                     $this->error('还原数据出错！');
               }elseif(0 === $start){
                   if(isset($list[++$part])){
                       $data = array('part' => $part, 'start' => 0);
                       $this->success("正在还原...#{$part}", '', $data);
                   } else {
                       session::delete('backup_list');
                       addlog();//写入日志
                       $this->success('还原完成！');
                   }
               }else{
                   $data = array('part' => $part, 'start' => $start[0]);
                   if($start[1]){
                       $rate = floor(100 * ($start[0] / $start[1]));
                       $this->success("正在还原...#{$part} ({$rate}%)", '', $data);
                   } else {
                       $data['gz'] = 1;
                       $this->success("正在还原...#{$part}", '', $data);
                   }
                   $this->success("正在还原...#{$part}", '');
                   
               }
           
           
       }else{
           $this->error('参数错误！');
       }

      
   }
   /**
    * 删除备份文件
    */
   public function del($time = 0){
       $db= new Backup();
       if($db->delFile($time)){
           addlog($time);//写入日志
           $this->success("备份文件删除成功！",'admin/databackup/importlist');
       }else{
           $this->error("备份文件删除失败，请检查权限！");
       }
   }


   //备份表
   public function export()
   {
       $db= new Backup();
       if(Request::instance()->isPost()){
           $input=input('post.');
          
           $fileinfo  =$db->getFile();
           //检查是否有正在执行的任务
           $lock = "{$fileinfo['filepath']}backup.lock";
           if(is_file($lock)){
               $this->error('检测到有一个备份任务正在执行，请稍后再试！');
           } else {
               //创建锁文件
               file_put_contents($lock,time());
           }
           // 检查备份目录是否可写
           is_writeable($fileinfo['filepath']) || $this->error('备份目录不存在或不可写，请检查后重试！');

           //缓存锁文件
           session::set('lock', $lock);
           //缓存备份文件信息
           session::set('backup_file', $fileinfo['file']);
           //缓存要备份的表
           session::set('backup_tables', $input['tables']);
           //创建备份文件
           if(false !== $db->Backup_Init()){
               $this->success('初始化成功！','',['tab'=>['id' => 0, 'start' => 0]]);
           }else{
               $this->error('初始化失败，备份文件创建失败！');
           }
       }else if(Request::instance()->isGet()){
           $tables =  session::get('backup_tables');
           $file=session::get('backup_file');

           $id=input('id');
           $start=input('start');
           $start= $db->setFile($file)->backup($tables[$id], $start);
           if(false === $start){
               $this->error('备份出错！');
           }else if(0 === $start){
               if(isset($tables[++$id])){
                   $tab = array('id' => $id, 'start' => 0);
                   addlog();//写入日志
                   $this->success('备份完成！', '', array('tab' => $tab));
               } else { //备份完成，清空缓存
                   unlink(session::get('lock'));
                   Session::delete('backup_tables');
                   Session::delete('backup_file');
                   addlog();//写入日志
                   $this->success('备份完成！');
               }
           }
       }else{
           $this->error('参数错误！');
       }


   }

   //修复表
   public function repair($tables= null)
   {
       $db= new Backup();
       if($db->repair($tables)){
           return $this->success("数据表修复完成！");
       }else{
           return $this->error("数据表修复出错请重试");
       }
   }
   //优化表
   public function optimize($tables= null)
   {
        $db= new Backup();
         if($db->optimize($tables)){
           return $this->success("数据表优化完成！");
         }else{
           return $this->error("数据表优化出错请重试！");
         }
   }
}