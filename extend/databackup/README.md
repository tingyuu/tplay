

### 使用composer进行安装
~~~
     composer require tp5er/tp5-databackup dev-master
~~~

### 使用composer update进行安装
~~~
    "require": {
        "tp5er/tp5-databackup": "dev-master"
    },
~~~

### 引入类文件
~~~
use \tp5er\Backup;
~~~

### 配置文件
~~~
$config=array(
    'path'     => './Data/',//数据库备份路径
    'part'     => 20971520,//数据库备份卷大小
    'compress' => 0,//数据库备份文件是否启用压缩 0不压缩 1 压缩
    'level'    => 9 //数据库备份文件压缩级别 1普通 4 一般  9最高
);
~~~

### 实例化
~~~
 $db= new Backup($config);
~~~

### 文件命名规则，请严格遵守（温馨提示）
~~~
$file=['name'=>date('Ymd-His'),'part'=>1]
~~~

### 数据类表列表
~~~
return $this->fetch('index',['list'=>$db->dataList()]);
~~~
### 备份文件列表
~~~
  return $this->fetch('importlist',['list'=>$db->fileList()]);
~~~

### 备份表
~~~
 $tables="数据库表1";
 $start= $db->setFile($file)->backup($tables[$id], 0);
 当$start返回0的时候就表示备份成功
~~~

### 导入表
~~~
 $start=0;
 $start= $db->setFile($file)->import($start);
~~~

### 删除备份文件
~~~
    $db->delFile($time);
~~~

### 修复表
~~~
    $db->repair($tables)
~~~

### 优化表
~~~
    $db->optimize($tables)
~~~

# 技术交流与bug提交QQ群：368683534!!!!
