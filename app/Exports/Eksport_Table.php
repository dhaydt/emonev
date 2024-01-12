<?php

namespace App\Exports;
use App\Dafunit;
use App\Data_Opd;
use App\Program;
use App\Renstra_Keg;
use App\Urusan_Opd;
use App\Rpjmd_Prog;
use App\Rpjmd_Prog_Indikator;
use App\Renja;
use App\Renja_Indikator;
use App\Renja_Per;
use App\Renja_Indikator_Per;
use App\Renja_Indikator_Det;
use App\Realisasi;
use DB;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

// use Maatwebsite\Excel\Concerns\ShouldAutoSize;

// use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
/**
* 
*/
class Eksport_Table implements FromView
{
	public function __construct($table,$jns)
    {
        $this->table = $table;
        $this->jns = $jns;
    }

	use Exportable;
	
	public function view(): View
	{
		// $dafunit= dafunit::all();

		$jns=$this->jns;
    $table=$this->table;
    if($table=="dafunit"){
      $data=Dafunit::all();
    }elseif($table=="data_opd"){
      $data=Data_Opd::all();
    }elseif($table=="program"){
      $data=Program::all();
    }elseif($table=="kegiatan"){
      $data=Renstra_Keg::all();
    }elseif($table=="urusan_opd"){
      $data=Urusan_Opd::all();
    }elseif($table=="rpjmd_prog"){
      $data=Rpjmd_Prog::all();
    }elseif($table=="rpjmd_prog_indikator"){
      $data=Rpjmd_Prog_Indikator::all();
    }elseif($table=="renja"){
      $data=Renja::all();
    }elseif($table=="renja_indikator"){
      $data=Renja_Indikator::all();
    }elseif($table=="renja_per"){
      $data=Renja_Per::all();
    }elseif($table=="renja_indikator_per"){
      $data=Renja_Indikator_Per::all();
    }elseif($table=="renja_indikator_det"){
      $data=Renja_Indikator_Det::all();
    }elseif($table=="realisasi"){
      $data=Realisasi::all();
    }

	    return view('admin.import.'.$table.'.eksport',compact('data','jns','table'));
	}

}
