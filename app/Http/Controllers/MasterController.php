<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Dafunit;
class MasterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //handler error getcontent
    	/*
        function file_contents($path) {
    	    $str = @file_get_contents($path);
    	    if ($str === FALSE) {
    	        throw new Exception("Periksa koneksi internet anda dan refresh kembali alamat, Cannot access '$path' to read contents.");
    	    } else {
    	        return $str;
    	    }
    	}
    	//token
    	function token(){
	    	try {
	    	    $url='http://eplanning.sumbarprov.go.id/sin/sinkron/generate_token/bakeuda/bakeudakoneksi';
	    	    $token=file_contents($url);
	    	    return $token;
	    	} catch (Exception $e) {
	    	    return $e->getMessage();
	    	}
    	}
        */
    }

    public function master_opd(){
        $url_json = 'http://localhost/api_eplanning/dafunit.json';
        $data_json = file_get_contents($url_json);
        $dafunit = json_decode($data_json);
        //dd($dafunit);
        foreach ($dafunit as $v) {
            if($v->type=="table")
            {
                foreach ($v->data as $r) {
                    if($r->kdlevel==1 or $r->kdlevel==2){
                        $store=[
                                'id' => $r->id_instansi,
                                'parent_id' => $r->parent_id,
                                'id_status' => $r->id_status,
                                'order_no' => $r->order_no,
                                'kdlevel' => $r->kdlevel,
                                'unitkey' => $r->unitkey,
                                'kdunit' => $r->kdunit,
                                'nm_unit' => $r->nm_instansi,
                                'type' => $r->type
                            ];
                        Dafunit::create($store);

                        //echo $r->parent_id;
                        //echo $r->unitkey;
                        //echo $r->kdunit;
                        //echo $r->nm_instansi;
                    }
                }
                echo"data tersimpan";
            }
        }
    }

    public function opd(){
    	$token=token();
    	//data opd
    	try {
    	    $url_json2 = 'http://eplanning.sumbarprov.go.id/sin/sinkron/sharing_data_dafunit/'.$token;
    	    $data_json2 = file_contents($url_json2);
    	    $opd = json_decode($data_json2);
    	} catch (Exception $e) {
    	    return $e->getMessage();
    	}
    	return view('admin.master.opd',compact('opd'));
    }

    public function urusan(){
    	$token=token();
    	//data urusan
    	try {
    	    $url_json2 = 'http://eplanning.sumbarprov.go.id/sin/sinkron/sharing_data_dafunit/'.$token;
    	    $data_json2 = file_contents($url_json2);
    	    $urusan = json_decode($data_json2);
    	} catch (Exception $e) {
    	    return $e->getMessage();
    	}
    	return view('admin.master.urusan',compact('urusan'));
    }
    public function program(){
    	$token=token();
    	//data program
    	try {
    	    $url_json2 = 'http://eplanning.sumbarprov.go.id/sin/sinkron/sharing_data_programunit_pe/90/1/'.$token;
    	    $data_json2 = file_contents($url_json2);
    	    $program = json_decode($data_json2);
    	} catch (Exception $e) {
    	    return $e->getMessage();
    	}
    	return view('admin.master.program',compact('program'));
    }
    public function kegiatan(){
    	$token=token();
    	//data kegiatan
    	try {
    	    $url_json2 = 'http://eplanning.sumbarprov.go.id/sin/sinkron/sharing_data_kegunit/90/1/'.$token;
    	    $data_json2 = file_contents($url_json2);
    	    $kegiatan = json_decode($data_json2);
    	} catch (Exception $e) {
    	    return $e->getMessage();
    	}
    	return view('admin.master.kegiatan',compact('kegiatan'));
    }
}
