<?php

namespace App\Http\Controllers\master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Periode_Rpjmd;
use Validator;

class MasterPeriodeRpjmdController extends Controller
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
            $prpjmd= Periode_Rpjmd::orderby('id','desc')->get();
            return view('admin.master.periode_rpjmd.index',compact('prpjmd'));
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            return view('admin.master.periode_rpjmd.create');
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
                    'thn_awal' => $request->thn_awal,
                    'thn_akhir' => $request->thn_akhir,
                    'judul' => $request->judul
                ];
            
            $validator = Validator::make(request()->all(), [
                'thn_awal'  => 'required',
                'thn_akhir'  => 'required',
                'judul' => 'required',
            ]);
            
            if ($validator->fails()) {
                
                return redirect()->back()->withErrors($validator->errors());
            }
                $cek = Periode_Rpjmd::create($store);
                // if ($cek === null) {
                    return redirect()->route('periode_rpjmd.index')->with('sukses','Data tersimpan');
                // }else{
                //     return redirect()->route('periode_rpjmd.create')->with('fail','Data Gagal disimpan/data sudah ada');
                // }
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            $periode_rpjmd=Periode_Rpjmd::find($id);

            return view('admin.master.periode_rpjmd.edit',compact('periode_rpjmd'));
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
                'thn_awal'  => 'required',
                'thn_akhir'  => 'required',
                'judul' => 'required',
            ]);

            $cek = Periode_Rpjmd::find($id)->first();
                
            if ($cek !== null) {
                $periode_rpjmd=Periode_Rpjmd::find($id);
                $periode_rpjmd->thn_awal=$request->get('thn_awal');
                $periode_rpjmd->thn_akhir=$request->get('thn_akhir');
                $periode_rpjmd->judul=$request->get('judul');
                $periode_rpjmd->save();
                return redirect()->route('periode_rpjmd.index')
                    ->with('sukses','data berhasil diubah');
            }else{
                return redirect()->route('periode_rpjmd.edit', $id)->with('fail','Data Gagal diubah');
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
            $cek = Periode_Rpjmd::find($id);
                //dd($cek);
                
            if ($cek !== null) {
                $cek->delete();
                return redirect()->route('periode_rpjmd.index')->with('sukses','Data dihapus');
            }else{
                return redirect()->route('periode_rpjmd.index')->with('sukses','Data gagal dihapus');
            }
        }

}
