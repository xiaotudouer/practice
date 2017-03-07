<?php
namespace My
{
    class A
    {
        public function sayHello()
        {
            echo "hello!";
        }
    }
}
namespace Other
{
    class A
    {
        public function show()
        {
            echo "show me code!";
        }
    }
}
//怎么在run空间下分别使用My和Other空间下的A类
namespace run
{
    class A
    {
        public function index()
        {
            echo "index!";
        }
    }
    use \My\A as A1;//
    use \Other\A as A2;
    //使用My空间下的A类
    $obj = new A1();
    $obj->sayHello();
    //使用Other空间下的A类
    $obj = new A2();
    $obj->show();
    $obj = new A();
    $obj->index();
}
//$obj = new
