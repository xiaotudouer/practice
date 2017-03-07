<?php
header("content-type:text/html;charset=utf-8");
//定义一个学生类
class Student{
  //声明类的对象属性
  public $name;
  public $sex;
  public $age;
  public static $count = 0;
  const SCHOOL = '北京联合大学';
  //声明类的方法
  //(1)定义构造方法
  public function __construct($name,$sex,$age){
    $this->name = $name;
    $this->sex = $sex;
    $this->age = $age;
    self::$count++;

  }
  //(2)定义自我介绍方法
  public function show(){
    echo "<br>姓名:".$this->name;
    echo "<br>性别:".$this->sex;
    echo "<br>年龄:".$this->age;
    echo "<br>学校:".self::SCHOOL;
    echo "<br>欢迎".$this->name."同学加入传智,当前有".self::$count."个学生.";
  }
  //(3)定义构析函数
  public function __destruct(){
    self::$count--;
  }
}
$obj = new Student('张三','男',13);
$obj->show();
$obj1 = new Student('李四','男',130);
$obj1->show();
?>
