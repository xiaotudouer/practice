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
  $password = $_POST['password'];//md5()对密码进行加密
  $expire = $_POST['expire'];
  //判断用户信息是否正确,将用户数据与数据库做比对
  $sql = "select * from user where username ='$username' and password='$password'";//执行sql查询语句
  $result = mysql_query($sql);//sql语句查询结果
  $records = mysql_num_rows($result);//取出记录数:可能为1,可能为0
  //判断记录数是1还是0
  if($records==0)
  {
    $msg = urlencode("用户名或密码不正确!");
    //跳转到错误页面
    header("location:./include/error.php?message=$msg");
  }
  //更新用户的资料,最后登录时间和最后登录IP
  $lastloginip = $_SERVER['REMOTE_ADDR'];//获取最后登录IP
  $lastlogintime = time();//获取最后登录时间
  //构建更新数据库信息的SQL语句
  $sql = "update user set lastloginip='$lastloginip',lastlogintime='$lastlogintime' where username='$username'";
  //执行SQL语句
  mysql_query($sql);
  //将用户信息写入cookie
  setcookie("username",$username,time()+$expire);
  setcookie("password",$password,time()+$expire);
  //将用户名存入session,便于页面显示用户登录成功时显示用户名,不成功显示游客
  $row = mysql_fetch_assoc($result);
  $_SESSION ['uid'] = $row['id'];
  $_SESSION['username'] = $username;
  //跳转到成功页面
  $msg = urlencode("恭喜{$username}登录成功!正在跳转到首页");
  $url = "/IndexController.php";//./为当前目录,去掉.为根目录
  header("location:./include/success.php?url=$url&message=$msg");//跳转到注册成功页面
}else
{
  //跳转到错误页面
  $msg = urlencode("非法用户");
  header("location:./include/error.php?msg=$msg");
}
?>
