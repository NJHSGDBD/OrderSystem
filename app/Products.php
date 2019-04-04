<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
	protected $connection = 'mysql_old2';
	protected $table = 'webike_products';
	protected $primaryKey = 'products_id';
	public $timestamps = false;

}
