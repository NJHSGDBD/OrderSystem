<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class localOrdersTotal extends Model
{
    protected $connection = 'mysql';
	protected $table = 'orders_total';
	protected $primaryKey = 'orders_total_id';
	public $timestamps = false;
}
