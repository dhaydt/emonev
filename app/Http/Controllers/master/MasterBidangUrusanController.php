<?php

namespace App\Http\Controllers\master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Dafunit;
use Validator;

class MasterBidangUrusanController extends Controller
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
            //DB::enableQueryLog();
            //dd(DB::getQueryLog());
            
            $urusan= Dafunit::Level('1')->get();
            $burusan= Dafunit::Level('2')->get();
            //$burusan= Dafunit::with('parent')->get();
            //dd($burusan);
            return view('admin.master.bidang_urusan.index',compact('urusan','burusan'));
        }

        public function index_dafunit()
        {
            $urusan= Dafunit::Level('1')->get();
            return view('admin.master.bidang_urusan.index_dafunit',compact('urusan'));
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            $urusan= Dafunit::Level('1')->get();
            return view('admin.master.bidang_urusan.create',compact('urusan'));
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
                    'parent_id' => $request->id_urusan,
                    'kdunit' => $request->kdunit,
                    'id_status' => 1,
                    'kdlevel' => 2,
                    'unitkey' => $request->unit_key,
                    'nm_unit' => $request->nm_burusan,
                    'type' => $request->tipe
                ];
            
            $validator = Validator::make(request()->all(), [
                'id_urusan'  => 'required',
                'kdunit'  => 'required',
                'unit_key' => 'required',
                'nm_burusan' => 'required',
            ]);
            
            if ($validator->fails()) {
                
                return redirect()->back()->withErrors($validator->errors());
                //dd($validator->fails());

            }
                $cek = Dafunit::where([
                        ['kdunit', '=', $request->kdunit],
                        ['unitkey', '=', $request->unit_key],
                    ])->first();
                //dd($cek);
                
                if ($cek === null) {
                    Dafunit::create($store);
                    return redirect()->route('bidang_urusan.index')->with('sukses','Data tersimpan');
                }else{
                    return redirect()->route('bidang_urusan.create')->with('fail','Data Gagal disimpan/data sudah ada');
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
            $urusan= Dafunit::Level('1')->get();
            $burusan=Dafunit::find($id);

            return view('admin.master.bidang_urusan.edit',compact('urusan','burusan'));
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
                'id_urusan'=>'required',
                'kdunit'=>'required',
                'unit_key'=>'required',
                'nm_burusan'=>'required',
            ]);

            $cek = Dafunit::find($id)->first();
                //dd($cek);
                
            if ($cek !== null) {
                $urusan=Dafunit::find($id);
                $urusan->parent_id=$request->get('id_urusan');
                $urusan->kdunit=$request->get('kdunit');
                $urusan->unitkey=$request->get('unit_key');
                $urusan->nm_unit=$request->get('nm_burusan');
                $urusan->type=$request->get('tipe');
                $urusan->save();
                return redirect()->route('bidang_urusan.index')
                    ->with('sukses','Bidang urusan berhasil diubah');
            }else{
                return redirect()->route('bidang_urusan.edit', $id)->with('fail','Data Gagal diubah');
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
            $cek = Dafunit::find($id);
                //dd($cek);
                
            if ($cek !== null) {
                $cek->delete();
                return redirect()->route('bidang_urusan.index')->with('sukses','Data dihapus');
            }else{
                return redirect()->route('bidang_urusan.index')->with('sukses','Data gagal dihapus');
            }
        }

}
