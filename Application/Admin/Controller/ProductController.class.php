<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/3
 * Time: 14:43
 */
namespace Admin\Controller;

use Think\Controller;
class ProductController extends BaseController{
      //获得产品信息
    public function getList(){
         if(IS_AJAX){
             $Product=D('Product');
             $this->ajaxReturn($Product->getList(I('post.page'), I('post.rows'), I('post.sort'), I('post.order')));
         }else{
             $this->error('非法操作');
         }
    }

    //获取上传图片信息
    public function webup($id){
        $config = array(
            'mimes'         =>  array(), //允许上传的文件MiMe类型
            'maxSize'       =>  0, //上传的文件大小限制 (0-不做限制)
            'exts'          =>  array('jpg', 'gif', 'png', 'jpeg'), //允许上传的文件后缀
            'autoSub'       =>  true, //自动子目录保存文件
            'subName'       =>  array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
            'rootPath'      =>  './Public/Uploads/', //保存根路径
            'savePath'      =>  '',//保存路径
            'id'=>I('get.id')
        );
        $upload = new \Think\Upload($config);// 实例化上传类


        $info   =   $upload->upload();

        if(!$info) {

            $this->error($upload->getError());// 上传错误提示错误信息

        }else{// 上传成功
            /*
             * 分离缩略图和轮播图
             */

            //dump($info);

            dump($config);
            dump($info);
            print_r($info['file']['savename']);


//            foreach ($info as $va){
//
//                if ($va['key']=="suoluetu"){
//                    $suoluetu.="Public/Uploads/luxian/".$va['savepath'].$va['savename']."||";
//                }else {
//                    $lunbotu.="Public/Uploads/luxian/".$va['savepath'].$va['savename']."||";
//                }
//            }
        }
    }

    //图像上传
    public function uploadify()
    {
        if (!empty($_FILES)) {
            //图片上传设置
            $config = array(
                'maxSize'    =>    3145728,
                'savePath'   =>    C('UPLOAD_PATH'),
                'saveName'   =>    array('uniqid',''),
                'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
                'autoSub'    =>    true,
                'subName'    =>    array('date','Ymd'),
            );
            $upload = new \Think\Upload($config);// 实例化上传类
            $info = $upload->upload();
            //判断是否有图
            if($info){
                $imgPath=C('UPLOAD_PATH').$info['Filedata']['savepath'].$info['Filedata']['savename'];
                //返回文件地址和名给JS作回调用
                $image = new \Think\Image();
                $image->open('./Uploads/'.$info['Filedata']['savepath'].$info['Filedata']['savename']);
                $thumbPath= C('UPLOAD_PATH').$info['Filedata']['savepath'].'180_'.$info['Filedata']['savename'];
                $image->thumb(180,180)->save('./Uploads/'.'180_'.$info['Filedata']['savename']);
                $image_info=array(
                    'imgPath'=>$imgPath,
                    'thumbPath'=>$thumbPath
                );
                return $this->ajaxReturn($image_info);
            }
            else{
                $this->error($upload->getError());//获取失败信息
            }
        }
    }
}