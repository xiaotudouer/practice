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
        if(isset($_SESSION['loginFlag']) && $_SESSION['loginFlag'] == true) {
            $this->loadHtml('index',$users=array());
        } else {
            $this->redirect('index.php?a=login&c=User&p=backend','请登录');
        }

    }
    public function header()
    {
        $this->loadHtml('header',$users=array());
    }
    public function menu()
    {
        $this->loadHtml('menu',$users=array());
    }
    public function content()
    {
        $this->loadHtml('content',$users=array());
    }

}