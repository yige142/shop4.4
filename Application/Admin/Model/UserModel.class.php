<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/9
 * Time: 16:08
 */
namespace Admin\Model;
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
    //获取数据列表
    public function getList($page,$rows,$sort,$order,$keywords,$dateType,$dateFrom,$dateTo,$state){
        $map=array();
        if($keywords){
            $map['accounts']=array('like','%'.$keywords.'%');
        }
        if($dateFrom && $dateTo){
            $map["$dateType"]=array(array('egt',$dateFrom),array('elt',$dateTo));
        }else if($dateFrom){
            $map["$dateType"]=array('egt',$dateFrom);
        }else if($dateTo){
            $map["$dateType"]=array('elt',$dateTo);
        }
        //按状态条件查询
        if($state){
            $map['state']=$state;
        }

        $object = $this ->field('id,accounts,last_login_time,last_login_ip,login_count,state,create_time')
            ->where($map)
            ->order(array($sort=>$order))
            ->limit(($rows * ($page - 1)), $rows)
            ->select();
        //echo $this->getLastSql();
        return array(
            'total'=>$this->count(),
            'rows'=>$object?$object : ''
        );
    }
    //根据ID获取一条记录
    public function getOne($id){
        $map['id']=$id;
        return $this -> field('id,accounts,state')
            ->where($map)
            ->find();
    }
    //根据ID修改一条记录
    public function update($id,$password,$state){
        $updateData=array(
            'id'        =>$id,
            'password' =>$password,
            'state'    =>$state
        );
        if($this->create($updateData)){
            if(empty($password)){
                unset($updateData['password']);
            }else{
                $updateData['password']=sha1($password);
            }

            $id=$this->save($updateData);
            return $id ? $id : 0;
        }else{
            return $this->getError();
        }
    }

    //点击状态图标审核状态
    public function state($id,$state){
        $StateDate=array(
            'id'=>$id,
            'state'=>$state
        );

        return $this->save($StateDate);
    }

    //新增操作
    public function register($accounts,$password,$outRegister=false){
        if($outRegister){
            $addData=array(
                'accounts'=>$accounts,
                'password'=>$password,
                'create_time'=>getTime(),
                'state'=>'冻结'
            );
        }else{
            $addData=array(
                'accounts'=>$accounts,
                'password'=>$password,
                'create_time'=>getTime(),
                'state'=>'正常'
            );        }


        if($this->create($addData)){
            $addData['password']=sha1($password);
            $id=$this->add($addData);
            if($id){
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

    //根据ID集合删除操作
    public function remove($ids){
        return $this->delete($ids);
    }



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

            $object= $this->field('id,accounts,state,tab')
                ->where($map)
                ->find();
            if($object){
                //冻结账号返回-1
                if($object['state']=='冻结'){
                    return -1;
                }
                if($object['tab']=='超管'){
                    //登录成功，写session
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
                    return -2;
                }


            }else{
                return 0;
            }
        }else{
            return $this->getError();
        }
    }

    //根据ID修改密码
    public function editPassword($id,$password,$notPassword){
        $updateData= array(
            'id'=>$id,
            'password'=>$password,
            'notPassword'=>$notPassword
        );
        //暂时理解为 create创建数据对象，但不先保存到数据库，在创建数据库的同时验证上方$_validate中的规则，通过则执行下方法
        if($this->create($updateData)){
            $updateData['password']=sha1($password);
            $id= $this->save($updateData);//save 返回受影响的行数
            return $id ? $id : 0;
        }else{
            return $this->getError();
        }
    }
}
