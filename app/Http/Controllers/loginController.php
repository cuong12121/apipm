<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;

class loginController extends Controller
{
    public function index(){
        
        if (Session::has('admin')) {
            
            return view('admin.admin');
            //
        }else{
            
            return view('login');
        }
       
    }  
    
    public function login(Request $request){
        
        $username =  trim($request->username);
        
        $password = trim($request->password);
        
        if($username ==='adminapi' && $password ==='123456123'){
            
            $data = ['admin'];
            
            $request->session()->put('admin', $data);
            
            return redirect(route('admin-view'));
            
            
        }
        else{
            return abort('403');
        }
    }
    
    public function view_admin(){
        
        if (Session::has('admin')) {
            
            return view('admin.admin');
            //
        }else{
            
            return redirect(route('view-login'));
        }
        
        
        
    }
    
    
    
}
