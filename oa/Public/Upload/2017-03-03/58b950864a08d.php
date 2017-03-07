<?php
header("content-type:text/html;charset=utf-8");
//定义一个学生类
class Student{
  //添加类的属性(变量)
  public $name = 'Tom';
  public $sex = 'man';
  public $age = 18;
  //添加类的方法/行为(函数)
  public function eat(){
    echo "Tom is eatting.";
  }
}
//创建一个类的实例对象
$obj = new Student();
echo $obj->name;
?>
