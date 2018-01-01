<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/18
 * Time: 13:37
 */
namespace Home\Model;
use Think\Model;

class UserModel extends Model{
    //自动验证
    protected $_validate=array(
        array('accounts','2,20','2账号长度不合法',self::EXISTS_VALIDATE,'length',self::MODEL_INSERT),
        //账号是否被占用
        array('accounts','','账号名称被占用',self::EXISTS_VALIDATE,'unique',self::MODEL_INSERT),
        //新增密码
        array('password','6,30','密码长度不合法',self::EXISTS_VALIDATE,'length',self::MODEL_INSERT),

        //确认密码是否与密码相同，create方法创建数据时会先验证该规则，通关则保存，不通过debug可查看错误信息
        array('notPassword','password','确认密码不正确',self::EXISTS_VALIDATE,'confirm',self::MODEL_UPDATE),
        //修改密码6-30，可以空
        array('password','6,30','密码长度不合法',self::EXISTS_VALIDATE,'length',self::MODEL_UPDATE),

        //登录验证 账号2-20位之间
        array('accounts','2,20','登录长度不合法',self::EXISTS_VALIDATE,'length',4),
        //登录验证 密码长度
        array('password','6,30','登录密码长度不合法',self::EXISTS_VALIDATE,'length',4),

    );

    //验证账号密码
    public function checkUser($accounts,$password){
        $CheckData=array(
            'accounts'=>$accounts,
            'password'=>$password
        );

        if($this->create($CheckData,4))
        {
            $map=array(
                'accounts'=>$accounts,
                'password'=>sha1($password)
            );

            $object= $this->field('id,accounts,state')
                ->where($map)
                ->find();
            if($object){
                //冻结账号返回-1
                if($object['state']=='冻结') return -1;

                //登录成功，先入session
                session('admin',array(
                    'id'        =>$object['id'],
                    'accounts' =>$object['accounts']
                ));

                //更新登录次数
                $LoginUpdate=array(
                    'id'                =>$object['id'],
                    'last_login_time'=>getTime(),
                    'last_login_ip'   =>get_client_ip(),
                    'login_count'     =>array('exp','login_count+1')
                );
                //保存更新
                $this->save($LoginUpdate);
                //返回登录的ID
                return $object['id'];
            }else{
                return 0;
            }
        }else{
            return $this->getError();
        }
    }

    //新增操作
    public function register($accounts,$password){
        $addData=array(
            'accounts'=>$accounts,
            'password'=>$password,
            'create_time'=>getTime(),
            'state'=>'正常'
        );

        if($this->create($addData)){
            $addData['password']=sha1($password);
            $id=$this->add($addData);
            if($id){
                M('BaseInfo')->add(array(
                    'uid'=>$id,
                    'sex'=>'男',
                    'birthday'=>'1990-01-01'
                ));
                return $id;
            }else{
                return 0;
            }
        }else{
            if($this->getError() == '账号名称被占用'){
                return -1;
            }
            return $this->getError();
        }
    }

    //根据ID修改密码
    public function editPassword($id,$oldPassword,$password){
        $a=sha1($oldPassword);
        $map['password']=sha1($oldPassword);
        $object=$this->field('password')->where($map)->select();
        if($a=$object){
            $updateData= array(
                'id'=>$id,
                'password'=>$password,
            );
            //暂时理解为 create创建数据对象，但不先保存到数据库，在创建数据库的同时验证上方$_validate中的规则，通过则执行下方法
            if($this->create($updateData)){
                $updateData['password']=sha1($password);
                $id= $this->save($updateData);//save 返回受影响的行数
                return $id ? $id : 0;
            }else{
                return $this->getError();
            }
        }else{
            return -3;
        }
    }


}