<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dafunit;
use App\Data_Opd;
use App\Rpjmd_Prog;
use App\Periode_Rpjmd;
use App\Periode_Renja;
use Validator;
use DB;

use App\Exports\Eksport_Table;
use App\Imports\DafunitImport;
use App\Imports\Data_OpdImport;
use App\Imports\ProgramImport;
use App\Imports\KegiatanImport;
use App\Imports\Urusan_OpdImport;
use App\Imports\Rpjmd_ProgImport;
use App\Imports\Rpjmd_Prog_IndikatorImport;
use App\Imports\RenjaImport;
use App\Imports\Renja_IndikatorImport;
use App\Imports\Renja_PerImport;
use App\Imports\Renja_Indikator_PerImport;
use App\Imports\Renja_Indikator_DetImport;
use App\Imports\RealisasiImport;

use Maatwebsite\Excel\Facades\Excel;
use Session;
class ImportController extends Controller
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
    public function index(Request $request)
    {
        $tbl=request()->get('tbl');
        $eksport=request()->get('eksport');
        if($tbl=="dafunit"){
            if($eksport=="true"){
                return Excel::download(new Eksport_Table($tbl,'true'), 'eksport_dafunit.xlsx');                
            }elseif($eksport=="template"){
                return Excel::download(new Eksport_Table($tbl,'template'), 'template_import_dafunit.xlsx');                
            }else{
                return view('admin.import.dafunit.index',compact('tbl'));
            }
        }elseif($tbl=="data_opd"){
            if($eksport=="true"){
                return Excel::download(new Eksport_Table($tbl,'true'), 'eksport_data_opd.xlsx');                
            }elseif($eksport=="template"){
                return Excel::download(new Eksport_Table($tbl,'template'), 'template_import_data_opd.xlsx');                
            }else{
                return view('admin.import.data_opd.index',compact('tbl'));
            }
        }elseif($tbl=="program"){
            if($eksport=="true"){
                return Excel::download(new Eksport_Table($tbl,'true'), 'eksport_program.xlsx');                
            }elseif($eksport=="template"){
                return Excel::download(new Eksport_Table($tbl,'template'), 'template_import_program.xlsx');                
            }else{
                return view('admin.import.program.index',compact('tbl'));
            }
        }elseif($tbl=="kegiatan"){
            if($eksport=="true"){
                return Excel::download(new Eksport_Table($tbl,'true'), 'eksport_kegiatan.xlsx');                
            }elseif($eksport=="template"){
                return Excel::download(new Eksport_Table($tbl,'template'), 'template_import_kegiatan.xlsx');                
            }else{
                return view('admin.import.kegiatan.index',compact('tbl'));
            }
        }elseif($tbl=="urusan_opd"){
            if($eksport=="true"){
                
                return Excel::download(new Eksport_Table($tbl,'true'), 'eksport_urusan_opd.xlsx');                
            }elseif($eksport=="template"){
                return Excel::download(new Eksport_Table($tbl,'template'), 'template_import_urusan_opd.xlsx');                
            }else{
                return view('admin.import.urusan_opd.index',compact('tbl'));
            }
        }elseif($tbl=="rpjmd_prog"){
            if($eksport=="true"){
                return Excel::download(new Eksport_Table($tbl,'true'), 'eksport_rpjmd_prog.xlsx');                
            }elseif($eksport=="template"){
                return Excel::download(new Eksport_Table($tbl,'template'), 'template_import_rpjmd_prog.xlsx');                
            }else{
                $periode_rpjmd=Periode_Rpjmd::all();
                return view('admin.import.rpjmd_prog.index',compact('tbl','periode_rpjmd'));
            }
        }elseif($tbl=="rpjmd_prog_indikator"){
            if($eksport=="true"){
                return Excel::download(new Eksport_Table($tbl,'true'), 'eksport_rpjmd_prog_indikator.xlsx');                
            }elseif($eksport=="template"){
                return Excel::download(new Eksport_Table($tbl,'template'), 'template_import_rpjmd_prog_indikator.xlsx');                
            }else{
                $periode_rpjmd=Periode_Rpjmd::all();
                return view('admin.import.rpjmd_prog_indikator.index',compact('tbl','periode_rpjmd'));
            }
        }elseif($tbl=="renja"){
            if($eksport=="true"){
                return Excel::download(new Eksport_Table($tbl,'true'), 'eksport_renja.xlsx');                
            }elseif($eksport=="template"){
                return Excel::download(new Eksport_Table($tbl,'template'), 'template_import_renja.xlsx');                
            }else{
                $periode_renja=Periode_Renja::all();
                return view('admin.import.renja.index',compact('tbl','periode_renja'));
            }
        }elseif($tbl=="renja_indikator"){
            if($eksport=="true"){
                return Excel::download(new Eksport_Table($tbl,'true'), 'eksport_renja_indikator.xlsx');                
            }elseif($eksport=="template"){
                return Excel::download(new Eksport_Table($tbl,'template'), 'template_import_renja_indikator.xlsx');                
            }else{
                $periode_renja=Periode_Renja::all();
                return view('admin.import.renja_indikator.index',compact('tbl','periode_renja'));
            }
        }elseif($tbl=="renja_per"){
            if($eksport=="true"){
                return Excel::download(new Eksport_Table($tbl,'true'), 'eksport_renja_per.xlsx');                
            }elseif($eksport=="template"){
                return Excel::download(new Eksport_Table($tbl,'template'), 'template_import_renja_per.xlsx');                
            }else{
                $periode_renja=Periode_Renja::all();
                return view('admin.import.renja_per.index',compact('tbl','periode_renja'));
            }
        }elseif($tbl=="renja_indikator_per"){
            if($eksport=="true"){
                return Excel::download(new Eksport_Table($tbl,'true'), 'eksport_renja_indikator_per.xlsx');                
            }elseif($eksport=="template"){
                return Excel::download(new Eksport_Table($tbl,'template'), 'template_import_renja_indikator_per.xlsx');                
            }else{
                $periode_renja=Periode_Renja::all();
                return view('admin.import.renja_indikator_per.index',compact('tbl','periode_renja'));
            }
        }elseif($tbl=="renja_indikator_det"){
            if($eksport=="true"){
                return Excel::download(new Eksport_Table($tbl,'true'), 'eksport_renja_indikator_det.xlsx');                
            }elseif($eksport=="template"){
                return Excel::download(new Eksport_Table($tbl,'template'), 'template_import_renja_indikator_det.xlsx');                
            }else{
                $periode_renja=Periode_Renja::all();
                return view('admin.import.renja_indikator_det.index',compact('tbl','periode_renja'));
            }
        }elseif($tbl=="realisasi"){
            if($eksport=="true"){
                return Excel::download(new Eksport_Table($tbl,'true'), 'eksport_realisasi_kegiatan.xlsx');                
            }elseif($eksport=="template"){
                return Excel::download(new Eksport_Table($tbl,'template'), 'template_import_realisasi_kegiatan.xlsx');                
            }else{
                $periode_renja=Periode_Renja::all();
                return view('admin.import.realisasi.index',compact('tbl','periode_renja'));
            }
        }
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
        // menangkap file excel
        $tbl = $request->input('tbl');
        $file = $request->file('file');
        if($tbl=="dafunit"){
            Excel::import(new DafunitImport,$file);                               
        }elseif($tbl=="data_opd"){
            Excel::import(new Data_OpdImport,$file);                               
        }elseif($tbl=="program"){
            Excel::import(new ProgramImport,$file);                               
        }elseif($tbl=="kegiatan"){
            Excel::import(new KegiatanImport,$file);                               
        }elseif($tbl=="urusan_opd"){
            Excel::import(new Urusan_OpdImport,$file);                               
        }elseif($tbl=="rpjmd_prog"){
            $id_periode_rpjmd=$request->input('id_periode_rpjmd');
            Excel::import(new Rpjmd_ProgImport($id_periode_rpjmd),$file);                               
        }elseif($tbl=="rpjmd_prog_indikator"){
            $id_periode_rpjmd=$request->input('id_periode_rpjmd');
            Excel::import(new Rpjmd_Prog_IndikatorImport($id_periode_rpjmd),$file);                               
        }elseif($tbl=="renja"){
            $id_periode_renja=$request->input('id_periode_renja');
            Excel::import(new RenjaImport($id_periode_renja),$file);                               
        }elseif($tbl=="renja_indikator"){
            $id_periode_renja=$request->input('id_periode_renja');
            Excel::import(new Renja_IndikatorImport($id_periode_renja),$file);                               
        }elseif($tbl=="renja_per"){
            $id_periode_renja=$request->input('id_periode_renja');
            Excel::import(new Renja_PerImport($id_periode_renja),$file);                               
        }elseif($tbl=="renja_indikator_per"){
            $id_periode_renja=$request->input('id_periode_renja');
            Excel::import(new Renja_Indikator_PerImport($id_periode_renja),$file);                               
        }elseif($tbl=="renja_indikator_det"){
            $id_periode_renja=$request->input('id_periode_renja');
            Excel::import(new Renja_Indikator_DetImport($id_periode_renja),$file);                            
        }elseif($tbl=="realisasi"){
            $id_periode_renja=$request->input('id_periode_renja');
            Excel::import(new RealisasiImport($id_periode_renja),$file);                            
        }

        // notifikasi dengan session
        Session::flash('sukses','Data Berhasil Diimport!');
 
        // alihkan halaman kembali
        return redirect('/import?tbl='.$tbl);
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
