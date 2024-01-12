<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data_Opd;
use Validator;
class MasterOpdController extends Controller
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
        $opd= Data_Opd::all();
        return view('admin.master.opd.index',compact('opd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.master.opd.create');
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
                'unit_key' => $request->unit_key,
                'kdunit' => $request->kdunit,
                'kdlevel' => $request->kdlevel,
                'tipe' => $request->tipe,
                'nm_instansi' => $request->nm_instansi,
                'nip' => $request->nip,
                'pimpinan' => $request->pimpinan,
                'kepala' => $request->kepala,
                'singkatan' => $request->singkatan,
                'akrounit' => $request->akrounit,
                'telp' => $request->telp,
                'non_urusan' => $request->non_urusan,
                'alamat' => $request->alamat
            ];
        
        $validator = Validator::make(request()->all(), [
            'unit_key'  => 'required',
            'kdunit'  => 'required',
            'kdlevel' => 'required',
            'tipe' => 'required',
            'nm_instansi' => 'required',
            'singkatan' => 'required',
            'akrounit' => 'required',
            'pimpinan' => 'required',
            'non_urusan' => 'required',
        ]);
        
        if ($validator->fails()) {
            
            return redirect()->back()->withErrors($validator->errors());
            //dd($validator->fails());

        }
            $cek = Data_Opd::where('kdunit', '=', $request->kdunit)->orwhere('unit_key', '=', $request->unit_key)->first();
            //dd($cek);
            
            if ($cek === null) {
                Data_Opd::create($store);
                return redirect()->route('data-opd.index')->with('sukses','Data tersimpan');
            }else{
                return redirect()->route('data-opd.create')->with('fail','Data Gagal disimpan/data sudah ada');
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
        $opd= Data_Opd::find($id);
        return view('admin.master.opd.edit',compact('opd'));
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
            'unit_key'  => 'required',
            'kdunit'  => 'required',
            'kdlevel' => 'required',
            'tipe' => 'required',
            'nm_instansi' => 'required',
            'pimpinan' => 'required',
            'singkatan' => 'required',
            'akrounit' => 'required',
            'non_urusan' => 'required',
        ]);

        $cek = Data_Opd::find($id)->first();
            //dd($cek);
            
        if ($cek !== null) {
            $opd=Data_Opd::find($id);
            $opd->unit_key=$request->get('unit_key');
            $opd->kdunit=$request->get('kdunit');
            $opd->kdlevel=$request->get('kdlevel');
            $opd->tipe=$request->get('tipe');
            $opd->nm_instansi=$request->get('nm_instansi');
            $opd->singkatan=$request->get('singkatan');
            $opd->akrounit=$request->get('akrounit');
            $opd->nip=$request->get('nip');
            $opd->kepala=$request->get('kepala');
            $opd->pimpinan=$request->get('pimpinan');
            $opd->telp=$request->get('telp');
            $opd->alamat=$request->get('alamat');
            $opd->non_urusan=$request->get('non_urusan');
            $opd->save();
            return redirect()->route('data-opd.index')
                ->with('sukses','Data OPD berhasil diubah');
        }else{
            return redirect()->route('data-opd.edit', $id)->with('fail','Data Gagal diubah');
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
        $cek = Data_Opd::find($id);
            
        if ($cek !== null) {
            $cek->delete();
            return redirect()->route('data-opd.index')->with('sukses','Data dihapus');
        }else{
            return redirect()->route('data-opd.index')->with('sukses','Data gagal dihapus');
        }
    }
}
