<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Status_E55;
use Validator;
class StatusE55Controller extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        $store=[
                $request->nmfield => $request->vfield,
                'id_instansi' => $request->id_instansi,
                'thn' => $request->periode
            ];
        $cek=Status_E55::where('thn',$request->periode)->where('id_instansi',$request->id_instansi)->first();
        // simpan
        if ($cek === null) {
              Status_E55::create($store);
              $pesan="data disimpan";
        }else{            
            $cek->update([$request->nmfield => $request->vfield]);
            $pesan="data disimpan";
        }
        $msg = array(
                'info' => 'Info',
                'store' => $store,
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
