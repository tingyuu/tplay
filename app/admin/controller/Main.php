<?php
// +----------------------------------------------------------------------
// | Tplay [ WE ONLY DO WHAT IS NECESSARY ]
// +----------------------------------------------------------------------
// | Copyright (c) 2017 http://tplay.pengyichen.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 听雨 < 389625819@qq.com >
// +----------------------------------------------------------------------


namespace app\admin\controller;

use \think\Db;
use \think\Cookie;
class Main extends \think\Controller
{
    public function index()
    {
        //tp版本号
        $info['tp'] = THINK_VERSION;
        //php版本
        $info['php'] = PHP_VERSION;
        //操作系统
        $info['win'] = PHP_OS;
        //最大上传限制
        $info['upload_size'] = ini_get('upload_max_filesize');
        //脚本执行时间限制
        $info['execution_time'] = ini_get('max_execution_time').'S';
        //环境
        $sapi = php_sapi_name();
        if($sapi = 'apache2handler') {
        	$info['environment'] = 'apache';
        } elseif($sapi = 'cgi-fcgi') {
        	$info['environment'] = 'cgi';
        } else {
        	$info['environment'] = 'cli';
        }
        //剩余空间大小
        //$info['disk'] = round(disk_free_space("/")/1024/1024,1).'M';
        $this->assign('info',$info);


        /**
         *网站信息
         */
        $web['user_num'] = Db::name('admin')->count();
        $web['admin_cate'] = Db::name('admin_cate')->count();
        $ip_ban = Db::name('webconfig')->value('black_ip');
        $web['ip_ban'] = empty($ip_ban) ? 0 : count(explode(',',$ip_ban));
        
        $web['article_num'] = Db::name('article')->count();
        $web['status_article'] = Db::name('article')->where('status',0)->count();
        $web['top_article'] = Db::name('article')->where('is_top',1)->count();
        $web['file_num'] = Db::name('attachment')->count();
        $web['status_file'] = Db::name('attachment')->where('status',0)->count();
        $web['ref_file'] = Db::name('attachment')->where('status',-1)->count();
        $web['message_num'] = Db::name('messages')->count();
        $web['look_message'] = Db::name('messages')->where('is_look',0)->count();

        if(Cookie::has('remember')) {
            $web['remember'] = Cookie::get('remember');
            //return $web['remember'];
        } else {
            $web['remember'] = '';
        }

        $this->assign('web',$web);

        return $this->fetch();
    }


    public function remember()
    {
        if($this->request->isPost()) {
            $post = $this->request->post();
            if(Cookie::has('remember')) {
                Cookie::delete('remember');
            }
            Cookie::forever('remember',$post['message']);
            return $this->success('一经记,不轻忘...');
        }
    }


    public function delremember()
    {
        if($this->request->isPost()) {
            if(Cookie::has('remember')) {
                Cookie::delete('remember');
            } else {
                return $this->error('不曾记,何以忘...');
            }
            return $this->success('一经忘,不再想...');
        }
    }
}
