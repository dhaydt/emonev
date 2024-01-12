<?php

namespace App\Http\Controllers\master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Periode_Renja;
use App\Periode_Rpjmd;
use App\SetTriwulan;
use Validator;

class MasterPeriodeRenjaController extends Controller
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
            $prenja= Periode_Renja::orderby('id','desc')->get();
            return view('admin.master.periode_renja.index',compact('prenja'));
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            $prpjmd=Periode_Rpjmd::orderby('id','desc')->get();
            return view('admin.master.periode_renja.create',compact('prpjmd'));
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
                    'id' => $request->id,
                    'id_periode_rpjmd' => $request->id_periode_rpjmd,
                    'aktiv' => $request->aktiv
                ];
            
            $validator = Validator::make(request()->all(), [
                'id'  => 'required',
                'id_periode_rpjmd' => 'required',
                'aktiv' => 'required',
            ]);
            $setTriwulan = [
                'thn' => $request->id,
                'tw1' => 1,
                'tw2' => 1,
                'tw3' => 1,
                'tw4' => 1,
                'tw1_src' => 'awal',
                'tw2_src' => 'awal',
                'tw3_src' => 'awal',
                'tw4_src' => 'perubahan',
            ];
            
            if ($validator->fails()) {
                
                return redirect()->back()->withErrors($validator->errors());
            }

                $cek=Periode_Renja::find($request->id);
                if ($cek === null) {
                    Periode_Renja::create($store);
                    SetTriwulan::create($setTriwulan);
                    return redirect()->route('periode_renja.index')->with('sukses','Data tersimpan');
                }else{
                    return redirect()->route('periode_renja.create')->with('fail','Data Gagal disimpan/data sudah ada');
                }
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            $periode_renja=Periode_Renja::find($id);
            $prpjmd=Periode_Rpjmd::orderby('id','desc')->get();
            return view('admin.master.periode_renja.edit',compact('periode_renja','prpjmd'));
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
            $request->validate([
                'id_periode_rpjmd' => 'required',
                'aktiv' => 'required',
            ]);

            $cek = Periode_Renja::find($id)->first();
                
            if ($cek !== null) {
                $periode_renja=Periode_Renja::find($id);
                $periode_renja->id_periode_rpjmd=$request->get('id_periode_rpjmd');
                $periode_renja->aktiv=$request->get('aktiv');
                $periode_renja->save();

                /*if($request->get('aktiv') == 1){
                    $pr = Periode_Renja::all();
                    $data1000['aktiv'] = 0; 

                    foreach($pr as $p){
                        if($p->id != $id){
                                periode_renja::where('id', $p->id)->update($data1000);
                        }
                    }
                }*/

                return redirect()->route('periode_renja.index')
                    ->with('sukses','data berhasil diubah');
            }else{
                return redirect()->route('periode_renja.edit', $id)->with('fail','Data Gagal diubah');
            }
            
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            $cek = Periode_Renja::find($id);
                //dd($cek);
                
            if ($cek !== null) {
                $cek->delete();
                return redirect()->route('periode_renja.index')->with('sukses','Data dihapus');
            }else{
                return redirect()->route('periode_renja.index')->with('sukses','Data gagal dihapus');
            }
        }

}
