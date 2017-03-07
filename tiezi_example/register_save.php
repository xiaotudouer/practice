<?PHP
header("content-type:text/HTML;charset=utf-8");
//包含连接数据库文件
require_once("./include/conn.php");
//开启session
session_start();
//判断表单是否提交
if(isset($_POST['ac'])&&$_POST['ac']==$_SESSION['rand_value'])
{
  //获取表单提交值
  $username = $_POST['username'];
  $password = md5($_POST['password']);//md5()对密码进行加密
  $name = $_POST['name'];
  $addate = $_POST['addate'];
  $yanzhengma = $_POST['yanzhegma'];
  //判断验证码是否正确
  if($yanzhengma!=$_SESSION['yanzhengma'])
  {
    $msg = urlencode("验证码不正确");
    //跳转到错误页面
    header("location:./include/error.php?message=$msg");
  }
  //判断该用户名是否被注册
  $sql = "select * from user where username ='$username'";//执行sql查询语句
  $result = mysql_query($sql);//sql语句查询结果
  $records = mysql_num_rows($result);//取出记录数:可能为1,可能为0
  //判断记录数是1还是0
  if($records!==0)
  {
    $msg = urlencode("用户名已被注册!请换一个用户名!");
    //跳转到错误页面
    header("location:./include/error.php?message=$msg");
  }
  //将自己的数据写入数据库
  $sql = "insert into user(username,password,name,addate)values('$username','$password','$name','$addate')";
  if(mysql_query($sql))
  {
    $msg = urlencode("恭喜{$username}注册成功!请登录!");
    $url = "/login.php";//./为当前目录,去掉.为根目录
    header("location:./include/success.php?url=$url&message=$msg");//跳转到注册成功页面

  }
}else
{
  //跳转到错误页面
  $msg = urlencode("非法用户");
  header("location:./include/error.php?msg=$msg");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="<?php echo $str_language; ?>" xml:lang="<?php echo $str_language; ?>">
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>用户注册页面</title>
<style type="text/css">
</style>
</head>
<body>
  <img />
</body>
</html>
