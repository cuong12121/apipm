<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class productController extends Controller
{

    public function getdata_order_to_time()
    {
        $data =  DB::table('fs_order_uploads_detail')->where('created_time','>','2024-06-01')->get()->toArray();

        $redis->connect('127.0.0.1', 6379);

        $results = json_encode($data);

        $keyExists = $redis->exists('data_order_new_2024');

        if ($keyExists) {
            $redis->del("data_order_new_2024");

        }   
        $redis->set("data_order_new_2024", $results);

        echo "thành công";

    }

    public function count_product_sale()
    {

        $data_order = $this->getdata_order_to_time();

        echo "thành công";

        die;
        $product = DB::table('fs_products')->select('id')->where('id', '>=',37898354)->get();

        $number_sale = [];


        foreach ($product as $key => $value) {

            $sl = DB::table('fs_order_uploads_detail')->select('id')->where('is_package',1)->where('sp_duoc_tro_gia_tu_shp','!=',2)->where('product_id',$value->id)->get();

            $number_sale[$value->id] = $sl->count();

        }


        $redis = new \Redis();

        // Thiết lập kết nối
        $redis->connect('127.0.0.1', 6379);

        $results = json_encode($number_sale);

        $keyExists = $redis->exists('count_product_sale');

        if ($keyExists) {
            $redis->del("count_product_sale");

        }   
        $redis->set("count_product_sale", $results);

        echo "thành công";

        
    }
}
