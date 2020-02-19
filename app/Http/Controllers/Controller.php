<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function updateSession(Request $request){
        $session_name = $request->session_name;
        $session_value = $request->session_value;
        session([$session_name=>$session_value]);
        return json_encode([$session_name=>$session_value]);
    }

    public function redirect(){
        if(Auth::user()){
            if(Auth::user()->type == 'Admin' || Auth::user()->type == 'Trainer'){
                return redirect('/trainer/dashboard');
            }else{
                return redirect('/trainee/dashboard');
            }
        }

        return redirect('login');
    }
}
