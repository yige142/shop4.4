<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/4
 * Time: 12:41
 */
namespace Admin\Controller;
use Think\Upload;

class GoodsController extends BaseController{
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
               // $thumbPath= C('UPLOAD_PATH').$info['Filedata']['savepath'].'180_'.$info['Filedata']['savename'];
                $image->thumb(150,150)->save('./Uploads/'.'180_'.$info['Filedata']['savename']);

                //$thumbPath 存的路径地址
                $thumbPath='Uploads/'.'180_'.$info['Filedata']['savename'];
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

    //添加商品数据
    public function register(){
        if(IS_AJAX){
            $Goods=D('Goods');
            echo $Goods->register  (I('post.goods_name'),I('post.goods_sn'),I('post.carriage'),I('post.shop_price'),
                                    I('post.goods_stock'),I('post.goods_unit'),I('post.goods_info'),I('post.goods_classify'),
                                    I('post.goods_status'),I('post.goods_recommend'),I('post.goods_competitive'),I('post.new_product'),
                                    I('post.hot_cakes'),I('post.img_path'),I('post.thumb_path'),I('post.goods_describe'));
        }else{
            $this->error('非法操作');
        }
    }

    //获取商品数据列表
    public function getList(){
        if(IS_AJAX){
            $Goods=D('Goods');
            $this->ajaxReturn($Goods->getList(I('post.page'),I('post.rows'),I('post.sort'),I('post.order'),
                I('post.goods_search_type'),I('post.keywords'),I('post.goods_type')));
        }else{
            $this->error('非法操作');
        }
    }

  //根据一条ID返回一条商品数据
    public function  getOne(){
        if(IS_AJAX){
            $Goods=D('Goods');
            $this->ajaxReturn($Goods->getOne(I('post.id')));
        }else{
            $this->error('非法操作');
        }
    }

    //根据ID修改一条数据
    public function update(){
        if(IS_AJAX){
            $Goods=D('Goods');
            echo $Goods->update(I('post.id'),I('post.goods_name'),I('post.goods_sn'),I('post.carriage'),
                                I('post.shop_price'),I('post.goods_stock'),I('post.goods_unit'),I('post.goods_info'),
                                I('post.goods_classify'),I('post.goods_status'),I('post.goods_recommend'),I('post.goods_competitive'),
                                I('post.new_product'),I('post.hot_cakes'),I('post.img_path'),I('post.thumb_path'),I('post.goods_describe'));
        }else{
            $this->error('非法操作');
        }
    }

    //根据ID集合删除记录
    public function remove(){
        if(IS_AJAX){
            $Goods=D('Goods');
            echo $Goods->remove(I('post.ids'));
        }else{
            $this->error('非法操作');
        }
    }

    //审核商品下架
    public function down(){
        if(IS_AJAX){
            $Goods=D('Goods');
            echo $Goods->down(I('post.id'),I('post.state'));
        }else{
            $this->error('非法操作');
        }
    }

    //审核商品推荐
    public function recommend(){
        if(IS_AJAX){
            $Goods=D('Goods');
            echo $Goods->recommend(I('post.id'),I('post.state'));
        }else{
            $this->error('非法操作');
        }
    }

    //审核商品设置精品
    public function competitive(){
        if(IS_AJAX){
            $Goods=D('Goods');
            echo $Goods->competitive(I('post.id'),I('post.state'));
        }else{
            $this->error('非法操作');
        }
    }

    //审核商品设置新品
    public function new_product(){
        if(IS_AJAX){
            $Goods=D('Goods');
            echo $Goods->new_product(I('post.id'),I('post.state'));
        }else{
            $this->error('非法操作');
        }
    }

    //审核设置热销
    public function hot_cakes(){
        if(IS_AJAX){
            $Goods=D('Goods');
            echo $Goods->hot_cakes(I('post.id'),I('post.state'));
        }else{
            $this->error('非法操作');
        }
    }

    //查看商品详情
    public function goods_detail(){

          //  $this->display('goods_detail');
        $Goods=D('Goods');
        echo  $this->assign('Goods', $Goods->getOne(I('get.id')));
        $this->display('Detail:goods_detail');

    }

}