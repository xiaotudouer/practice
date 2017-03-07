<?php
/**
 * Created by PhpStorm.
 * User: xx
 * Date: 17/3/2
 * Time: 09:54
 */

namespace Admin\Controller;


use Think\Controller;

class DeptController extends CommonController
{
    //定义部门列表showList方法,展示列表信息
    public function showList()
    {
        //实例化模型
        $model = M('Dept');
        //查询部门列表内所有信息数据
        $data = $model -> select();
        //二次循环遍历列表的数据,pid对应的name值
        foreach($data as $key => $value) {
            //将遍历出的pid对应的name值存到$info中
            $info = $model -> find($value['pid']);
            //将查询到的pid对应的name值存到$data中
            $data[$key]['parentName'] = $info['name'];
        }
        //dump($data);die;
        //实现无限极分类
        //加载无限极分类文件tree.php
        load('@/tree');
        //调用getTree方法
        $data = getTree($data);
        //把查询到的数据传递给模板
        $this -> assign('data',$data);
        //展示模板
        $this -> display();
    }
    //定义添加部门方法add
    public function add()
    {
        //实例化模型
        $model = M('Dept');
        //获取已有部门数据
        $data = $model -> select();
        //将获取的数据传递给模板
        $this -> assign('data',$data);
        //展示模板
        $this -> display();
    }
    //定义添加部门保存方法addOk
    public function addOk()
    {
        //接收add模板传递过来的数据
        $post = I('post.');
        //实例化模型
        $model = M('Dept');
        //保存添加的数据
        $rst = $model -> add($post);
        //判断是否保存成功
        if($rst){
            //成功跳转到showList
            $this -> success('添加部门成功!',U('showList'),3);
        }else{
            //失败跳转到添加add
            $this -> error('添加失败!',U('add'),3);
        }
    }
    //定义删除部门列表信息的方法del
    public function del()
    {
        //接收模板传递过来的数据
        $ids = I('get.ids');
        //实例化模型
        $model = D('Dept');
        //执行删除的sql操作
        $rst = $model -> delete($ids);
        //dump($rst);die;
        //判断删除结果
        if($rst){
            //删除成功
            $this -> success('删除成功!',U('showList'),3);
        }else{
            //删除失败
            $this -> error('删除失败!',U('showList'),3);
        }
    }
    //定义编辑部门列表信息的方法edit
    public function edit()
    {
        //接收模板传递过来的数据
        $id = I('get.id');
        //判断传递过来的id是否是数字类型
        if(!is_numeric($id)){
            //报错跳转
            $this -> error('请选择要修改的数据!',U('showList'),3);
        }
        //实例化模型
        $model = D('Dept');
        //查询出要修改的id对应的数据信息
        $rst = $model -> find($id);
        //将查询到的数据传递给模板
        $this -> assign('rst',$rst);
        //查询出所有部门列表数据
        $data = $model -> select();
        //将数据传递给模板
        $this -> assign('data',$data);

        //展示模板
        $this -> display();
    }
    //定义保存编辑部门列表信息的方法editOk
    public function editOk()
    {
        //接收数据
        $post = I('post.');
        //实例化
        $model = D('Dept');
        //将接收的数据保存
        $rst = $model -> save($post);
        //判断是否保存成功
        if($rst){
            //成功
            $this -> success('修改成功!',U('showList'),3);
        }else{
            //失败
            $this -> error('修改失败!',U('edit'),3);
        }
    }
}