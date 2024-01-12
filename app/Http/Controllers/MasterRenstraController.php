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
use App\Renstra_Keg;

use App\M_Renstra;
use App\M_Renstra_Indikator;
use App\M_Renstra_Indikator_Det;

use Validator;
//use App\Renja_Keg;

class MasterRenstraController extends Controller
{
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
        // $data_opd= Data_Opd::all();
        // $opd= Urusan_Opd::all();
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
        return view('admin.data.renstra.index',compact('opd','dafunit','rpjmd_prog','rpjmd_prog_non','data_opd','periode'));
    }

    public function show_kegiatan_renstra(Request $request,$periode,$id,$id_instansi,$unitkey)
    {
        //$periode=$periode;
        $opd= Data_Opd::where('id',$id_instansi)->first();
        $prog= Rpjmd_Prog::where('idprgrm',$id)->where('id_instansi',$id_instansi)->first();
        
        if (Auth::guard('web')->check()) {
            $renja=M_Renstra::where('periode',$periode)->where('id_instansi',$id_instansi)
            // ->where('bappeda',1)
            ->where('idprgrm',$id)
            ->get();
        }else{
            $renja=M_Renstra::where('periode',$periode)->where('id_instansi',$id_instansi)
            // ->where('bappeda',1)
            ->where('idprgrm',$id)
            ->get();
        }
        $keg=Renstra_Keg::where('idprgrm',$id)->get();
        return view('admin.data.renstra.modal_master_renstra',compact('prog','renja','periode','keg','id_instansi','unitkey','opd'))->renderSections()['content'];
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            // insert renstra indikator
            $periode = $request->input('periode');
            $store=[
                        'id_renstra' => $id_renja,
                        'kdjkk' => '02',
                        'tolokur' => $ind,
                    ];
                M_Renstra_Indikator::create($store);
                $pesan="Indikator berhasil disimpan";
        }elseif($id_kegindikator!=""){
            $periode = $request->input('periode');
            $id_instansi = $request->input('id_instansi');
           
                 // $cekind_renja=Renja_Indikator::where('id',$id_kegindikator)->first();
                // $cek=DB::table('m_renstra_indikator')
                //     ->join('m_renstra', 'm_renstra_indikator.id_renstra', '=', 'm_renstra.id')
                //     ->select('m_renstra.kdkegunit')->where('m_renstra_indikator.id',$id_kegindikator)->first();
                $store=[
                            'id_kegindikator' => $id_kegindikator,
                            'sat_det' => $request->input('tsat'),
                            'target_det' => $request->input('tk'),
                            'target2_det' => $request->input('tk2'),
                            'target3_det' => $request->input('tk3'),
                            'target4_det' => $request->input('tk4'),
                            'target5_det' => $request->input('tk5'),
                            'target6_det' => $request->input('tk6'),
                        ];                
            
            M_Renstra_Indikator_Det::create($store);
            $pesan="Output berhasil disimpan";
        }else{
            // insert renstra
            $periode = $request->input('periode');
            $id_instansi = $request->input('id_instansi');
            $unitkey = $request->input('unitkey');
            $idprgrm = $request->input('idprgrm');
            $kdkegunit = $request->input('kdkegunit');
            $id_prioritas = $request->input('id_prioritas');
            $sasaran = $request->input('sasaran');
            $data_awl = $request->input('data_awl');
            $trp_1 = $request->input('trp_1');
            $trp_2 = $request->input('trp_2');
            $trp_3 = $request->input('trp_3');
            $trp_4 = $request->input('trp_4');
            $trp_5 = $request->input('trp_5');
            $trp_6 = $request->input('trp_6');

            if($periode != "" or $id_instansi != "" or $unitkey != "" or $idprgrm != ""){
                $nmkegunit=Renstra_Keg::find($kdkegunit);
                $store=[
                        'periode' => $periode,
                        'id_instansi' => $id_instansi,
                        'urusan_key' => $unitkey,
                        'idprgrm' => $idprgrm,
                        'kdkegunit' => $kdkegunit,
                        'id_prioritas' => $id_prioritas,
                        'nmkegunit' => $nmkegunit->nmkegunit,
                        'sasaran' => $sasaran,
                        'data_awl' => $data_awl,
                        'trp_1' => $trp_1,
                        'trp_2' => $trp_2,
                        'trp_3' => $trp_3,
                        'trp_4' => $trp_4,
                        'trp_5' => $trp_5,
                        'trp_6' => $trp_6,
                    ];
                    $cek = M_Renstra::where('periode', '=', $periode)
                        ->where('id_instansi', '=', $id_instansi)
                        ->where('urusan_key', '=', $unitkey)
                        ->where('idprgrm', '=', $idprgrm)
                        ->where('kdkegunit', '=', $kdkegunit)
                        ->first();
                    if ($cek === null) {
                           M_Renstra::create($store);
                        $pesan="data kegiatan tersimpan";
                    }else{
                        $pesan="Kegiatan sudah ada";
                }                
            }
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
                M_Renstra_Indikator_Det::find($pk[0])->update([$request->name => $request->value]);
                $pesan="indikator_det di update";
            }else{
                $pk=$request->pk;
                // if($pk[1] != "perubahan"){
                    M_Renstra_Indikator::find($pk)->update([$request->name => $request->value]);
                // }else{
                //     Renja_Indikator_Per::find($pk[0])->update([$request->name => $request->value]);
                // }
                
                $pesan="indikator di update";
            }
            return response()->json(['success'=>$pesan]);
        }else{
                // start edit kegiatan renja
                $id_prioritas = $request->input('id_prioritas');
                $sasaran = $request->input('sasaran');
                $data_awl = $request->input('data_awl');
                $trp_1 = $request->input('trp_1');
                $trp_2 = $request->input('trp_2');
                $trp_3 = $request->input('trp_3');
                $trp_4 = $request->input('trp_4');
                $trp_5 = $request->input('trp_5');
                $trp_6 = $request->input('trp_6');
                
                $cek = M_Renstra::find($id);
                
                
                if ($cek !== null) {
                    $cek->id_prioritas= $id_prioritas;
                    $cek->trp_1= $trp_1 ? $trp_1 : 0;
                    $cek->trp_2= $trp_2 ? $trp_2 : 0;
                    $cek->trp_3= $trp_3 ? $trp_3 : 0;
                    $cek->trp_4= $trp_4 ? $trp_4 : 0;
                    $cek->trp_5= $trp_5 ? $trp_5 : 0;
                    $cek->trp_6= $trp_6 ? $trp_6 : 0;
                    $cek->sasaran= $sasaran;
                    $cek->data_awl= $data_awl;
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
    public function destroy(Request $request,$id)
    {
        if($request->tabel=="ind"){
            $cek = M_Renstra_Indikator::find($id);
                
            if ($cek !== null) {
                $cek->delete();
                // if($cek2 !== null){$cek2->delete();}
                $pesan='Data indikator dihapus';
            }else{
                $pesan='Data indikator gagal dihapus';
            }
        }elseif($request->tabel=="ind_det"){
            $cek = M_Renstra_Indikator_Det::find($id);
                
            if ($cek !== null) {
                $cek->delete();
                $pesan='Data satuan dan target(K) dihapus';
            }else{
                $pesan='Data satuan dan target(K) gagal dihapus';
            }
        }else{
            // start hapus renja
            $cek = M_Renstra::find($id);
            $cek2 = M_Renstra_Indikator::where('id_renstra',$id);
            
            if ($cek !== null) {
                $cek->delete();
                if($cek2 !== null){$cek2->delete();}
                $pesan='Data renstra dihapus';
            }else{
                $pesan=' Data renstra gagal dihapus '.$request->tabel;
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
