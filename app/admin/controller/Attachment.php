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
use \app\admin\controller\Permissions;
use \app\admin\model\Attachment as model;
use \think\Cookie;
class Attachment extends Permissions
{
    public function index()
    {
        $model = new model();

        $post = $this->request->param();
        if (isset($post['keywords']) and !empty($post['keywords'])) {
            $where['filename'] = ['like', '%' . $post['keywords'] . '%'];
        }
        
        if (isset($post['status']) and ($post['status'] == 1 or $post['status'] === '0' or $post['status'] == -1)) {
            $where['status'] = $post['status'];
        }
 
        if(isset($post['create_time']) and !empty($post['create_time'])) {
            $min_time = strtotime($post['create_time']);
            $max_time = $min_time + 24 * 60 * 60;
            $where['create_time'] = [['>=',$min_time],['<=',$max_time]];
        }
        
        $attachment = empty($where) ? $model->order('create_time desc')->paginate(20) : $model->where($where)->order('create_time desc')->paginate(20,false,['query'=>$this->request->param()]);
        
        $this->assign('attachment',$attachment);
        return $this->fetch();
    }


    public function audit()
    {
    	//获取文件id
        $id = $this->request->has('id') ? $this->request->param('id', 0, 'intval') : 0;
        if($id > 0) {
        	if($this->request->isPost()) {
        		//是提交操作
        		$post = $this->request->post();
        		$status = $post['status'];
                $admin_id = Cookie::get('admin');
        		if(false == Db::name('attachment')->where('id',$id)->update(['status'=>$status,'admin_id'=>$admin_id,'audit_time'=>time()])) {
        			return $this->error('审核提交失败');
        		} else {
                    addlog($id);//写入日志
        			return $this->success('审核提交成功','admin/attachment/index');
        		}
        	} 
        } else {
        	return $this->error('id不正确');
        }
    }

    public function delete()
    {
    	if($this->request->isAjax()) {
    		$id = $this->request->has('id') ? $this->request->param('id', 0, 'intval') : 0;
    		$attachment = Db::name('attachment')->where('id',$id)->value('filepath');
            if(file_exists(ROOT_PATH . 'public' . $attachment)) {
                if(unlink(ROOT_PATH . 'public' . $attachment)) {
                    if(false == Db::name('attachment')->where('id',$id)->delete()) {
                        return $this->error('删除失败');
                    } else {
                        addlog($id);//写入日志
                        return $this->success('删除成功','admin/attachment/index');
                    }
                } else {
                    return $this->error('删除失败');
                }
            } else {
                if(false == Db::name('attachment')->where('id',$id)->delete()) {
                    return $this->error('删除失败');
                } else {
                    addlog($id);//写入日志
                    return $this->success('删除成功','admin/attachment/index');
                }
            }
    	}
    }


    public function download()
    {
        if($this->request->isAjax()) {
            $id = $this->request->has('id') ? $this->request->param('id', 0, 'intval') : 0;
            if($id > 0) {
                //获取下载链接
                $data = Db::name('attachment')->where('id',$id)->find();
                $res['data'] = $data['filepath'];
                $res['name'] = $data['filename'];
                //增加下载量
                Db::name('attachment')->where('id',$id)->setInc('download',1);

                $res['code'] = 1;
                addlog($id);
                return json($res);
            } else {
                return $this->error('错误请求');
            }
        }
    }


    public function upload($module='admin',$use='attachment')
    {
        if($this->request->file('file')){
            $file = $this->request->file('file');
        }else{
            $res['code']=1;
            $res['msg']='没有上传文件';
            return json($res);
        }
        $web_config = Db::name('webconfig')->where('web','web')->find();
        $info = $file->validate(['size'=>$web_config['file_size']*1024,'ext'=>$web_config['file_type']])->rule('date')->move(ROOT_PATH . 'public' . DS . 'uploads' . DS . $module . DS . $use);
        if($info) {
            //写入到附件表
            $data = [];
            $data['module'] = $this->request->has('module') ? $this->request->param('module') : $module;//模块
            $data['filename'] = $info->getFilename();//文件名
            $data['filepath'] = DS . 'uploads' . DS . $module . DS . $use . DS . $info->getSaveName();//文件路径
            $data['fileext'] = $info->getExtension();//文件后缀
            $data['filesize'] = $info->getSize();//文件大小
            $data['create_time'] = time();//时间
            $data['uploadip'] = $this->request->ip();//IP
            $data['user_id'] = Cookie::has('admin') ? Cookie::get('admin') : 0;
            if($data['module'] = 'admin') {
                //通过后台上传的文件直接审核通过
                $data['status'] = 1;
                $data['admin_id'] = $data['user_id'];
                $data['audit_time'] = time();
            }
            $data['use'] = $this->request->has('use') ? $this->request->param('use') : $use;//用处
            $res['id'] = Db::name('attachment')->insertGetId($data);
            addlog($res['id']);//记录日志
            return $this->success('上传完成','admin/attachment/index');
        } else {
            // 上传失败获取错误信息
            return $this->error('上传失败：'.$file->getError());
        }
    }
}
