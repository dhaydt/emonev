<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data_Opd;
use App\Urusan_Opd;
use App\Dafunit;
class UrusanOpdController extends Controller
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
        $data_opd= Data_Opd::orderby('id','asc')->get();
        $opd= Urusan_Opd::all();
        $dafunit= Dafunit::all();
        $bidangurusan=Dafunit::where('kdlevel',2)->get();
        return view('admin.data.urusan_opd.index',compact('opd','dafunit','data_opd','bidangurusan'));
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
        $store=[
                'id_instansi' => $request->id_instansi,
                'arr_urusan' => $request->unitkey,
                'th_awal' => 2019,
                'th_akhir' => 2021
            ];
        $pesan="gagal disimpan";
        $cek=Urusan_Opd::where('id_instansi',$request->id_instansi)->first();
        if ($cek === null) {
            Urusan_Opd::create($store);
            $pesan="data disimpan";
        }else{
            $arr_urusan=$cek->arr_urusan.','.$request->unitkey;
            $cek->update(['arr_urusan' => $arr_urusan]);
            $pesan="data disimpan";
        }
        $daf=Dafunit::where('unitkey',$request->unitkey)->first();
        $urusan=$daf->nm_unit;
        // $store='store';
        $msg = array(
                'info' => 'Info',
                'store' => $store,
                'msg' => $pesan,
                'urusan' => $urusan
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
    public function destroy(Request $request, $id)
    {
        $store=[
            'id_instansi' => $request->id_instansi,
            'arr_urusan' => $request->unitkey,
        ];
        $pesan='gagal dihapus';

        $cek=Urusan_Opd::where('id_instansi',$request->id_instansi)->first();
        if ($cek === null) {
            //Urusan_Opd::create($store);
            $pesan="data gagal dihapus";
        }else{
            //$arr_urusan=$cek->arr_urusan.','.$request->unitkey;
            $no=1;
            $pecah=explode(",",$cek->arr_urusan);
            $arr_urusan="";
            foreach($pecah as $val) {
                if($request->unitkey != $val){
                    if($no>1){
                        $arr_urusan=$arr_urusan.','.$val;
                    }else{
                        $arr_urusan=$val;
                    }
                $no++;
                }
            }
            $cek->update(['arr_urusan' => $arr_urusan]);
            $pesan="data dihapus";
        }
        $msg = array(
                'info' => 'Info',
                'store' => $store,
                'msg' => $pesan
              );
        return json_encode($msg); 
    }

    //import json
    /*public function impor(){
        $url_json = 'http://localhost/api_eplanning/urusan_opd.json';
        $data_json = file_get_contents($url_json);
        $urusan_opd = json_decode($data_json);
        //dd($urusan_opd);
        foreach ($urusan_opd as $v) {
        if($v->type=="table")
        {
            foreach ($v->data as $r) {
                if($r->id == 1){
                    $store=[
                            'id' => $r->id,
                            'id_instansi' => "0",
                            'arr_urusan' => "-",
                            'th_awal' => 2016,
                            'th_akhir' => 2021
                        ];
                        //dd($store);
                    Urusan_Opd::create($store);
                }else{
                    //cari
                    $datalogin=Urusan_Opd::where('id_instansi',$r->id_instansi)->get();

                    if(count($datalogin)>0){
                        $urusan=Urusan_Opd::where('id_instansi',$r->id_instansi)->first();
                        $urusan->arr_urusan= $datalogin[0]['arr_urusan'].",".$r->unitkey;
                        $urusan->save();
                    }else{
                    $store=[
                            'id' => $r->id,
                            'id_instansi' => $r->id_instansi,
                            'arr_urusan' => $r->unitkey,
                            'th_awal' => 2016,
                            'th_akhir' => 2021
                        ];
                    Urusan_Opd::create($store);
                    }
                    //dd($store);
                }
            }
        }
        }
    }*/
}
