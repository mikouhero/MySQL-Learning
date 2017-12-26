<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;

class Role extends Controller
{

    public function index()
    {
        $data = Db::name('role')->select();
        return view('admin@role/index',[
            'list'=>$data
        ]);
    }

    public function create()
    {
        return view('admin@role/create');
    }

    public function save(Request $request)
    {
        $data = $request->post();
        $result = DB::name('role')->insert($data);
        if ($result > 0) {
            $this->success('添加成功','role/index');
        } else {
            $this->error('添加失败');
        }
    }


    public function read($id)
    {
        //
    }


    public function edit($id)
    {
        $data = Db::name('role')->find($id);
        return view('admin@role/edit',[
            'list'=>$data
            ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->post();
        $result = Db::name('role')->where(['id'=>$id])->update($data);
        if ($result > 0) {
            $this->success('修改成功','role/index');
        } else {
            $this->error('修改失败');
        }
    }


    public function delete($id)
    {
      // 删除一个角色  role 中对应得$id
        //同时删除用户对应得角色 user_role 中 rid = $id
        // 删除角色所对应的节点 role_node  中  rid = $id
        // 有bug
            $data = Db::name('role')->where(['id'=>$id])->delete();
            $dataur = Db::name('user_role')->where(['rid'=>$id])->delete();
            $datarn = Db::name('role_node')->where(['rid'=>$id])->delete();

        if ($data > 0 && $datarn > 0 && $dataur > 0) {
            $this->success('删除成功','role/index');
        } else {
            $this->error('删除成功');
        }
    }

    //角色的权限列表
    public function nodelist($id)
    {
        //所有的节点 node 表  遍历出来
        $nodes = Db::name('node')->select();

        // 获取该角色的相关信息 role表  条件 role.id = $id
        $role = Db::name('role')->find($id);

        //查找该角色所有的权限 role_node 表  条件 role.node.rid = $id
        $data = Db::name('role_node')->where(['rid'=>$id])->select();

        //指定id角色的节点权限
        $list =  array();
        foreach ($data as $v) {
            $list[] = $v['nid'];
        }
        return view('admin@role/nodelist',[
            'nodes'=>$nodes,
            'role'=>$role,
            'list'=>$list
        ]);
    }

    public function savenode(Request $request,$id)
    {
        $data = $request->post();
        if(empty($data['node'])){
            $this->error('请分配权限');
            die;
        }
        //清空role_node表中 角色的节点 rid = $id
        $del = Db::name('role_node')->where(['rid'=>$id])->delete();
        foreach ($data['node'] as $v){
            $info['nid'] = $v;
            $info['rid'] = $id;
            $result = Db::name('role_node')->insert($info);
        }

        if ($result>0) {
            $this->success('修改成功','Role/index');
        } else {
            $this->error('修改失败');
        }
    }
}
