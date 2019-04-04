<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
	protected $connection = 'mysql_old';
	protected $table = 'webike_orders';
	protected $primaryKey = 'orders_id';
	public $timestamps = false;
	public function orders_products_id(){
		return $this->hasMany('App\OrdersProducts','orders_id','orders_id');//(模型，外键，本表主键)
	}
	public function orders_total_id(){
		return $this->hasMany('App\OrdersTotal','orders_id','orders_id');
	}
}
