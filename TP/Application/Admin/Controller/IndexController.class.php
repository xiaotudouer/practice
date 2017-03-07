<?php
/**
 * Created by PhpStorm.
 * User: xx
 * Date: 17/3/1
 * Time: 09:33
 */
//声明当前命名空间
namespace Admin\Controller;

//引入父类控制器元素
use Think\Controller;

//定义控制器并继承父类控制器
class IndexController extends Controller
{
    //定义首页展示index方法
    public function index()
    {
        //展示模板
        $this -> display();
    }
}