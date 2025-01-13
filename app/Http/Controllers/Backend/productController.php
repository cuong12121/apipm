<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class productController extends Controller
{
    public function count_product_sale()
    {
        $product = DB::table('fs_products')->select('id')->get();

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
