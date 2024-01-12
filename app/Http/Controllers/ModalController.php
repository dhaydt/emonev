<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data_Opd;
use App\Periode_Rpjmd;
use App\Rpjmd_Prog;
use App\Rpjmd_Prog_Indikator;
//use App\Renstra_Keg;

class ModalController extends Controller
{
    public function show(Request $request,$id,$id_instansi,$id_periode_rpjmd)
    {
        $prog= Rpjmd_Prog::where('idprgrm',$id)->where('id_instansi',$id_instansi)->where('id_periode_rpjmd',$id_periode_rpjmd)->first();
//        $rpjmd_prog_indikator= Rpjmd_Prog_Indikator::where('idprgrm',$id)->where('id_instansi',$id_instansi)->get();
        $cekrpjmd=Periode_Rpjmd::find($id_periode_rpjmd);
        if($cekrpjmd!=""){
            $th_awal = $cekrpjmd->thn_awal;
            $th_akhir = $cekrpjmd->thn_akhir;
        }else{
            $th_awal = 0;
            $th_akhir = 0;
        }
        return view('admin.data.rpjmd.modalindikator',compact('prog','th_awal','th_akhir','id_periode_rpjmd'))->renderSections()['content'];
    }

    /*
    //convert indikator program
    public function inprog()
    {
    	$url_json = 'http://localhost/api_eplanning/mpgrm_indikator1.json';
        $data_json = file_get_contents($url_json);
        $urusan_opd = json_decode($data_json);
        //dd($urusan_opd);
        foreach ($urusan_opd as $v) {
        if($v->type=="table")
        {
            //dd($v->data);
            foreach ($v->data as $r) {
            	//convert idurusan - unitkey
            		$url_json2 = 'http://localhost/api_eplanning/urusan_opd.json';
            	    $data_json2 = file_get_contents($url_json2);
            	    $urusan_opd2 = json_decode($data_json2);
            	    foreach ($urusan_opd2 as $v2) {
            	    if($v2->type=="table")
            	    {
            	    	foreach ($v2->data as $u) {
            	    		if($u->id_urusan==$r->urusanunit){
            	    		if($u->id_urusan==1){$uk="0_";}else{$uk=$u->unitkey;}
            	    		}
            	    	}
            	    }
            		}

            		$store=[
            		        'id' => $r->id,
            		        'idprgrm' => $r->idprgrm,
            		        'id_instansi' => $r->id_instansi,
            		        'unitkey' => $uk,
            		        'indikator' => $r->indikator,
            		        'satuan' => $r->satuan,
            		        't1' => $r->t_16,
            		        't2' => $r->t_17,
            		        't3' => $r->t_18,
            		        't4' => $r->t_19,
            		        't5' => $r->t_20,
            		        't6' => $r->t_21,
            		        'rt1' => $r->realisasi_t16,
            		        'rt2' => $r->realisasi_t17,
            		        'rt3' => $r->realisasi_t18,
            		        'rt4' => 0,
            		        'rt5' => 0,
            		        'rt6' => 0,
            		        'pe1' => "-",
            		        'pe2' => $r->evaluasi_pe2017,
            		        'pe3' => "-",
            		        'pe4' => "-",
            		        'pe5' => "-",
            		        'pe6' => "-"
            		    ];
            		    //dd($store);
            		Rpjmd_Prog_Indikator::create($store);

            }
            
        }
    	}
    }

    //convert kegiatan renstra
    public function kegiatan()
    {
    	$url_json = 'http://localhost/api_eplanning/mkegiatan_baru.json';
        $data_json = file_get_contents($url_json);
        $urusan_opd = json_decode($data_json);
        //dd($urusan_opd);
        foreach ($urusan_opd as $v) {
        if($v->type=="table")
        {
            //dd($v->data);
            foreach ($v->data as $r) {

            		$store=[
            		        'id' => $r->kdkegunit,
            		        'idprgrm' => $r->idprgrm,
            		        'kdperspektif' => $r->kdperspektif,
            		        'nmkegunit' => $r->nmkegunit,
            		        'levelkeg' => $r->levelkeg,
            		        'type' => $r->type,
            		        'type' => $r->type,
            		        'kode' => $r->kode,
            		        'id_status' => $r->id_status
            		    ];
            		//    dd($store);
            		Renstra_Keg::create($store);

            }
            
        }
    	}
    }
    */
}
