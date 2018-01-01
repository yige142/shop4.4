<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/2
 * Time: 15:26
 */

namespace Admin\Model;
use Think\Model;

class AuthGroupModel extends Model{
    //获取角色数据列表
    public function getList($page, $rows) {
        $obj = $this->field('id,title,rules')
            ->limit(($rows * ($page - 1)), $rows)
            ->select();
        //print_r($obj) 	;
        foreach ($obj as $key=>$value) {
            $map['id'] = array('in', $value['rules']);
            //print_r($map['id']);
            $AuthRule = M('AuthRule');
            $objAR = $AuthRule->field('title')->where($map)->select();
            //print_r($objAR) ;
            foreach ($objAR as $key2=>$value2) {
                $obj[$key]['auth'] .= $value2['title'].',';
            }

            $obj[$key]['auth'] = substr($obj[$key]['auth'], 0, -1);
            //print_r($obj[$key]['auth']);
        }
        return array(
            'total'=>$this->count(),
            'rows'=>$obj ? $obj :'',
        );
    }
}