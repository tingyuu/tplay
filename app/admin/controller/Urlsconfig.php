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

use \think\Controller;
use think\Db;
use app\admin\controller\User;
use app\admin\model\Urlconfig;
class Urlsconfig extends User
{
    public function index()
    {
        $model = new Urlconfig();
        $urlconfig = $model->order('create_time desc')->paginate(20);
        $this->assign('urlconfig',$urlconfig);
        return $this->fetch();
    }


    public function publish()
    {
    	//获取规则id
    	$id = $this->request->has('id') ? $this->request->param('id', 0, 'intval') : 0;
    	$model = new Urlconfig();
		//是正常添加操作
		if($id > 0) {
    		//是修改操作
    		if($this->request->isPost()) {
    			//是提交操作
    			$post = $this->request->post();
    			//验证  唯一规则： 表名，字段名，排除主键值，主键名
	            $validate = new \think\Validate([
	                ['url', 'require', '需要美化的url不能为空'],
	                ['aliases', 'require', '美化后的url不能为空'],
	            ]);
	            //验证部分数据合法性
	            if (!$validate->check($post)) {
	                $this->error('提交失败：' . $validate->getError());
	            }
	            //验证规则是否存在
	            $urlconfig = $model->where('id',$id)->find();
	            if(empty($urlconfig)) {
	            	return $this->error('id不正确');
	            }
	            if(false == $model->allowField(true)->save($post,['id'=>$id])) {
	            	return $this->error('修改失败');
	            } else {
                    addlog($id);//写入日志
	            	return $this->success('修改成功','admin/urlsconfig/index');
	            }
    		} else {
    			//非提交操作
    			$urlconfig = $model->where('id',$id)->find();
    			if(!empty($urlconfig)) {
    				$this->assign('urlconfig',$urlconfig);
    				return $this->fetch();
    			} else {
    				return $this->error('id不正确');
    			}
    		}
    	} else {
    		//是新增操作
    		if($this->request->isPost()) {
    			//是提交操作
    			$post = $this->request->post();
    			//验证  唯一规则： 表名，字段名，排除主键值，主键名
	            $validate = new \think\Validate([
	                ['url', 'require', '需要美化的url不能为空'],
                    ['aliases', 'require', '美化后的url不能为空'],
	            ]);
	            //验证部分数据合法性
	            if (!$validate->check($post)) {
	                $this->error('提交失败：' . $validate->getError());
	            }
	            if(false == $model->allowField(true)->save($post)) {
	            	return $this->error('添加失败');
	            } else {
                    addlog($model->id);//写入日志
	            	return $this->success('添加成功','admin/urlsconfig/index');
	            }
    		} else {
    			//非提交操作
    			return $this->fetch();
    		}
    	}
    	
    }


    public function delete()
    {
    	if($this->request->isAjax()) {
    		$id = $this->request->has('id') ? $this->request->param('id', 0, 'intval') : 0;
            if(false == Db::name('urlconfig')->where('id',$id)->delete()) {
                return $this->error('删除失败');
            } else {
                addlog($id);//写入日志
                return $this->success('删除成功','admin/urlsconfig/index');
            }
    	}
    }


    public function status()
    {
        //获取文件id
        $id = $this->request->has('id') ? $this->request->param('id', 0, 'intval') : 0;
        if($id > 0) {
            if($this->request->isPost()) {
                //是提交操作
                $post = $this->request->post();
                $status = $post['status'];
                if(false == Db::name('urlconfig')->where('id',$id)->update(['status'=>$status])) {
                    return $this->error('设置失败');
                } else {
                    addlog($id);//写入日志
                    return $this->success('设置成功','admin/urlsconfig/index');
                }
            } 
        } else {
            return $this->error('id不正确');
        }
    }
}
