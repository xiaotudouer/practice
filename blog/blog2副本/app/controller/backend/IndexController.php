<?php
/**
 * Created by PhpStorm.
 * User: xx
 * Date: 17/1/9
 * Time: 17:36
 */

namespace app\controller\backend;


class IndexController extends \core\Controller
{

    public function index()
    {
        $this->loadHtml('index');
    }
    public function header()
    {
        $this->loadHtml('header');
    }
    public function menu()
    {
        $this->loadHtml('menu');
    }
    public function content()
    {
        $this->loadHtml('content');
    }

}