<?php

namespace core;

// 核心控制器
class Controller
{
    protected function loadHtml($name,$users)
    {
        foreach($users as $variableName => $variableValue) {
            $$variableName = $variableValue;
        }
        require VIEW_PATH . DS . PLATFORM . DS . $name . '.html';
    }
    public function redirect($url, $msg = '', $waitSeconds = 3)
    {
        header('Refresh: ' . $waitSeconds . '; url=' . $url);
        echo $msg;
    }
}





















