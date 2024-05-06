<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class orderController extends Controller
{
    public function getdata()
    {
    	$data  = DB::table('fs_order_uploads_detail')->orderBy('id', 'desc')->paginate(12)->toArray();

    	return response($data);

    }

    public function searchDataOrder(Request $request)
    {

    	if(!empty($request->search)):
	    	$clearData = trim($request->search);

	        $clearData = strip_tags($clearData);

	        $search = $clearData; 
	        	

	        $orders = DB::table('fs_order_uploads_detail')->select('product_name','shop_name','shop_code','date','record_id', 'total_price', 'count', 'tracking_code','shop_name')->where('tracking_code', 'like', '%'.$search.'%')->Orwhere('shop_code', $search)->Orwhere('shop_name', $search)->take(12)->OrderBy('id','desc')->get();

	        if(!empty($orders)):

	        	return response($orders);
	        else:

	        	$array = [];
	        	return response($array);
	        endif;	
	    endif;    

    }
}
