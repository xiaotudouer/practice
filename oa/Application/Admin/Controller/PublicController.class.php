<?php
/**
 * Created by PhpStorm.
 * User: xx
 * Date: 17/3/2
 * Time: 09:23
 */

namespace Admin\Controller;


use Think\Controller;

class PublicController extends Controller
{
    //定义展示登录模板login方法
    public function login()
    {
        //展示模板
        $this -> display();
    }
    //定义生成验证码方法captcha
    public function captcha()
    {
        //配置验证码生成参数
        $cfg = array(
            'fontSize'  =>  14,              // 验证码字体大小(px)
            'useCurve'  =>  false,            // 是否画混淆曲线
            'useNoise'  =>  false,            // 是否添加杂点
            //'imageH'    =>  0,               // 验证码图片高度
            //'imageW'    =>  0,               // 验证码图片宽度
            'length'    =>  4,               // 验证码位数
            'fontttf'   =>  '4.ttf',
        );
        //实例化验证码类
        $verify = new \Think\Verify($cfg);
        //生成输出保存验证码
         $verify -> entry();
        //dump($rst);die;
    }
    //定义接收登录数据的index方法
    public function index()
    {
        //接收模板传递过来的数据
        $post = I('post.');
        //实例化验证码类
        $verify = new \Think\Verify();
        //验证验证码
        $rst = $verify -> check($post['captcha']);
        //判断验证码是否正确
        if($rst){
            //验证通过,验证用户名密码并进行用户登录持久化操作
            //实例化
            $model = M('user');
            //查询用户信息,验证用户名密码
            $data = $model -> where(array('username' => $post['username'], 'password' => $post['password'])) -> find();
            //用户持久化
            if($data){
                //说明用户名密码正确,进行用户登录持久化操作
                session('uid',$data['id']);
                session('uname',$data['username']);
                session('role_id',$data['role_id']);
                $this -> success('登陆成功!',U('Index/index'),3);
            }else{
                //失败
                $this -> error('用户名或密码错误!',U('login'),3);
            }
        }else{
            //失败
            $this -> error('验证码错误!',U('login'),3);
        }
    }
    //定退出登录的方法logout
    public function logout()
    {
        //删除全部session
        session(null);
        //退出
        $this -> success('退出成功!',U('login'),3);
    }
}