<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Data_Opd;
use App\Urusan_Opd;
use App\Dafunit;
use App\Renja;
use App\Renja_Indikator;
use App\Renja_Indikator_Det;

use App\Renja_Per;

use DB; 
use App\Rpjmd_Prog;
use App\Rpjmd_Prog_Indikator;

use App\Realisasi;
use App\Realisasi_Target;
use App\Realisasi_Tprog;

use App\Status_E55;

//excel eksport
use App\Exports\EvaluasiRenja_Report;
use App\Exports\EvaluasiRkpd_Report;
use Maatwebsite\Excel\Facades\Excel;
class MonitoringEvaRkpdController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:opd');
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function index()
    {
        //session cek
        if (!Auth::guard('opd')->check() and !Auth::guard('web')->check()){
            return redirect('/');
        }

        $periode = request()->get('periode');
        $triwulan = request()->get('pilih_triwulan');
        $data_renja = request()->get('data_renja');
        $data_opd_all= Data_Opd::all();        
        if (Auth::guard('web')->check()) {
            $data_opd= Data_Opd::all();
            $opd= Urusan_Opd::all();
            // $opd= Urusan_Opd::whereIn('id_instansi',[4,6,162])->get();
        }else{
            $id_instansi=Auth::guard('opd')->user()->id_instansi;
            $data_opd= Data_Opd::where('id',$id_instansi)->get();
            $opd= Urusan_Opd::where('id_instansi',$id_instansi)->get();
            //dd($data_opd);
        }

        $dafunit= dafunit::all();
       if(Request()->get('data_renja')=="awal"){
          $rpjmd_prog= rpjmd_prog::
             whereExists(function ($query) {
                $query->select(DB::raw(1))
                      ->from('renja')
                      ->whereRaw('renja.id_instansi = rpjmd_prog.id_instansi')
                      ->whereRaw('renja.idprgrm = rpjmd_prog.idprgrm')
                      ->whereRaw('renja.periode = ?', [request()->get('periode')]);
            })
          ->where('unitkey','!=','0_')
          ->where('id_status','=','1')
          ->get();
          
          // $rpjmd_prog_non= rpjmd_prog::       
          // //with('renja')
          // join('renja', 'renja.id_instansi', '=', 'rpjmd_prog.id_instansi')
          // ->where('renja.idprgrm','rpjmd_prog.idprgrm')
          // ->where('renja.id_instansi','rpjmd_prog.id_instansi')
          
            $rpjmd_prog_non=Rpjmd_prog::
            whereExists(function ($query) {
                  $query->select(DB::raw(1))
                        ->from('renja')
                        ->whereRaw('renja.id_instansi = rpjmd_prog.id_instansi')
                        ->whereRaw('renja.idprgrm = rpjmd_prog.idprgrm')
                        ->whereRaw('renja.periode = ?', [request()->get('periode')]);
              })
            ->where('rpjmd_prog.unitkey','0_')
            ->where('rpjmd_prog.id_status','=','1')
            ->get();
        }elseif(Request()->get('data_renja')=="perubahan"){
          $rpjmd_prog= rpjmd_prog::
             whereExists(function ($query) {
                $query->select(DB::raw(1))
                      ->from('renja_per')
                      ->whereRaw('renja_per.id_instansi = rpjmd_prog.id_instansi')
                      ->whereRaw('renja_per.idprgrm = rpjmd_prog.idprgrm')
                      ->whereRaw('renja_per.periode = ?', [request()->get('periode')]);
            })
          ->where('unitkey','!=','0_')
          ->where('id_status','=','1')
          ->get();
          
            $rpjmd_prog_non=Rpjmd_prog::
            whereExists(function ($query) {
                  $query->select(DB::raw(1))
                        ->from('renja_per')
                        ->whereRaw('renja_per.id_instansi = rpjmd_prog.id_instansi')
                        ->whereRaw('renja_per.idprgrm = rpjmd_prog.idprgrm')
                        ->whereRaw('renja_per.periode = ?', [request()->get('periode')]);
              })
            ->where('rpjmd_prog.unitkey','0_')
            ->where('rpjmd_prog.id_status','=','1')
            ->get();
        }else{
          return redirect('monitoring_evaluasi_rkpd?data_renja=awal');
        }

        $statuse55=Status_E55::all();
        
        return view('admin.data.monitor_eva_rkpd.index',compact('opd','dafunit','data_opd','data_opd_all','periode','rpjmd_prog','rpjmd_prog_non','statuse55','triwulan','data_renja'));
    }

    public function show_evaluasi_renja(Request $request,$periode,$triwulan,$id,$id_instansi,$data_renja)
    {
        //session cek
        if (!Auth::guard('opd')->check() and !Auth::guard('web')->check()){
            return redirect('/');
        }
        //$periode=$periode;
        $prog= Rpjmd_Prog::where('idprgrm',$id)->where('id_instansi',$id_instansi)->first();
//        $rpjmd_prog_indikator= Rpjmd_Prog_Indikator::where('idprgrm',$id)->where('id_instansi',$id_instansi)->get();
        if($data_renja=="awal"){
          $renja=Renja::where('periode',$periode)->where('id_instansi',$id_instansi)
          ->where('idprgrm',$id)
          ->where('bappeda',1)
          ->get();
        }elseif($data_renja=="perubahan"){
          $renja=Renja_Per::where('periode',$periode)->where('id_instansi',$id_instansi)
          ->where('idprgrm',$id)
          ->where('bappeda',1)
          ->get();
        }
        return view('admin.data.monitor_eva_rkpd.modal_renja',compact('prog','renja','periode','triwulan','data_renja'))->renderSections()['content'];
    }
}
