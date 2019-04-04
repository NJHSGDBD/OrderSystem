<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class localOrdersProducts extends Model
{
    protected $connection = 'mysql';
	protected $table = 'orders_products';
	protected $primaryKey = 'orders_products_id';
	public $timestamps = false;
}
