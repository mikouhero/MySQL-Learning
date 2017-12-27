<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;

class Node extends Admin
{
    public function index()
    {
        $data = Db::name('node')->select();
        // var_dump($data);die;
        return view('admin@node/index',[
            'list'=>$data
        ]);
    }

    public function create()
    {
        return view('admin@node/create');
    }

    public function save(Request $request)
    {
       $data = $request->post();
       $result = Db::name('node')->insert($data);
       if ($result >0) {
           $this->success('添加成功','node/index');
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
        $data = Db::name('node')->find($id);
       return view('admin@node/edit',[
           'list'=>$data
       ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->post();
        $result = Db::name('node')->where(['id'=>$id])->update($data);
       if ($result>0) {
           $this->success('修改成功','node/index');
       } else {
           $this->error('修改失败');
       }
    }

    public function delete($id)
    {
        $result = Db::name('node')->where(['id'=>$id])->delete();
        if ($result>0) {
            $this->success('删除成功','Node/index');
        } else {
            $this->error('删除失败');
        }
    }
}
