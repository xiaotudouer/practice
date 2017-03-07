<?php
/**
 * Created by PhpStorm.
 * User: xx
 * Date: 17/1/9
 * Time: 21:15
 */

namespace app\controller\backend;


class UserController extends \core\Controller
{
    public function add()
    {

        //var_dump($_POST);
        // 用户的添加的用户数据存到数据库里
        /*sqli_connect('localhost','root','root');
        mysqli_query('set names utf8');
        mysqli_select_db('userlist');*/

        $userModel = \core\Model::create('\app\model\UserModel');
        //var_dump($userModel);

        if(!empty($_POST)) {

            //$sql = "INSERT INTO `user` ('username','nickname','email') values ('{$_POST['Username']}','{$_POST['Nickname']}','{$_POST['Email']}')";
            //mysqli_query($sql);
            //判断MySQL插入语句是否成功
            $data = array(
                'username' => $_POST['Username'],
                'nickname' => $_POST['Nickname'],
                'email' => $_POST['Email'],
                'last_login_time' => time(),

            );
            if ($userModel->add($data)) {
                //插入成功
                //echo "插入成功!";
                $this->redirect('index.php?a=getList&c=User&p=backend','插入成功');
            } else {
                //插入失败
                //echo "插入失败!";
                $this->redirect('index.php?a=add&c=User&p=backend','插入失败');
            }
        } else {
        //    require 'useradd.htm
            $this->loadHtml('useradd',$users=array());
        }

    }
    public function getList()
    {
        // 查询出所有用户，显示到html里
        //mysql_connect('localhost', 'root', 'root');
        //mysql_query('SET NAMES utf8');
        //mysql_select_db('userlist');

        $userModel = \core\Model::create('\app\model\UserModel');

       //$sql = "SELECT * FROM user WHERE 2 > 1";
        //$resourceResult = mysql_query($sql);
        //var_dump($resourceResult);
        // 从资源里获取数据？

        $users = $userModel->findAll();
        //while($user = mysql_fetch_assoc($resourceResult)) {
           // $users[] = $user;
        //}
        //var_dump($users);

        //require 'userlist.html';
     /*   $data = array(
            $users => $users,
        );*/
        $this->loadHtml('userlist', $users);
    }
    public function delete()
    {
        // 删除用户的逻辑

// 告诉我们应该删除那行记录了
        $id = $_GET['id'];
        /*$sql = "DELETE FROM `user` WHERE id={$id};";

        mysql_connect('localhost', 'root', 'hahaha');
        mysql_query('SET NAMES utf8');
        mysql_select_db('userlist4');*/
        $userModel = \core\Model::create('\app\model\UserModel');
// 将sql语句发送到mysql服务器里执行
        if ($userModel->deleteById($id)) {
            // 删除成功
            //echo '删除成功';
            // 跳转?那个页面？=>跳转回用户列表页面，方便用户查看最新的用户列表
            //header('Refresh: 3; url=userlist.php');
            $this->redirect('index.php?a=getList&c=User&p=backend','删除成功');
        } else {
            // 删除失败
            //echo '删除失败';
            //header('Refresh: 3; url=userlist.php');
            $this->redirect('index.php?a=getList&c=User&p=backend','删除失败');
        }
    }
    public function update()
    {

// 获取当前需要修改的用户，在html里回显出用户信息
        $id = $_GET['id'];
        $userModel = \core\Model::create('\app\model\UserModel');
      /*  mysql_connect('localhost', 'root', 'hahaha');
        mysql_query('SET NAMES utf8');
        mysql_select_db('userlist4');*/

        //var_dump($_POST);
        if (!empty($_POST)) {
            //$sql = "UPDATE `user` SET username='{$_POST['Username']}', nickname='{$_POST['Nickname']}', email='{$_POST['Email']}' WHERE id={$id}";
            $data = array(
                'username' => $_POST['Username'],
                'nickname' => $_POST['Nickname'],
                'email' => $_POST['Email'],
            );
// 修改成功后，给用户一个友好的提示，修改失败后，给用户一个失败的提示
//      修改成功后，跳转到用户列表页
//      修改失败后，跳转到用户修改页
            if ($userModel->updateById($id,$data)) {
                // 修改成功
                //echo '修改成功';
                //header('Refresh: 3; url=userlist.php');
                $this->redirect('index.php?a=getList&c=User&p=backend','修改成功');
            } else {
                // 修改失败了
                //echo '修改失败';
                //header('Refresh: 3; url=useredit.php?id=' . $id);
                $this->redirect('index.php?a=update&c=User&p=backend&id=' . $id ,'修改失败');
            }
        } else {
           /* $sql = "SELECT * FROM `user` WHERE id={$id}";
            $resourceResult = mysql_query($sql);
            $user = mysql_fetch_assoc($resourceResult);
            var_dump($user);*/
            $user = $userModel->findOneById($id);
            //var_dump($user);exit;
            $this->loadHtml('useredit', array(
                'user' => $user,
            ));
            //require 'useredit.html';
        }
    }
    public function login()
    {
        if($_POST) {
            $userModel = \core\Model::create('\app\model\UserModel');
            $user = $userModel->findOneBy("username='{$_POST['username']}' AND password='{$_POST['password']}'");
            if(!empty($user)) {
               // echo "用户登陆成功!";
                $_SESSION['loginFlag'] = true;
                $this->redirect('index.php?a=index&c=Index&p=backend','登录成功');
            } else {
                //echo "用户登录失败!";
                $_SESSION['loginFlag'] = false;
                $this->redirect('index.php?a=login&c=User&p=backend','登录失败');
            }
        } else {
            $this->loadHtml('login',$users=array());
        }

    }
}