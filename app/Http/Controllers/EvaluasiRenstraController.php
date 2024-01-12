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

use App\M_Renstra;
use App\M_Renstra_Indikator_Det;
use App\Realisasi_Renstra;
use App\Realisasi_Renstra_Target;
use App\Realisasi_Renstra_Tprog;


use App\Status_E55;

//excel eksport
use App\Exports\EvaluasiRenja_Report;
use App\Exports\EvaluasiRkpd_Report;
use Maatwebsite\Excel\Facades\Excel;
class EvaluasiRenstraController extends Controller
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
    	if (!Auth::guard('opd')->check() and !Auth::guard('web')->check()){
    	    return redirect('/');
    	}
    	
        $periode = request()->get('periode');
        if (Auth::guard('web')->check()) {
            $data_opd= Data_Opd::all();
            $opd= Urusan_Opd::all();
        }else{
            $id_instansi=Auth::guard('opd')->user()->id_instansi;
            $data_opd= Data_Opd::where('id',$id_instansi)->get();
            $opd= Urusan_Opd::where('id_instansi',$id_instansi)->get();
            //dd($data_opd);
        }
        $dafunit= dafunit::all();
        $rpjmd_prog= rpjmd_prog::where('unitkey','!=','0_')->where('id_status','=','1')->get();
        $rpjmd_prog_non= rpjmd_prog::where('unitkey','0_')->where('id_status','=','1')->get();
        //dd($data_opd);
        return view('admin.data.evaluasi_renstra.index',compact('opd','dafunit','rpjmd_prog','rpjmd_prog_non','data_opd','periode'));
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
        $pesan = 'gagal disimpan';
        $store=null;
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
            $p_re = $request->input('p_re.'.$key);
            $p_t1 = str_replace(',', '', $request->input('p_t1.'.$key));
            $p_t2 = str_replace(',', '', $request->input('p_t2.'.$key));
            $p_t3 = str_replace(',', '', $request->input('p_t3.'.$key));
            $p_t4 = str_replace(',', '', $request->input('p_t4.'.$key));
            $p_t5 = str_replace(',', '', $request->input('p_t5.'.$key));
            $p_t6 = str_replace(',', '', $request->input('p_t6.'.$key));
            if($p_re != "" or $p_t1 != "" or $p_t2 != "" or $p_t3 != "" or $p_t4 != ""){
               $store=[
                       'id_ind_prog' => $id_ind_prog,
                       'ket_prog' => $ket_prog,
                       'fpenghambat_prog' => $fpenghambat_prog,
                       'fpendorong_prog' => $fpendorong_prog,
                       'p_re' => $p_re ? $p_re : null,
                       'p_t1' => $p_t1 ? $p_t1 : null,
                       'p_t2' => $p_t2 ? $p_t2 : null,
                       'p_t3' => $p_t3 ? $p_t3 : null,
                       'p_t4' => $p_t4 ? $p_t4 : null,
                       'p_t5' => $p_t5 ? $p_t5 : null,
                       'p_t6' => $p_t6 ? $p_t6 : null
                   ];
                // cek
                $cek = Realisasi_Renstra_Tprog::where('id_ind_prog', '=', $request->input('id_ind_prog.'.$key))->first();
                // simpan
                if ($cek === null) {
                      Realisasi_Renstra_Tprog::create($store);
                }else{
                    $cek->ket_prog=$ket_prog ? $ket_prog : null;
                    $cek->fpenghambat_prog=$fpenghambat_prog ? $fpenghambat_prog : null;
                    $cek->fpendorong_prog=$fpendorong_prog ? $fpendorong_prog : null;
                    $cek->p_re= $p_re ? $p_re : null;
                    $cek->p_t1= $p_t1 ? $p_t1 : null;
                    $cek->p_t2= $p_t2 ? $p_t2 : null;
                    $cek->p_t3= $p_t3 ? $p_t3 : null;
                    $cek->p_t4= $p_t4 ? $p_t4 : null;
                    $cek->p_t5= $p_t5 ? $p_t5 : null;
                    $cek->p_t6= $p_t6 ? $p_t6 : null;
                    $cek->save();
                }
            }
            $pesan='Data berhasil disimpan';
        }
        // simpan realisasi kegiatan
        foreach ($request->id_renja as $key => $value) {
         // $store = $request->input('id_renja.',$key);
            $id_renja = $request->input('id_renja.'.$key);
            // $rp5 = str_replace(',', '', $request->input('rp5.'.$key));
            // $rp6 = str_replace(',', '', $request->input('rp6.'.$key));
            $rpt1 = str_replace(',', '', $request->input('rpt1.'.$key));
            $rpt2 = str_replace(',', '', $request->input('rpt2.'.$key));
            $rpt3 = str_replace(',', '', $request->input('rpt3.'.$key));
            $rpt4 = str_replace(',', '', $request->input('rpt4.'.$key));
            $rpt5 = str_replace(',', '', $request->input('rpt5.'.$key));
            $rpt6 = str_replace(',', '', $request->input('rpt6.'.$key));
             if($rpt5 != "" or $rpt6 != "" or $rpt1 != "" or $rpt2 != "" or $rpt3 != "" or $rpt4 != ""){

                // $store=[
                //         'id_renja' => $id_renja,
                //         'rp5' => $rp5 ? $rp5 : null,
                //         'rp6' => $rp6 ? $rp6 : null,
                //         'rpt1' => $rpt1 ? $rpt1 : null,
                //         'rpt2' => $rpt2 ? $rpt2 : null,
                //         'rpt3' => $rpt3 ? $rpt3 : null,
                //         'rpt4' => $rpt4 ? $rpt4 : null
                //     ];

                if($rpt5==""){$rpt5=null;}
                if($rpt6==""){$rpt6=null;}
                if($rpt1==""){$rpt1=null;}
                if($rpt2==""){$rpt2=null;}
                if($rpt3==""){$rpt3=null;}
                if($rpt4==""){$rpt4=null;}

                
                  $cek_renja=M_Renstra::where('id',$id_renja)->first();
                  $store=[
                      'id_renstra' => $id_renja,
                      'rpt5' => $rpt5,
                      'rpt6' => $rpt6,
                      'rpt1' => $rpt1,
                      'rpt2' => $rpt2,
                      'rpt3' => $rpt3,
                      'rpt4' => $rpt4,
                      'periode_renstra' => $cek_renja->periode,
                      'id_instansi_renstra' => $cek_renja->id_instansi,
                      'kdkegunit_renstra' => $cek_renja->kdkegunit
                  ];
                
                
                // $cek = Realisasi_Renstra::where('periode_renstra', $cek_renja->periode)->where('id_instansi_renstra', $cek_renja->id_instansi)->where('kdkegunit_renstra', $cek_renja->kdkegunit)->first();
                  $cek = Realisasi_Renstra::where('id_renstra', $id_renja)->first();
                
                // $cek = Realisasi::where('id_renja', '=', $request->input('id_renja.'.$key))->first();
                if ($cek === null) {
                      Realisasi_Renstra::create($store);
                    
                    // DB::insert('insert into realisasi (id_renja,rp5) values(?,?)', [$key, $request->input('rp5.'.$key)]);
                    // DB::insert('insert into realisasi (id_renja,rp5,rp6,rpt1,rpt2,rpt3,rpt4) values(?,?,?,?,?,?,?)', [$key, $request->input('rp5.'.$key), $request->input('rp6.'.$key, $request->input('rp8.'.$key), $request->input('rp9.'.$key), $request->input('rp10.'.$key), $request->input('rp11.'.$key)]);
                }else{
                    // $cek->rp5=$rp5 ? $rp5 : null;
                    // $cek->rp6=$rp6 ? $rp6 : null;
                    // $cek->rpt1= $rpt1 ? $rpt1 : null;
                    // $cek->rpt2= $rpt2 ? $rpt2 : null;
                    // $cek->rpt3= $rpt3 ? $rpt3 : null;
                    // $cek->rpt4= $rpt4 ? $rpt4 : null;

                    // if($request->input('id_renja')=="awal"){$cek->id_renja=$cek_renja->id;}elseif($request->input('id_renja')=="perubahan"){$cek->id_renja_per=$cek_renja->id;}
                    if($rpt5!=""){$cek->rpt5= $rpt5;}else{$cek->rpt5=null;}
                    if($rpt6!=""){$cek->rpt6= $rpt6;}else{$cek->rpt6=null;}
                    if($rpt1!=""){$cek->rpt1= $rpt1;}else{$cek->rpt1=null;}
                    if($rpt2!=""){$cek->rpt2= $rpt2;}else{$cek->rpt2=null;}
                    if($rpt3!=""){$cek->rpt3= $rpt3;}else{$cek->rpt3=null;}
                    if($rpt4!=""){$cek->rpt4= $rpt4;}else{$cek->rpt4=null;}
                    $cek->save();
                }
            }
            $pesan='Data berhasil disimpan';
        }

        foreach ($request->id_target as $key => $value) {
            $id_target = $request->input('id_target.'.$key);
            $ket_keg = $request->input('ket_keg.'.$key);
            $fpenghambat_keg = $request->input('fpenghambat_keg.'.$key);
            $fpendorong_keg = $request->input('fpendorong_keg.'.$key);
            $kt5 = str_replace(',', '', $request->input('kt5.'.$key));
            $kt6 = str_replace(',', '', $request->input('kt6.'.$key));
            $kt1 = str_replace(',', '', $request->input('kt1.'.$key));
            $kt2 = str_replace(',', '', $request->input('kt2.'.$key));
            $kt3 = str_replace(',', '', $request->input('kt3.'.$key));
            $kt4 = str_replace(',', '', $request->input('kt4.'.$key));

             if($kt5 != "" or $kt6 != "" or $kt1 != "" or $kt2 != "" or $kt3 != "" or $kt4 != ""){
                $store=[
                        'id_target' => $id_target,
                        'ket_keg' => $ket_keg,
                        'fpenghambat_keg' => $fpenghambat_keg,
                        'fpendorong_keg' => $fpendorong_keg,
                        'kt5' => $kt5 ? $kt5 : null,
                        'kt6' => $kt6 ? $kt6 : null,
                        'kt1' => $kt1 ? $kt1 : null,
                        'kt2' => $kt2 ? $kt2 : null,
                        'kt3' => $kt3 ? $kt3 : null,
                        'kt4' => $kt4 ? $kt4 : null
                    ];
                $cek = Realisasi_Renstra_Target::where('id_target', '=', $request->input('id_target.'.$key))->first();
                if ($cek === null) {
                      Realisasi_Renstra_Target::create($store);
                }else{
                    $cek->ket_keg=$ket_keg ? $ket_keg : null;
                    $cek->fpenghambat_keg=$fpenghambat_keg ? $fpenghambat_keg : null;
                    $cek->fpendorong_keg=$fpendorong_keg ? $fpendorong_keg : null;
                    $cek->kt5= $kt5 ? $kt5 : null;
                    $cek->kt6= $kt6 ? $kt6 : null;
                    $cek->kt1= $kt1 ? $kt1 : null;
                    $cek->kt2= $kt2 ? $kt2 : null;
                    $cek->kt3= $kt3 ? $kt3 : null;
                    $cek->kt4= $kt4 ? $kt4 : null;
                    $cek->save();
                }
            }
            $pesan='Data berhasil disimpan';
        }


        $msg = array(
                'info' => 'Info',
                'store' => $store,
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

    public function show_evaluasi_renstra(Request $request,$periode,$id,$id_instansi,$unitkey)
    {
        //session cek
        if (!Auth::guard('opd')->check() and !Auth::guard('web')->check()){
            return redirect('/');
        }
        //$periode=$periode;
        $prog= Rpjmd_Prog::where('idprgrm',$id)->where('id_instansi',$id_instansi)->first();
//        $rpjmd_prog_indikator= Rpjmd_Prog_Indikator::where('idprgrm',$id)->where('id_instansi',$id_instansi)->get();
        
          $renja=M_Renstra::where('periode',$periode)->where('id_instansi',$id_instansi)
          ->where('idprgrm',$id)
          ->get();          
        

        return view('admin.data.evaluasi_renstra.modal_renstra',compact('prog','renja','periode'))->renderSections()['content'];
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
    
    public function ekspor_renja_excel($periode,$jenis,$id_instansi,$triwulan,$rekap,$data_renja){
        //session cek
        if (!Auth::guard('opd')->check() and !Auth::guard('web')->check()){
            return redirect('/');
        }
        
       $opd=Data_Opd::find($id_instansi);
       if (Auth::guard('web')->check()){
            $nm_instansi=$opd->nm_instansi;
       }else{
            $data_opd=Auth::guard('opd')->user()->id_instansi;
            $do=Data_Opd::find($data_opd);
            $nm_instansi=$do->nm_instansi;
            $id_instansi=$do->id;
       }

       if($rekap!="Detail"){$nmrekap="Rekap-Program_";}else{$nmrekap="";}
       if($jenis=="RKPD"){
          return (new EvaluasiRenja_Report($periode,$jenis,$id_instansi,$triwulan,$rekap,$data_renja))->download($nmrekap.'E.19 - Evaluasi_RKPD_'.$periode.'_'.$nm_instansi.'_Triwulan-'.$triwulan.'('.date('Y-m-d').').xlsx');
       }elseif($jenis=="RKPD Per-Urusan"){
          return (new EvaluasiRkpd_Report($periode,$triwulan,$rekap,$data_renja))->download($nmrekap.'E.19 - Evaluasi_RKPD_Per-Urusan'.$periode.'_Triwulan-'.$triwulan.'('.date('Y-m-d').').xlsx');
       }else{
          return (new EvaluasiRenja_Report($periode,$jenis,$id_instansi,$triwulan,$rekap,$data_renja))->download($nmrekap.'E.55 - Evaluasi_Renja_'.$periode.'_'.$nm_instansi.'_Triwulan-'.$triwulan.'('.date('Y-m-d').').xlsx');
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
    Route::get('renja_impor','RenjaController@impor');
    public function impor(){
        $url_json = 'http://localhost/api_eplanning/rkpd/data_rancangan_akhir.json';
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
                        'tags' => $r->tags
                    ];

                    //dd($store);
                Renja::create($store);
                
            }
        }
        }
    }

    */
    //import kegiatan indikator
    //Route::get('renja_impor_indikator','RenjaController@impor_indikator');
    //     public function impor_indikator(){
    //     $url_json = 'http://localhost/api_eplanning/rkpd/data_rancangan_akhir_kinkeg.json';
    //     $data_json = file_get_contents($url_json);
    //     $urusan_opd = json_decode($data_json);
    //     //dd($urusan_opd);
    //     foreach ($urusan_opd as $v) {
    //     if($v->type=="table")
    //     {
    //         //dd($v->data);
    //         foreach ($v->data as $r) {                
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

    //                 //dd($store);
    //             Renja_Indikator::create($store);
                
    //         }
    //     }
    //     }
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
    //             Renja_Indikator_Det::create($store);
    //             }
    // }
}
