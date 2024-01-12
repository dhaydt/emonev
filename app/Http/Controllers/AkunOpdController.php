<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\hash;
use Illuminate\Support\Facades\Auth;

use Validator;

use App\Opd;
use App\Data_Opd;

class AkunOpdController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Opd::orderby('id_instansi','asc')->get();
        //dd($data);
        return view('admin.master.akunopd.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $data=Data_Opd::orderby('nm_instansi','asc')->get();
        return view('admin.master.akunopd.create',compact('data'));
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
                'username' => $request->username,
                'password' => md5($request->password),
                'email' => $request->email,
                'nip' => $request->nip,
                'nm_pegawai' => $request->nm_pegawai,
                'status' => $request->status
                ];
        
        $validator = Validator::make(request()->all(), [
            'id_instansi'  => 'required',
            'username'  => 'required',
            'password'  => 'required',
            'email'  => 'required',
            'nip'  => 'required',
            'nm_pegawai'  => 'required',
            'status'  => 'required',
        ]);
        
        if ($validator->fails()) {
            
            return redirect()->back()->withErrors($validator->errors());
            //dd($validator->fails());

        }
            $cek = Opd::where('email', '=', $request->email)->first();
            //dd($cek);
            
            if ($cek === null) {
                Opd::create($store);
                return redirect()->route('akun-opd.index')->with('sukses','Data tersimpan');
            }else{
                return redirect()->route('akun-opd.create')->with('fail','Data Gagal disimpan/data sudah ada');
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
        $opd= Opd::find($id);
        $data=Data_Opd::orderby('nm_instansi','asc')->get();
        return view('admin.master.akunopd.edit',compact('opd','data'));
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
            'id_instansi'  => 'required',
            'username'  => 'required',
            'email'  => 'required',
            'nip'  => 'required',
            'nm_pegawai'  => 'required',
            'status'  => 'required',
        ]);

        $cek = Opd::find($id);
            //dd($cek);
            
        if ($cek !== null) {
            $opd=Opd::find($id);
            $opd->id_instansi=$request->get('id_instansi');
            $opd->username=$request->get('username');
            $opd->email=$request->get('email');
            $opd->nip=$request->get('nip');
            $opd->nm_pegawai=$request->get('nm_pegawai');
            $opd->status=$request->get('status');
            if($request->get('password')!=""){
                $opd->password=md5($request->get('password'));
            }
            $opd->save();
            return redirect()->route('akun-opd.index')
                ->with('sukses','Data berhasil diubah');
        }else{
            return redirect()->route('akun-opd.edit', $id)->with('fail','Data Gagal diubah');
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
        $cek = Opd::find($id);
            
        if ($cek !== null) {
            $cek->delete();
            return redirect()->route('akun-opd.index')->with('sukses','Data dihapus');
        }else{
            return redirect()->route('akun-opd.index')->with('sukses','Data gagal dihapus');
        }
    }
}
