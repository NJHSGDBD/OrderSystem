<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class localManufacturers extends Model
{
    protected $connection = 'mysql';
	protected $table = 'webike_manufacturers';
	protected $primaryKey = 'manufacturers_id';
	public $timestamps = false;
}
