<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class orderController extends Controller
{
    public function getdata()
    {
    	$user_package_id = $_GET['id_user'];

    	$data  = DB::table('fs_order_uploads_detail')->orderBy('date_package', 'desc')->where('user_package_id', $user_package_id)->where('is_package',1)->paginate(12)->toArray();

    	if(!empty($data)):

    		return response($data);
    	else:
    	
    		return [];
    	endif;		

    }

    public function searchDataOrder(Request $request)
    {

    	if(!empty($request->search)):

    		$active =  $request->active;

    		if($active ==1):

		    	$clearData = trim($request->search);

		        $clearData = strip_tags($clearData);

		        $search = $clearData; 

		        $user_package_id = $request->user_package_id;
		        	

		        $orders = DB::table('fs_order_uploads_detail')->select('id')->where('is_package', 0)->where('tracking_code', $search)->first();

		        if(!empty($orders)):

		        	$update = DB::table('fs_order_uploads_detail')->where('id', $orders->id)->update(['is_package'=>1,'user_package_id'=>$user_package_id, 'date_package'=>date("Y-m-d H:i:s")]);
		        	return response('Đóng hàng thành công đơn hàng có mã đơn'.$search);
		        else:

		        	
		        	return response('Đóng hàng không thành công, vui lòng kiểm tra lại mã đơn');
		        endif;	
		    else:

		    	if($active ==0):
			    	$id = $request->search;

			    	$update = DB::table('fs_order_uploads_detail')->where('id', $id)->update(['is_package'=>0,'user_package_id'=>NULL, 'date_package'=>NULL]);
			    	return response('Hoàn thành công đơn hàng');

			    endif;	

			    return response('lỗi');

		    endif;    	

	    endif; 

	    // return response(1);   

    }
}
