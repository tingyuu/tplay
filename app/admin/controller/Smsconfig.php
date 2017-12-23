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

class Smsconfig extends User
{
    public function index()
    {
        $data = Db::name('smsconfig')->where('sms','sms')->find();
        $this->assign('data',$data);
        return $this->fetch();
    }


    public function publish()
    {
    	if($this->request->isPost()) {
    		$post = $this->request->post();
    		//验证  唯一规则： 表名，字段名，排除主键值，主键名
            $validate = new \think\Validate([
                ['appkey', 'require', 'AppKey不能为空'],
                ['secretkey', 'require', 'SecretKey不能为空'],
                ['name', 'require', '短信签名不能为空'],
                ['code', 'require', '短信模板ID不能为空'],
            ]);
            //验证部分数据合法性
            if (!$validate->check($post)) {
                $this->error('提交失败：' . $validate->getError());
            }

            //$post['content'] = htmlentities($post['content']);
            if(false == Db::name('smsconfig')->where('sms','sms')->update($post)) {
            	return $this->error('提交失败');
            } else {
                addlog();//写入日志
            	return $this->success('提交成功','admin/smsconfig/index');
            }
    	} else {
    		return $this->error('非法请求');
    	}
    }


    public function smsto()
    {
        //return $this->error('hehe');
        if($this->request->isPost()) {
            $post = $this->request->post();
            //验证  唯一规则： 表名，字段名，排除主键值，主键名
            $validate = new \think\Validate([
                ['phone', 'require|length:11,11|number', '手机号码不能为空|手机号码格式不正确|手机号码格式不正确'],
            ]);
            //验证部分数据合法性
            if (!$validate->check($post)) {
                $this->error('提交失败：' . $validate->getError());
            }

            $phone = (string)$post['phone'];

            $param = '{"name":"Tplay用户"}';

            $smsto = SendSms($param,$phone);
            
            if(!empty($smsto)) {
                return $this->error('发送失败');
            } else {
                $phone = hide_phone($phone);
                addlog($phone);//写入日志
                return $this->success('短信发送成功');
            }
        } else {
            return $this->fetch();
        }
    }
}
