<?php

namespace app\admin\model;

use think\Model;

class categorys extends Model
{
    public function getAdminCate()
    {
        $list = Db::name('test_object')->filed(['id','name','pa'])->select();
        return $list;
    }
}
