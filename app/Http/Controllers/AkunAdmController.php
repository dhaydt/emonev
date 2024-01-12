<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Validator;

use App\User;

class AkunAdmController extends Controller
{
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
        $data=User::all();
        return view('admin.master.akunadm.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.master.akunadm.create');
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
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'email' => $request->email,
                'level' => $request->level
                ];
        
        $validator = Validator::make(request()->all(), [
            'name'  => 'required',
            'password'  => 'required',
            'email'  => 'required',
            'level'  => 'required',
        ]);
        
        if ($validator->fails()) {
            
            return redirect()->back()->withErrors($validator->errors());
            //dd($validator->fails());

        }
            $cek = User::where('email', '=', $request->email)->first();
            //dd($cek);
            
            if ($cek === null) {
                User::create($store);
                return redirect()->route('akun-adm.index')->with('sukses','Data tersimpan');
            }else{
                return redirect()->route('akun-adm.create')->with('fail','Data Gagal disimpan/data sudah ada');
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
        $adm= User::find($id);
        return view('admin.master.akunadm.edit',compact('adm'));
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
            'name'  => 'required',
            'email'  => 'required',
            'level'  => 'required',
        ]);

        $cek = User::find($id);
            //dd($cek);
            
        if ($cek !== null) {
            $adm=User::find($id);
            $adm->name=$request->get('name');
            $adm->email=$request->get('email');
            $adm->level=$request->get('level');
            if($request->get('password')!=""){
                $adm->password=Hash::make($request->get('password'));
            }
            $adm->save();
            return redirect()->route('akun-adm.index')
                ->with('sukses','Data berhasil diubah');
        }else{
            return redirect()->route('akun-adm.edit', $id)->with('fail','Data Gagal diubah');
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
        $cek = User::find($id);
            
        if ($cek !== null) {
            $cek->delete();
            return redirect()->route('akun-adm.index')->with('sukses','Data dihapus');
        }else{
            return redirect()->route('akun-adm.index')->with('sukses','Data gagal dihapus');
        }
    }
}
