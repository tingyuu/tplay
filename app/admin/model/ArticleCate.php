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


namespace app\admin\model;

use \think\Model;
class ArticleCate extends Model
{
	public function catelist($cate,$id=0,$level=0){
		static $cates = array();
		foreach ($cate as $value) {
			if ($value['pid']==$id) {
				$value['level'] = $level+1;
				if($level == 0)
				{
					$value['str'] = str_repeat('',$value['level']);
				}
				elseif($level == 2)
				{
					$value['str'] = '&emsp;&emsp;&emsp;&emsp;'.'└ ';
				}
				else
				{
					$value['str'] = '&emsp;&emsp;'.'└ ';
				}
				$cates[] = $value;
				$this->catelist($cate,$value['id'],$value['level']);
			}
		}
		return $cates;
	}


	public function article()
    {
        //关联文章表
        return $this->hasOne('Article');
    }
}
