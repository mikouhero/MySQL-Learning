<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;

class User extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //查询user 表中的 用户名 和姓名
        $list = Db::name('user')->field(['id','username','name'])->select();
        // 查询对应用户的角色 role


        $arr = array(); //声明一个空数组
        //遍历用户信息
        foreach($list as $v) {
            // 查询对应用户的  角色id =>　rid　　　　uid = user.id
            $role_ids = Db::name('_user_role')->field('rid')->where(array('uid' => array('eq', $v['id'])))->select();
            // dump($role_ids);die;
            //定义空数组
            $roles = array();
            //遍历
            //查询角色表名称 _role 表  role表中的id  对应的是 用户角色表中的rid
            foreach ($role_ids as $value) {
                $roles[] = Db::name('_role')->where(array('id' => array('eq', $value['rid']), 'status' => array('eq', 1)))->value('name');

            }
            $v['role'] = $roles; //将新得到角色信息放置到$v中
            // dump($v);die;
            $arr[] = $v;
        }
        // var_dump($arr);die;
        return view('admin@User/index',[
            'list'=>$arr
        ]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $list = Db::name('user')->field(['username','name'])->find($id);
        // var_dump($list);
        return view('admin@user/edit');
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        return '删除';
    }

    public function send()
    {
        return '分配角色界面';
    }
}
