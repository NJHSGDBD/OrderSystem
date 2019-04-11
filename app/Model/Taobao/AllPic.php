<?php

namespace App\Model\Taobao;

use Illuminate\Database\Eloquent\Model;

class AllPic extends Model
{
    protected $connection = "mysql_local";
    protected $table = "AllPic";
    protected $primarykey = "id";
    public $timestamps = false;
}
