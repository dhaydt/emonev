<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Data_Opd;
use App\Urusan_Opd;
use App\Dafunit;

use App\Rpjmd_Prog;
use App\Rpjmd_Prog_Indikator;
use App\Renja;
use App\Renja_Indikator;
use App\Renja_Indikator_Det;

use App\Program;
use App\Data_Sdgs;
//use App\Renstra_Keg;

use Validator;
class MasterSdgsController extends Controller
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
      $periode = request()->get('periode');
        $data_opd= Data_Opd::all();
        $opd= Urusan_Opd::all();
        $dafunit= dafunit::all();
       $rpjmd_prog= rpjmd_prog::where('unitkey','!=','0_')->where('id_status','=','1')->get();
        // $rpjmd_prog_non= rpjmd_prog::where('unitkey','0_')->where('id_status','=','1')->get();
        //dd($data_opd);
       // $sdgs=Data_Sdgs::where('periode',$periode)->get();
       $sdgs=Data_Sdgs::all();
        return view('admin.data.sdgs.index',compact('opd','dafunit','rpjmd_prog','data_opd','periode','sdgs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $store=[
                $request->nmfield => $request->vfield,
                'id_instansi' => $request->id_instansi,
                'idprgrm' => $request->idprgrm,
                'periode' => $request->periode
            ];
        $pesan="data disimpan";
        $cek=Data_Sdgs::where('periode',$request->periode)
        ->where('id_instansi',$request->id_instansi)
        ->where('idprgrm',$request->idprgrm)
        ->first();
        // simpan
        if ($cek === null) {
              Data_Sdgs::create($store);
              $pesan="data disimpan";
        }else{            
            $cek->update([$request->nmfield => $request->vfield]);
            $pesan="data disimpan";
        }
        $msg = array(
                'info' => 'Info',
                'store' => $store,
                'msg' => $pesan
              );
        return json_encode($msg);
    }
    public function data_sdgs()
    {
      $periode = request()->get('periode');
      $download = request()->get('download');
        $data_opd= Data_Opd::all();
        $opd= Urusan_Opd::all();
        $dafunit= dafunit::all();
       $rpjmd_prog= rpjmd_prog::where('unitkey','!=','0_')->where('id_status','=','1')->get();
       $renja=Renja::where('periode',2019)->where('bappeda',1)->get();
        // $rpjmd_prog_non= rpjmd_prog::where('unitkey','0_')->where('id_status','=','1')->get();
        //dd($data_opd);
       // $sdgs=Data_Sdgs::where('periode',$periode)->get();
       $sdgs=Data_Sdgs::all();
       if( Auth::guard('web')->check()){
        return view('admin.data.sdgs.data_sdgs',compact('opd','dafunit','rpjmd_prog','data_opd','periode','sdgs','renja','download'));
       }else{
        return view('admin.data.sdgs.data_sdgs2',compact('opd','dafunit','rpjmd_prog','data_opd','periode','sdgs','renja','download'));
        }
    }
}
