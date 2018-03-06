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

use app\admin\controller\Permissions;
use \think\Db;
use \think\Cookie;
use \think\Session;
use \think\Cache;
class Index extends Permissions
{
    public function index()
    {
        $menu = Db::name('admin_menu')->where(['is_display'=>1])->order('orders asc')->select();

        //删除不在当前角色权限里的菜单，实现隐藏
        $admin_cate = Session::get('admin_cate_id');
        $permissions = Db::name('admin_cate')->where(['id'=>$admin_cate])->value('permissions');
        $permissions = explode(',',$permissions);

        foreach ($menu as $k => $val) {
        	if($val['type'] == 1 and $val['is_display'] == 1 and !in_array($val['id'],$permissions)) {
        		unset($menu[$k]);
        	}
        }

        //添加url
        foreach ($menu as $key => $value) {
        	if(empty($value['parameter'])) {
        		$url = url($value['module'].'/'.$value['controller'].'/'.$value['function']);
        	} else {
                $url = url($value['module'].'/'.$value['controller'].'/'.$value['function'],$value['parameter']);
        	}
        	$menu[$key]['url'] = $url;
        }
        $menus = $this->menulist($menu);
        $this->assign('menus',$menus);

        $cookie = Db::name('admin')->where('id',Session::get('admin'))->find();
        $this->assign('cookie',$cookie);

        return $this->fetch();
    }


    protected function menulist($menu){
		$menus = array();
		//先找出顶级菜单
		foreach ($menu as $k => $val) {
			if($val['pid'] == 0) {
				$menus[$k] = $val;
			}
		}
		//通过顶级菜单找到下属的子菜单
		foreach ($menus as $k => $val) {
			foreach ($menu as $key => $value) {
				if($value['pid'] == $val['id']) {
					$menus[$k]['list'][] = $value;
				}
			}
		}
		//三级菜单
		foreach ($menus as $k => $val) {
			if(isset($val['list'])) {
				foreach ($val['list'] as $ks => $vals) {
					foreach ($menu as $key => $value) {
						if($value['pid'] == $vals['id']) {
							$menus[$k]['list'][$ks]['list'][] = $value;
						}
					}
				}
			}
		}//dump($menus);die;
		return $menus;
	}
}
