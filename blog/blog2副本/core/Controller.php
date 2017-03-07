<?php

namespace core;

// 核心控制器
class Controller
{
    protected function loadHtml($name)
    {
        require VIEW_PATH . DS . PLATFORM . DS . $name . '.html';
    }
    public function redirect($url, $msg = '', $waitSeconds = 3)
    {
        echo $msg;
        header('Refresh: ' . $waitSeconds . '; url=' . $url);
    }
}





















