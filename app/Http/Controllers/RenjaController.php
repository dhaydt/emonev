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
use App\Renja_Indikator_Per;
use DB; 
use App\Rpjmd_Prog;
use App\Rpjmd_Prog_Indikator;

use App\Realisasi;
use App\Realisasi_Target;
use App\Realisasi_Tprog;
use App\Realisasi_Tkegiatan;

use App\Rkpd_prog;
use App\Rkpd_keg;
use App\Rkpd_subkeg;
use App\Periode_Renja;
use App\Periode_Rpjmd;

use App\Status_E55;

//excel eksport
use App\Exports\EvaluasiRenja_Report;
use App\Exports\EvaluasiRkpd_Report;
use Maatwebsite\Excel\Facades\Excel;
class RenjaController extends Controller
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
        $data_opd_all= Data_Opd::all();        
        if (Auth::guard('web')->check()) {
            $data_opd= Data_Opd::all();
            if($periode==2022){
                $opd= Urusan_Opd::where('th_awal','=',2022)->orderBy('urutan')->get();
            }else{
                $opd= Urusan_Opd::where('th_awal','=',2023)->orderBy('urutan')->get();    
            }
            
            // $opd= Urusan_Opd::whereIn('id_instansi',[4,6,162])->get();
        }else{
            $id_instansi=Auth::guard('opd')->user()->id_instansi;
            $data_opd= Data_Opd::where('id',$id_instansi)->get();
            $opd= Urusan_Opd::where('id_instansi',$id_instansi)->where('th_awal','=',$periode)->get();
            //dd($data_opd);
        }

        $dafunit= dafunit::all();
        
        if(Request()->get('data_renja')=="awal"){
          $rpjmd_prog= Rkpd_prog::
             whereExists(function ($query) {
                $query->select(DB::raw(1))
                      ->from('rkpd_subkeg')
                      // ->whereRaw('renja.id_instansi = rpjmd_prog.id_instansi')
                      // ->whereRaw('renja.idprgrm = rpjmd_prog.idprgrm')
                      // ->whereRaw('renja.periode = ?', [request()->get('periode')]);
                ->whereRaw('rkpd_subkeg.subkeg_awal = ?','1')
                ->whereRaw('rkpd_subkeg.idopd = rkpd_prog.idopd')
                ->whereRaw('rkpd_prog.idprog=SUBSTRING(rkpd_subkeg.idsubkeg,1,7)')
                ->whereRaw('rkpd_subkeg.periode = ?', [request()->get('periode')]);
            })
          // ->where('unitkey','!=','0_')
          // ->where('id_status','=','1')
         ->where('prog_awal','=','1')
         ->where('periode','=',$periode)
          ->select(DB::raw('rkpd_prog.*,SUBSTRING(idprog,1,4)as unitkey'))
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
          // $rpjmd_prog_non=array();
        }elseif(Request()->get('data_renja')=="perubahan"){
          $rpjmd_prog= Rkpd_prog::
             whereExists(function ($query) {
                $query->select(DB::raw(1))
                      ->from('rkpd_subkeg')
                      ->whereRaw('rkpd_subkeg.subkeg_perubahan = ?','1')
                      ->whereRaw('rkpd_subkeg.idopd = rkpd_prog.idopd')
                      ->whereRaw('rkpd_prog.idprog=SUBSTRING(rkpd_subkeg.idsubkeg,1,7)')
                      ->whereRaw('rkpd_subkeg.periode = ?', [request()->get('periode')]);

                      // whereRaw("id=SUBSTRING('".$this->id."', 1, 4)")
            })
          ->where('prog_perubahan','=','1')
          ->where('periode','=',$periode)
          ->select(DB::raw('rkpd_prog.*,SUBSTRING(idprog,1,4)as unitkey'))
          ->get();
// dd($rpjmd_prog);
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
          // $rpjmd_prog_non=array();
        }else{
          return redirect('evaluasi-renja?data_renja=awal');
        }
        $periode_renja=Periode_Renja::where('aktiv', 1)->get();

        // $rpjmd_prog_non=Rpjmd_Prog::select('select * from rpjmd_prog,renja where rpjmd_prog.idprgrm=renja.idprgrm and renja.id_instansi=rpjmd_prog.id_instansi');
//        dd($rpjmd_prog_non);

        $statuse55=Status_E55::all();
        if(Request()->get('data_renja')=="perubahan"){$data_renja="perubahan";}else{$data_renja="awal";}
        return view('admin.data.rkpd.index',compact('opd','dafunit','data_opd','data_opd_all','periode','rpjmd_prog','rpjmd_prog_non','statuse55','triwulan','data_renja','periode_renja'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //session cek
        if (!Auth::guard('opd')->check() and !Auth::guard('web')->check()){
            return redirect('/');
        }
        $pesan = 'gagal disimpan...!';
        $store=null;

        // $request=json_decode($request,true);
        // $validator = Validator::make(request()->all(), [
        //     'id_renja'  => 'required',
        //     'id_target'  => 'required',
        //     'rp5.*'  => 'double',
        //     'rp6.*'  => 'double',
        //     'rpt1.*'  => 'double',
        //     'rpt2.*'  => 'double',
        //     'rpt3.*'  => 'double',
        //     'rpt4.*'  => 'double',
        // ]);
        
        // if ($validator->fails()) {
        //     $msg = array(
        //             'info' => 'Error',
        //             'msg' => 'data gagal disimpan'
        //           );
        //     // return redirect()->back()->withErrors($validator->errors());
        // }
        
        // simpan realisasi Prog
        foreach ($request->id_ind_prog as $key => $vpro) {
            $id_ind_prog = $request->input('id_ind_prog.'.$key);
            $ket_prog = $request->input('ket_prog.'.$key);
            $fpenghambat_prog = $request->input('fpenghambat_prog.'.$key);
            $fpendorong_prog = $request->input('fpendorong_prog.'.$key);
            $p_t6 = str_replace(',', '', $request->input('p_t6.'.$key));
            $p_re = str_replace(',', '', $request->input('p_re.'.$key));
            $p_t1 = str_replace(',', '', $request->input('p_t1.'.$key));
            $p_t2 = str_replace(',', '', $request->input('p_t2.'.$key));
            $p_t3 = str_replace(',', '', $request->input('p_t3.'.$key));
            $p_t4 = str_replace(',', '', $request->input('p_t4.'.$key));
            if($p_re != "" or $p_t1 != "" or $p_t2 != "" or $p_t3 != "" or $p_t4 != ""){
               $store=[
                       'id_ind_prog' => $id_ind_prog,
                       'ket_prog' => $ket_prog,
                       'fpenghambat_prog' => $fpenghambat_prog,
                       'fpendorong_prog' => $fpendorong_prog,
                       'p_ak' => $p_t6 ? $p_t6 : null,
                       'p_re' => $p_re ? $p_re : null,
                       'p_t1' => $p_t1 ? $p_t1 : null,
                       'p_t2' => $p_t2 ? $p_t2 : null,
                       'p_t3' => $p_t3 ? $p_t3 : null,
                       'p_t4' => $p_t4 ? $p_t4 : null
                   ];
                // cek
                $cek = Realisasi_Tprog::where('id_ind_prog', '=', $request->input('id_ind_prog.'.$key))->first();
                // simpan
                if ($cek === null) {
                      Realisasi_Tprog::create($store);
                }else{
                    $cek->ket_prog=$ket_prog ? $ket_prog : null;
                    $cek->fpenghambat_prog=$fpenghambat_prog ? $fpenghambat_prog : null;
                    $cek->fpendorong_prog=$fpendorong_prog ? $fpendorong_prog : null;
                    $cek->p_ak= $p_t6 ? $p_t6 : null;
                    $cek->p_re= $p_re ? $p_re : null;
                    $cek->p_t1= $p_t1 ? $p_t1 : null;
                    $cek->p_t2= $p_t2 ? $p_t2 : null;
                    $cek->p_t3= $p_t3 ? $p_t3 : null;
                    $cek->p_t4= $p_t4 ? $p_t4 : null;
                    $cek->save();
                }
            }
            $pesan='Data berhasil disimpan';
        }

        //simpan realisasi Kegiatan90
        foreach ($request->id_ind_kegiatan as $key => $vskeg) {
            $id_ind_kegiatan = $request->input('id_ind_kegiatan.'.$key);
            $ket_kegiatan = $request->input('ket_kegiatan.'.$key);
            $fpenghambat_kegiatan = $request->input('fpenghambat_kegiatan.'.$key);
            $fpendorong_kegiatan = $request->input('fpendorong_kegiatan.'.$key);
            $k_t6 = str_replace(',', '', $request->input('k_t6.'.$key));
            $k_re = str_replace(',', '', $request->input('k_re.'.$key));
            $k_t1 = str_replace(',', '', $request->input('k_t1.'.$key));
            $k_t2 = str_replace(',', '', $request->input('k_t2.'.$key));
            $k_t3 = str_replace(',', '', $request->input('k_t3.'.$key));
            $k_t4 = str_replace(',', '', $request->input('k_t4.'.$key));
            if($k_re != "" or $k_t1 != "" or $k_t2 != "" or $k_t3 != "" or $k_t4 != ""){
               $store=[
                       'id_ind_kegiatan' => $id_ind_kegiatan,
                       'ket_kegiatan' => $ket_kegiatan,
                       'fpenghambat_kegiatan' => $fpenghambat_kegiatan,
                       'fpendorong_kegiatan' => $fpendorong_kegiatan,
                       'p_ak' => $k_t6 ? $k_t6 : null,
                       'k_re' => $k_re ? $k_re : null,
                       'k_t1' => $k_t1 ? $k_t1 : null,
                       'k_t2' => $k_t2 ? $k_t2 : null,
                       'k_t3' => $k_t3 ? $k_t3 : null,
                       'k_t4' => $k_t4 ? $k_t4 : null
                   ];
                // cek
                $cek = Realisasi_Tkegiatan::where('id_ind_kegiatan', '=', $request->input('id_ind_kegiatan.'.$key))->first();
                // simpan
                if ($cek === null) {
                      Realisasi_Tkegiatan::create($store);
                }else{
                    $cek->ket_kegiatan=$ket_kegiatan ? $ket_kegiatan : null;
                    $cek->fpenghambat_kegiatan=$fpenghambat_kegiatan ? $fpenghambat_kegiatan : null;
                    $cek->fpendorong_kegiatan=$fpendorong_kegiatan ? $fpendorong_kegiatan : null;
                    $cek->p_ak= $k_t6 ? $k_t6 : null;
                    $cek->k_re= $k_re ? $k_re : null;
                    $cek->k_t1= $k_t1 ? $k_t1 : null;
                    $cek->k_t2= $k_t2 ? $k_t2 : null;
                    $cek->k_t3= $k_t3 ? $k_t3 : null;
                    $cek->k_t4= $k_t4 ? $k_t4 : null;
                    $cek->save();
                }
            }
            $pesan='Data berhasil disimpan';
        }

        // // simpan realisasi kegiatan
        // foreach ($request->id_renja as $key => $value) {
        //  // $store = $request->input('id_renja.',$key);
        //     $id_renja = $request->input('id_renja.'.$key);
            
        //     if($request->tw=="1"){
        //       $rp5 = str_replace(',', '', $request->input('rp5.'.$key));
        //       $rp6 = str_replace(',', '', $request->input('rp6.'.$key));
        //       $rpt1 = str_replace(',', '', $request->input('rp8.'.$key));
        //     }elseif($request->tw=="2"){          
        //       $rpt2 = str_replace(',', '', $request->input('rp9.'.$key));
        //     }elseif($request->tw=="3"){
        //       $rpt3 = str_replace(',', '', $request->input('rp10.'.$key));
        //     }elseif($request->tw=="4"){
        //       $rpt4 = str_replace(',', '', $request->input('rp11.'.$key));
        //     }

        //      if(@$rp5 != "" or @$rp6 != "" or @$rpt1 != "" or @$rpt2 != "" or @$rpt3 != "" or @$rpt4 != ""){

        //         // $store=[
        //         //         'id_renja' => $id_renja,
        //         //         'rp5' => $rp5 ? $rp5 : null,
        //         //         'rp6' => $rp6 ? $rp6 : null,
        //         //         'rpt1' => $rpt1 ? $rpt1 : null,
        //         //         'rpt2' => $rpt2 ? $rpt2 : null,
        //         //         'rpt3' => $rpt3 ? $rpt3 : null,
        //         //         'rpt4' => $rpt4 ? $rpt4 : null
        //         //     ];

        //         if(@$rp5==""){$rp5=null;}
        //         if(@$rp6==""){$rp6=null;}
        //         if(@$rpt1==""){$rpt1=null;}
        //         if(@$rpt2==""){$rpt2=null;}
        //         if(@$rpt3==""){$rpt3=null;}
        //         if(@$rpt4==""){$rpt4=null;}

                
        //         if($request->input('data_renja')=="awal"){
        //           $cek_renja=Rkpd_subkeg::where('id',$id_renja)->first();
        //           //$cek_renja_2=Renja_Per::where('periode', $cek_renja->periode)->where('id_instansi', $cek_renja->id_instansi)->where('kdkegunit', $cek_renja->kdkegunit)->first();
        //           //if($cek_renja_2!==null){$id_renja_2=$cek_renja_2->id;}else{$id_renja_2=null;}
        //           $id_renja_2=$id_renja;
        //           if($request->tw=="1"){
        //             $store=[
        //                 'id_renja' => $id_renja,
        //                 'id_renja_per' => $id_renja_2,
        //                 'rp5' => $rp5,
        //                 'rp6' => $rp6,
        //                 'rpt1' => $rpt1,
        //                 'periode_renja' => $cek_renja->periode,
        //                 'id_instansi_renja' => $cek_renja->idopd,
        //                 'kdkegunit_renja' => $cek_renja->idsubkeg
        //             ];
        //           }elseif($request->tw=="2"){
        //             $store=[
        //                 'id_renja' => $id_renja,
        //                 'id_renja_per' => $id_renja_2,
        //                 'rpt2' => $rpt2,
        //                 'periode_renja' => $cek_renja->periode,
        //                 'id_instansi_renja' => $cek_renja->idopd,
        //                 'kdkegunit_renja' => $cek_renja->idsubkeg
        //             ];
        //           }elseif($request->tw=="3"){
        //             $store=[
        //                 'id_renja' => $id_renja,
        //                 'id_renja_per' => $id_renja_2,
        //                 'rpt3' => $rpt3,
        //                 'periode_renja' => $cek_renja->periode,
        //                 'id_instansi_renja' => $cek_renja->idopd,
        //                 'kdkegunit_renja' => $cek_renja->idsubkeg
        //             ];
        //           }elseif($request->tw=="4"){
        //             $store=[
        //                 'id_renja' => $id_renja,
        //                 'id_renja_per' => $id_renja_2,
        //                 'rpt4' => $rpt4,
        //                 'periode_renja' => $cek_renja->periode,
        //                 'id_instansi_renja' => $cek_renja->idopd,
        //                 'kdkegunit_renja' => $cek_renja->idsubkeg
        //             ];
        //           }
        //           // $store=[
        //           //     'id_renja' => $id_renja,
        //           //     'id_renja_per' => $id_renja_2,
        //           //     'rp5' => $rp5,
        //           //     'rp6' => $rp6,
        //           //     'rpt1' => $rpt1,
        //           //     'rpt2' => $rpt2,
        //           //     'rpt3' => $rpt3,
        //           //     'rpt4' => $rpt4,
        //           //     'periode_renja' => $cek_renja->periode,
        //           //     'id_instansi_renja' => $cek_renja->id_instansi,
        //           //     'kdkegunit_renja' => $cek_renja->kdkegunit
        //           // ];
        //         }elseif($request->input('data_renja')=="perubahan"){
        //           $cek_renja=Rkpd_subkeg::where('id',$id_renja)->first();
        //           // $cek_renja_2=Renja::where('periode', $cek_renja->periode)->where('id_instansi', $cek_renja->id_instansi)->where('kdkegunit', $cek_renja->kdkegunit)->first();
        //           // if($cek_renja_2!==null){$id_renja_2=$cek_renja_2->id;}else{$id_renja_2=null;}
        //           $id_renja_2=null;
        //           if($request->tw=="1"){
        //             $store=[
        //                 'id_renja' => $id_renja_2,
        //                 'id_renja_per' => $id_renja,
        //                 'rp5' => $rp5,
        //                 'rp6' => $rp6,
        //                 'rpt1' => $rpt1,
        //                 'periode_renja' => $cek_renja->periode,
        //                 'id_instansi_renja' => $cek_renja->idopd,
        //                 'kdkegunit_renja' => $cek_renja->idsubkeg
        //             ];
        //           }elseif($request->tw=="2"){
        //             $store=[
        //                 'id_renja' => $id_renja_2,
        //                 'id_renja_per' => $id_renja,
        //                 'rpt2' => $rpt2,
        //                 'periode_renja' => $cek_renja->periode,
        //                 'id_instansi_renja' => $cek_renja->idopd,
        //                 'kdkegunit_renja' => $cek_renja->idsubkeg
        //             ];
        //           }elseif($request->tw=="3"){
        //             $store=[
        //                 'id_renja' => $id_renja_2,
        //                 'id_renja_per' => $id_renja,
        //                 'rpt3' => $rpt3,
        //                 'periode_renja' => $cek_renja->periode,
        //                 'id_instansi_renja' => $cek_renja->idopd,
        //                 'kdkegunit_renja' => $cek_renja->idsubkeg
        //             ];
        //           }elseif($request->tw=="4"){
        //             $store=[
        //                 'id_renja' => $id_renja_2,
        //                 'id_renja_per' => $id_renja,
        //                 'rpt4' => $rpt4,
        //                 'periode_renja' => $cek_renja->periode,
        //                 'id_instansi_renja' => $cek_renja->idopd,
        //                 'kdkegunit_renja' => $cek_renja->idsubkeg
        //             ];
        //           }
        //           // $store=[
        //           //     'id_renja' => $id_renja_2,
        //           //     'id_renja_per' => $id_renja,
        //           //     'rp5' => $rp5,
        //           //     'rp6' => $rp6,
        //           //     'rpt1' => $rpt1,
        //           //     'rpt2' => $rpt2,
        //           //     'rpt3' => $rpt3,
        //           //     'rpt4' => $rpt4,
        //           //     'periode_renja' => $cek_renja->periode,
        //           //     'id_instansi_renja' => $cek_renja->id_instansi,
        //           //     'kdkegunit_renja' => $cek_renja->kdkegunit
        //           // ];
        //         }

                
        //         $cek = Realisasi::where('periode_renja', $cek_renja->periode)->where('id_instansi_renja', $cek_renja->idopd)->where('kdkegunit_renja', $cek_renja->idsubkeg)->first();
                
        //         // $cek = Realisasi::where('id_renja', '=', $request->input('id_renja.'.$key))->first();
        //         if ($cek === null) {
        //               Realisasi::create($store);
        //         }else{

        //             if($request->input('id_renja')=="awal"){$cek->id_renja=$cek_renja->id;}elseif($request->input('id_renja')=="perubahan"){$cek->id_renja_per=$cek_renja->id;}
                    
        //            if($request->tw=="1"){
        //             if($rp5!=""){$cek->rp5= $rp5;}else{$cek->rp5=null;}
        //             if($rp6!=""){$cek->rp6= $rp6;}else{$cek->rp6=null;}
        //             if($rpt1!=""){$cek->rpt1= $rpt1;}else{$cek->rpt1=null;}
        //            }elseif($request->tw=="2"){
        //             if($rpt2!=""){$cek->rpt2= $rpt2;}else{$cek->rpt2=null;}
        //            }elseif($request->tw=="3"){
        //             if($rpt3!=""){$cek->rpt3= $rpt3;}else{$cek->rpt3=null;}
        //            }elseif($request->tw=="4"){
        //             if($rpt4!=""){$cek->rpt4= $rpt4;}else{$cek->rpt4=null;}
        //            } 
                    
        //             $cek->save();
        //         }
        //     }
        //     $pesan='Data berhasil disimpan';
        // }

        // // simpan realisasi target k
        // foreach ($request->id_target as $key => $value) {
        //     $id_target = $request->input('id_target.'.$key);
        //     $ket_keg = $request->input('ket_keg.'.$key);
        //     $fpenghambat_keg = $request->input('fpenghambat_keg.'.$key);
        //     $fpendorong_keg = $request->input('fpendorong_keg.'.$key);
            
        //     if($request->tw=="1"){
        //       $k5 = str_replace(',', '', $request->input('k5.'.$key));
        //       $k6 = str_replace(',', '', $request->input('k6.'.$key));
        //       $kt1 = str_replace(',', '', $request->input('k8.'.$key));
        //     }elseif($request->tw=="2"){
        //       $kt2 = str_replace(',', '', $request->input('k9.'.$key));
        //     }elseif($request->tw=="3"){
        //       $kt3 = str_replace(',', '', $request->input('k10.'.$key));
        //     }elseif($request->tw=="4"){
        //       $kt4 = str_replace(',', '', $request->input('k11.'.$key));
        //     }


        //      if(@$k5 != "" or @$k6 != "" or @$kt1 != "" or @$kt2 != "" or @$kt3 != "" or @$kt4 != ""){
                
        //         if($request->tw=="1"){
        //           $store=[
        //                   'id_target' => $id_target,
        //                   'ket_keg' => $ket_keg,
        //                   'fpenghambat_keg' => $fpenghambat_keg,
        //                   'fpendorong_keg' => $fpendorong_keg,
        //                   'k5' => $k5 ? $k5 : null,
        //                   'k6' => $k6 ? $k6 : null,
        //                   'kt1' => $kt1 ? $kt1 : null
        //               ];
        //         }elseif($request->tw=="2"){
        //           $store=[
        //                   'id_target' => $id_target,
        //                   'ket_keg' => $ket_keg,
        //                   'fpenghambat_keg' => $fpenghambat_keg,
        //                   'fpendorong_keg' => $fpendorong_keg,
        //                   'kt2' => $kt2 ? $kt2 : null
        //               ];
        //         }elseif($request->tw=="3"){
        //           $store=[
        //                   'id_target' => $id_target,
        //                   'ket_keg' => $ket_keg,
        //                   'fpenghambat_keg' => $fpenghambat_keg,
        //                   'fpendorong_keg' => $fpendorong_keg,
        //                   'kt3' => $kt3 ? $kt3 : null
        //               ];
        //         }elseif($request->tw=="4"){
        //           $store=[
        //                   'id_target' => $id_target,
        //                   'ket_keg' => $ket_keg,
        //                   'fpenghambat_keg' => $fpenghambat_keg,
        //                   'fpendorong_keg' => $fpendorong_keg,
        //                   'kt4' => $kt4 ? $kt4 : null
        //               ];
        //         }
        //         // $store=[
        //         //         'id_target' => $id_target,
        //         //         'ket_keg' => $ket_keg,
        //         //         'fpenghambat_keg' => $fpenghambat_keg,
        //         //         'fpendorong_keg' => $fpendorong_keg,
        //         //         'k5' => $k5 ? $k5 : null,
        //         //         'k6' => $k6 ? $k6 : null,
        //         //         'kt1' => $kt1 ? $kt1 : null,
        //         //         'kt2' => $kt2 ? $kt2 : null,
        //         //         'kt3' => $kt3 ? $kt3 : null,
        //         //         'kt4' => $kt4 ? $kt4 : null
        //         //     ];
        //         $cek = Realisasi_Target::where('id_target', '=', $request->input('id_target.'.$key))->first();
        //         if ($cek === null) {
        //               Realisasi_Target::create($store);
        //         }else{
        //             $cek->ket_keg=$ket_keg ? $ket_keg : null;
        //             $cek->fpenghambat_keg=$fpenghambat_keg ? $fpenghambat_keg : null;
        //             $cek->fpendorong_keg=$fpendorong_keg ? $fpendorong_keg : null;
                    
        //             if($request->tw=="1"){
        //               $cek->k5= $k5 ? $k5 : null;
        //               $cek->k6= $k6 ? $k6 : null;
        //               $cek->kt1= $kt1 ? $kt1 : null;
        //             }elseif($request->tw=="2"){
        //               $cek->kt2= $kt2 ? $kt2 : null;
        //             }elseif($request->tw=="3"){
        //               $cek->kt3= $kt3 ? $kt3 : null;
        //             }elseif($request->tw=="4"){
        //               $cek->kt4= $kt4 ? $kt4 : null;
        //             }
 
        //             $cek->save();
        //         }
        //     }
        //     $pesan='Data berhasil disimpan';
        // }

        

        $msg = array(
                'info' => 'Info',
                'store' => $store,
                'msg' => $pesan
              );

        return json_encode($msg);
    }

    public function storeProg(Request $request){
        if (!Auth::guard('opd')->check() and !Auth::guard('web')->check()){
            return redirect('/');
        }
        $pesan = 'gagal disimpan...!';
        $store=null;

        $cek = Realisasi_Tprog::where('id_ind_prog', '=', $request->id)->first();
        if($cek === null){
            $store=[
               'id_ind_prog' => $request->id,
               'ket_prog' => null,
               'fpenghambat_prog' => null,
               'fpendorong_prog' => null,
               'p_ak' => null,
               'p_re' => null,
               'p_t1' => null,
               'p_t2' => null,
               'p_t3' => null,
               'p_t4' => null
            ];
            Realisasi_Tprog::create($store);

            $data[$request->kolom] = str_replace(',', '',$request->isi);

            $cek2 = Realisasi_Tprog::where('id_ind_prog', '=', $request->id)->first();
            Realisasi_Tprog::where('id', '=', $cek2->id)->update($data);
        }else{
            $data[$request->kolom] = str_replace(',', '',$request->isi);
            Realisasi_Tprog::where('id', '=', $cek->id)->update($data);
        }

        $pesan = "";
        $msg = array(
                'info' => 'Info',
                'data' => $data,
                'msg' => $pesan
              );

        return json_encode($msg);
    }

    public function storeKeg(Request $request){
        if (!Auth::guard('opd')->check() and !Auth::guard('web')->check()){
            return redirect('/');
        }
        $pesan = 'gagal disimpan...!';
        $store=null;

        $cek = Realisasi_Tkegiatan::where('id_ind_kegiatan', '=', $request->id)->first();
        if($cek === null){
            $store=[
               'id_ind_kegiatan' => $request->id,
               'ket_kegiatan' => null,
               'fpenghambat_kegiatan' => null,
               'fpendorong_kegiatan' => null,
               'p_ak' => null,
               'k_re' => null,
               'k_t1' => null,
               'k_t2' => null,
               'k_t3' => null,
               'k_t4' => null
            ];
            Realisasi_Tkegiatan::create(store);

            $request->isi ? $request->isi : null;
            $data[$request->kolom] = str_replace(',', '',$request->isi);
            $cek2 = Realisasi_Tkegiatan::where('id_ind_kegiatan', '=', $request->id)->first();
            Realisasi_Tkegiatan::where('id', '=', $cek2->id)->update($data);
        }else{
            $data[$request->kolom] = str_replace(',', '',$request->isi);
            Realisasi_Tkegiatan::where('id', '=', $cek->id)->update($data);
        }

        $pesan = "";
        $msg = array(
                'info' => 'Info',
                'data' => $data,
                'msg' => $pesan
              );

        return json_encode($msg);
    }

    public function storeSub(Request $request){
        if (!Auth::guard('opd')->check() and !Auth::guard('web')->check()){
            return redirect('/');
        }
        $pesan = 'gagal disimpan...!';
        $store=null;

        $cek = Realisasi_Target::where('id_target', '=', $request->id)->first();
        if($cek === null){
            $store=[
                'id_target' => $request->id,
                'ket_keg' => null,
                'fpenghambat_keg' => null,
                'fpendorong_keg' => null,
                'k5' => null,
                'k6' => null,
                'kt1' => null,
                'kt2' => null,
                'kt3' => null,
                'kt4' => null
            ];
            Realisasi_Target::create($store);

            $data[$request->kolom] = str_replace(',', '',$request->isi);

            $cek2 = Realisasi_Target::where('id_target', '=', $request->id)->first();
            Realisasi_Target::where('id', '=', $cek2->id)->update($data);
        }else{
            $data[$request->kolom] = str_replace(',', '',$request->isi);
            Realisasi_Target::where('id', '=', $cek->id)->update($data);
        }

        $pesan = "";
        $msg = array(
                'info' => 'Info',
                'data' => $data,
                'msg' => $pesan
              );

        return json_encode($msg);
    }

    public function storeRen(Request $request){
        if (!Auth::guard('opd')->check() and !Auth::guard('web')->check()){
            return redirect('/');
        }
        $pesan = 'gagal disimpan...!';
        $store=null;
        $cek_renja=Rkpd_subkeg::where('id',$request->id)->first();
        $cek = Realisasi::where('periode_renja', $cek_renja->periode)->where('id_instansi_renja', $cek_renja->idopd)->where('kdkegunit_renja', $cek_renja->idsubkeg)->first();
        if($cek === null){
            $store=[
                'id_renja' => $cek_renja->id,
                'id_renja_per' => $cek_renja->id,
                'rp5' => null,
                'rp6' => null,
                'rpt1' => null,
                'rpt2' => null,
                'rpt3' => null,
                'rpt4' => null,
                'periode_renja' => $cek_renja->periode,
                'id_instansi_renja' => $cek_renja->idopd,
                'kdkegunit_renja' => $cek_renja->idsubkeg
            ];
            Realisasi::create($store);

            $data[$request->kolom] = str_replace(',', '',$request->isi);

            $cek2 = Realisasi::where('periode_renja', $cek_renja->periode)->where('id_instansi_renja', $cek_renja->idopd)->where('kdkegunit_renja', $cek_renja->idsubkeg)->first();
            Realisasi::where('id', '=', $cek2->id)->update($data);
        }else{
            $data[$request->kolom] = str_replace(',', '',$request->isi);
            Realisasi::where('id', '=', $cek->id)->update($data);
        }

        $pesan = "";
        $msg = array(
                'info' => 'Info',
                'data' => $data,
                'msg' => $pesan
              );

        return json_encode($msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function show_evaluasi_renja(Request $request,$periode,$triwulan,$id,$id_instansi,$data_renja)
    {
        //session cek
        if (!Auth::guard('opd')->check() and !Auth::guard('web')->check()){
            return redirect('/');
        }
        //$periode=$periode;
        // $prog= Rpjmd_Prog::where('idprgrm',$id)->where('id_instansi',$id_instansi)->first();

        if($data_renja=="perubahan"){
            $prog=Rkpd_prog::where('idopd',$id_instansi)->where('periode',$periode)->where('prog_perubahan','1')->where('idprog',$id)->first();
        }else{
            $prog=Rkpd_prog::where('idopd',$id_instansi)->where('periode',$periode)->where('prog_awal','1')->where('idprog',$id)->first();
        }
//        $rpjmd_prog_indikator= Rpjmd_Prog_Indikator::where('idprgrm',$id)->where('id_instansi',$id_instansi)->get();
        
        // if($data_renja=="awal"){
        //   $renja=Renja::where('periode',$periode)->where('id_instansi',$id_instansi)
        //   ->where('idprgrm',$id)
        //   ->where('bappeda',1)
        //   ->get();
        // }elseif($data_renja=="perubahan"){
        //   $renja=Renja_Per::where('periode',$periode)->where('id_instansi',$id_instansi)
        //   ->where('idprgrm',$id)
        //   ->where('bappeda',1)
        //   ->get();          
        // }

        if($data_renja=="perubahan"){
            $rkpd_keg=Rkpd_keg::where('idopd',$id_instansi)->where('idprog',$id)->where('periode',$periode)->where('keg_perubahan','1')->orderby('idkeg','asc')->get();
        }else{
            $rkpd_keg=Rkpd_keg::where('idopd',$id_instansi)->where('idprog',$id)->where('periode',$periode)->where('keg_awal','1')->orderby('idkeg','asc')->get();
        }

        //data thn sebelumnya
        $thnsebelumnya=$periode-1;
        // $site="http://simonevdokrenda.sumbarprov.go.id/".$thnsebelumnya."/api_realisasi/".$thnsebelumnya."/".$id_instansi."/".$id;
        // $content = @file_get_contents($site);
        $api_keg=array();
        /*
        if($content === FALSE) { 
        // handle error here... 
        }else{
          $data_lalu= json_decode($content);
          foreach ($data_lalu as $key => $v) {
            $api_keg[$key]['tren']=$v->tren;
            $api_keg[$key]['real']=$v->real;  
          }
        }
        */
        //echo $api_keg[2]['tren'];
        //dd($api_keg);
        //echo count($api_keg);
        // $site2="http://simonevdokrenda.sumbarprov.go.id/".$thnsebelumnya."/api_realisasi_prog/1/".$id_instansi."/".$id;
        // $content2 = @file_get_contents($site2);
        $api_prog=array();
        /*
        if($content2 === FALSE) { 
        // handle error here... 
        }else{
          $data_lalu2= json_decode($content2);
          // dd($data_lalu2);
          foreach ($data_lalu2 as $key2 => $v2) {
            $api_prog[$key2]=$v2; 
          }
        }
        */
        // bappeda,psda,dishut,dinsos,kominfo,dpmd,dlh,dinas pangan,bakeuda,bpsdm,dinas peternakan,pupr,esdm,inspektorat,disnakertrans,dkp,kesbangpol,satpolpp,balitbang
        // roaset
        $pengecualian_rensta=array();
        // $pengecualian_rensta=array('72','19','13','61','38','32','29','26','74','78','59','12','63','70','22','54','99','17','80','94');
        $periode_renja_aktif=Periode_Renja::where('id', $periode)->first();
        $periode_rpjmd=Periode_Rpjmd::where('id', $periode_renja_aktif->id_periode_rpjmd)->first();
        return view('admin.data.rkpd.modal_renja',compact('prog','periode','triwulan','data_renja','api_keg','api_prog','pengecualian_rensta','rkpd_keg','periode_rpjmd'))->renderSections()['content'];
    }

    // public function renja_indikator(){
    //     //session cek
    //     if (!Auth::guard('opd')->check() and !Auth::guard('web')->check()){
    //         return redirect('/');
    //     }
    //     $rin=renja::find(8);
    //         echo $rin->id."<br>";
    //         dd($rin->indikator_kegiatan);
    // }
    
    public function ekspor_renja_excel($periode,$jenis,$id_instansi,$triwulan,$rekap,$data_renja,$dok){
        //session cek
        if (!Auth::guard('opd')->check() and !Auth::guard('web')->check()){
            return redirect('/');
        }
        
       $opd=Data_Opd::find($id_instansi);
       if (Auth::guard('web')->check()){
            $nm_instansi=$opd->nm_instansi;
            // $do=Data_Opd::find($id_instansi);
       }else{
            // $do=Data_Opd::find(Auth::guard('opd')->user()->id_instansi);
            $data_opd=Auth::guard('opd')->user()->id_instansi;
            $opd=Data_Opd::find($data_opd);
            // $nm_instansi=$do->nm_instansi;
            // $id_instansi=$do->id;
            $nm_instansi=$opd->nm_instansi;
            $id_instansi=$opd->id;
       }
       $urusan_opd=Urusan_Opd::where('id_instansi',$id_instansi)->orderBy('id', 'DESC')->first();
       if($rekap!="Detail"){$nmrekap="Rekap-Program_";}else{$nmrekap="";}
       if($jenis=="RKPD"){
          return (new EvaluasiRenja_Report($periode,$jenis,$id_instansi,$triwulan,$rekap,$data_renja,$dok))->download($nmrekap.'E.19 - Evaluasi_RKPD_'.$periode.'_'.$nm_instansi.'_Triwulan-'.$triwulan.'('.date('Y-m-d').').xlsx');
       }elseif($jenis=="RKPD Per-Urusan"){
          return (new EvaluasiRkpd_Report($periode,$triwulan,$rekap,$data_renja))->download($nmrekap.'E.19 - Evaluasi_RKPD_Per-Urusan'.$periode.'_Triwulan-'.$triwulan.'('.date('Y-m-d').').xlsx');
       }else{
          // return (new EvaluasiRenja_Report($periode,$jenis,$id_instansi,$triwulan,$rekap,$data_renja))->download($nmrekap.'E.55 - Evaluasi_Renja_'.$periode.'_'.$nm_instansi.'_Triwulan-'.$triwulan.'('.date('Y-m-d').').xlsx');

       		        $dafunit= dafunit::all();
       		        if($data_renja=="awal"){
       		          $rpjmd_prog= Rkpd_prog::
       		             whereExists(function ($query) use($periode) {
       		                $query->select(DB::raw(1))
       		                      ->from('rkpd_subkeg')
       		                      // ->whereRaw('renja.id_instansi = rpjmd_prog.id_instansi')
       		                      // ->whereRaw('renja.idprgrm = rpjmd_prog.idprgrm')
       		                      // ->whereRaw('renja.periode = ?', [request()->get('periode')]);
       		                ->whereRaw('rkpd_subkeg.subkeg_awal = ?','1')
       		                ->whereRaw('rkpd_subkeg.idopd = rkpd_prog.idopd')
       		                ->whereRaw('rkpd_prog.idprog=SUBSTRING(rkpd_subkeg.idsubkeg,1,7)')
       		                ->whereRaw('rkpd_subkeg.periode = ?', [$periode]);
       		            })
       		         ->where('prog_awal','=','1')
                   ->where('idopd','=',$id_instansi)
       		         ->where('periode','=',$periode)
       		          ->select(DB::raw('rkpd_prog.*,SUBSTRING(idprog,1,4)as unitkey'))
       		          ->get();
       		          
       		          $rpjmd_prog_non=array();
       		        }elseif($data_renja=="perubahan"){
       		          $rpjmd_prog= Rkpd_prog::
       		             whereExists(function ($query) use($periode){
       		                $query->select(DB::raw(1))
       		                      ->from('rkpd_subkeg')
       		                      ->whereRaw('rkpd_subkeg.subkeg_perubahan = ?','1')
       		                      ->whereRaw('rkpd_subkeg.idopd = rkpd_prog.idopd')
       		                      ->whereRaw('rkpd_prog.idprog=SUBSTRING(rkpd_subkeg.idsubkeg,1,7)')
       		                      ->whereRaw('rkpd_subkeg.periode = ?', [$periode])
       		                      ;

       		                      // whereRaw("id=SUBSTRING('".$this->id."', 1, 4)")
       		            })
       		          ->where('prog_perubahan','=','1')
                    ->where('idopd','=',$id_instansi)
       		          ->where('periode','=',$periode)
       		          ->select(DB::raw('rkpd_prog.*,SUBSTRING(idprog,1,4)as unitkey'))
       		          ->get();
       					$rpjmd_prog_non=array();
       		        }else{
       		          return redirect('evaluasi-renja?data_renja=awal');
       		        }

       		        if($data_renja=="perubahan"){
       		            $rkpd_keg=Rkpd_keg::where('idopd',$id_instansi)->where('periode',$periode)->where('keg_perubahan','1')->orderby('idkeg','asc')->get();
       		        }else{
       		            $rkpd_keg=Rkpd_keg::where('idopd',$id_instansi)->where('periode',$periode)->where('keg_awal','1')->orderby('idkeg','asc')->get();
       		        }

       		        $api_keg=array();
       	return view('excel.evaluasi_renja',compact('urusan_opd','periode','jenis','opd','triwulan','rpjmd_prog','rpjmd_prog_non','dafunit','data_renja','rkpd_keg','api_keg','dok'));
       }
       // $msg = array(
       //         'info' => 'Info',
       //         'download' => $download,
       //         'msg' => 'sukses'
       //       );

       // return json_encode($msg);
       

       //eksport ke pdf
       // composer required dompdf/dompdf
       // return (new EvaluasiRenja_Report($periode,$id_instansi))->download('Evaluasi_Renja_'.$periode.'_'.$nm_instansi.'('.date('Y-m-d').').pdf', \Maatwebsite\Excel\Excel::MPDF);
       // return Excel::download(new EvaluasiRenja_Report($periode,$id_instansi),'Evaluasi_Renja_'.$periode.'_'.$nm_instansi.'('.date('Y-m-d').').html','Html');
    }

    public function tcekspor_renja_excel($periode,$jenis,$id_instansi,$triwulan,$rekap,$data_renja,$dok){
        //session cek
        if (!Auth::guard('opd')->check() and !Auth::guard('web')->check()){
            return redirect('/');
        }
        
       $opd=Data_Opd::find($id_instansi);
       if (Auth::guard('web')->check()){
            $nm_instansi=$opd->nm_instansi;
            // $do=Data_Opd::find($id_instansi);
       }else{
            // $do=Data_Opd::find(Auth::guard('opd')->user()->id_instansi);
            $data_opd=Auth::guard('opd')->user()->id_instansi;
            $opd=Data_Opd::find($data_opd);
            // $nm_instansi=$do->nm_instansi;
            // $id_instansi=$do->id;
            $nm_instansi=$opd->nm_instansi;
            $id_instansi=$opd->id;
       }

       $urusan_opd=Urusan_Opd::where('id_instansi',$id_instansi)->first();
       if($rekap!="Detail"){$nmrekap="Rekap-Program_";}else{$nmrekap="";}
       if($jenis=="RKPD"){
          return (new EvaluasiRenja_Report($periode,$jenis,$id_instansi,$triwulan,$rekap,$data_renja,$dok))->download($nmrekap.'E.19 - Evaluasi_RKPD_'.$periode.'_'.$nm_instansi.'_Triwulan-'.$triwulan.'('.date('Y-m-d').').xlsx');
       }elseif($jenis=="RKPD Per-Urusan"){
          return (new EvaluasiRkpd_Report($periode,$triwulan,$rekap,$data_renja))->download($nmrekap.'E.19 - Evaluasi_RKPD_Per-Urusan'.$periode.'_Triwulan-'.$triwulan.'('.date('Y-m-d').').xlsx');
       }else{
          // return (new EvaluasiRenja_Report($periode,$jenis,$id_instansi,$triwulan,$rekap,$data_renja))->download($nmrekap.'E.55 - Evaluasi_Renja_'.$periode.'_'.$nm_instansi.'_Triwulan-'.$triwulan.'('.date('Y-m-d').').xlsx');

                    $dafunit= dafunit::all();
                    if($data_renja=="awal"){
                      $rpjmd_prog= Rkpd_prog::
                         whereExists(function ($query) use($periode) {
                            $query->select(DB::raw(1))
                                  ->from('rkpd_subkeg')
                                  // ->whereRaw('renja.id_instansi = rpjmd_prog.id_instansi')
                                  // ->whereRaw('renja.idprgrm = rpjmd_prog.idprgrm')
                                  // ->whereRaw('renja.periode = ?', [request()->get('periode')]);
                            ->whereRaw('rkpd_subkeg.subkeg_awal = ?','1')
                            ->whereRaw('rkpd_subkeg.idopd = rkpd_prog.idopd')
                            ->whereRaw('rkpd_prog.idprog=SUBSTRING(rkpd_subkeg.idsubkeg,1,7)')
                            ->whereRaw('rkpd_subkeg.periode = ?', [$periode]);
                        })
                     ->where('prog_awal','=','1')
                   ->where('idopd','=',$id_instansi)
                     ->where('periode','=',$periode)
                      ->select(DB::raw('rkpd_prog.*,SUBSTRING(idprog,1,4)as unitkey'))
                      ->get();
                      
                      $rpjmd_prog_non=array();
                    }elseif($data_renja=="perubahan"){
                      $rpjmd_prog= Rkpd_prog::
                         whereExists(function ($query) use($periode){
                            $query->select(DB::raw(1))
                                  ->from('rkpd_subkeg')
                                  ->whereRaw('rkpd_subkeg.subkeg_perubahan = ?','1')
                                  ->whereRaw('rkpd_subkeg.idopd = rkpd_prog.idopd')
                                  ->whereRaw('rkpd_prog.idprog=SUBSTRING(rkpd_subkeg.idsubkeg,1,7)')
                                  ->whereRaw('rkpd_subkeg.periode = ?', [$periode])
                                  ;

                                  // whereRaw("id=SUBSTRING('".$this->id."', 1, 4)")
                        })
                      ->where('prog_perubahan','=','1')
                    ->where('idopd','=',$id_instansi)
                      ->where('periode','=',$periode)
                      ->select(DB::raw('rkpd_prog.*,SUBSTRING(idprog,1,4)as unitkey'))
                      ->get();
                        $rpjmd_prog_non=array();
                    }else{
                      return redirect('evaluasi-renja?data_renja=awal');
                    }

                    if($data_renja=="perubahan"){
                        $rkpd_keg=Rkpd_keg::where('idopd',$id_instansi)->where('periode',$periode)->where('keg_perubahan','1')->orderby('idkeg','asc')->get();
                    }else{
                        $rkpd_keg=Rkpd_keg::where('idopd',$id_instansi)->where('periode',$periode)->where('keg_awal','1')->orderby('idkeg','asc')->get();
                    }

                    $api_keg=array();
        return view('excel.tcevaluasi_renja',compact('urusan_opd','periode','jenis','opd','triwulan','rpjmd_prog','rpjmd_prog_non','dafunit','data_renja','rkpd_keg','api_keg','dok'));
       }
       // $msg = array(
       //         'info' => 'Info',
       //         'download' => $download,
       //         'msg' => 'sukses'
       //       );

       // return json_encode($msg);
       

       //eksport ke pdf
       // composer required dompdf/dompdf
       // return (new EvaluasiRenja_Report($periode,$id_instansi))->download('Evaluasi_Renja_'.$periode.'_'.$nm_instansi.'('.date('Y-m-d').').pdf', \Maatwebsite\Excel\Excel::MPDF);
       // return Excel::download(new EvaluasiRenja_Report($periode,$id_instansi),'Evaluasi_Renja_'.$periode.'_'.$nm_instansi.'('.date('Y-m-d').').html','Html');
    }

    /*
    // Route::get('renja_impor','RenjaController@impor');
    public function impor(){
      $no=0;
        $url_json = 'http://simonevdokrenda.sumbarprov.go.id/2020/data_renja_akhir.json';
        $data_json = file_get_contents($url_json);
        $urusan_opd = json_decode($data_json);
        //dd($urusan_opd);
        foreach ($urusan_opd as $v) {
        if($v->type=="table")
        {
            //dd($v->data);
            foreach ($v->data as $r) {                
                if($r->tglawal!="0000-00-00 00:00:00"){$tglawal=$r->tglawal;}
                if($r->tglakhir!="0000-00-00 00:00:00"){$tglakhir=$r->tglakhir;}
                if($r->kdstatus_urgency==""){$kdstatus_urgency=0;}else{$kdstatus_urgency=$r->kdstatus_urgency;}
                
                //4311
                if($r->kdkegunit=="-- Pilih Ke"){$kdkegunit='0';}else{$kdkegunit=$r->kdkegunit;}
                $store=[
                        'id' => $r->id_renja,
                        'id_instansi' => $r->id_instansi,
                        'periode' => $r->periode,
                        'unitkey' => $r->unitkey,
                        'induk_key' => $r->induk_key,
                        'urusan_key' => $r->urusan_key,
                        'idmslh' => $r->idmslh,
                        'kdkegunit' => $kdkegunit,
                        'nm_kegunit_awal' => '',
                        'nm_kegunit_akhir' => '',
                        'tanda_lokasi' => $r->tanda_lokasi,
                        'id_prioritas' => $r->id_prioritas,
                        'id_sasaran_prioritas' => $r->id_sasaran_prioritas,
                        'id_prioritas_nasional' => $r->id_prioritas_nasional,
                        'id_jenis_belanja' => $r->id_jenis_belanja,
                        'idprgrm' => $r->idprgrm,
                        'noprior' => $r->noprior,
                        'id_renstra_detail' => $r->id_renstra_detail,
                        //'tglawal' => $tglawal,
                        //'tglakhir' => $tglakhir,
                        'belanja_p_now' => $r->belanja_p_now,
                        'belanja_bj_now' => $r->belanja_bj_now,
                        'belanja_m_now' => $r->belanja_m_now,
                        'belanja_p_after' => $r->belanja_p_after,
                        'belanja_bj_after' => $r->belanja_bj_after,
                        'belanja_m_after' => $r->belanja_m_after,
                        'lokasi' => $r->lokasi,
                        'jumlahmin1' => $r->jumlahmin1,
                        'pagu' => $r->pagu,
                        'pagu_after' => $r->pagu_after,
                        'target_before' => $r->target_before,
                        'target_after' => $r->target_after,
                        'sumber_dana' => $r->sumber_dana,
                        'jumlahpls1' => $r->jumlahpls1,
                        'alasan_bappeda' => $r->alasan_bappeda,
                        'alasan_bidang_evaluasi' => $r->alasan_bidang_avaluasi,
                        'kdstatus_urgency' => $kdstatus_urgency,
                        'keterangan_sumber_dana' => $r->keterangan_sumber_dana,
                        // 'tags' => $r->tags
                    ];

                    // dd($store);
                    if($r->id_status=="7"){
                      $no++;
                      // Renja::create($store);                      
                    }

            }
        }
        }
        echo $no;
    }
    */
    
    //import kegiatan indikator
    // Route::get('renja_impor_indikator','RenjaController@impor_indikator');
    //     public function impor_indikator(){
    //     $url_json = 'http://simonevdokrenda.sumbarprov.go.id/2020/data_renja_awal2020rkpd_kinkeg.json';
    //     $data_json = file_get_contents($url_json);
    //     $urusan_opd = json_decode($data_json);
    //     //dd($urusan_opd);
    //     $no=0;
    //     foreach ($urusan_opd as $v) {
    //     if($v->type=="table")
    //     {
    //         //dd($v->data);
    //         foreach ($v->data as $r) {  
    //           if($r->PERIODE=="2020"){              
    //             $store=[
    //                     'id' => $r->id,
    //                     'id_renja' => $r->id_renja,
    //                     'kdjkk' => $r->KDJKK,
    //                     'kdkegunit' => $r->KDKEGUNIT,
    //                     'kdtahap' => $r->KDTAHAP,
    //                     'unitkey' => $r->UNITKEY,
    //                     'tolokur' => $r->TOLOKUR,
    //                     'sat' => $r->TARGET,
    //                     'target' => $r->TARGET
    //                 ];

    //                 // dd($store);
    //                 if($r->KDJKK=="02"){
    //                   // Renja_Indikator::create($store);
    //                   $no++;
    //                 }

                
    //           }
    //         }
    //     }
    //     }
    //     echo $no;
    // }

    //detail target
    // Route::get('renja_impor_indikator_det','RenjaController@impor_indikator_det');
    // public function impor_indikator_det(){
    //         $det = Renja_Indikator::where('kdjkk','02')->get();
    //             foreach($det as $r){
    //             $store=[
    //                     'id_kegindikator' => $r->id,
    //                     'tolokur_sumber' => $r->tolokur,
    //                     'tolokur_det' => $r->tolokur,
    //                     'target_sumber' => $r->target,
    //                     'sat_det' => $r->target,
    //                     'target_det' => $r->target
    //                 ];

    //             //    dd($store);
    //             // Renja_Indikator_Det::create($store);
    //             }
    // }
}
