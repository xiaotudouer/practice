<?php
header("content-type:text/html;charset=utf-8");
//定义一个教师类
class Teacher{
  //定义类的对象属性
  public $name;
  public $sex;
  public $age;
  //定义类的方法
  //定义构造方法传值
  public function __construct($name,$sex,$age){
    $this->name = $name;
    $this->sex = $sex;
    $this->age = $age;
  }
  //定义自我介绍方法显示对象信息
  public function show(){
    echo "<br>姓名:".$this->name;
    echo "<br>性别:".$this->sex;
    echo "<br>年龄:".$this->age;

  }
  //定义构析函数
  public function __destruct(){

  }
}
$obj = new Teacher('李林山','男',25);
$obj->show();
$obj1 = new Teacher('jim','man',18);
$obj1->show();
?>
