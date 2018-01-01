<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/30
 * Time: 12:49
 */
namespace Home\Model;
use Think\Model;

class BaseInfoModel extends Model{
    //根据ID获取用户信息
    public function getOne($id){
        $map['shop_base_info.uid']=$id;
        $object=$this->field('shop_base_info.id,
                           shop_base_info.sex,
                           shop_base_info.birthday,
                           shop_base_info.phone,
                           shop_base_info.email')->where($map)->find();
        return $object;
    }

   //修改用户信息
   public function update($id,$sex,$birthday,$phone,$email){
       $updateData=array(
           'id'=>$id,
           'sex'=>$sex,
           'birthday'=>$birthday,
           'phone'=>$phone,
           'email'=>$email
       );
       if($this->create($updateData)){
           $affectRow=$this->save($updateData);
           //echo $affectRow;
           return $affectRow;
       }else{
           return $this->getError();
       }
   }
}