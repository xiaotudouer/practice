<?php
/**
 * Created by PhpStorm.
 * User: xx
 * Date: 17/3/1
 * Time: 09:55
 */
//声明命名空间
namespace Admin\Controller;

//引入父类控制器元素
use Think\Controller;

//定义添加控制器并继承父类控制器
class DeptController extends Controller
{
    //定义部门列表showList方法
    public function showList()
    {
        //这个方法有两个业务逻辑,获取数据和展示模板
        //实例化父类模型
        $model = M('Dept');
        //查询数据
        $data = $model -> select();
        foreach ($data as $key => $value)
        {
            //二次查询,通过查询pid所对应的数据信息,获取其中的name字段
            $info = $model -> find($value['pid']);
            //获取其中的name字段存到$data中去
            $data[$key]['parentName'] = $info['name'];
        }
        //dump($data);die;
        //加载tree.php无限极分类文件
        load('@/tree');
        //无限极分类
        $data = getTree($data);
        //传递数据给模板
        $this -> assign('data',$data);
        //展示模板
        $this -> display();
    }
    //定义添加方法add
    public function add()
    {
        //实例化
        $model = D('Dept');
        //读取已经有的部门信息
        $rst = $model -> select();
        //传递数据给模板文件
        $this -> assign('rst',$rst);
        //展示部门的添加模板文件
        $this -> display();
    }
    //定义执行保存添加数据的方法addOk方法
    public function addOk()
    {
        //接收数据
        $post = I('post.');
        //实例化
        $model = M('Dept');
        //保存数据
        $rst = $model -> add($post);
        //判断返回值
        if($rst){
            //成功
            $this -> success('添加成功!',U('showList'),3);
        }else{
            //失败
            $this -> error('添加失败!',U('add'),3);
        }
    }
    //定义执行删除操作的方法del
    public function del()
    {
        //接收数据
        $ids = I('get.ids');
        //实例化类
        $model = D('Dept');
        //删除操作
        $rst = $model -> delete($ids);
        //判断删除结果
        if($rst){
            //成功
            $this -> success('删除成功!',U('showList'),3);
        }else{
            //失败
            $this -> error('删除失败!',U('showList'),3);
        }
    }
    //定义执行编辑操作的方法edit
    public function edit()
    {
        //接收原先id的信息
        $id = I('get.id');
        //dump($id);die;
        //判断是否有id传过来
        if(!is_numeric($id)){
            $this -> error('请选择需要修改的数据!',U('showList'),3);
        }
        //实例化类
        $model = D('Dept');
        //查询原先的数据
        $rst = $model -> find($id);
        //传递数据给模板
        $this -> assign('rst',$rst);
        //查询出原先全部的部门
        $data = $model -> select();
        //将数据传递给模板
        $this -> assign('data',$data);
        //展示模板
        $this -> display();
    }
    //定义执行编辑保存的方法editOk
    public function editOk()
    {
        //接收数据
        $post = I('post.');
        //实例化模型
        $model = D('Dept');
        //保存数据
        $rst = $model -> save($post);
        //判断返回结果
        if($rst != false){
            //成功
            $this -> success('修改成功!',U('showList'),3);
        }else{
            //失败
            $this -> error('修改失败!',U('edit',array('id' => $post['id'])),3);
        }
    }
}