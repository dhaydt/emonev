<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Data_Opd;
// use App\Urusan_Opd;
// use App\Dafunit;

// use App\Rpjmd_Prog;
// use App\Rpjmd_Prog_Indikator;


// use App\Program;
use App\Renstra_Keg;
use App\Sub_Keg;

use Validator;
//use App\Renja_Keg;

class SubkegController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subkeg=Sub_Keg::orderby('kdkegunit','asc')->orderby('id','asc')->get();
        return view('admin.master.subkegiatan.index',compact('subkeg'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prog=Renstra_Keg::all();
        $thn=date('y');
        $bln=date('m');
        $hr=date('d');
        $h=date('h');
        $i=date('i');
        $s=date('s');
        $id=$thn.$bln.$hr.$h.$i.$s;
        return view('admin.master.subkegiatan.create',compact('prog','id'));
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
                'kdkegunit' => $request->idprgrm,
                'nmsub_keg' => $request->nmkegunit,
                'id_status' => $request->id_status
                ];
        
        $validator = Validator::make(request()->all(), [
            'id'  => 'required',
            'idprgrm'  => 'required',
            'nmkegunit'  => 'required',
            'id_status'  => 'required',
        ]);
        //dd($store);
        if ($validator->fails()) {
            
            return redirect()->back()->withErrors($validator->errors());
            //dd($validator->fails());

        }
            $cek = Sub_Keg::where('nmsub_keg', '=', $request->nmkegunit)->where('id', '=', $request->id)->first();
            //dd($cek);
            
            if ($cek === null) {
                Sub_Keg::create($store);
                return redirect()->route('mastersubkegiatan.index')->with('sukses','Data tersimpan');
            }else{
                return redirect()->route('mastersubkegiatan.create')->with('fail','Data Gagal disimpan/data sudah ada');
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
        $prog = Renstra_Keg::all();
        $kegiatan = Sub_Keg::find($id);
        return view('admin.master.subkegiatan.edit',compact('kegiatan','prog'));
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
            'idprgrm'  => 'required',
            'nmkegunit'  => 'required',
            'id_status'  => 'required',
        ]);

        $cek = Sub_Keg::find($id)->first();
            //dd($cek);
            
        if ($cek !== null) {
            $kegiatan=Sub_Keg::find($id);
            $kegiatan->kdkegunit=$request->get('idprgrm');
            $kegiatan->nmsub_keg=$request->get('nmkegunit');
            $kegiatan->id_status=$request->get('id_status');
            $kegiatan->save();
            return redirect()->route('mastersubkegiatan.index')
                ->with('sukses','Data berhasil diubah');
        }else{
            return redirect()->route('mastersubkegiatan.index', $id)->with('fail','Data Gagal diubah');
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
        $cek = Sub_Keg::find($id);
            
        if ($cek !== null) {
            $cek->delete();
            return redirect()->route('mastersubkegiatan.index')->with('sukses','Data dihapus');
        }else{
            return redirect()->route('mastersubkegiatan.index')->with('sukses','Data gagal dihapus');
        }
    }
}
