<?php

namespace app\admin\controller;

use think\Controller;

class Index extends Controller
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
