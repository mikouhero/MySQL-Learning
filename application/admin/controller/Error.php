<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Error extends Controller
{

    public function index()
    {
        $this->redirect('admin/Index/index');
    }


}
