<?php

namespace App\Http\Controllers\master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Program;
class MasterProgramController extends Controller
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
        $program=Program::orderby('id','asc')->get();
        // dd($program);
        return view('admin.master.program.index',compact('program'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $p=Program::where('id','not like','_')->max('id');
        $thn=date('y');
        $bln=date('m');
        $hr=date('d');
        $h=date('h');
        $i=date('i');
        $s=date('s');
        $idprgrm=$thn.$bln.$hr.$h.$i.$s;
        
        return view('admin.master.program.create',compact('idprgrm'));
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
                'nmprgrm' => $request->nmprgrm,
                'non_urusan' => $request->non_urusan,
                'id_status' => $request->id_status
                ];
        
        $validator = Validator::make(request()->all(), [
            'id'  => 'required',
            'nmprgrm'  => 'required',
            'id_status'  => 'required',
            'non_urusan'  => 'required',
        ]);
        
        if ($validator->fails()) {
            
            return redirect()->back()->withErrors($validator->errors());
            //dd($validator->fails());

        }
            $cek = Program::where('nmprgrm', '=', $request->nmprgrm)->where('id', '=', $request->id)->first();
            //dd($cek);
            
            if ($cek === null) {
                Program::create($store);
                return redirect()->route('program.index')->with('sukses','Data tersimpan');
            }else{
                return redirect()->route('program.create')->with('fail','Data Gagal disimpan/data sudah ada');
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
        $program= Program::find($id);
        return view('admin.master.program.edit',compact('program'));
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
            'nmprgrm'  => 'required',
            'id_status'  => 'required',
            'non_urusan'  => 'required',
        ]);

        $cek = Program::find($id);
            //dd($cek);
            
        if ($cek !== null) {
            $program=Program::find($id);
            $program->nmprgrm=$request->get('nmprgrm');
            $program->id_status=$request->get('id_status');
            $program->non_urusan=$request->get('non_urusan');
            $program->save();
            return redirect()->route('program.index')
                ->with('sukses','Data Program berhasil diubah');
        }else{
            return redirect()->route('program.edit', $id)->with('fail','Data Gagal diubah');
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
        $cek = Program::find($id);
            
        if ($cek !== null) {
            $cek->delete();
            return redirect()->route('program.index')->with('sukses','Data dihapus');
        }else{
            return redirect()->route('program.index')->with('sukses','Data gagal dihapus');
        }
    }

    
    /*
    //import
    Route::get('program_impor','master\MasterProgramController@impor');
    
    public function impor(){
        $url_json = 'http://localhost/api_eplanning/mpgrm.json';
        $data_json = file_get_contents($url_json);
        $urusan_opd = json_decode($data_json);
        //dd($urusan_opd);
        foreach ($urusan_opd as $v) {
        if($v->type=="table")
        {
            //dd($v->data);
            foreach ($v->data as $r) {
                $store=[
                        'id' => $r->idprgrm,
                        'nmprgrm' => $r->nmprgrm,
                        'nomor' => $r->nomor,
                        'id_status' => $r->id_status
                    ];
                Program::create($store);
            }
        }
        }
    }
    */

}
