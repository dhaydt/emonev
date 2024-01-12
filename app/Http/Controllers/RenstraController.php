<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data_Opd;
use App\Urusan_Opd;
use App\Dafunit;

use App\Rpjmd_Prog;
use App\Rpjmd_Prog_Indikator;


use App\Program;
use App\Renstra_Keg;

use Validator;
//use App\Renja_Keg;

class RenstraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data_opd= Data_Opd::all();
        // $opd= Urusan_Opd::all();
        // $dafunit= dafunit::all();
        // $rpjmd_prog= rpjmd_prog::where('unitkey','!=','0_')->where('id_status','=','1')->get();
        // $rpjmd_prog_non= rpjmd_prog::where('unitkey','0_')->where('id_status','=','1')->get();
        // //dd($data_opd);
        // return view('admin.data.renstra.index',compact('opd','dafunit','rpjmd_prog','rpjmd_prog_non','data_opd'));

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_kegiatan()
    {
        $renstra=Renstra_Keg::orderby('idprgrm','asc')->orderby('id','asc')->get();
        return view('admin.master.kegiatan.index',compact('renstra'));
    }

    // public function indikator_program($idprgrm,$id_instansi)
    // {
    //     $prog= Rpjmd_Prog::where('idprgrm',$idprgrm)->where('id_instansi',$id_instansi)->first();
    //     //dd($prog);
    //     return view('admin.data.renstra.show',compact('rpjmd_prog_indikator','opd','prog'));
    // }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prog=Program::all();
        $thn=date('y');
        $bln=date('m');
        $hr=date('d');
        $h=date('h');
        $i=date('i');
        $s=date('s');
        $id=$thn.$bln.$hr.$h.$i.$s;
        return view('admin.master.kegiatan.create',compact('prog','id'));
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
                'idprgrm' => $request->idprgrm,
                'kdperspektif' => $request->kdperspektif,
                'nmkegunit' => $request->nmkegunit,
                'levelkeg' => $request->levelkeg,
                'type' => $request->type,
                'kode' => $request->kode,
                'id_status' => $request->id_status
                ];
        
        $validator = Validator::make(request()->all(), [
            'id'  => 'required',
            'idprgrm'  => 'required',
            'kdperspektif'  => 'required',
            'nmkegunit'  => 'required',
            'levelkeg'  => 'required',
            'type'  => 'required',
            'kode'  => 'required',
            'id_status'  => 'required',
        ]);
        //dd($store);
        if ($validator->fails()) {
            
            return redirect()->back()->withErrors($validator->errors());
            //dd($validator->fails());

        }
            $cek = Renstra_Keg::where('nmkegunit', '=', $request->nmkegunit)->where('id', '=', $request->id)->first();
            //dd($cek);
            
            if ($cek === null) {
                Renstra_Keg::create($store);
                return redirect()->route('master-kegiatan')->with('sukses','Data tersimpan');
            }else{
                return redirect()->route('renstra.create')->with('fail','Data Gagal disimpan/data sudah ada');
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
        $prog = Program::all();
        $kegiatan = Renstra_Keg::find($id);
        return view('admin.master.kegiatan.edit',compact('kegiatan','prog'));
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
            'kdperspektif'  => 'required',
            'nmkegunit'  => 'required',
            'levelkeg'  => 'required',
            'type'  => 'required',
            'kode'  => 'required',
            'id_status'  => 'required',
        ]);

        $cek = Renstra_Keg::find($id)->first();
            //dd($cek);
            
        if ($cek !== null) {
            $kegiatan=Renstra_Keg::find($id);
            $kegiatan->idprgrm=$request->get('idprgrm');
            $kegiatan->kdperspektif=$request->get('kdperspektif');
            $kegiatan->nmkegunit=$request->get('nmkegunit');
            $kegiatan->levelkeg=$request->get('levelkeg');
            $kegiatan->type=$request->get('type');
            $kegiatan->kode=$request->get('kode');
            $kegiatan->id_status=$request->get('id_status');
            $kegiatan->save();
            return redirect()->route('master-kegiatan')
                ->with('sukses','Data Program berhasil diubah');
        }else{
            return redirect()->route('renstra.edit', $id)->with('fail','Data Gagal diubah');
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
        $cek = Renstra_Keg::find($id);
            
        if ($cek !== null) {
            $cek->delete();
            return redirect()->route('master-kegiatan')->with('sukses','Data dihapus');
        }else{
            return redirect()->route('master-kegiatan')->with('sukses','Data gagal dihapus');
        }
    }
}
