<?php
/**
 * Created by PhpStorm.
 * User: xx
 * Date: 17/3/4
 * Time: 22:14
 */

namespace Admin\Controller;


use Think\Controller;

class EmptyController extends CommonController
{
    //创建空操作方法
    public function _empty()
    {
        //展示模板
        $this -> display('Empty/error');
    }

}