<?php

namespace app\controller\backend;// 强制要求

// 将核心控制器导入到当前的名字空间
use core\Controller;

class TestController extends Controller
{
    public function show()
    {
        $o = new \app\model\TestModel();
        $o->challenge();
        echo '感觉自己萌萌哒。';
        $this->redirect('http://www.baidu.com');
    }
}