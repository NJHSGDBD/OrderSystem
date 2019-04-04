<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdersProducts extends Model
{
	protected $connection = 'mysql_old';
	protected $table = 'webike_orders_products';
	protected $primaryKey = 'orders_products_id';
	public $timestamps = false;
}