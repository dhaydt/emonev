<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\hash;
use Illuminate\Support\Facades\Auth;

use Validator;

use App\Opd;
use App\Data_Opd;

class ProfilOpdController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:opd');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $opd= Opd::find(Auth::id());
        return view('admin.master.akunopd.profil',compact('opd'));
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
            'nip'  => 'required',
            'nm_pegawai'  => 'required',
            'nip_pimpinan'  => 'required',
            'pimpinan'  => 'required',
        ]);

        $cek = Opd::find(Auth::id());
            //dd($cek);
            
        if ($cek !== null) {
            // $opd=Opd::where('id_instansi',Auth::id())->first();
            $cek->nip=$request->get('nip');
            $cek->nm_pegawai=$request->get('nm_pegawai');
            $cek->save();

            $data_opd=Data_Opd::find($cek->id_instansi);
            $data_opd->nip=$request->get('nip_pimpinan');
            $data_opd->kepala=$request->get('kepala');
            $data_opd->pimpinan=$request->get('pimpinan');
            $data_opd->telp=$request->get('telp');
            $data_opd->alamat=$request->get('alamat');
            $data_opd->save();

            return redirect()->route('profil.index')
                ->with('sukses','Data berhasil diubah');
        }else{
            return redirect()->route('profil.index')->with('fail','Data Gagal diubah');
        }
    }

}
