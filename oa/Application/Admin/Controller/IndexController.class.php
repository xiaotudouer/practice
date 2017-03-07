<?php
/**
 * Created by PhpStorm.
 * User: xx
 * Date: 17/3/2
 * Time: 10:13
 */

namespace Admin\Controller;


use Think\Controller;

class IndexController extends CommonController
{
    //定义显示网页首页的方法index
    public function index()
    {
        //展示模板
        $this -> display();
    }
    //定义方法home用于展示首页框架
    public function home()
    {
        //展示模板
        $this -> display();
    }
}