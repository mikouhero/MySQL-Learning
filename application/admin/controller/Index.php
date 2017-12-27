<?php

namespace app\admin\controller;

use think\Controller;
use think\Session;

class Index extends Admin
{

    /**
     * 后台主页
     * @return \think\response\View
     */
    public function index()
    {
        return view('admin@Index/index');
    }

}
