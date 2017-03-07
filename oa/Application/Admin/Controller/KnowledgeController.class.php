<?php
/**
 * Created by PhpStorm.
 * User: xx
 * Date: 17/3/4
 * Time: 10:21
 */

namespace Admin\Controller;


use Think\Controller;

class KnowledgeController extends CommonController
{
    //创建知识库列表showList方法
    public function showList()
    {
        //实例化
        $model = M('Knowledge');
        //读取数据
        $data = $model -> select();
        //传递数据
        $this -> assign('data',$data);
        //展示模板
        $this -> display();
    }
    //创建添加方法add
    public function add()
    {
        //实例化
        $model = M('Knowledge');
        //查询原有数据
        $data = $model -> select();
        //传递数据给模板
        $this -> assign('data',$data);
        //展示模板
        $this -> display();
    }
    //创建保存添加方法addOk
    public function addOk()
    {
        //接收数据
        $post = I('post.');
        //文件上传操作
        if($_FILES['thumb']['size'] > 0){
            //配置上传
            $cfg = array(
                'rootPath' => WORKING_PATH . UPLOAD_ROOT_PATH
            );
            //实例化上传类
            $upload = new \Think\Upload($cfg);
            //上传
            $info = $upload -> uploadOne($_FILES['thumb']);
            //判断返回结果
            if($info){
                //上传成功处理
                //picture字段
                $post['picture'] = UPLOAD_ROOT_PATH . $info['savepath'] . $info['savename'];
                //生成缩略图
                //实例化图片上传类
                $img = new \Think\Image();
                //打开图片
                $pic = WORKING_PATH . $post['picture'];
                $img -> open($pic);
                //制作缩略图
                $img -> thumb(100,100);//等比缩放原则2000x2500  100 125
                //保存图片
                $pos = WORKING_PATH . UPLOAD_ROOT_PATH . $info['savepath'] . 'thumb_' . $info['savename'];
                $img -> save($pos);
                //拼凑thumb字段数据
                $post['thumb'] = UPLOAD_ROOT_PATH . $info['savepath'] . 'thumb_' . $info['savename'];
            }
        }
        //实例化
        $model = M('Knowledge');
        //添加缩略图上传时间
        $post['addtime'] = time();
        //保存数据
        $rst = $model -> add($post);
        //判断返回值
        if($rst){
            //为真,成功
            $this -> success('添加成功!',U('showList'),3);
        }else{
            //为假,失败
            $this -> error('添加失败!',U('showList'),3);
        }
    }
    //创建删除方法del
    public function del()
    {
        //接收数据
        $ids = I('get.ids');
        //实例化
        $model = M('Knowledge');
        //dump($ids);die;
        //执行删除操作
        $rst = $model -> delete($ids);
        //判断删除结果
        if($rst){
            //true,成功
            $this -> success('删除成功!',U('showList'),3);
        }else{
            //false,失败
            $this -> error('删除失败!',U('showList'),3);
        }
    }
    //创建编辑方法edit
    public function edit()
    {
        //接收数据
        $id = I('get.id');
        //dump($id);die;
        //实例化
        $model = M('Knowledge');
        //查询数据
        $data = $model -> find($id);
        //将数据传递给模板
        $this -> assign('data',$data);
        //展示模板
        $this -> display();
    }
    //创建保存编辑方法editOk
    public function eddOk()
    {
        //获取数据
        $post = I('post.');
        //文件上传操作
        if($_FILES['thumb']['size'] > 0){
            //配置上传
            $cfg = array(
                'rootPath' => WORKING_PATH . UPLOAD_ROOT_PATH
            );
            //实例化上传类
            $upload = new \Think\Upload($cfg);
            //上传
            $info = $upload -> uploadOne($_FILES['thumb']);
            //判断返回结果
            if($info){
                //上传成功处理
                //picture字段
                $post['picture'] = UPLOAD_ROOT_PATH . $info['savepath'] . $info['savename'];
                //生成缩略图
                //实例化图片上传类
                $img = new \Think\Image();
                //打开图片
                $pic = WORKING_PATH . $post['picture'];
                $img -> open($pic);
                //制作缩略图
                $img -> thumb(100,100);//等比缩放原则2000x2500  100 125
                //保存图片
                $pos = WORKING_PATH . UPLOAD_ROOT_PATH . $info['savepath'] . 'thumb_' . $info['savename'];
                $img -> save($pos);
                //拼凑thumb字段数据
                $post['thumb'] = UPLOAD_ROOT_PATH . $info['savepath'] . 'thumb_' . $info['savename'];
            }
        }
        //实例化
        $model = M('Knowledge');
        //保存数据
        $rst = $model -> save($post);
        //判断保存结果
        if($rst){
            //成功
            $this -> success('修改成功!',U('showList'),3);
        }else{
            //失败
            $this -> error('修改失败!',U('edit'),3);
        }
    }
}