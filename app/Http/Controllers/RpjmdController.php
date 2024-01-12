<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data_Opd;
use App\Urusan_Opd;
use App\Dafunit;

use App\Program;
use App\Rpjmd_Prog;
use App\Rpjmd_Prog_Indikator;
use App\Periode_Rpjmd;
use Validator;
class RpjmdController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prpjmd=Periode_Rpjmd::orderby('id','asc')->get();
        $id_periode_rpjmd=Request()->get('id_periode_rpjmd');
        $cekrpjmd=Periode_Rpjmd::find($id_periode_rpjmd);
        if($cekrpjmd!=""){
            $th_awal = $cekrpjmd->thn_awal;
            $th_akhir = $cekrpjmd->thn_akhir;
        }else{
            $th_awal = 0;
            $th_akhir = 0;
        }
        $data_opd= Data_Opd::all();
        $opd= Urusan_Opd::all();
        $dafunit= dafunit::all();
        $rpjmd_prog= rpjmd_prog::where('unitkey','!=','0_')->where('id_status','=','1')->where('id_periode_rpjmd',$id_periode_rpjmd)->get();
        $rpjmd_prog_non= rpjmd_prog::where('unitkey','0_')->where('id_status','=','1')->where('id_periode_rpjmd',$id_periode_rpjmd)->get();
        
        
        $prog_non=Program::where('non_urusan','1')->get();
        $arr_nonurusan=array();
        foreach ($prog_non as $pnu) {
            $arr_nonurusan[]=$pnu->id;
        }
        $program=Program::whereNotIn('id',$arr_nonurusan)->get();
        $program_non_urusan=Program::whereIn('id', $arr_nonurusan)->get();
        //dd($data_opd);
        return view('admin.data.rpjmd.index',compact('opd','dafunit','rpjmd_prog','rpjmd_prog_non','data_opd','program','program_non_urusan','th_awal','th_akhir','prpjmd','id_periode_rpjmd','cekrpjmd','arr_nonurusan'));
    }


    public function indikator_program($idprgrm,$id_instansi,$id_periode_rpjmd)
    {
        $prog= Rpjmd_Prog::where('idprgrm',$idprgrm)->where('id_instansi',$id_instansi)->where('id_periode_rpjmd',$id_periode_rpjmd)->first();
        $opd= Data_Opd::where('id',$id_instansi)->first();
        //dd($opd);
        $rpjmd_prog_indikator= Rpjmd_Prog_Indikator::where('idprgrm',$idprgrm)->where('id_instansi',$id_instansi)->where('id_periode_rpjmd',$id_periode_rpjmd)->get();
        $cekrpjmd=Periode_Rpjmd::find($id_periode_rpjmd);
        if($cekrpjmd!=""){
            $th_awal = $cekrpjmd->thn_awal;
            $th_akhir = $cekrpjmd->thn_akhir;
        }else{
            $th_awal = 0;
            $th_akhir = 0;
        }
        return view('admin.data.rpjmd.show',compact('rpjmd_prog_indikator','opd','prog'));
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
        $pesan='Data gagal disimpan';
        $store='tes';

        if($request->tabel=="rpjmd_indikator"){
        $store=[
                'id_instansi' => $request->id_instansi,
                'idprgrm' => $request->idprgrm,
                'unitkey' => $request->unitkey,
                'indikator' => $request->indikator,
                'satuan' => $request->satuan,
                't1' => $request->t1,
                't2' => $request->t2,
                't3' => $request->t3,
                't4' => $request->t4,
                't5' => $request->t5,
                't6' => $request->t6,
                'id_periode_rpjmd' => $request->id_periode_rpjmd
                ]; 
        $validator = Validator::make(request()->all(), [
            'id_instansi'  => 'required',
            'idprgrm'  => 'required',
            'indikator'  => 'required',
            'unitkey'  => 'required',
        ]);
        
        if ($validator->fails()) {
            
            return redirect()->back()->withErrors($validator->errors());
        }
            $simpan=Rpjmd_Prog_Indikator::create($store);
            if($simpan){$pesan='Indikator ditambahkan';}else{$pesan='Data gagal disimpan';}

            $msg = array(
                    'info' => 'Info',
                    'store' => $store,
                    'msg' => $pesan
                  );

        }elseif ($request->tabel=="rpjmd" and $request->idprgrm!="") {
            $prgrm=Program::where('id',$request->idprgrm)->first();
            $nmprgrm=$prgrm->nmprgrm;
            $id_status=$prgrm->id_status;
            $store=[
                    'id_instansi' => $request->id_instansi,
                    'unitkey' => $request->unitkey,
                    'idprgrm' => $request->idprgrm,
                    'prioritas' => $request->pr,
                    'tahun_awal_rpjmd' => $request->th_awal,
                    'tahun_akhir_rpjmd' => $request->th_akhir,
                    'id_status' => $id_status,
                    'nmprgrm' => $nmprgrm,
                    'id_indikator_rpjmd' => 0,
                    'programindikator' => '-',
                    'nuprgrm' => 0,
                    'id_periode_rpjmd' => $request->id_periode_rpjmd,
                ];
             $simpan=true;
            $simpan=Rpjmd_Prog::create($store);
            if($simpan){$pesan='Program OPD ditambahkan';}else{$pesan='Data gagal disimpan';}

            $msg = array(
                    'info' => 'Info',
                    'store' => $store,
                    'nmprgrm' => $nmprgrm,
                    'msg' => $pesan
                  );
        }
   

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
        $rpjmd_prog_indikator= Rpjmd_Prog_Indikator::where('idprgrm',$id)->get();
        
        return view('admin.data.rpjmd.show',compact('rpjmd_prog_indikator'));
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
        if($request->pk!=""){
                $pk=$request->pk;
                $cek = Rpjmd_Prog_Indikator::find($pk)->update([$request->name => $request->value]);

                $pesan="indikator di update".$pk."/".$request->name."/".$request->value;
            return response()->json(['success'=>$pesan]);
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
        if($request->tabel=="rpjmd_indikator"){
            $cek = Rpjmd_Prog_Indikator::find($id);
            if ($cek !== null) {
                $cek->delete();
                $pesan='Indikator Program dihapus';
            }else{
                $pesan='gagal';
            }
        }if($request->tabel=="rpjmd"){
            $store=[
                'id_instansi' => $request->id_instansi,
                'unitkey' => $request->unitkey,
                'idprgrm' => $request->idprgrm,
            ];
            $pesan='gagal dihapus';
            $cek=Rpjmd_Prog::where('id_instansi',$request->id_instansi)->where('unitkey',$request->unitkey)->where('idprgrm',$request->idprgrm)->first();
            if ($cek === null) {
                $pesan="data gagal dihapus";
            }else{
                $del=$cek->delete();
                if($del){$pesan="data program OPD dihapus";}
            }
        }else{
            $pesan='Program dihapus';
        }
        $msg = array(
                'info' => 'Info',
                'store' => $id,
                'msg' => $pesan
              );

        return json_encode($msg);
    }

    
    /*
    //Route::get('rpjmd_impor','RpjmdController@impor');
    public function impor(){
        $url_json = 'http://localhost/api_eplanning/mpgrm_all.json';
        $data_json = file_get_contents($url_json);
        $urusan_opd = json_decode($data_json);
        //dd($urusan_opd);
        foreach ($urusan_opd as $v) {
        if($v->type=="table")
        {
            //dd($v->data);
            foreach ($v->data as $r) {
                if($r->id_instansi!='' and $r->id_instansi!='-'){
                $url_json2 = 'http://localhost/api_eplanning/urusan_opd.json';
                $data_json2 = file_get_contents($url_json2);
                $urusan_opd2 = json_decode($data_json2);
                    $pecah=explode(",",$r->unitkey_urusan);
                    foreach ($pecah as $key) {
                            foreach ($urusan_opd2 as $v2) {
                                if($v2->type=="table")
                                {
                                        foreach ($v2->data as $r2) {
                                            if($r2->id_urusan == $key){
                                                if($r2->unitkey!=""){
                                                    $id=$r2->unitkey;
                                                }else{
                                                    $id="0_";    
                                                }
                                            }
                                        }

                                }
                            }
                    }
                
                $store=[
                        'id' => $r->id,
                        'idprgrm' => $r->idprgrm,
                        'id_indikator_rpjmd' => $r->id_indikator_rpjmd,
                        'tahun_awal_rpjmd' => 2016,
                        'tahun_akhir_rpjmd' => 2021,
                        'unitkey' => $id,
                        'nmprgrm' => $r->nmprgrm,
                        'programindikator' => $r->programindikator,
                        'id_instansi' => $r->id_instansi,
                        'nuprgrm' => $r->nuprgrm,
                        'id_status' => $r->id_status,
                        'prioritas' => $r->prioritas
                    ];
                //dd($store);
                Rpjmd_Prog::create($store);
                }
                
            }
        }
        }
    }
    */
    public function capaian_rpjmd()
    {
        $data_opd= Data_Opd::all();
        $opd= Urusan_Opd::all();
        $dafunit= dafunit::all();
        $urusan=Dafunit::where('kdlevel',2)->get();
        //$prog_rpjmd=Rpjmd_Prog::all();
        //$rpjmd_prog= rpjmd_prog::where('unitkey','!=','0_')->where('id_status','=','1')->get();
        //$rpjmd_prog_non= rpjmd_prog::where('unitkey','0_')->where('id_status','=','1')->get();
        //dd($data_opd);
        return view('admin.data.rpjmd.capaian_rpjmd',compact('opd','dafunit','data_opd','urusan'));
    }
}
