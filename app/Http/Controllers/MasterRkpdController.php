<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use App\Data_Opd;
use App\Urusan_Opd;
use App\Dafunit;
// use App\Renja;
// use App\Renja_Indikator;
// use App\Renja_Indikator_Det;
// use App\Rpjmd_Prog;
// use App\Rpjmd_Prog_Indikator;

use App\Renstra_Keg;

// use App\Realisasi;
// use App\Realisasi_Target;

use App\Periode_Renja;
use App\Program;
use App\Rkpd_prog;
use App\Rkpd_prog_ind;

use App\Rkpd_keg;
use App\Rkpd_keg_ind;

use App\Rkpd_subkeg;
use App\Rkpd_subkeg_ind;

use App\Sub_Keg;

// use App\Renja_Per;
// use App\Renja_Indikator_Per;

// use App\Sasaran_Pembangunan;
use DB;
class MasterRkpdController extends Controller
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
        
        $periode = request()->get('periode');
        // $cek_prenja=Periode_Renja::find(request()->get('periode'));
        // if($cek_prenja!=null){$id_periode_rpjmd=$cek_prenja->id_periode_rpjmd;}else{$id_periode_rpjmd=0;}

        // $data_opd_all= Data_Opd::all();        
        if (Auth::guard('web')->check()) {
            $data_opd= Data_Opd::orderby('id','asc')->get();
        }else{
            $id_instansi=Auth::guard('opd')->user()->id_instansi;
            $data_opd= Data_Opd::where('id',$id_instansi)->orderby('id','asc')->get();
            //dd($data_opd);
        }

        if(Request()->get('data_renja')=="perubahan"){$data_renja="perubahan";}else{$data_renja="awal";}
        
        if(Request()->get('act')==""){
            $periode_renja=Periode_Renja::where('aktiv', 1)->get();
            return view('admin.data.master_rkpd.index',compact('data_opd','data_renja','periode','periode_renja'));
        }elseif(Request()->get('act')=="rkpd_prog"){
            if (!Auth::guard('web')->check()) {
                $rules = DB::table('rules')->where('path', Request()->get('act'))->where('idopd', Auth::guard('opd')->user()->id_instansi)->get();
            }else{
                $rules = [];
            }
            $data_opd=$data_opd->where('id',Request()->get('opd'))->first();
            $program=Program::all();
            $opd=Request()->get('opd');
            $act=Request()->get('act');

            if(Request()->get('data_renja')=="perubahan"){
                $rkpd_prog=Rkpd_prog::where('idopd',$opd)->where('periode',$periode)->where('prog_perubahan','1')->get();
            }else{
                $rkpd_prog=Rkpd_prog::where('idopd',$opd)->where('periode',$periode)->where('prog_awal','1')->get();
            }

            // dd($rkpd_prog[0]->pagu(8, 2024));
            
            return view('admin.data.master_rkpd.index_prog',compact('data_opd','data_renja','periode','opd','act','program','rkpd_prog','rules'));
        }elseif (Request()->get('act')=="rkpd_kegiatan") {
            if (!Auth::guard('web')->check()) {
                $rules = DB::table('rules')->where('path', Request()->get('act'))->where('idopd', Auth::guard('opd')->user()->id_instansi)->get();
            }else{
                $rules = [];
            }
            $data_opd=$data_opd->where('id',Request()->get('opd'))->first();
            $data_program=Program::where('id',Request()->get('idprog'))->first();
            $opd=Request()->get('opd');
            $idprog=Request()->get('idprog');
            $act=Request()->get('act');

            $kegiatan=Renstra_Keg::where('idprgrm',$idprog)->get();
            
            if(Request()->get('data_renja')=="perubahan"){
                // $rkpd_prog=Rkpd_prog::where('idopd',$opd)->where('periode',$periode)->where('prog_perubahan','1')->get();
                $rkpd_keg=Rkpd_keg::where('idopd',$opd)->where('idprog',$idprog)->where('periode',$periode)->where('keg_perubahan','1')->get();
            }else{
                // $rkpd_prog=Rkpd_prog::where('idopd',$opd)->where('periode',$periode)->where('prog_awal','1')->get();
                $rkpd_keg=Rkpd_keg::where('idopd',$opd)->where('idprog',$idprog)->where('periode',$periode)->where('keg_awal','1')->get();
            }
            
            return view('admin.data.master_rkpd.index_keg',compact('data_opd','data_renja','periode','opd','idprog','act','kegiatan','rkpd_keg','data_program','rules'));
        }elseif (Request()->get('act')=="rkpd_subkegiatan") {
             if (!Auth::guard('web')->check()) {
                $rules = DB::table('rules')->where('path', Request()->get('act'))->where('idopd', Auth::guard('opd')->user()->id_instansi)->get();
            }else{
                $rules = [];
            }
            $data_opd=$data_opd->where('id',Request()->get('opd'))->first();
            $data_kegiatan=Renstra_Keg::where('id',Request()->get('idkeg'))->first();
            $data_program=Program::where('id',$data_kegiatan->idprgrm)->first();
            // dd($data_kegiatan);
            $opd=Request()->get('opd');
            $idkeg=Request()->get('idkeg');
            $act=Request()->get('act');

            $kegiatan=Sub_Keg::where('kdkegunit',$idkeg)->get();
            
            if(Request()->get('data_renja')=="perubahan"){
                // $rkpd_prog=Rkpd_prog::where('idopd',$opd)->where('periode',$periode)->where('prog_perubahan','1')->get();
                // $rkpd_keg=Rkpd_keg::where('idopd',$opd)->where('idprog',$idprog)->where('periode',$periode)->where('keg_perubahan','1')->get();
                $rkpd_subkeg=Rkpd_subkeg::where('idopd',$opd)->where('idkeg',$idkeg)->where('periode',$periode)->where('subkeg_perubahan','1')->get();
            }else{
                // $rkpd_prog=Rkpd_prog::where('idopd',$opd)->where('periode',$periode)->where('prog_awal','1')->get();
                // $rkpd_keg=Rkpd_keg::where('idopd',$opd)->where('idprog',$idprog)->where('periode',$periode)->where('keg_awal','1')->get();
                $rkpd_subkeg=Rkpd_subkeg::where('idopd',$opd)->where('idkeg',$idkeg)->where('periode',$periode)->where('subkeg_awal','1')->get();
            }
            
            return view('admin.data.master_rkpd.index_subkeg',compact('data_opd','data_renja','periode','opd','idkeg','act','kegiatan','rkpd_subkeg','data_kegiatan','data_program','rules'));
        }
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
        if($request->tbl_prog=="Simpan"){
            $store=[
                    'idprog' => $request->idprog,
                    'idopd' => $request->opd,
                    'prog_awal' => $request->prog_awal,
                    'prog_perubahan' => $request->prog_perubahan,
                    'periode' => $request->periode
                ];
            
            // dd($store);

            $validator = Validator::make(request()->all(), [
                'idprog'  => 'required',
                'opd'  => 'required',
            ]);
            
            if ($validator->fails()) {
                
                return redirect()->back()->withErrors($validator->errors());
                //dd($validator->fails());

            }
            
            $cek = Rkpd_prog::where('idopd', '=', $request->idopd)->where('idprog', '=', $request->idprog)->where('periode', '=', $request->periode)->first();
                
                if ($cek === null) {
                    Rkpd_prog::create($store);
                    return redirect()->to('./data-rkpd?periode='.$request->periode.'&data_renja='.$request->data_renja.'&act='.$request->act.'&opd='.$request->opd)->with('sukses','Data tersimpan');
                }else{
                    return redirect()->to('./data-rkpd?periode='.$request->periode.'&data_renja='.$request->data_renja.'&act='.$request->act.'&opd='.$request->opd)->with('fail','Data Gagal disimpan/data sudah ada');
                }    
        }elseif($request->tbl_prog=="Edit"){
            $request->validate([
                'id'  => 'required',
            ]);

            $cek = Rkpd_prog::find($request->id)->first();
                //dd($cek);
                
            if ($cek !== null) {
                $opd=Rkpd_prog::find($request->id);
                // $opd->idprog=$request->idprog;
                $opd->prog_awal=$request->prog_awal;
                $opd->prog_perubahan=$request->prog_perubahan;
                $opd->save();
                return redirect()->to('./data-rkpd?periode='.$request->periode.'&data_renja='.$request->data_renja.'&act='.$request->act.'&opd='.$request->opd)->with('sukses','Data diubah');
            }else{
                return redirect()->to('./data-rkpd?periode='.$request->periode.'&data_renja='.$request->data_renja.'&act='.$request->act.'&opd='.$request->opd)->with('fail','Data Gagal disimpan/data sudah ada');
            }
        }elseif ($request->tbl_prog=="Simpan Indikator") {
            $store=[
                    'idprog' => $request->idprog,
                    'idopd' => $request->opd,
                    'indikator_awal' => $request->indikator_awal,
                    'raw_sat_awal' => $request->raw_sat_awal,
                    'sat_awal' => $request->sat_awal,
                    'target_awal' => $request->target_awal,
                    'indikator_perubahan' => $request->indikator_perubahan,
                    'raw_sat_perubahan' => $request->raw_sat_perubahan,
                    'sat_perubahan' => $request->sat_perubahan,
                    'target_perubahan' => $request->target_perubahan,
                    'prog_ind_awal' => $request->prog_ind_awal,
                    'prog_ind_perubahan' => $request->prog_ind_perubahan,
                    'periode' => $request->periode
                ];
            
            // dd($store);

            $validator = Validator::make(request()->all(), [
                'idprog'  => 'required',
                'opd'  => 'required',
                'periode'  => 'required',
            ]);

            if($request->data_renja=="awal"){
                $cek = Rkpd_prog_ind::where('idopd', '=', $request->opd)->where('idprog', '=', $request->idprog)->where('periode', '=', $request->periode)->where('indikator_awal', '=', $request->indikator_awal)->first();
            }elseif($request->data_renja=="perubahan"){
                $cek = Rkpd_prog_ind::where('idopd', '=', $request->opd)->where('idprog', '=', $request->idprog)->where('periode', '=', $request->periode)->where('indikator_perubahan', '=', $request->indikator_perubahan)->first();
            }
                
                if ($cek === null) {
                    Rkpd_prog_ind::create($store);
                    return redirect()->to('./data-rkpd?periode='.$request->periode.'&data_renja='.$request->data_renja.'&act='.$request->act.'&opd='.$request->opd)->with('sukses','Data tersimpan');
                }else{
                    return redirect()->to('./data-rkpd?periode='.$request->periode.'&data_renja='.$request->data_renja.'&act='.$request->act.'&opd='.$request->opd)->with('fail','Data Gagal disimpan/data sudah ada');
                }    
        }elseif ($request->tbl_prog=="Edit Indikator") {
            $request->validate([
                'id_indikator'  => 'required',
            ]);

            $cek = Rkpd_prog_ind::find($request->id_indikator)->first();
                // dd($store);
                
            if ($cek !== null) {
                $opd=Rkpd_prog_ind::find($request->id_indikator);
                $opd->prog_ind_awal=$request->prog_ind_awal;
                $opd->indikator_awal=$request->indikator_awal;
                $opd->raw_sat_awal=$request->raw_sat_awal;
                $opd->sat_awal=$request->sat_awal;
                $opd->target_awal=$request->target_awal;
                $opd->indikator_perubahan=$request->indikator_perubahan;
                $opd->raw_sat_perubahan=$request->raw_sat_perubahan;
                $opd->sat_perubahan=$request->sat_perubahan;
                $opd->target_perubahan=$request->target_perubahan;
                $opd->prog_ind_perubahan=$request->prog_ind_perubahan;
                $opd->save();
                return redirect()->to('./data-rkpd?periode='.$request->periode.'&data_renja='.$request->data_renja.'&act='.$request->act.'&opd='.$request->opd)->with('sukses','Data diubah');
            }else{
                return redirect()->to('./data-rkpd?periode='.$request->periode.'&data_renja='.$request->data_renja.'&act='.$request->act.'&opd='.$request->opd)->with('fail','Data Gagal disimpan/data sudah ada');
            }
        }elseif($request->tbl_prog=="Simpan_kegiatan"){
            $store=[
                    'idkeg' => $request->idkeg,
                    'idprog' => $request->idprog,
                    'idopd' => $request->opd,
                    'keg_awal' => $request->keg_awal,
                    'keg_perubahan' => $request->keg_perubahan,
                    'periode' => $request->periode
                ];

            // dd($store);
                $validator = Validator::make(request()->all(), [
                    'idkeg'  => 'required',
                    'idprog'  => 'required',
                    'opd'  => 'required',
                ]);
            if ($validator->fails()) {
                
                return redirect()->back()->withErrors($validator->errors());
                //dd($validator->fails());

            }
            
            $cek = Rkpd_keg::where('idopd', '=', $request->opd)->where('idkeg', '=', $request->idkeg)->where('periode', '=', $request->periode)->first();
                
                if ($cek === null) {
                    Rkpd_keg::create($store);
                    return redirect()->to('./data-rkpd?periode='.$request->periode.'&data_renja='.$request->data_renja.'&act='.$request->act.'&opd='.$request->opd.'&idprog='.$request->idprog)->with('sukses','Data tersimpan');
                }else{
                    return redirect()->to('./data-rkpd?periode='.$request->periode.'&data_renja='.$request->data_renja.'&act='.$request->act.'&opd='.$request->opd.'&idprog='.$request->idprog)->with('fail','Data Gagal disimpan/data sudah ada');
                }
        }elseif($request->tbl_prog=="Edit_kegiatan"){
            $request->validate([
                'id'  => 'required',
            ]);

            $cek = Rkpd_keg::find($request->id)->first();
                //dd($cek);
                
            if ($cek !== null) {
                $opd=Rkpd_keg::find($request->id);
                // $opd->idkeg=$request->idkeg;
                $opd->keg_awal=$request->keg_awal;
                $opd->keg_perubahan=$request->keg_perubahan;
                $opd->save();
                return redirect()->to('./data-rkpd?periode='.$request->periode.'&data_renja='.$request->data_renja.'&act='.$request->act.'&opd='.$request->opd.'&idprog='.$request->idprog)->with('sukses','Data tersimpan');
            }else{
                return redirect()->to('./data-rkpd?periode='.$request->periode.'&data_renja='.$request->data_renja.'&act='.$request->act.'&opd='.$request->opd.'&idprog='.$request->idprog)->with('fail','Data Gagal disimpan/data sudah ada');
            }
        }elseif ($request->tbl_prog=="Simpan Indikator_kegiatan") {
            $store=[
                    'idkeg' => $request->idkeg,
                    'idopd' => $request->opd,
                    'indikator_awal' => $request->indikator_awal,
                    'raw_sat_awal' => $request->raw_sat_awal,
                    'sat_awal' => $request->sat_awal,
                    'target_awal' => $request->target_awal,
                    'indikator_perubahan' => $request->indikator_perubahan,
                    'raw_sat_perubahan' => $request->raw_sat_perubahan,
                    'sat_perubahan' => $request->sat_perubahan,
                    'target_perubahan' => $request->target_perubahan,
                    'keg_ind_awal' => $request->keg_ind_awal,
                    'keg_ind_perubahan' => $request->keg_ind_perubahan,
                    'periode' => $request->periode
                ];
            
            // dd($store);

            $validator = Validator::make(request()->all(), [
                'idkeg'  => 'required',
                'opd'  => 'required',
                'periode'  => 'required',
            ]);

            if($request->data_renja=="awal"){
                $cek = Rkpd_keg_ind::where('idopd', '=', $request->opd)->where('idkeg', '=', $request->idkeg)->where('periode', '=', $request->periode)->where('indikator_awal', '=', $request->indikator_awal)->first();
            }elseif($request->data_renja=="perubahan"){
                $cek = Rkpd_keg_ind::where('idopd', '=', $request->opd)->where('idkeg', '=', $request->idkeg)->where('periode', '=', $request->periode)->where('indikator_perubahan', '=', $request->indikator_perubahan)->first();
            }
                
                if ($cek === null) {
                    Rkpd_keg_ind::create($store);
                    return redirect()->to('./data-rkpd?periode='.$request->periode.'&data_renja='.$request->data_renja.'&act='.$request->act.'&opd='.$request->opd.'&idprog='.$request->idprog)->with('sukses','Data tersimpan');
                }else{
                    return redirect()->to('./data-rkpd?periode='.$request->periode.'&data_renja='.$request->data_renja.'&act='.$request->act.'&opd='.$request->opd.'&idprog='.$request->idprog)->with('fail','Data Gagal disimpan/data sudah ada');
                }    
        }elseif ($request->tbl_prog=="Edit Indikator_kegiatan") {
            $request->validate([
                'id_indikator'  => 'required',
            ]);

            $cek = Rkpd_keg_ind::find($request->id_indikator)->first();
                // dd($store);
                
            if ($cek !== null) {
                $opd=Rkpd_keg_ind::find($request->id_indikator);
                $opd->keg_ind_awal=$request->keg_ind_awal;
                $opd->indikator_awal=$request->indikator_awal;
                $opd->raw_sat_awal=$request->raw_sat_awal;
                $opd->sat_awal=$request->sat_awal;
                $opd->target_awal=$request->target_awal;
                $opd->indikator_perubahan=$request->indikator_perubahan;
                $opd->raw_sat_perubahan=$request->raw_sat_perubahan;
                $opd->sat_perubahan=$request->sat_perubahan;
                $opd->target_perubahan=$request->target_perubahan;
                $opd->keg_ind_perubahan=$request->keg_ind_perubahan;
                $opd->save();
                return redirect()->to('./data-rkpd?periode='.$request->periode.'&data_renja='.$request->data_renja.'&act='.$request->act.'&opd='.$request->opd.'&idprog='.$request->idprog)->with('sukses','Data diubah');
            }else{
                return redirect()->to('./data-rkpd?periode='.$request->periode.'&data_renja='.$request->data_renja.'&act='.$request->act.'&opd='.$request->opd.'&idprog='.$request->idprog)->with('fail','Data Gagal disimpan/data sudah ada');
            }
        }elseif($request->tbl_prog=="Simpan_subkegiatan"){
            $store=[
                    'idsubkeg' => $request->idsubkeg,
                    'idkeg' => $request->idkeg,
                    'idopd' => $request->opd,
                    'subkeg_awal' => $request->subkeg_awal,
                    'subkeg_perubahan' => $request->subkeg_perubahan,
                    'periode' => $request->periode,
                    'pagu_awal' => floatval(str_replace(",","",$request->pagu_awal)),
                    'pagu_perubahan' => floatval(str_replace(",","",$request->pagu_perubahan)),
                    'lokasi' => $request->lokasi,
                    'sumber_dana' => $request->sumber_dana,
                    'pn' => $request->pn,
                    'pd' => $request->pd
                ];

            // dd($store);
                $validator = Validator::make(request()->all(), [
                    'idkeg'  => 'required',
                    'idsubkeg'  => 'required',
                    'opd'  => 'required',
                ]);
            if ($validator->fails()) {
                
                return redirect()->back()->withErrors($validator->errors());
                //dd($validator->fails());

            }
            
            $cek = Rkpd_subkeg::where('idopd', '=', $request->opd)->where('idsubkeg', '=', $request->idsubkeg)->where('periode', '=', $request->periode)->first();
                // dd($cek); 
                if ($cek === null) {
                    Rkpd_subkeg::create($store);
                    return redirect()->to('./data-rkpd?periode='.$request->periode.'&data_renja='.$request->data_renja.'&act='.$request->act.'&opd='.$request->opd.'&idkeg='.$request->idkeg)->with('sukses','Data tersimpan');
                }else{
                    return redirect()->to('./data-rkpd?periode='.$request->periode.'&data_renja='.$request->data_renja.'&act='.$request->act.'&opd='.$request->opd.'&idkeg='.$request->idkeg)->with('fail','Data Gagal disimpan/data sudah ada');
                }
        }elseif($request->tbl_prog=="Edit_subkegiatan"){
            $request->validate([
                'id'  => 'required',
            ]);

            $cek = Rkpd_subkeg::find($request->id)->first();
                // dd($request);
                
            if ($cek !== null) {
                $opd=Rkpd_subkeg::find($request->id);
                // $opd->idkeg=$request->idkeg;
                $opd->subkeg_awal=$request->subkeg_awal;
                $opd->subkeg_perubahan=$request->subkeg_perubahan;
                $opd->pagu_awal=floatval(str_replace(",","",$request->pagu_awal));
                $opd->pagu_perubahan=floatval(str_replace(",","",$request->pagu_perubahan));
                $opd->lokasi=$request->lokasi;
                $opd->sumber_dana=$request->sumber_dana;
                $opd->pn=$request->pn;
                $opd->pd=$request->pd;
                $opd->save();
                return redirect()->to('./data-rkpd?periode='.$request->periode.'&data_renja='.$request->data_renja.'&act='.$request->act.'&opd='.$request->opd.'&idkeg='.$request->idkeg)->with('sukses','Data tersimpan');
            }else{
                return redirect()->to('./data-rkpd?periode='.$request->periode.'&data_renja='.$request->data_renja.'&act='.$request->act.'&opd='.$request->opd.'&idkeg='.$request->idkeg)->with('fail','Data Gagal disimpan/data sudah ada');
            }
        }elseif ($request->tbl_prog=="Simpan Indikator_subkegiatan") {
            $store=[
                    'idsubkeg' => $request->idsubkeg,
                    'idopd' => $request->opd,
                    'indikator_awal' => $request->indikator_awal,
                    'raw_sat_awal' => $request->raw_sat_awal,
                    'sat_awal' => $request->sat_awal,
                    'target_awal' => $request->target_awal,
                    'indikator_perubahan' => $request->indikator_perubahan,
                    'raw_sat_perubahan' => $request->raw_sat_perubahan,
                    'sat_perubahan' => $request->sat_perubahan,
                    'target_perubahan' => $request->target_perubahan,
                    'subkeg_ind_awal' => $request->subkeg_ind_awal,
                    'subkeg_ind_perubahan' => $request->subkeg_ind_perubahan,
                    'periode' => $request->periode
                ];
            
            // dd($store);

            $validator = Validator::make(request()->all(), [
                'idsubkeg'  => 'required',
                'opd'  => 'required',
                'periode'  => 'required',
            ]);

            if($request->data_renja=="awal"){
                $cek = Rkpd_subkeg_ind::where('idopd', '=', $request->opd)->where('idsubkeg', '=', $request->idsubkeg)->where('periode', '=', $request->periode)->where('indikator_awal', '=', $request->indikator_awal)->first();
            }elseif($request->data_renja=="perubahan"){
                $cek = Rkpd_subkeg_ind::where('idopd', '=', $request->opd)->where('idsubkeg', '=', $request->idsubkeg)->where('periode', '=', $request->periode)->where('indikator_perubahan', '=', $request->indikator_perubahan)->first();
            }

                
                if ($cek === null) {
                    Rkpd_subkeg_ind::create($store);
                    return redirect()->to('./data-rkpd?periode='.$request->periode.'&data_renja='.$request->data_renja.'&act='.$request->act.'&opd='.$request->opd.'&idkeg='.$request->idkeg)->with('sukses','Data tersimpan');
                }else{
                    return redirect()->to('./data-rkpd?periode='.$request->periode.'&data_renja='.$request->data_renja.'&act='.$request->act.'&opd='.$request->opd.'&idkeg='.$request->idkeg)->with('fail','Data Gagal disimpan/data sudah ada');
                }    
        }elseif ($request->tbl_prog=="Edit Indikator_subkegiatan") {
            $request->validate([
                'id_indikator'  => 'required',
            ]);

            $cek = Rkpd_subkeg_ind::find($request->id_indikator)->first();
                // dd($store);
                
            if ($cek !== null) {
                $opd=Rkpd_subkeg_ind::find($request->id_indikator);
                $opd->subkeg_ind_awal=$request->subkeg_ind_awal;
                $opd->indikator_awal=$request->indikator_awal;
                $opd->raw_sat_awal=$request->raw_sat_awal;
                $opd->sat_awal=$request->sat_awal;
                $opd->target_awal=$request->target_awal;
                $opd->indikator_perubahan=$request->indikator_perubahan;
                $opd->raw_sat_perubahan=$request->raw_sat_perubahan;
                $opd->sat_perubahan=$request->sat_perubahan;
                $opd->target_perubahan=$request->target_perubahan;
                $opd->subkeg_ind_perubahan=$request->subkeg_ind_perubahan;
                $opd->save();
                return redirect()->to('./data-rkpd?periode='.$request->periode.'&data_renja='.$request->data_renja.'&act='.$request->act.'&opd='.$request->opd.'&idkeg='.$request->idkeg)->with('sukses','Data tersimpan');
            }else{
                return redirect()->to('./data-rkpd?periode='.$request->periode.'&data_renja='.$request->data_renja.'&act='.$request->act.'&opd='.$request->opd.'&idkeg='.$request->idkeg)->with('fail','Data Gagal disimpan/data sudah ada');
            }
        }

        
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if($request->tabel=="rkpd_prog"){
            $cek = Rkpd_prog::find($id);
                
            if ($cek !== null) {
                $cek->delete();
                return redirect()->to('./data-rkpd?periode='.$cek->periode.'&data_renja='.$request->data_renja.'&act='.$request->act.'&opd='.$cek->idopd)->with('sukses','Data dihapus');
                
            }else{
                return redirect()->to('./data-rkpd?periode='.$cek->periode.'&data_renja='.$request->data_renja.'&act='.$request->act.'&opd='.$cek->idopd)->with('fail','gagal disimpan');
            }
        }elseif ($request->tabel=="rkpd_prog_ind") {
            $cek = Rkpd_prog_ind::find($id);
                
            if ($cek !== null) {
                $cek->delete();
                return redirect()->to('./data-rkpd?periode='.$cek->periode.'&data_renja='.$request->data_renja.'&act='.$request->act.'&opd='.$cek->idopd)->with('sukses','Data dihapus');
                
            }else{
                return redirect()->to('./data-rkpd?periode='.$cek->periode.'&data_renja='.$request->data_renja.'&act='.$request->act.'&opd='.$cek->idopd)->with('fail','gagal disimpan');
            }
        }elseif ($request->tabel=="rkpd_keg") {
            $cek = Rkpd_keg::find($id);
            if ($cek !== null) {
                $cek->delete();
                return redirect()->to('./data-rkpd?periode='.$cek->periode.'&data_renja='.$request->data_renja.'&act='.$request->act.'&opd='.$cek->idopd.'&idprog='.$cek->idprog)->with('sukses','Data dihapus');
                
            }else{
                return redirect()->to('./data-rkpd?periode='.$cek->periode.'&data_renja='.$request->data_renja.'&act='.$request->act.'&opd='.$cek->idopd.'&idprog='.$cek->idprog)->with('fail','gagal disimpan');
            }
        }elseif ($request->tabel=="rkpd_keg_ind") {
            $cek = Rkpd_keg_ind::find($id);
            $cek2 = Rkpd_keg::where('idkeg',$cek->idkeg)->first();
            if ($cek !== null) {
                $cek->delete();
                return redirect()->to('./data-rkpd?periode='.$cek->periode.'&data_renja='.$request->data_renja.'&act='.$request->act.'&opd='.$cek->idopd.'&idprog='.$cek2->idprog)->with('sukses','Data dihapus');
            }else{
                return redirect()->to('./data-rkpd?periode='.$cek->periode.'&data_renja='.$request->data_renja.'&act='.$request->act.'&opd='.$cek->idopd.'&idprog='.$cek2->idprog)->with('fail','gagal disimpan');
            }
        }elseif ($request->tabel=="rkpd_subkeg") {
            $cek = Rkpd_subkeg::find($id);
            if ($cek !== null) {
                $cek->delete();
                return redirect()->to('./data-rkpd?periode='.$cek->periode.'&data_renja='.$request->data_renja.'&act='.$request->act.'&opd='.$cek->idopd.'&idkeg='.$cek->idkeg)->with('sukses','Data dihapus');
            }else{
                return redirect()->to('./data-rkpd?periode='.$cek->periode.'&data_renja='.$request->data_renja.'&act='.$request->act.'&opd='.$cek->idopd.'&idkeg='.$cek->idkeg)->with('fail','gagal disimpan');
            }
        }elseif ($request->tabel=="rkpd_subkeg_ind") {
            $cek = Rkpd_subkeg_ind::find($id);
            $cek2 = Rkpd_subkeg::where('idsubkeg',$cek->idsubkeg)->first();
            if ($cek !== null) {
                $cek->delete();
                return redirect()->to('./data-rkpd?periode='.$cek->periode.'&data_renja='.$request->data_renja.'&act='.$request->act.'&opd='.$cek->idopd.'&idkeg='.$cek2->idkeg)->with('sukses','Data dihapus');
            }else{
                return redirect()->to('./data-rkpd?periode='.$cek->periode.'&data_renja='.$request->data_renja.'&act='.$request->act.'&opd='.$cek->idopd.'&idkeg='.$cek2->idkeg)->with('fail','gagal disimpan');
            }
        }
    }
}
