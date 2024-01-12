<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\hash;
use Illuminate\Support\Facades\Auth;

use App\Opd;

class OpdController extends Controller
{
    function masuk(Request $kiriman){
        //$hash=Hash::make($kiriman->password);
        $hash=md5($kiriman->password);
        $datalogin=Opd::where('username',$kiriman->username)->where('password',$hash)->get();

        if(count($datalogin)>0){
            // Auth::guard('opd')->LoginUsingId($datalogin[0]['id']);
            // Auth::guard('opd')->attempt(['username' => $kiriman->username,'password' => $hash]);
            Auth::guard('opd')->LoginUsingId($datalogin[0]['id']);
            //echo $datalogin[0]['id'];
            //echo Auth::user();
            //echo Auth::id();
            return redirect()->route('opd');
        }else{
            return redirect('/')->with('fail','Login Gagal');
        }
    }
    
    function keluar(){
        if(Auth::guard('opd')->check()){
            Auth::guard('opd')->Logout();
        }
        return redirect('/');
    }

}
