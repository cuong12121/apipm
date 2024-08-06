<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class orderController extends Controller
{
    public function getdata()
    {
    	$user_package_id = $_GET['id_user']??'';

    	if(!empty($user_package_id)):

    		$data  = DB::table('fs_order_uploads_detail')->orderBy('date_package', 'desc')->where('user_package_id', $user_package_id)->where('is_package',1)->paginate(12)->toArray();
        else:
        	$data  = DB::table('fs_order_uploads_detail')->orderBy('date_package', 'desc')->where('is_package',1)->paginate(12)->toArray();	

        endif;

    	if(!empty($data)):

    		return response($data);
    	else:
    	
    		return [];
    	endif;		

    }


    public function SearchDataOfUser(Request $request)
    {
    	$date1 =  $request->date1;

    	$date2 =  $request->date2;


		$startOfDay = Carbon::parse($date1)->startOfDay();
		$endOfDay = Carbon::parse($date2)->endOfDay();

		

    	$user_package_id = $request->name;

    	if(!empty($date1) && !empty($user_package_id)&&!empty($user_package_id)){
    		
    		$data = DB::table('fs_order_uploads_detail')->where('is_package', 1)->where('user_package_id', $user_package_id)->whereBetween('date_package', [$startOfDay, $endOfDay])->orderBy('date_package', 'desc')->paginate(12)->toArray();

	    	if(!empty($data)):

	    		return response($data);
	    	else:
	    	
	    		return [];
	    	endif;		
    	}

    	

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
		        	
		        $checkorders = DB::table('fs_order_uploads_detail')->select('id')->where('is_package', 1)->where('tracking_code', $search)->get();

		        $orders = DB::table('fs_order_uploads_detail')->select('id')->where('is_package', 0)->where('tracking_code', $search)->last();

		        if(empty($checkorders) && !empty($orders)):

			        
			        	
				    $update = DB::table('fs_order_uploads_detail')->where('id', $orders->id)->update(['is_package'=>1,'user_package_id'=>$user_package_id, 'date_package'=>date("Y-m-d H:i:s")]);

				        
			        
			        return response('Đóng hàng thành công '.$orders->count().' đơn hàng có mã vận đơn: '.$search);
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
