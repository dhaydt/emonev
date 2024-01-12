<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Opd;
use App\User;
class LogActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index(){
      $opd=Opd::all();
      $user=User::all();
      return view('admin.log_activity',compact('opd','user'));
    }
}
