<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Periode_Renja;
use App\SetTriwulan;
use DB;
class SetTriwulanController extends Controller
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
    public function index(Request $request)
    {
        $thn=$request->thn;
		$cek=SetTriwulan::where('thn', $thn)->first();
		if(!empty($thn)){
			$cek=SetTriwulan::where('thn', $thn)->first();
			if ($cek === null) {
                SetTriwulan::create([
                    'thn' => $thn,
                    'tw1_src' => 'awal',
                    'tw2_src' => 'awal',
                    'tw3_src' => 'awal',
                    'tw4_src' => 'awal'
                ]);
               $cek=SetTriwulan::where('thn', $thn)->first(); 
            }
		}
        $periode=Periode_Renja::where('aktiv', 1)->orderBy('id', 'ASC')->get();
		
        return view('admin.master.settriwulan.index',compact('cek','thn','periode'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($thn)
    {
        $cek = SetTriwulan::where('thn',$thn)->first();
		 $msg = array(
                'info' => 'Info',
                'store' => $cek,
                'msg' => 'sukses'
              );

        return json_encode($msg);
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
        $cek = SetTriwulan::find($id);
        if ($cek !== null) {
            $cek->tw1=$request->get('tw1');
            $cek->tw2=$request->get('tw2');
            $cek->tw3=$request->get('tw3');
            $cek->tw4=$request->get('tw4');
            $cek->tw1_src=$request->get('tw1_src');
            $cek->tw2_src=$request->get('tw2_src');
            $cek->tw3_src=$request->get('tw3_src');
            $cek->tw4_src=$request->get('tw4_src');
            $cek->save();
            return redirect()->route('settings_triwulan.index',['thn' => $cek->thn])
                ->with('sukses','data disimpan');
        }else{
            return redirect()->route('settings_triwulan.edit', $id)->with('fail','Data Gagal diubah');
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
        //
    }

    public function indexsetrules(){
        $opd = DB::table('data_opd')->get();
        $rules = DB::table('rules')->orderby('id')->get();
        return view('admin.master.settriwulan.setrules', compact('opd','rules'));
    }

    public function setedit(){
        DB::table('rules')->where('id', request('id'))->update(['edit'=>request('isi')]);
        return;
    }

    public function setehapus(){
        DB::table('rules')->where('id', request('id'))->update(['hapus'=>request('isi')]);
        return;
    }
}
