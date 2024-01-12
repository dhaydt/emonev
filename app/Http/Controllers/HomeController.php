<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Renja;
use App\Renja_Per;
use App\Periode_Renja;
use App\Rpjmd_Prog;
use App\Status_E55;
use App\Data_Opd;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
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
            $st=Status_E55::where('thn',$url)->get();
            $periode=$url;
        }else{
            $st=Status_E55::where('thn',request()->get('periode'))->get();
            $periode=request()->get('periode');
        }

        $periode_renja=Periode_Renja::where('id',$periode)->first();
        $jo=Data_Opd::count();
        
        $jk=Renja_Per::where('bappeda',1)->where('periode',$periode)->count();
        $tbl="renja_per";
        if($jk==""){
            $jk=Renja::where('bappeda',1)->where('periode',$periode)->count();
            $tbl="renja";
        }

        $jp=Rpjmd_Prog::
         whereExists(function ($query) use ($periode,$tbl){
            $query->select(DB::raw(1))
                  ->from($tbl)
                  ->where('bappeda',1)
                  ->whereRaw($tbl.'.id_instansi = rpjmd_prog.id_instansi')
                  ->whereRaw($tbl.'.idprgrm = rpjmd_prog.idprgrm')
                  ->whereRaw($tbl.'.periode = ?', $periode);
        })->where('id_periode_rpjmd',@$periode_renja->id_periode_rpjmd)->count();

        return view('home',compact('jk','st','jp','jo','periode'));
    }
}
