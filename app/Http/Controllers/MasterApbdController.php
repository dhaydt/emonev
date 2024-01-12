<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Program;
use App\Data_Opd;
use App\Renja;
use App\Apbd;
use Validator;
use DB;
class MasterApbdController extends Controller
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
        $apbd=Apbd::where('thn','2019')->get();
        // foreach ($apbd as $key => $v) {
        //     $idprgrm = str_replace(' ', '', $v->idprgrm_);
        //     // if(preg_match("/_/", $idprgrm)) {
        //     //   echo '_';
        //     // } else {
        //       // echo 'Tidak ada pola fgh dalam string';
        //       // DB::table('apbd')
        //       // ->where('id', $v->id)
        //       // ->update(['idprgrm' => $idprgrm]);
        //     // }
            
        //     // $kdkegunit = str_replace(' ', '', $v->kdkegunit_);
        //     // if(preg_match("/_/", $kdkegunit)) {
        //     //   echo '_';
        //     // } else {
        //     //   DB::table('apbd')
        //     //   ->where('id', $v->id)
        //     //   ->update(['kdkegunit' => $kdkegunit]);
        //     // }
            
        //     // $opd=Data_Opd::where('nm_instansi',$v->opd)->first();
        //     // if($opd!=""){
        //     //     // echo $opd->nm_instansi;
        //     //     DB::table('apbd')
        //     //   ->where('id', $v->id)
        //     //   ->update(['id_instansi' => $opd->id]);
        //     // }
        // }
        
        //$program=Program::all();
        return view('admin.data.apbd.index',compact('apbd'));
    }
    public function persandingan()
    {
        $apbd=Apbd::where('thn','2019')->orderBy('id_instansi', 'asc')->get();
        return view('admin.data.apbd.persandingan',compact('apbd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cek=Apbd::find($request->id);
        // simpan
        if ($cek === null) {
              // Data_Sdgs::create($store);
              // $pesan="data disimpan";
        }else{            
            $cek->update(['rkpd' => $request->vfield]);
            $pesan="data disimpan";
        }
        $msg = array(
                'info' => 'Info',
                'msg' => $pesan
              );
        return json_encode($msg);
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
