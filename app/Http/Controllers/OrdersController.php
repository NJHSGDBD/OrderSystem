<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orders as Orders;
use App\Products as Products;
use App\localOrders as localOrders;
use App\localOrdersProducts as localOrdersProducts;
use App\localOrdersTotal as localOrdersTotal;
use App\localManufacturers as localManufacturers;

class OrdersController extends Controller
{
    public function deleteValues($date){
        $orders_values = localOrders::where('date_purchased','REGEXP',$date)->delete();
    }
    public function getValues($date1="0",$date2="0"){

        ini_set('max_execution_time', 0);
        ini_set("memory_limit", 1048576000);

        $orders_json = Orders::where([['date_purchased','>',$date1],['date_purchased','<=',$date2]])->select('orders_id','date_purchased','orders_status','customers_id','customers_name','customers_email_address','customers_state','customers_country','delivery_state','delivery_country','shipping_method')->get();

        if($orders_json == "[]"){
            return "没有最新的数据";
        }else{
            foreach($orders_json as $order){
                $this->setOrders($order);
                $this->setOrdersProducts($order['orders_id']);
                $this->setOrdersTotal($order['orders_id']);
            }
            return "success";
        }
    }
public function read($date1="0",$date2="0"){

    ini_set('max_execution_time', 0);
    $orders_json = '';
    $resarr = array();
    $resarrs = array();
    if($date1 == "0" && $date2 == "0"){
        // $orders_json = localOrders::orderBy('orders_id','desc')->get();
    }else{
        $orders_json='';
        if($date1 != "0" && $date2 == "0"){
            $orders_json = localOrders::where('date_purchased','REGEXP',$date1)->orderBy('orders_id','desc')->get();
        }else if($date1 == "0" && $date2 != "0"){
            $orders_json = localOrders::where('date_purchased','REGEXP',$date2)->orderBy('orders_id','desc')->get();
        }else if($date1 != "0" && $date2 != "0"){

            $orders_json = localOrders::whereBetween('date_purchased',[$date1.' 00:00:00',$date2.' 23:59:59'])->orderBy('orders_id','desc')->get();
        }
        // whereBetween('date_purchased',['2019-03-26 00:00:00','2019-03-31 00:00:00'])
        // return $orders_json;
        // $orders_json = localOrders::all();
        foreach($orders_json as $orders){

            $products_json = $this->readProducts($orders['orders_id']);

            foreach ($products_json as $product_json) {

                $order_json = localOrders::find($orders['orders_id']);
                $orders_subtotal_json = localOrdersTotal::where('orders_id',$orders['orders_id'])->select('value')->first();

                $orders_subtotal = json_decode($orders_subtotal_json,true);
                $order = json_decode($order_json,true);
                $product = json_decode($product_json,true);

                $manufacturers_name = $this->getManufacturers($product['manufacturers_id']);

                $manufacturers = array('manufactruers' => $manufacturers_name['manufacturers_name']);
                $subtotal = array('orders_subtotal' => $orders_subtotal['value']);
                $kind = array('kind' => 'retail');
                $resarr = array_merge($order,$product,$subtotal,$manufacturers,$kind);

                array_push($resarrs, $resarr);
                unset($resarr);

            }
        }
        return json_encode($resarrs);
    }
}
public function readProducts($orders_id){
    $products_json = localOrdersProducts::where('orders_id',$orders_id)->get();
    return $products_json;
}
//保存订单信息
public function setOrders($order){
    $local = new localOrders;
    $local->orders_id = $order['orders_id'];
    $local->date_purchased = $order['date_purchased'];
    $local->orders_status = $order['orders_status'];
    $local->customers_id = $order['customers_id'];
    $local->customers_name = $order['customers_name'];
    $local->customers_email_address = $order['customers_email_address'];
    $local->customers_state = $order['customers_state'];
    $local->customers_country = $order['customers_country'];
    $local->delivery_state = $order['delivery_state'];
    $local->delivery_country = $order['delivery_country'];
    $local->shipping_method = $order['shipping_method'];
    $local->save();
}
//保存订单商品信息
public function setOrdersProducts($orders_id){
    //表关联
    $orders_products = Orders::find($orders_id)->orders_products_id;
    //删除已存在的数据
    localOrdersProducts::where('orders_id',$orders_id)->delete();

    foreach ($orders_products as $orders_product) {
        $manufacturers_id_json = Products::select('manufacturers_id')->find($orders_product['products_id']);
        $manufacturers_id = json_decode($manufacturers_id_json,true);
        $localOrdersProducts = new localOrdersProducts;
        $localOrdersProducts->orders_products_id = $orders_product['orders_products_id'];
        $localOrdersProducts->orders_id = $orders_product['orders_id'];
        $localOrdersProducts->products_id = $orders_product['products_id'];
        $localOrdersProducts->products_model = $orders_product['products_model'];
        $localOrdersProducts->products_name = $orders_product['products_name'];
        $localOrdersProducts->products_price = $orders_product['products_price'];
        $localOrdersProducts->products_quantity = $orders_product['products_quantity'];
        $localOrdersProducts->manufacturers_id = $manufacturers_id['manufacturers_id'];
        $localOrdersProducts->save();
    }
}
//保存订单小计
public function setOrdersTotal($orders_id){
    $orders_total = Orders::find($orders_id)->orders_total_id;

    localOrdersTotal::where('orders_id',$orders_id)->delete();

    foreach($orders_total as $total){
        $localOrdersTotal = new localOrdersTotal;
        $localOrdersTotal->orders_total_id = $total['orders_total_id'];
        $localOrdersTotal->orders_id = $total['orders_id'];
        $localOrdersTotal->title = $total['title'];
        $localOrdersTotal->text = $total['text'];
        $localOrdersTotal->value = $total['value'];
        $localOrdersTotal->save();
    }

}
//获取厂家名称
public function getManufacturers($manufacturers_id){
    $manufactruers = localManufacturers::select('manufacturers_name')->find($manufacturers_id);
    return json_decode($manufactruers,true);
}
//获取最新的更新日期
public function getLatestUpdate(){
    $date = localOrders::select('date_purchased')->orderBy('date_purchased','desc')->first();
    return $date;
}
public function setCate(Request $request){
    localOrdersProducts::where('orders_id',147582)->delete();
}
}
