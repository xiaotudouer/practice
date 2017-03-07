<?php
header("content-type:text/html;charset=utf-8");
//最终数据库工具类:单例模式  最终类只能实例化不能被继承
final class Db{
  //私有的属性:配置信息
  private $dbhost;
  private $dbport;
  private $dbuser;
  private $dbpwd;
  private $dbname;
  private $charset;
  private $link;
  private static $instance;//类实例,就是对象
  //私有的构造方法:进行一些初始化工作
  private function __construct($config=array()){
    $this->dbhost = $config['host'];
    $this->dbport = $config['port'];
    $this->dbuser = $config['user'];
    $this->dbpwd = $config['pwd'];
    $this->dbname = $config['name'];
    $this->charset = $config['charset'];
    $this->connectDB();//连接数据库
    $this->selectDB();//选择数据库
    $this->setCharacter();//设置字符集

  }
  //私有的克隆方法:阻止类外克隆对象
  private function __clone(){}
  //公共的静态创建实例的方法
  public static function getInstance($config=array()){
    //判断类实例是否存在  存在直接返回  不存在创建实例
    if(!(self::$instance instanceof self)){
      self::$instance = new self($config);//不存在则创建对象
    }
    return self::$instance;//返回创建的对象
  }
  //私有的连接数据库的方法
  private function connectDB(){
    $link = @mysql_connect("{$this->dbhost}:{$this->dbport}",$this->dbuser,$this->dbpwd);
    if(!$link){
      exit("php连接MySQL服务器失败!");
    }
    $this->link = $link;
  }
  //私有的选择数据库的方法
  private function selectDB(){
    if(!mysql_select_db($this->dbname)){
      exit("选择数据库{$this->dbname}失败了!");
    }
  }
  //私有的设置字符集的方法
  private function setCharacter(){
    mysql_query("set names $this->charset");
  }
  //定义公共的的执行sql语句的方法
  public function query($sql){
    return mysql_query($sql);
  }
  //公共的获取结果集的方法
  public function getAllRows($sql){
    $result = $this->query($sql);
    while($row = mysql_fetch_assoc($result)){
      $arr[] = $row;
    }
    return $arr;
  }
}
?>
