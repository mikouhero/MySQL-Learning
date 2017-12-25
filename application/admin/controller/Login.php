<?php

namespace app\admin\controller;

class Login
{
    /**
     * 后台登录页面
     * @return \think\response\View
     */
    public function index()
    {
        return view('admin@Login/login');
    }

}
