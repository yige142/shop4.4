<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/31
 * Time: 13:47
 */
namespace Home\Model;
use Think\Model;

class AddressModel extends Model{
   //获取用户地址List信息
    public function getList($id,$page, $rows,$sort,$order){
          //echo $id;
          $map['uid']=$id;
        $object=$this->field('id,uid,name,phone,address,tab,create_time')
                     ->where($map)
                     ->order(array($sort=>$order))
                     ->limit(($rows * ($page -1)),$rows)
                     ->select();
        //echo $this->getLastSql();
        return array(
            //'total'=>$this->count(),
            'total'=>$this->field('id,uid')->where($map)->count(),
            'rows'=>$object ? $object :''
        );
    }

    //新增地址信息
    public function register($uid,$name,$phone,$address,$tab){
        $addData=array(
            'uid'=>$uid,
            'name'=>$name,
            'phone'=>$phone,
            'address'=>$address,
            'tab'=>$tab
        );
        if($this->create($addData)){
            $id=$this->add($addData);
            if($id){
                return $id;
            }else{
                return 0;
            }
        }else{
            return $this->getError();
        }
    }

    //根据ID返回一条地址信息
    public function getOne($id){
        $map['id']=$id;
        return $this -> field('id,uid,name,phone,address,tab')
            ->where($map)
            ->find();
    }

    //根据ID修改地址信息
    public function update($id,$name,$phone,$address,$tab){
         $updateDate=array(
             'id'=>$id,
             'name'=>$name,
             'phone'=>$phone,
             'address'=>$address,
             'tab'=>$tab
         );

        if($this->create($updateDate)){
            $id= $this->save($updateDate);
//            if($tab){
//                $map['tab'] = '默认';
//                $map['id'] !=$id ;
//                $map['_logic']='and';
//            }
//                $updateTab='非默认';
//                $object['updateOrder']=M('Address')->where($map)->save($updateTab);

            return $id ? $id :0 ;
        }else{
            return $this->getError();
        }
    }

    //根据ID删除操作
    public function remove($id){
        return $object=$this->delete($id);
    }
}