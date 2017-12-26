<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;

class User extends Controller
{

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
        return view('admin@user/create');
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $data = $request->put();
        $info['name'] = $data['name'];
        $info['username'] = $data['username'];
        $info['userpass'] = md5($data['userpass']);
        $result = Db::name('user')->insert($info);
        if ($result>0) {
            $this->success('添加成功','user/index');
        } else {
            $this->error('添加失败');
        }
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
        $list = Db::name('user')->field(['id','username','name'])->find($id);

        return view('admin@user/edit',[
            'list'=>$list
        ]);
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
        $info = $request->post();
        $result = Db::name('user')->where('id', $id)->update($info);
        if ($result > 0) {
            $this->success('修改成功','admin/user/index');
        } else {
            $this->success('修改失败');
        }

    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        // 删除用户的同时  同时也删除 user_role 表中对应得角色 user id = role_user.uid
        //有bug 未分配角色 开启事务
        $deluser = Db::name('user')->delete($id) ;
        $delrole= Db::name('user_role')->where(array('uid'=>array('eq',$id)))->delete();
        if ($deluser> 0  ) {
            $this->success('删除成功','User/index');
        } else {
            $this->error('删除失败');
        }
        return '删除';

    }

    public function rolelist($id)
    {
        // 获取用户id  查询user_role中uid = id
        // 遍历 role 中的角色
        $list = Db::name('role')->where(['status'=>1])->select();
        // var_dump($list);die;
        $user = Db::name('user')->where(['id'=>$id])->find($id);
        // 查询用户角色的相关信息
        $rolelist =Db::name('user_role')->where(array('uid'=>array('eq',$id)))->select();

        $myrole = array(); //定义空数组
        //对用户的角色进行重组
        foreach($rolelist as $v){
            $myrole[] = $v['rid'];
        }
        // var_dump($user);
        // var_dump($myrole);
        // var_dump($list);die;
        return view('admin@user/rolelist',[
            'list'=>$list,
            'user'=>$user,
            'role'=>$myrole
        ]);
    }

    public function saverole(Request $request,$id)
    {
        $data = $request->put();
        if (empty($data['role'])) {
        $this->error('请选择一个角色');
    }
        //清除用户所有的角色信息，避免重复添加
        $del = Db::name('user_role')->where(array('uid'=>array('eq',$id)))->delete();
        // dump($del);
        // dump($data['role']);
        foreach($data['role'] as $v){
            $info['uid'] = $id;
            $info['rid'] = $v;
            //执行添加
           $result =  Db::name('user_role')->insert($info);
           // dump($result);
        }

        if ($result>0 ) {
            $this->success('分配成功','User/index');
        } else {
            $this->error('分配失败');
        }
    }
}
