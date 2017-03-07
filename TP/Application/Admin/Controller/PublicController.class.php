<?php
/**
 * Created by PhpStorm.
 * User: xx
 * Date: 17/3/1
 * Time: 09:12
 */
//声明当前名字空间
namespace Admin\Controller;

//引入父类控制器元素
use Think\Controller;

//定义控制器并继承父类控制器
class PublicController extends Controller
{
    //定义方法login,展示登录页面
    public function login()
    {
        //渲染模板
        $this -> display();
    }
    //定义生成验证码方法captcha
    public function captcha()
    {
        //配置
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
    }
    //定义接收登录数据的index方法
    public function index()
    {
        //接收数据
        $post = I('post.');
        //实例化验证码类
        $verify = new \Think\Verify();
        //验证验证码
        //$str = $_POST['captcha'];
        //dump($str);die;
        $rst = $verify -> check($post['captcha']);
        //dump($rst);die;
        //判断验证码是否成功
        if($rst){
            //验证成功,验证用户名
            //实例化模型
            $model = M('user');
            //查询用户信息
            $result = $model -> where(array('username' => $post['username'],'password' => $post['password'])) -> find();
            //用户登录持久化
            if($result){
                //持久化
                session('uid',$result['id']);//持久化用户id
                session('uname',$result['username']);//持久化用户名
                session('role_id',$result['role_id']);//持久化用户组id
                $this -> success('登录成功!',U('Index/index'),3);
            }else{
                //登录失败
                $this -> error('登录失败!',U('login'),3);
            }
        }else{
            //验证失败
            $this -> error('验证码错误!',U('login'),3);
        }
    }
    //定义退出登录的方法logout
    public function logout()
    {
        //删除全部的session
        session(null);
        //跳转到登录页
        $this -> success('退出成功!',U('login'),3);
    }
}