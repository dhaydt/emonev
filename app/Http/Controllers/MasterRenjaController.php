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
use App\Rpjmd_Prog;
use App\Rpjmd_Prog_Indikator;

use App\Renstra_Keg;

use App\Realisasi;
use App\Realisasi_Target;

use App\Periode_Renja;

use App\Renja_Per;
use App\Renja_Indikator_Per;
use App\Rkpd_subkeg_ind;
use App\Sasaran_Pembangunan;
use DB;
class MasterRenjaController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
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
        
        $periode_renja=Periode_Renja::orderby('id','asc')->get();
        $periode = request()->get('periode');
        $cek_prenja=Periode_Renja::find(request()->get('periode'));
        if($cek_prenja!=null){$id_periode_rpjmd=$cek_prenja->id_periode_rpjmd;}else{$id_periode_rpjmd=0;}

        $data_opd_all= Data_Opd::all();        
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
        $rpjmd_prog= rpjmd_prog::where('unitkey','!=','0_')->where('id_status','=','1')->where('id_periode_rpjmd',$id_periode_rpjmd)->get();
        $rpjmd_prog_non= rpjmd_prog::where('unitkey','0_')->where('id_status','=','1')->where('id_periode_rpjmd',$id_periode_rpjmd)->get();

        if(Request()->get('data_renja')=="perubahan"){$data_renja="perubahan";}else{$data_renja="awal";}
        return view('admin.data.master_renja.index',compact('opd','dafunit','data_opd','data_opd_all','periode','rpjmd_prog','rpjmd_prog_non','periode_renja','data_renja'));
    }

    public function show_kegiatan(Request $request,$periode,$data_renja,$id,$id_instansi,$unitkey)
    {
        // periode
        $periode_renja=Periode_Renja::orderby('id','asc')->get();
        $cek_prenja=Periode_Renja::find($periode);
        if($cek_prenja!=null){$id_periode_rpjmd=$cek_prenja->id_periode_rpjmd;}else{$id_periode_rpjmd=0;}

        //$periode=$periode;
        $opd= Data_Opd::where('id',$id_instansi)->first();
        $prog= Rpjmd_Prog::where('idprgrm',$id)->where('id_instansi',$id_instansi)->where('id_periode_rpjmd',$id_periode_rpjmd)->first();
        if($data_renja!="perubahan"){
            if (Auth::guard('web')->check()) {
                $renja=Renja::where('periode',$periode)->where('id_instansi',$id_instansi)
                ->where('bappeda',1)
                ->where('idprgrm',$id)
                ->orderby('id','asc')
                ->get();
            }else{
                $renja=Renja::where('periode',$periode)->where('id_instansi',$id_instansi)
                ->where('bappeda',1)
                ->where('idprgrm',$id)
                ->orderby('id','asc')
                ->get();
            }
        }else{
            // perubahan
            if (Auth::guard('web')->check()) {
                $renja=Renja_Per::where('periode',$periode)->where('id_instansi',$id_instansi)
                ->where('bappeda',1)
                ->where('idprgrm',$id)
                ->orderby('id','asc')
                ->get();
            }else{
                $renja=Renja_Per::where('periode',$periode)->where('id_instansi',$id_instansi)
                ->where('bappeda',1)
                ->where('idprgrm',$id)
                ->orderby('id','asc')
                ->get();
            }
        }
        $keg=Renstra_Keg::where('idprgrm',$id)->get();
        $sasaran_pembangunan=Sasaran_Pembangunan::get();
        return view('admin.data.master_renja.modal_master_renja',compact('prog','renja','periode','keg','id_instansi','unitkey','opd','data_renja','sasaran_pembangunan'))->renderSections()['content'];
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
        $id_renja=$request->input('id_renja');
        $ind=$request->input('ind');
        $pind=$request->input('pind');
        
        $id_kegindikator=$request->input('id_kegindikator');

        if($id_renja!=""){
            // simpan indikator
            $periode = $request->input('periode');
            $store=[
                        'id_renja' => $id_renja,
                        'kdjkk' => '02',
                        'kdkegunit' => 0,
                        'kdtahap' => 0,
                        'tolokur' => $ind,
                        'ind_st' => $pind,
                        'periode' => $periode,
                    ];
                if($request->input('data_renja')!="perubahan"){
                    Renja_Indikator::create($store);                    
                }else{
                    Renja_Indikator_Per::create($store);
                }

                $pesan="Indikator berhasil disimpan";
        }elseif($id_kegindikator!=""){
            $periode = $request->input('periode');
            $id_instansi = $request->input('id_instansi');
            
            if($request->input('data_renja')!="perubahan"){
                // $cekind_renja=Renja_Indikator::where('id',$id_kegindikator)->first();
                // $cek=DB::table('renja_indikator')
                //     ->join('renja', 'renja_indikator.id_renja', '=', 'renja.id')
                //     ->select('renja.kdkegunit')->where('renja_indikator.id',$id_kegindikator)->first();                
                $cek=DB::table('rkpd_subkeg_ind')
                    ->where('id',$id_kegindikator)->first();
                $store=[
                            'id_kegindikator' => $id_kegindikator,
                            'sat_det' => $request->input('tsat'),
                            'target_det' => $request->input('tk'),
                            'sub_keg' => $request->input('sub_keg'),
                            'id_instansi' => $id_instansi,
                            'kdkegunit' => $cek->idsubkeg,
                            'periode' => $periode,
                            'id_kegindikator_per' => null,
                            'perubahan' => 2,
                        ];                
            }else{
                // $cek=DB::table('renja_indikator_per')
                    // ->join('renja_per', 'renja_indikator_per.id_renja', '=', 'renja_per.id')
                    // ->select('renja_per.kdkegunit')->where('renja_indikator_per.id',$id_kegindikator)->first();
                $cek=DB::table('rkpd_subkeg_ind')
                    ->where('id',$id_kegindikator)->first();
                
                // 'id_kegindikator' => $id_kegindikator,
                
                $store=[
                            'id_kegindikator' => 0,
                            'sat_det' => $request->input('tsat'),
                            'target_det_per' => $request->input('tk'),
                            'sub_keg_per' => $request->input('sub_keg'),
                            'id_instansi' => $id_instansi,
                            'kdkegunit' => $cek->idsubkeg,
                            'periode' => $periode,
                            'id_kegindikator_per' => $id_kegindikator,
                            'perubahan' => 1,
                        ];
            }

            Renja_Indikator_Det::create($store);
            $pesan="Output berhasil disimpan";
        }else{
            // start tambah renja
            $periode = $request->input('periode');
            $id_instansi = $request->input('id_instansi');
            $unitkey = $request->input('unitkey');
            $idprgrm = $request->input('idprgrm');
            $kdkegunit = $request->input('kdkegunit');
            $id_prioritas = $request->input('id_prioritas');
            $bp = $request->input('bp');
            $pagu = $request->input('pagu');
            $bm = $request->input('bm');
            $lokasi = $request->input('lokasi');
            $rpjmd = $request->input('rpjmd');
            $rkpd = $request->input('rkpd');
            $apbd = $request->input('apbd');
            $sasaran_pembangunan = $request->input('sasaran_pembangunan');
            $sasaran = $request->input('sasaran');

             if($periode != "" or $id_instansi != "" or $unitkey != "" or $idprgrm != ""){
                $nmkegunit=Renstra_Keg::find($kdkegunit);
                $store=[
                        'periode' => $periode,
                        'id_instansi' => $id_instansi,
                        'urusan_key' => $unitkey,
                        'idprgrm' => $idprgrm,
                        'kdkegunit' => $kdkegunit,
                        'id_prioritas' => $id_prioritas,
                        'belanja_p_now' => $bp ? $bp : 0,
                        'belanja_bj_now' => $pagu ? $pagu : 0,
                        'belanja_m_now' => $bm ? $bm : 0,
                        'lokasi' => $lokasi,
                        'rpjmd_st' => $rpjmd,
                        'rkpd_st' => $rkpd,
                        'apbd_st' => $apbd,
                        'id_jenis_belanja' => 2,
                        'bappeda' => 1,
                        'nmkegunit' => $nmkegunit->nmkegunit,
                        'id_sasaran_prioritas' => $sasaran_pembangunan,
                        'sasaran' => $sasaran,
                    ];
                if($request->input('data_renja')!="perubahan"){
                    $cek = Renja::where('periode', '=', $periode)
                        ->where('id_instansi', '=', $id_instansi)
                        ->where('urusan_key', '=', $unitkey)
                        ->where('idprgrm', '=', $idprgrm)
                        ->where('kdkegunit', '=', $kdkegunit)
                        ->first();
                    if ($cek === null) {
                           Renja::create($store);
                        $pesan="data kegiatan tersimpan";
                    }else{
                        $pesan="Kegiatan sudah ada";
                    }
                }else{
                    // perubahan
                    $cek = Renja_Per::where('periode', '=', $periode)
                        ->where('id_instansi', '=', $id_instansi)
                        ->where('urusan_key', '=', $unitkey)
                        ->where('idprgrm', '=', $idprgrm)
                        ->where('kdkegunit', '=', $kdkegunit)
                        ->first();
                    if ($cek === null) {
                           Renja_Per::create($store);
                        $pesan="data kegiatan tersimpan";
                    }else{
                        $pesan="Kegiatan sudah ada";
                    }
                }
            }
            // end tambah renja

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
        if($request->pk!=""){
            $ketemu=strpos($request->pk,',');
            $pesan="indikator gagal update";
            if($ketemu){
                $pk=explode(',', $request->pk);
                if($pk[2] != "perubahan"){
                    Renja_Indikator_Det::find($pk[0])->update([$request->name => $request->value]);
                    $pesan="indikator_det di update";
                }else{
                    $kolom=$request->name;
                    if($kolom=="target_det"){
                        $kolom="target_det_per";
                    }elseif($kolom=="sub_keg"){
                        $kolom="sub_keg_per";
                    }
                    Renja_Indikator_Det::find($pk[0])->update([$kolom => $request->value]);
                    $pesan="indikator_det di update";
                }
            }else{
                $pk=explode('/', $request->pk);
                if($pk[1] != "perubahan"){
                    // Renja_Indikator::find($pk[0])->update([$request->name => $request->value]);
                    Rkpd_subkeg_ind::find($pk[0])->update([$request->name => $request->value]);
                }else{
                    // Renja_Indikator_Per::find($pk[0])->update([$request->name => $request->value]);
                    Rkpd_subkeg_ind::find($pk[0])->update([$request->name => $request->value]);
                }
                
                $pesan="indikator di update";
            }
            return response()->json(['success'=>$pesan]);
        }else{
                // start edit kegiatan renja
                $id_prioritas = $request->input('id_prioritas');
                $bp = $request->input('bp');
                $pagu = $request->input('pagu');
                $bm = $request->input('bm');
                $lokasi = $request->input('lokasi');
                $rpjmd = $request->input('rpjmd');
                $rkpd = $request->input('rkpd');
                $apbd = $request->input('apbd');
                $bappeda = $request->input('bappeda');
                $id_sasaran_prioritas = $request->input('id_sasaran_prioritas');
                $sasaran = $request->input('sasaran');
                
                if($request->input('data_renja')!="perubahan"){
                    $cek = Renja::find($id);
                }else{
                    // perubahan
                    $cek = Renja_Per::find($id);
                }
                
                if ($cek !== null) {
                    $cek->id_prioritas= $id_prioritas;
                    $cek->belanja_p_now= $bp ? $bp : 0;
                    $cek->belanja_bj_now= $pagu ? $pagu : 0;
                    $cek->belanja_m_now= $bm ? $bm : 0;
                    $cek->lokasi= $lokasi;
                    $cek->rpjmd_st= $rpjmd;
                    $cek->rkpd_st= $rkpd;
                    $cek->apbd_st= $apbd;
                    $cek->bappeda= $bappeda;
                    $cek->id_sasaran_prioritas= $id_sasaran_prioritas;
                    $cek->sasaran= $sasaran;
                    $cek->save();
                    $pesan='Data berhasil diubah';
                }else{
                    $pesan='Data gagal disimpan';
                }
                $msg = array(
                        'info' => 'Info',
                        'store' => $id,
                        'msg' => $pesan
                      );

                return json_encode($msg);
                // end edit kegiatan renja
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if($request->tabel=="ind"){
            if($request->data_renja!="perubahan"){
                $cek = Renja_Indikator::find($id);
                // $cek2 = Renja_Indikator_Det::where('id_kegindikator',$id);                
            }else{
                $cek = Renja_Indikator_Per::find($id);
                // $cek2 = Renja_Indikator_Det::where('id_kegindikator',$id);
            }

                
            if ($cek !== null) {
                $cek->delete();
                // if($cek2 !== null){$cek2->delete();}
                $pesan='Data indikator dihapus';
            }else{
                $pesan='Data indikator gagal dihapus';
            }
        }elseif($request->tabel=="ind_det"){
            $cek = Renja_Indikator_Det::find($id);
                
            if ($cek !== null) {
                if($request->data_renja!="perubahan"){
                    $cek->id_kegindikator= 0;
                    $cek->save();
                }else{
                    $cek->id_kegindikator_per= 0;
                    $cek->perubahan= 0;
                    $cek->save();
                }

                $pesan='Data satuan dan target(K) dihapus';
            }else{
                $pesan='Data satuan dan target(K) gagal dihapus';
            }
        }else{
            // start hapus renja
            if($request->data_renja!="perubahan"){
                $cek = Renja::find($id);
                $cek2 = Renja_Indikator::where('id_renja',$id);
            }else{
                $cek = Renja_Per::find($id);
                $cek2 = Renja_Indikator_Per::where('id_renja',$id);
            }

            if ($cek !== null) {
                $cek->delete();
                if($cek2 !== null){$cek2->delete();}
                $pesan='Data renja dihapus';
            }else{
                $pesan=' Data renja gagal dihapus'.$request->tabel;
            }
            // end hapus renja
        }
        $msg = array(
                'info' => 'Info',
                'store' => $id,
                'msg' => $pesan
              );

        return json_encode($msg);
    }
}
