<?php
/**
 * Created by PhpStorm.
 * User: xx
 * Date: 17/3/4
 * Time: 23:47
 */

namespace Admin\Controller;


use Think\Controller;

class CommonController extends Controller
{
    //创建TP中的构造方法_initialize
    public function _initialize()
    {
        //判断session是否存在
        $uid = session('uid');
        //判断$uid内的值
        if(empty($uid)){
            //真空,则没有用户id,说明用户没有登录,进行跳转
            $url = U('Public/login');
            //JavaScript代码实现跳转
            $script= "<script>window.top.location.href='$url';</script>";
            echo $script;exit;
        }

        //RBAC权限判断
        $cname = CONTROLLER_NAME;
        $aname = ACTION_NAME;
        //获取权限数组
        $auths = C('RBAC_AUTHS');
        //获取用户的用户组id
        $roleid = session('role_id');
        //取出当前用户的权限
        $auth = $auths['auth' . $roleid];
        //判断权限
        if($roleid != 1){
            if(!in_array($cname . '/*',$auth) && !in_array($cname . '/' . $aname,$auth)){
                $this -> error('您没有权限',U('Index/home'),3);
            }
        }
    }

}