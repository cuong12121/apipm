<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use Auth;

class adminController extends Controller
{
    public function loginAdminUser(Request $request)
    {


        return redirect(route('table'));
        // $email =  strip_tags(trim($request->email), '@') ;

        // $password = $request->password;

        // $check  =   DB::table('admins')->where('email', $email)->first();

        // if(!empty($check)){
        //     $data = [
        //         'email' => $email,
        //         'password' => $password,
        //     ];

        //     if (Auth::guard('admin')->attempt($data)) {

        //         return redirect(route('table'));
                
                   
        //     } else {
                
        //          echo "thất bại";
        //     }

        // }
       
    }
}
