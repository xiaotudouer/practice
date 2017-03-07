<?php
/**
 * Created by PhpStorm.
 * User: xx
 * Date: 17/3/3
 * Time: 16:09
 */

namespace Admin\Controller;


use Think\Controller;

class DocController extends CommonController
{
    //创建公文列表方法showList
    public function showList()
    {
        //实例化
        $model = M('Doc');
        //读取公文列表数据
        $data = $model -> select();
        //将查询的数据传递给模板
        $this -> assign('data',$data);
        //展示模板
        $this -> display();
    }
    //创建添加公文方法add
    public function add()
    {
        //实例化
        $model = M('Doc');
        //查询已有公文数据
        $data = $model -> select();
        //将数据传递给模板
        $this -> assign('data',$data);
        //展示模板
        $this -> display();
    }
    //创建保存添加公文的方法addOk
    public function addOk()
    {
        //接收数据
        $post = I('post.');
        //实例化模型
        $model = M('Doc');
        //添加公文上传的时间
        $post['addtime'] = time();
        //实例化上传类
        $cfg = array(
            //保存根路径
          'rootPath' => WORKING_PATH . UPLOAD_ROOT_PATH
        );
        $upload = new \Think\Upload($cfg);
        //上传
        $info = $upload -> uploadOne($_FILES['file']);
        //$rst = $upload -> getError();
        //dump($info);die;
        //判断上传返回结果
        if($info){
            //设置表中filepath字段
            $post['filepath'] = UPLOAD_ROOT_PATH . $info['savepath'] . $info['savename'];
            //设置表中的filename字段
            $post['filename'] = $info['savename'];
            //设置表中hasfile字段
            $post['hasfile'] = 1;
        }
        //保存添加操作
        $rst = $model -> add($post);
        //判断添加返回值
        if($rst){
            //为真,成功
            $this -> success('添加文件成功',U('showList'),3);
        }else{
            //为假,失败
            $this -> error('添加公文失败',U('add'),3);
        }
    }
    //创建下载方法download
    public function download()
    {
        //接收数据
        $id = I('get.id');
        //实例化
        $model = M('Doc');
        //查询
        $data = $model -> find($id);
        //拼凑完整的路径
        $file = WORKING_PATH . $data['filename'];
        //将文件输出
        header("Content-Type:application/octet-stream");
        Header("Content-Length: ".filesize($file));
        Header('Content-Disposition: attachment; filename="' . basename($file) . '" ');
        readfile($file);
    }
    //创建getContent方法,输出公文信息
    public function getContent()
    {
        //接收数据
        $id = I('get.id');
        //实例化
        $model = M('Doc');
        //查询公文信息
        $data = $model -> find($id);
        //输出
        echo htmlspecialchars_decode($data['content']);
    }
    //创建edit方法,编辑公文信息
    public function edit(){
        //接收数据
        $id = I('get.id');
        //实例化
        $model = M('Doc');
        //查询
        $data = $model -> find($id);
        //把数据传递给模板
        $this -> assign('data',$data);
        //展示模板
        $this -> display();
    }
    //创建保存编辑editOk方法
    public function editOk()
    {
        //接收数据
        $post = I('post.');
        //判断是否有上传文件
        if($_FILES['file']['size'] > 0){
            //执行新文件的上传操作
            //配置上传
            $cfg = array(
                //上传的保存路径
                'rootPath' => WORKING_PATH . UPLOAD_ROOT_PATH
            );
            //实例化上传类
            $upload = new \Think\Upload($cfg);
            //上传
            $info = $upload -> uploadOne($_FILES['file']);
            //$rst = $upload -> getError();
            //dump($info);die;
            //判断上传结果
            if($info){
                //表示上传成功需要的操作
                //filepath字段的更新
                $post['filepath'] = UPLOAD_ROOT_PATH . $info['savepath'] . $info['savename'];
                //filename字段的更新
                $post['filename'] = $info['savename'];
                //更新hasfile字段
                $post['hasfile'] = 1;
            }
        }
        //实例化
        $model = M('Doc');
        //保存
        $rst = $model -> save($post);
        //判断返回值
        if($rst){
            //成功
            $this -> success('修改成功!',U('showList'),3);
        }else{
            //失败
            $this -> error('修改失败!',U('edit'),3);
        }
    }
    //创建删除方法del
    public function del()
    {
        //接收数据
        $ids = I('get.ids');
        //dump($ids);die;
        //实例化
        $model = M('Doc');
        //删除
        $rst = $model -> delete($ids);
        //判断删除结果
        if($rst){
            //返回值为真,成功
            $this -> success('删除成功!',U('showList'),3);
        }else{
            //返回值为假,失败
            $this -> error('删除失败!',U('showList'),3);
        }
    }
}