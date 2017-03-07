<?php
/**
 * Created by PhpStorm.
 * User: xx
 * Date: 17/3/4
 * Time: 19:23
 */

namespace Admin\Controller;


use Think\Controller;

class EmailController  extends CommonController
{
    //创建展示编辑发送方法send
    public function send()
    {
        //实例化用户类
        $model = M('User');
        //查询数据,列出收件人
        $data = $model -> select();
        //将数据传递给模板
        $this -> assign('data',$data);
        //展示模板
        $this -> display();
    }
    //创建保存发送方法sendOk
    public function sendOk()
    {
        //接收数据
        $post = I('post.');
        //判断是否有附件上传(如果附件大小大于0,则表示有附件)
        if($_FILES['file']['size'] > 0){
            //配置上传路径
            $cfg = array(
              'rootPath' => WORKING_PATH . UPLOAD_ROOT_PATH
            );
            //实例化上传类
            $upload = new \Think\Upload($cfg);
            //上传数据
            $info = $upload -> uploadOne($_FILES['file']);
            //判断上传结果
            if($info){
                //设置file字段
                $post['file'] = UPLOAD_ROOT_PATH . $info['savepath'] . $info['savename'];
                //设置hasfile字段
                $post['hasfile'] = 1;
                //设置filename字段
                $post['filename'] = $info['savename'];
            }
        }
        //实例化邮件类
        $model = M('Email');
        //获取发件时间
        $post['addtime'] = time();
        //保存数据
        $rst = $model -> add($post);
        //判断保存结果
        if($rst){
            //成功
            $this -> success('保存发送成功!',U('send'),3);
        }else{
            //失败
            $this -> error('保存发送失败!',U('send'),3);
        }
    }
    //创建展示发件箱的列表方法sendbox
    public function sendBox()
    {
        //dump(session());die;
        //实例化邮件类
        $model = M('Email');
        //连表查询数据(table连表)
        //原始sql查询语句
        //select t1.*,t2.truename from tp_email as t1,tp_user as t2 where t1.to_id = t2.id and from_id = uid;
        $data = $model -> field('t1.*,t2.truename')
                       -> table('tp_email as t1,tp_user as t2')
                       -> where('t1.to_id = t2.id and from_id = ' . session('uid'))
                       -> select();
        //传递数据给模板
        $this -> assign('data',$data);
        //展示模板
        $this -> display();
    }
    //创建下载附件方法download
    public function download()
    {
        //接收数据
        $id = I('get.id');
        //dump($id);die;
        //实例化邮件类
        $model = M('Email');
        //查询邮件记录
        $data = $model -> find($id);
        //组装file的完整路径
        $file = WORKING_PATH . $data['file'];
        //定义header头
        header('Content-type: application/octet-stream');
        header("Content-Length: ".filesize($file));
        header('Content-Disposition: attachment; filename="' . basename($file) . '" ');
        readfile($file);
    }
    //创建展示收件箱方法recbox
    public function recbox(){
        //实例化邮件类
        $model = M('Email');
        //读取收件箱数据
        $data = $model -> field('t1.*,t2.truename')
                       -> table('tp_email as t1,tp_user as t2')
                       -> where('t1.from_id = t2.id and to_id = ' . session('uid'))
                       -> select();
        //传递数据给模板
        $this -> assign('data',$data);
        //展示模板
        $this -> display();
    }
    //创建读取文件内容方法getContent
    public function getContent()
    {
        //获取数据
        $id = I('get.id');
        //实例化邮件类
        $model = M('Email');
        //查询邮件的信息
        $data = $model -> where("id = $id and to_id = " . session('uid')) -> find($id);
        //通过判断$data内的数据,修改未读isread状态
        if($data){
            $model -> save(array('id' => $id,'isread' => 1));
        }
        //输出邮件内容
        echo $data['content'];
    }
    //创建获取未读邮件数量的方法getMsgCount
    public function getMsgCount()
    {
        if(IS_AJAX){
            //实例化邮件类
            $model = M('Email');
            //查询未读邮件数量
            $count = $model -> where("isread = 0 and to_id = " . session('uid')) -> count();
            //输出
            echo $count;
        }else{
            echo 'Access Denied!';
        }
    }
}