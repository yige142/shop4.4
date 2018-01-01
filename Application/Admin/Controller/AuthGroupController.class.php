<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/2
 * Time: 14:54
 */

namespace Admin\Controller;
use Think\Controller;
class AuthGroupController extends BaseController {

    //获取角色数据列表
    public function getLIst(){
        if (IS_AJAX) {
            $AuthGroup = D('AuthGroup');
            $this->ajaxReturn($AuthGroup->getList(I('post.page'),I('post.rows')));
        } else {
            $this->error('非法操作！');
        }
    }
}