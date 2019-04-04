<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class localOrders extends Model
{
    protected $connection = 'mysql';
	protected $table = 'orders';
	protected $primaryKey = 'orders_id';
	public $timestamps = false;
	public function getNameAttribute(){
		if($this->delivery_name == 'YUE GAO'){
			return '1111111111111';
		}else{
			return '2222222222222';
		}
	}
}
