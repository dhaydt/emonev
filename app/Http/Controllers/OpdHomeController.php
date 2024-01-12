<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Data_Opd;
use App\Renja;
use App\Renja_Per;
use App\Periode_Renja;
use App\Rpjmd_Prog;
use App\Status_E55;
use App\Rkpd_prog;
use App\Rkpd_keg;
use App\User;
use DB;
class OpdHomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:opd');
    }

    function index(){
        if (Auth::guard('opd')->check()) {
            //echo Auth::user();
            //echo Auth::id();

			 $jo=Data_Opd::count();
            $id_instansi=Auth::guard('opd')->user()->id_instansi;
            if(request()->get('periode')==""){
                //$url=url()->current();
                $url=date("Y");
            $host=request()->getHost();
            // $periode=request()->getHttpHost();
            $url=str_replace($host,'',$url);
            $url=str_replace('http:///','',$url);
            $url=str_replace('https:///','',$url);
            $url=substr($url,0,4);
            // return $url.'tes';
            // return redirect('http://'.$host.'/'.$url.'/home?periode='.$url);
   
                $st=Status_E55::where('id_instansi',$id_instansi)->where('thn',$url)->get();
                $periode=$url;
            }else{
                $st=Status_E55::where('id_instansi',$id_instansi)->where('thn',request()->get('periode'))->get();
                $periode=request()->get('periode');
            }

            $jk=Rkpd_keg::where('idopd',$id_instansi)->count();
            $tbl="renja_per";
            if($jk==""){
                $jk=Renja::where('id_instansi',$id_instansi)->where('bappeda',1)->where('periode',$periode)->count();
                $tbl="renja";
            }

            $periode_renja=Periode_Renja::where('id',$periode)->first();

            $jp=Rkpd_prog::where('idopd',$id_instansi)->count();

            
            $opd=Data_Opd::where('id',$id_instansi)->first();

            $id_akun=Auth::guard('opd')->user()->id;
            
            return view('opd.index',compact('jp','jk','opd','jo','periode','st','id_instansi','id_akun'));
        }
    }
}
