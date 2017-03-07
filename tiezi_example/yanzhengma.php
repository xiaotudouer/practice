<?PHP
header("content-type:text/HTML;charset=utf-8");
//声明变量
$fontsize = 18;
$str = '';
$fontfile = './images/.jpg';
//生成随机的字符串
$arr_list = array_merge(range('a','z'),range('0','9'));
//打乱字符串数组
shuffle($arr_list);
//随机取四位下标
$arr_key = array_rand($arr_list,4);
//循环取出4个元素
foreach($arr_key as $value)
{
  $str .= $arr_list[$value];
}
print_r($arr_list);//打印数组,观察里面数据
//将验证码存入session用来服务器端与用户提交验证码做对比
session_start();
$_SESSION['yanzhengma'] = $str;
//从已知图像创建画布
$filename = "./images/yanzhengma.png";
$img = imagecreatefrompng($filename);
//分配颜色
$color = imagecolorallocate($img,255,255,0);
//取出画布的尺寸
//$imgw = imagesx($img);
//$imgh = imagesy($img);
//取出字体的尺寸
//$fontw = imagefontwidth($fontsize);
//$fonth = imagefontheight($fontize);
//计算字符的起点坐标(居中)
//$x = ($imgw - strlen($str)*$fontw)/2;
//$y = ($imgh - $fonth)/2;
//写入字符串
imagettftext($img,$fontsize,0,22,25,$color,$fontfile,$str);
//在浏览器中输出
imagepng($img,null,100);
//释放资源
imagedestroy($img);
?>
