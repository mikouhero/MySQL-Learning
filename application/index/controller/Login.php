<?php
/**
 * Created by PhpStorm.
 * User: Mikou
 * Date: 2017/12/29 0029
 * Time: 11:31
 */

namespace app\index\controller;

use think\Db;
use think\Request;
class Login
{
    public function index()
    {
        return view('index@Login/login');
    }

    public  function save()
    {

    }
}