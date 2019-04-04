<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class orders_testTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Db::table('orders_test')->insert([
        	'orders_id'=>002,
        	'products_id'=>002,
        	'customers_id'=>002,
        	'delivery_name'=>'name',
        	'date_purchased'=>'2019-03-11 01:30:30',
        ]);
    }
}
