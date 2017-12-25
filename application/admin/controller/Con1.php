<?php

namespace app\admin\controller;

use think\Controller;

class Con1 extends Controller
{
    public function index()
    {
        return view('admin@con1/tables');
    }

    public function func1()
    {
        return view('admin@con1/func1');
    }

    public function func2()
    {
        return view('admin@con1/func2');
    }

}