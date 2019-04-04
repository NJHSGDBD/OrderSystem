<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MysqlUser extends Model
{
    protected $connection = 'mysql_test';
    protected $table='user';
    protected $primaryKey = 'id';
    public $timestamps = false;
    // protected $keyType = 'string';
    public function getDisplayNameAttribute(){
    	if($this->name == 'L'){
    		return 'LLLLL';
    	}
    }
    public function setNameAttribute($value){
    	$this->attributes['name'] = 'LLLLLLLLLL';
    }
}
