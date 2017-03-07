<?php
/**
 * Created by PhpStorm.
 * User: xx
 * Date: 17/3/3
 * Time: 09:09
 */

namespace Admin\Controller;


use Think\Controller;

class UserController extends CommonController
{
    //定义添加方法显示添加模板
    public function add()
    {
        //实例化
        $model = M('Dept');
        //查询部门信息
        $data = $model -> select();
        //加载tree文件实现无限极分类
        load('@/tree');
        $data = getTree($data);
        //将数据传递给模板
        $this -> assign('data',$data);
        //展示模板
        $this -> display();
    }
    //定义保存添加模板addOk方法
    public function addOk()
    {
        //接收模板传递过来的数据
        $post = I('post.');
        //实例化模型
        $model = M('User');
        //保存数据
        $post['addtime'] = time();
        $rst = $model -> add($post);
        //判断返回值,是否保存成功
        if($rst){
            //成功
            $this -> success('添加成功!',U('showList'),3);
        }else{
            //失败
            $this -> error('添加失败!',U('add'),3);
        }
    }
    //定义展示职员列表方法showList
    public function showList()
    {
        //实例化
        $model = M('User');
        //查询总的记录数
        $count = $model -> count();
        //实例化分页类,传递总的记录数和每页显示的条数
        $page = new \Think\Page($count,1);
        //定制分页提示信息
        $page -> setConfig('prev','上一页');
        $page -> setConfig('next','下一页');
        $page -> setConfig('first','首页');
        $page -> setConfig('last','末页');
        //将末页从数字显示方式切换成汉字提示
        $page -> lastSuffix = false;
        //生成页码等信息
        $show = $page -> show();
        //核心步骤,使用limit查询职员列表内的数据
        $data = $model -> limit($page -> firstRow,$page -> listRows) -> select();
        //关联部门列表,查询部门的名字
        $dept = M('Dept');
        foreach($data as $key => $value)
        {
            //关联部门表进行查询
            $info = $dept -> find($value['dept_id']);
            $data[$key]['deptName'] = $info['name'];
        }
        //传递数据给模板
        $this -> assign('data',$data);
        $this -> assign('page',$show);
        //展示模板
        $this -> display();
    }
    //创建方法edit,用于获取用户原先的记录信息,并且展示模板
    public function edit()
    {
        //接收模板传递过来的数据
        $id = I('get.id');
        //实例化模型
        $model = M('User');
        $dept = M('Dept');
        //查询原先职员记录信息
        $data = $model -> find($id);
        //查询部门信息
        $depts = $dept -> select();
        //传递数据给模板
        $this -> assign('data',$data);
        $this -> assign('depts',$depts);
        //展示模板
        $this -> display();
    }
    //创建方法editOk,用于接收修改数据并将修改数据保存到用户表中
    public function editOk()
    {
        //接收模板传递的数据
        $post = I('post.');
        //实例化
        $model = M('User');
        //判断密码是否为空
        if($post['password'] == ''){
            //删除password元素
            unset($post['password']);
        }
        //执行修改/编辑保存操作
        $rst = $model -> save($post);
        //判断返回结果
        if($rst){
            //为真,成功
            $this -> success('修改数据成功!',U('showList'),3);
        }else{
            //为假,失败
            $this -> error('修改数据失败!',U('edit',array('id' => $post['id'])),3);
        }
    }
    //创建方法del,用于删除某条数据
    public function del()
    {
        //接收数据
        $ids = I('get.ids');
        //实例化
        $model = M('User');
        //删除
        $rst = $model -> delete($ids);
        //判断返回值
        if($rst){
            //为真,成功
            $this -> success('删除成功!',U('showList'),3);
        }else{
            //为假,失败
            $this -> error('删除失败!',U('showList'),3);
        }
    }
    //创建统计各部门人数的图表方法charts
    public function charts()
    {
        //实例化模型
        $model = M();
        //组装sql语句
        $sql = "select t1.name as dept_name,count(t2.id) as count from tp_dept as t1 left join tp_user as t2 on t1.id = t2.dept_id
                group by dept_name having count > 0";
        //执行sql语句
        $data = $model -> query($sql);
        //拼凑Highcharts所需的数据
        $str = '[';
        foreach ($data as $key => $value)
        {
            $str .= "['" . $value['dept_name'] . "'," . $value['count'] . "],";
        }
        //去除最后一个多余的逗号
        $str = rtrim($str,',');
        //连上最后一个中括号
        $str .= ']';
        //将数据传递给模板
        $this -> assign('str',$str);
        //展示模板
        $this -> display();
    }
}