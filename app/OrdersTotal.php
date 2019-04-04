<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdersTotal extends Model
{
	protected $connection = 'mysql_old';
	protected $table = 'webike_orders_total';
	protected $primaryKey = 'orders_total_id';
	public $timestamps = false;
}
