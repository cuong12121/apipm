<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class orderController extends Controller
{
    public function getdata()
    {
    	$data  = DB::table('fs_order_uploads_detail')->orderBy('id', 'desc')->paginate(8)->toArray();

    

    	dd($data);

    }
}
