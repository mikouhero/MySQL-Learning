<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;
use think\Session;

class Login extends Controller
{
    public function _empty()
    {
        $this->redirect('admin/Index/index');
    }
    public function index()
    {
        return view('admin@login/index');
    }


    public function dologin(Request $request)
    {
        $data = $request->post();
        //验证密码
        $username = $data['username'];
        $userpass = $data['userpass'];
        $code = $data['code'];
        if(!captcha_check($code))
        {
            $this->error("验证码错误");
        };

            // var_dump($data);
        //验证用户名
        $user = Db::name('user')->where(['username'=>$username])->find();
        // var_dump($user);die;
        if(!$user) {
            $this->error('用户名不存在');
            exit;
        }
        if($user['userpass'] != md5($userpass)){
            $this->error('密码错误');
            exit;
        }
        // 将用户信息添加到 session
        Session::set('admin_user',$user);
        $kk = Session::get('admin_user');
        // dump($kk);die;

        //根据用户的id  获取对应得节点

        //获取用户角色
        $urole = Db::name('user_role')->where(['uid'=>['eq',$user['id']]])->select();
        // dump($urole);
        foreach( $urole as $v)
        {
            $rolelist[] = $v['rid'];
        }
        // dump($rolelist);

        // 通过角色id  查询对应得节点  role_node.rid in $rolelist
        $unode = Db::name('role_node')->where(['rid'=>['in',$rolelist]])->select();
        // var_dump($kk);
        // 重组  nodelist 既是节点的id
        foreach($unode as $v){
            $nodelist[] = $v['nid'];
        }
        // var_dump($nodelist);
        // 查询指定用户的node表中的相关信息
        $usernode = Db::view('node',['mname','aname'])->where(['id'=>['in',$nodelist]])->select();
        // var_dump($usernode);
        //控制器名大写
        foreach ($usernode as $key=>$value){
            $usernode[$key]['mname'] = ucfirst($value['mname']);
        }
        // var_dump($usernode);

        //$list 指定登录用户可用的 控制器=>方法
        $list = array();
        $list['Index'] = array('index');
        // var_dump($list);die;
        //遍历重新拼装
        foreach($usernode as $vo){
            $list[$vo['mname']][] = $vo['aname'];
            // 把修改和执行修改 添加和执行添加 拼装到一起
            if($vo['aname']=="edit"){
                $list[$vo['mname']][]="save";
            }
            if($vo['aname']=="add"){
                $list[$vo['mname']][]="doadd";
            }
        }
        // var_dump($list);die;
        // 将权限分配到session中
        Session::set('admin_user.nodelist',$list);
        // var_dump($_SESSION['think']['admin_user']);
        // var_dump(Session::get('admin_user.nodelist'));die;


        //跳转到首页
        $this->redirect('Index/index');

    }

    public function loginout()
    {
        //	删除（当前作用域） Session::delete('name');
        // //	删除think作用域下面的值 Session::delete('name','think')
        // 清空session
        // $data = Session::get('admin_user');
        // $data1 = Session::delete('admin_user');
        // var_dump(Session::get('admin_user'));die;
        Session::delete('admin_user');

        // 跳转页面
        $this->redirect('admin/Index/index');
    }


}
