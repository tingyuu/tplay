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
use \app\admin\controller\User;

class Emailconfig extends User
{
    public function index()
    {
        $data = Db::name('emailconfig')->where('email','email')->find();
        $this->assign('data',$data);
        return $this->fetch();
    }


    public function publish()
    {
    	if($this->request->isPost()) {
    		$post = $this->request->post();
    		//验证  唯一规则： 表名，字段名，排除主键值，主键名
            $validate = new \think\Validate([
                ['from_email', 'require|email', '发件箱不能为空|发件箱格式不正确'],
                ['from_name', 'require', '发件人不能为空'],
                ['smtp', 'require', '邮箱smtp服务器不能为空'],
                ['username', 'require|email', '登录账户不能为空|登录账户应为邮箱格式'],
                ['password', 'require', '登录密码不能为空'],
                ['content', 'require', '邮件模板不能为空'],
            ]);
            //验证部分数据合法性
            if (!$validate->check($post)) {
                $this->error('提交失败：' . $validate->getError());
            }

            //$post['content'] = htmlentities($post['content']);
            if(false == Db::name('emailconfig')->where('email','email')->update($post)) {
            	return $this->error('提交失败');
            } else {
                addlog();//写入日志
            	return $this->success('提交成功','admin/emailconfig/index');
            }
    	} else {
    		return $this->error('非法请求');
    	}
    }


    public function mailto()
    {
    	if($this->request->isPost()) {
    		$post = $this->request->post();
    		//验证  唯一规则： 表名，字段名，排除主键值，主键名
            $validate = new \think\Validate([
                ['email', 'require|email', '收件箱不能为空|收件箱格式不正确'],
            ]);
            //验证部分数据合法性
            if (!$validate->check($post)) {
                $this->error('提交失败：' . $validate->getError());
            }

            $address = $post['email'];
            $mailto = SendMail($address);
            if(false == $mailto) {
            	return $this->error('发送失败');
            } else {
            	addlog($address);//写入日志
            	return $this->success('邮件发送成功');
            }
            dump($mailto);
    	} else {
    		return $this->fetch();
    	}
    }
}
