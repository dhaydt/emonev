<?php

namespace App\Exports;
use App\Dafunit;
use App\Data_Opd;
use App\Urusan_Opd;
use App\Rpjmd_Prog;
use App\Renja;
use App\Renja_Per;
use DB;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

// use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
/**
* 
*/
class EvaluasiRenja_Report implements FromView
{
	public function __construct($periode,$jenis,$id_instansi,$triwulan,$rekap,$data_renja)
    {
        $this->periode = $periode;
        $this->jenis = $jenis;
        $this->id_instansi = $id_instansi;
        $this->triwulan = $triwulan;
        $this->rekap = $rekap;
        $this->data_renja = $data_renja;
    }

	use Exportable;
	
	public function view(): View
	{
		// $dafunit= dafunit::all();

    $periode=$this->periode;
		$jenis=$this->jenis;
    $triwulan=$this->triwulan;
    $rekap=$this->rekap;
		$data_renja=$this->data_renja;
		$opd=Data_OPD::find($this->id_instansi);

	    return view('excel.evaluasi_renja',compact('periode','jenis','opd','triwulan'));
	}
	// public function collection()
 //    {
 //        return Data_Opd::all();
 //    }


    /**
     * @return array
     */
  /*
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
              $jenis=$this->jenis;
              $rekap=$this->rekap;
              $data_renja=$this->data_renja;
              //set kolom akhir
              if($jenis=="RKPD"){
                $kolom_akhir="AB";
              }else{
                $kolom_akhir="AC";
              }

                //page setup
                $event->sheet->getDelegate()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
                $event->sheet->getDelegate()->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_FOLIO);
               
                //Page Setup: Scaling options
                  $event->sheet->getDelegate()->getPageSetup()->setFitToWidth(0);
                  $event->sheet->getDelegate()->getPageSetup()->setScale(50);

                  $event->sheet->getDelegate()->getPageMargins()->setTop(1);
                  $event->sheet->getDelegate()->getPageMargins()->setRight(0.3);
                  $event->sheet->getDelegate()->getPageMargins()->setLeft(0.3);
                  $event->sheet->getDelegate()->getPageMargins()->setBottom(1);
                  
                  //zoom level
                  $event->sheet->getDelegate()->getSheetView()->setZoomScale(80);;
                  
                  //header bold
                  $event->sheet->getDelegate()->getStyle('A1:AB4')->getFont()->setSize(16);
                  $event->sheet->getStyle('A1:AB4')->getAlignment()->setHorizontal('center');
                  $event->sheet->getDelegate()->getStyle('A1:AB4')->getFont()->setBold(true);

                  //header table
                  $cellRange = 'A1:'.$kolom_akhir.'4'; // All headers
                  //font name
                   // $event->sheet->getDelegate()->getStyle()->getFont()->setName('Arial');

                  //data
                  $dafunit= dafunit::all();

                  $periode=$this->periode;
                  $opd=Data_OPD::find($this->id_instansi);
                  $urusan_opd = Urusan_Opd::where('id_instansi',$this->id_instansi)->first();

                  if($data_renja=="awal"){
                    $rpjmd_prog= Rpjmd_Prog::
                       whereExists(function ($query) {
                          $query->select(DB::raw(1))
                                ->from('renja')
                                ->whereRaw('renja.id_instansi = rpjmd_prog.id_instansi')
                                ->whereRaw('renja.idprgrm = rpjmd_prog.idprgrm')
                                ->whereRaw('renja.periode = ?', $this->periode);
                      })
                    ->where('unitkey','!=','0_')
                    ->where('id_instansi','=',$this->id_instansi)
                    ->where('id_status','=','1')
                    ->get();

                    $rpjmd_prog_non=Rpjmd_Prog::
                    whereExists(function ($query) {
                          $query->select(DB::raw(1))
                                ->from('renja')
                                ->whereRaw('renja.id_instansi = rpjmd_prog.id_instansi')
                                ->whereRaw('renja.idprgrm = rpjmd_prog.idprgrm')
                                ->whereRaw('renja.periode = ?', $this->periode);
                      })
                    ->where('rpjmd_prog.unitkey','0_')
                    ->where('id_instansi','=',$this->id_instansi)
                    ->where('rpjmd_prog.id_status','=','1')
                    ->get();
                  }elseif($data_renja=="perubahan"){
                    $rpjmd_prog= Rpjmd_Prog::
                       whereExists(function ($query) {
                          $query->select(DB::raw(1))
                                ->from('renja_per')
                                ->whereRaw('renja_per.id_instansi = rpjmd_prog.id_instansi')
                                ->whereRaw('renja_per.idprgrm = rpjmd_prog.idprgrm')
                                ->whereRaw('renja_per.periode = ?', $this->periode);
                      })
                    ->where('unitkey','!=','0_')
                    ->where('id_instansi','=',$this->id_instansi)
                    ->where('id_status','=','1')
                    ->get();

                    $rpjmd_prog_non=Rpjmd_Prog::
                    whereExists(function ($query) {
                          $query->select(DB::raw(1))
                                ->from('renja_per')
                                ->whereRaw('renja_per.id_instansi = rpjmd_prog.id_instansi')
                                ->whereRaw('renja_per.idprgrm = rpjmd_prog.idprgrm')
                                ->whereRaw('renja_per.periode = ?', $this->periode);
                      })
                    ->where('rpjmd_prog.unitkey','0_')
                    ->where('id_instansi','=',$this->id_instansi)
                    ->where('rpjmd_prog.id_status','=','1')
                    ->get();
                  }


                  //mulai data baris 14 dari nonurusan
                  $baris_mulai=14;
                  $baris_akhir=14;
                  
	                $style_header = [
	                    'font' => 
	                    	[
		                          'bold' => true,
		                          // 'color' => ['argb' => 'ffffff'],
		                   ],
	                ];
	                $event->sheet->getDelegate()->getStyle('A8:'.$kolom_akhir.''.($baris_akhir-3))->applyFromArray($style_header);
	                $event->sheet->getDelegate()->getStyle('A8:'.$kolom_akhir.''.($baris_akhir-3))->getAlignment()->setHorizontal('center');
	                $event->sheet->getDelegate()->getStyle('A8:'.$kolom_akhir.'8')->getAlignment()->setWrapText(true);

	                $style_urusan = [
                      'font' => 
                        [
                              'bold' => true,
                              // 'color' => ['argb' => 'ffffff'],
                       ],
                       'fill' => [
                               'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                               'startColor' => [
                                   'argb' => 'ffff00',
                               ],
                           ],
                  ];
                  $style_opd = [
	                    'font' => 
	                    	[
		                          'bold' => true,
		                          // 'color' => ['argb' => 'ffffff'],
		                   ],
		                   'fill' => [
		                           'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
		                           'startColor' => [
		                               'argb' => '00FFFF',
		                           ],
		                       ],
	                ];
	                $style_program = [
	                    'font' => 
	                    	[
		                          'bold' => true,
		                          // 'color' => ['argb' => 'ffffff'],
		                   ],
		                   'fill' => [
		                           'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
		                           'startColor' => [
		                               'argb' => 'c0c0c0',
		                           ],
		                       ],
	                ];

                  
                  if($rpjmd_prog_non->count()>0){
                  //start jml prog non urusan
                  $gjmlopd="=G".($baris_akhir);
                  $ijmlopd="=I".($baris_akhir);
                  $kjmlopd="=K".($baris_akhir);
                  
                  $mjmlopd="=M".($baris_akhir);
                  $ojmlopd="=O".($baris_akhir);
                  $qjmlopd="=Q".($baris_akhir);
                  $sjmlopd="=S".($baris_akhir);
                  $baris_opd=$baris_akhir-1;

                  $vjmlopd="V".($baris_akhir);
                  $zjmlopd="Z".($baris_akhir);
                  $jmlurusanopd=1;
                  }else{
                    $gjmlopd="=0";
                    $ijmlopd="=0";
                    $kjmlopd="=0";
                    
                    $mjmlopd="=0";
                    $ojmlopd="=0";
                    $qjmlopd="=0";
                    $sjmlopd="=0";
                    $baris_opd=$baris_akhir;

                    $vjmlopd="0";
                    $zjmlopd="0";
                    $jmlurusanopd=0;
                  }
                  //opd
                  $event->sheet->getDelegate()->setCellValue('C'.$baris_opd,$opd->nm_instansi);
                  $event->sheet->getDelegate()->getStyle('A'.$baris_opd.':'.$kolom_akhir.''.$baris_opd)->applyFromArray($style_opd);
                  //mulai non urusan
	               if($rpjmd_prog_non->count()>0){
                  $event->sheet->getDelegate()->setCellValue('C'.$baris_akhir,'NON URUSAN');
                  $event->sheet->getDelegate()->getStyle('A'.$baris_akhir.':'.$kolom_akhir.''.$baris_akhir)->applyFromArray($style_urusan);
                  // $baris_akhir++;
                  // $event->sheet->getDelegate()->setCellValue('B'.$baris_akhir,$opd->kdunit);
                  // $event->sheet->getDelegate()->setCellValue('C'.$baris_akhir,$opd->nm_instansi);
                  // $event->sheet->getDelegate()->getStyle('A'.$baris_akhir.':'.$kolom_akhir.''.$baris_akhir)->applyFromArray($style_opd);
                  
                  }

                  //start jml prog non urusan
                  $gjmlprog="=G".($baris_akhir+1);
                  $ijmlprog="=I".($baris_akhir+1);
                  $kjmlprog="=K".($baris_akhir+1);
                  
                  $mjmlprog="=M".($baris_akhir+1);
                  $ojmlprog="=O".($baris_akhir+1);
                  $qjmlprog="=Q".($baris_akhir+1);
                  $sjmlprog="=S".($baris_akhir+1);
                  
                  $baris_non_urusan=$baris_akhir;
                  $vjmlprog="0";
                  $zjmlprog="0";
                  $jml_brs_indprog_non=0;
                  foreach($rpjmd_prog_non as $kp=>$vpn){
                    if($kp>0){$gjmlprog .= "+G".($baris_akhir+1);}
                    if($kp>0){$ijmlprog .= "+I".($baris_akhir+1);}
                    if($kp>0){$kjmlprog .= "+K".($baris_akhir+1);}
                    if($kp>0){$mjmlprog .= "+M".($baris_akhir+1);}
                    if($kp>0){$ojmlprog .= "+O".($baris_akhir+1);}
                    if($kp>0){$qjmlprog .= "+Q".($baris_akhir+1);}
                    if($kp>0){$sjmlprog .= "+S".($baris_akhir+1);}

                  		$nm_prog=$vpn->nmprgrm;
                  		// $jml_ind_prog = count($vpn->indikator_program());

                  		// for($a=0;$a<$jml_ind_prog;$a++){
                  		// 		if($a>0){$nm_prog="";}else{$baris_prog=$baris_akhir+1;}
                  		// 		$indikator=$vpn->indikator_program();
                  		// 		if($periode==2016){
                  		// 		    $v7k=$indikator[$a]['t1'];
                  		// 		}elseif($periode==2017){
                  		// 		    $v7k=$indikator[$a]['t2'];
                  		// 		}elseif($periode==2018){
                  		// 		    $v7k=$indikator[$a]['t3'];
                  		// 		}elseif($periode==2019){
                  		// 		    $v7k=$indikator[$a]['t4'];
                  		// 		}elseif($periode==2020){
                  		// 		    $v7k=$indikator[$a]['t5'];
                  		// 		}elseif($periode==2021){
                  		// 		    $v7k=$indikator[$a]['t6'];
                  		// 		}
	                  	// 	$baris_akhir++;
	                  	// 	$event->sheet->getDelegate()->getStyle('A'.$baris_akhir.':'.$kolom_akhir.''.$baris_akhir)->applyFromArray($style_program);

		                  // 	$event->sheet->getDelegate()->setCellValue('C'.$baris_akhir,$nm_prog);	
		                  // 	$event->sheet->getDelegate()->setCellValue('D'.$baris_akhir,$indikator[$a]['indikator']);	
		                  // 	$event->sheet->getDelegate()->setCellValue('E'.$baris_akhir,$indikator[$a]['satuan']);	
		                  // 	$event->sheet->getDelegate()->setCellValue('F'.$baris_akhir,$indikator[$a]['t6']);	
		                  // 	$event->sheet->getDelegate()->setCellValue('J'.$baris_akhir,$v7k);	
                  		// }
                              $a=0;$idprgrm2=null;
                              foreach($vpn->indikator_program() as $pi){
                                    if($a>0){$nm_prog="";}else{$baris_prog=$baris_akhir+1;}
                                       if($a>0){$nm_prog="";}else{$baris_prog=$baris_akhir+1;}
                                       if($periode==2016){
                                           $v7k=$pi->t1;
                                       }elseif($periode==2017){
                                           $v7k=$pi->t2;
                                       }elseif($periode==2018){
                                           $v7k=$pi->t3;
                                       }elseif($periode==2019){
                                           $v7k=$pi->t4;
                                       }elseif($periode==2020){
                                           $v7k=$pi->t5;
                                       }elseif($periode==2021){
                                           $v7k=$pi->t6;
                                       }

                                       //capaian kinerja non urusan
                                       $vjmlprog .= "+V".($baris_akhir+1);
                                       $zjmlprog .= "+Z".($baris_akhir+1);
                                       $jml_brs_indprog_non++;

                                 $baris_akhir++;
                                 $event->sheet->getDelegate()->getStyle('A'.$baris_akhir.':'.$kolom_akhir.''.$baris_akhir)->applyFromArray($style_program);
                                 $idprgrm=$opd->kdunit.($kp+1);
                                 if($idprgrm==$idprgrm2){
                                    $idprgrm="";
                                    $idprgrm2=$opd->kdunit.($kp+1);
                                  }else{
                                    $idprgrm2=$opd->kdunit.($kp+1);
                                  }

                                  $tahun_1=$pi->t1 ? $pi->t1 : null;
                                  $tahun_2=$pi->t2 ? $pi->t2 : null;
                                  $tahun_3=$pi->t3 ? $pi->t3 : null;
                                  $tahun_4=$pi->t4 ? $pi->t4 : null;
                                  $tahun_5=$pi->t5 ? $pi->t5 : null;
                                  $tahun_6=$pi->t6 ? $pi->t6 : null;
                                  $tkrpjmd=($tahun_1)+($tahun_2)+($tahun_3)+($tahun_4)+($tahun_5)+($tahun_6);
                                  
                                 $event->sheet->getDelegate()->setCellValue('B'.$baris_akhir,$idprgrm);  
                                 $event->sheet->getDelegate()->setCellValue('C'.$baris_akhir,$nm_prog);  
                                 $event->sheet->getDelegate()->setCellValue('D'.$baris_akhir,$pi->indikator); 
                                 $event->sheet->getDelegate()->setCellValue('E'.$baris_akhir,$pi->satuan);    
                                 $event->sheet->getDelegate()->setCellValue('F'.$baris_akhir,$tkrpjmd);  
                                 $event->sheet->getDelegate()->setCellValue('J'.$baris_akhir,$v7k);

                                 if($pi->realisasi_tprog!=""){
                                    $event->sheet->getDelegate()->setCellValue('H'.$baris_akhir,$pi->realisasi_tprog->p_re); 
                                    $event->sheet->getDelegate()->setCellValue('L'.$baris_akhir,$pi->realisasi_tprog->p_t1); 
                                    $event->sheet->getDelegate()->setCellValue('N'.$baris_akhir,$pi->realisasi_tprog->p_t2); 
                                    $event->sheet->getDelegate()->setCellValue('P'.$baris_akhir,$pi->realisasi_tprog->p_t3); 
                                    $event->sheet->getDelegate()->setCellValue('R'.$baris_akhir,$pi->realisasi_tprog->p_t4); 
                                    $event->sheet->getDelegate()->setCellValue('AC'.$baris_akhir,$pi->realisasi_tprog->ket_prog); 
                                 }

                                  // rumus K program
                                 $event->sheet->getDelegate()->setCellValue('T'.$baris_akhir,'=L'.$baris_akhir.'+N'.$baris_akhir.'+P'.$baris_akhir.'+R'.$baris_akhir);
                                 $event->sheet->getDelegate()->setCellValue('V'.$baris_akhir,'=T'.$baris_akhir.'/J'.$baris_akhir.'*100');
                                 $event->sheet->getDelegate()->setCellValue('X'.$baris_akhir,'=H'.$baris_akhir.'+T'.$baris_akhir);
                                 $event->sheet->getDelegate()->setCellValue('Z'.$baris_akhir,'=X'.$baris_akhir.'/F'.$baris_akhir.'*100');

                                    $a++;
                              }

                  		// kegiatan
                      if($data_renja=="awal"){
                  		  $renja1=Renja::where('periode',$this->periode)->where('id_instansi',$this->id_instansi)->where('idprgrm',$vpn->idprgrm)->where('bappeda',1)->get();
                      }elseif($data_renja=="perubahan"){
                        $renja1=Renja_Per::where('periode',$this->periode)->where('id_instansi',$this->id_instansi)->where('idprgrm',$vpn->idprgrm)->where('bappeda',1)->get();
                      }
                  		$no=0;
                      $idprgrm=$opd->kdunit.($kp+1);
                      $kdkegunit2=null;
                  		$baris_keg_mulai=$baris_akhir+1;
                  		foreach($renja1 as $kk=>$vr){
                  		$no++;
                      $no_keg=$no;
                  		$nm_keg=$vr->master_kegiatan->nmkegunit;
                  		$dana=$vr->belanja_p_now+$vr->belanja_bj_now+$vr->belanja_m_now;

                  		$jml_ind_keg = count($vr->indikator_kegiatan_target());
                  		
                  			$rp5="";
                  			$rp6="";
                  			$rpt1="";
                  			$rpt2="";
                  			$rpt3="";
                  			$rpt4="";
                  			if($vr->realisasi_renja != ""){
                  			    $rp5 = $vr->realisasi_renja->rp5+0;
                  			    $rp6 = $vr->realisasi_renja->rp6+0;
                  			    $rpt1 = $vr->realisasi_renja->rpt1+0;
                  			    $rpt2 = $vr->realisasi_renja->rpt2+0;
                  			    $rpt3 = $vr->realisasi_renja->rpt3+0;
                  			    $rpt4 = $vr->realisasi_renja->rpt4+0;
                  			}

                  			$isi=$vr->indikator_kegiatan_target();
                  			$tolokur="";$tolokur2="";
                  			for($k=0;$k<$jml_ind_keg;$k++){
                  			if($k>0){
                          $nm_keg="";$dana="";$no_keg="";
                          $rp5="";$rp6="";
                          $rpt1="";$rpt2="";$rpt3="";$rpt4="";
                        }
                  			
                        if($data_renja=="awal"){
                          $target_det=$isi[$k]['target_det'];
                  			}elseif($data_renja=="perubahan"){
                          $target_det=$isi[$k]['target_det_per'];
                        }

                        $tolokur=$isi[$k]['tolokur'];
                  			if($tolokur==$tolokur2){$tolokur="";}else{$tolokur=$isi[$k]['tolokur'];$tolokur2=$isi[$k]['tolokur'];}
                  			$baris_akhir++;
                  			$event->sheet->getDelegate()->setCellValue('A'.$baris_akhir,$no_keg);
                        
                        $kdkegunit=$idprgrm.".".($kk+1);
                        if($kdkegunit==$kdkegunit2){
                           $kdkegunit="";
                           $kdkegunit2=$idprgrm.".".($kk+1);
                         }else{
                           $kdkegunit2=$idprgrm.".".($kk+1);
                         }
                  			$event->sheet->getDelegate()->setCellValue('B'.$baris_akhir,$kdkegunit);
                  			$event->sheet->getDelegate()->setCellValue('C'.$baris_akhir,$nm_keg);
                  			$event->sheet->getDelegate()->setCellValue('D'.$baris_akhir,$tolokur);
                  			$event->sheet->getDelegate()->setCellValue('E'.$baris_akhir,$isi[$k]['sat_det']);

                  			$event->sheet->getDelegate()->setCellValue('F'.$baris_akhir,$isi[$k]['k5']);
                  			$event->sheet->getDelegate()->setCellValue('G'.$baris_akhir,$rp5);

                  			$event->sheet->getDelegate()->setCellValue('H'.$baris_akhir,$isi[$k]['k6']);
                  			$event->sheet->getDelegate()->setCellValue('I'.$baris_akhir,$rp6);

                  			$event->sheet->getDelegate()->setCellValue('J'.$baris_akhir,$target_det);
                  			$event->sheet->getDelegate()->setCellValue('K'.$baris_akhir,$dana);

                  			$event->sheet->getDelegate()->setCellValue('L'.$baris_akhir,$isi[$k]['kt1']);
                  			$event->sheet->getDelegate()->setCellValue('M'.$baris_akhir,$rpt1);

                  			$triwulan=$this->triwulan;
                  			if($triwulan=="II" or $triwulan=="III" or $triwulan=="IV"){
                  			$event->sheet->getDelegate()->setCellValue('N'.$baris_akhir,$isi[$k]['kt2']);
                  			$event->sheet->getDelegate()->setCellValue('O'.$baris_akhir,$rpt2);
                  			}
                  			
                  			if($triwulan=="III" or $triwulan=="IV"){
                  			$event->sheet->getDelegate()->setCellValue('P'.$baris_akhir,$isi[$k]['kt3']);
                  			$event->sheet->getDelegate()->setCellValue('Q'.$baris_akhir,$rpt3);
                  			}
                  			
                  			if($triwulan=="IV"){
                  			$event->sheet->getDelegate()->setCellValue('R'.$baris_akhir,$isi[$k]['kt4']);
                  			$event->sheet->getDelegate()->setCellValue('S'.$baris_akhir,$rpt4);
                  			}
                  			
                  			//rumus ...
              //(12)
                  			$event->sheet->getDelegate()->setCellValue('T'.$baris_akhir,'=L'.$baris_akhir.'+N'.$baris_akhir.'+P'.$baris_akhir.'+R'.$baris_akhir);
                  			if($k<1){
                        $event->sheet->getDelegate()->setCellValue('U'.$baris_akhir,'=M'.$baris_akhir.'+O'.$baris_akhir.'+Q'.$baris_akhir.'+S'.$baris_akhir);
                        }

							//(13)
                  			$event->sheet->getDelegate()->setCellValue('V'.$baris_akhir,'=T'.$baris_akhir.'/J'.$baris_akhir.'*100');
                        if($k<1){
                  			$event->sheet->getDelegate()->setCellValue('W'.$baris_akhir,'=U'.$baris_akhir.'/K'.$baris_akhir.'*100');
                        }

							//(14)
                  			$event->sheet->getDelegate()->setCellValue('X'.$baris_akhir,'=H'.$baris_akhir.'+T'.$baris_akhir);
                        if($k<1){
                  			$event->sheet->getDelegate()->setCellValue('Y'.$baris_akhir,'=I'.$baris_akhir.'+U'.$baris_akhir);
                        }

							//(15)
                  			$event->sheet->getDelegate()->setCellValue('Z'.$baris_akhir,'=X'.$baris_akhir.'/F'.$baris_akhir.'*100');
                        if($k<1){
                  			$event->sheet->getDelegate()->setCellValue('AA'.$baris_akhir,'=Y'.$baris_akhir.'/G'.$baris_akhir.'*100');
                        }


                  			$event->sheet->getDelegate()->setCellValue('AB'.$baris_akhir,$opd->singkatan);
                                    if($vr->lokasi!="" and $isi[$k]['ket_keg']!=""){$sep="/";}else{$sep="";}
                  			$event->sheet->getDelegate()->setCellValue('AC'.$baris_akhir,$vr->lokasi.' '.$sep.' '.$isi[$k]['ket_keg']);
		                  		
                  			}
                  		}
                  		//sum program
                  		$event->sheet->getDelegate()->setCellValue('G'.$baris_prog,'=sum(G'.$baris_keg_mulai.':G'.$baris_akhir.')');
                  		$event->sheet->getDelegate()->setCellValue('I'.$baris_prog,'=sum(I'.$baris_keg_mulai.':I'.$baris_akhir.')');
                  		$event->sheet->getDelegate()->setCellValue('K'.$baris_prog,'=sum(K'.$baris_keg_mulai.':K'.$baris_akhir.')');
                  		
                  		$event->sheet->getDelegate()->setCellValue('M'.$baris_prog,'=sum(M'.$baris_keg_mulai.':M'.$baris_akhir.')');
                  		$event->sheet->getDelegate()->setCellValue('O'.$baris_prog,'=sum(O'.$baris_keg_mulai.':O'.$baris_akhir.')');
                  		$event->sheet->getDelegate()->setCellValue('Q'.$baris_prog,'=sum(Q'.$baris_keg_mulai.':Q'.$baris_akhir.')');
                  		$event->sheet->getDelegate()->setCellValue('S'.$baris_prog,'=sum(S'.$baris_keg_mulai.':S'.$baris_akhir.')');
                  		

                  		$event->sheet->getDelegate()->setCellValue('U'.$baris_prog,'=M'.$baris_prog.'+O'.$baris_prog.'+Q'.$baris_prog.'+S'.$baris_prog);
                  		$event->sheet->getDelegate()->setCellValue('W'.$baris_prog,'=U'.$baris_prog.'/K'.$baris_prog.'*100');
                  		$event->sheet->getDelegate()->setCellValue('Y'.$baris_prog,'=I'.$baris_prog.'+U'.$baris_prog);
                  		$event->sheet->getDelegate()->setCellValue('AA'.$baris_prog,'=Y'.$baris_prog.'/G'.$baris_prog.'*100');

                  		// end kegiatan
                  		$baris_akhir++;
                  		$event->sheet->getDelegate()->setCellValue('A'.$baris_akhir,'Rata-rata Capaian Kinerja (%)');
                  		$event->sheet->getDelegate()->mergeCells('A'.$baris_akhir.':Y'.$baris_akhir);
                  		$event->sheet->getDelegate()->setCellValue('Z'.$baris_akhir,'=sum(Z'.$baris_keg_mulai.':Z'.($baris_akhir-1).')/'.($baris_akhir-$baris_keg_mulai));
                  		$event->sheet->getDelegate()->setCellValue('AA'.$baris_akhir,'=sum(AA'.$baris_keg_mulai.':AA'.($baris_akhir-1).')/'.$no);

                  		// v
                  		$baris_akhir++;
                  		$event->sheet->getDelegate()->setCellValue('A'.$baris_akhir,'Predikat Kinerja');
                  		$event->sheet->getDelegate()->mergeCells('A'.$baris_akhir.':Y'.$baris_akhir);
                  		$event->sheet->getDelegate()->setCellValue('Z'.$baris_akhir,'=IF(Z'.($baris_akhir-1).'>90,"ST",IF(Z'.($baris_akhir-1).'>=76,"T",IF(Z'.($baris_akhir-1).'>=66,"S",IF(Z'.($baris_akhir-1).'>=51,"R","SR"))))');
                  		$event->sheet->getDelegate()->setCellValue('AA'.$baris_akhir,'=IF(AA'.($baris_akhir-1).'>90,"ST",IF(AA'.($baris_akhir-1).'>=76,"T",IF(AA'.($baris_akhir-1).'>=66,"S",IF(AA'.($baris_akhir-1).'>=51,"R","SR"))))');

                        //hidden  kegiatan
                        if($rekap!="Detail"){
                            for ($b_hidden=$baris_keg_mulai; $b_hidden <= $baris_akhir; $b_hidden++) { 
                              $event->sheet->getDelegate()->getRowDimension($b_hidden)->setCollapsed(true);
                              $event->sheet->getDelegate()->getRowDimension($b_hidden)->setVisible(false);
                            }
                        }else{
                            $baris_akhir++;
                        }
                  }
                  //end non urusan
                  // sum non urusan
                  if($rpjmd_prog_non->count()>0){
                  $event->sheet->getDelegate()->setCellValue('G'.$baris_non_urusan,$gjmlprog);
                  $event->sheet->getDelegate()->setCellValue('I'.$baris_non_urusan,$ijmlprog);
                  $event->sheet->getDelegate()->setCellValue('K'.$baris_non_urusan,$kjmlprog);

                  $event->sheet->getDelegate()->setCellValue('M'.$baris_non_urusan,$mjmlprog);
                  $event->sheet->getDelegate()->setCellValue('O'.$baris_non_urusan,$ojmlprog);
                  $event->sheet->getDelegate()->setCellValue('Q'.$baris_non_urusan,$qjmlprog);
                  $event->sheet->getDelegate()->setCellValue('S'.$baris_non_urusan,$sjmlprog);

                  $event->sheet->getDelegate()->setCellValue('U'.$baris_non_urusan,'=M'.$baris_non_urusan.'+O'.$baris_non_urusan.'+Q'.$baris_non_urusan.'+S'.$baris_non_urusan);
                  $event->sheet->getDelegate()->setCellValue('W'.$baris_non_urusan,'=U'.$baris_non_urusan.'/K'.$baris_non_urusan.'*100');
                  $event->sheet->getDelegate()->setCellValue('Y'.$baris_non_urusan,'=I'.$baris_non_urusan.'+U'.$baris_non_urusan);
                  $event->sheet->getDelegate()->setCellValue('AA'.$baris_non_urusan,'=Y'.$baris_non_urusan.'/G'.$baris_non_urusan.'*100');
                  
                  $event->sheet->getDelegate()->setCellValue('V'.$baris_non_urusan,'=('.$vjmlprog.')/'.$jml_brs_indprog_non);
                  $event->sheet->getDelegate()->setCellValue('Z'.$baris_non_urusan,'=('.$zjmlprog.')/'.$jml_brs_indprog_non);
                  }
                  //Urusan
                  $pecah=explode(",",$urusan_opd->arr_urusan); 
                  foreach ($pecah as $value){
                  	    if($value!="80_"){
                  	        $du = $dafunit->where('unitkey','=',$value)->first();
                  	        $urusan = $du->nm_unit;
                  	    }else{
                  	        $du = $dafunit->where('unitkey','=','212_')->first();
                  	        $sekda = $opd->where('unit_key','=',$value)->first();
                  	        
                  	        $urusan = $du->nm_unit.' : '.$sekda->nm_instansi;
                  
                  	    }
                            if($du->parent!=null){
                            $baris_akhir++;
                            $event->sheet->getDelegate()->setCellValue('B'.$baris_akhir,$du->parent->kdunit);
                            $event->sheet->getDelegate()->setCellValue('C'.$baris_akhir,$du->parent->nm_unit);
                            $event->sheet->getDelegate()->getStyle('A'.$baris_akhir.':'.$kolom_akhir.''.$baris_akhir)->applyFromArray($style_urusan);
                            }

                            $baris_akhir++;
                            $event->sheet->getDelegate()->setCellValue('B'.$baris_akhir,$du->kdunit);
                            // if($value!="80_"){
                              $event->sheet->getDelegate()->setCellValue('C'.$baris_akhir,$urusan);
                            // }else{
                              $event->sheet->getDelegate()->setCellValue('C'.$baris_akhir,$urusan);
                            // }

                        $event->sheet->getDelegate()->getStyle('A'.$baris_akhir.':'.$kolom_akhir.''.$baris_akhir)->applyFromArray($style_urusan);

                        $gjmlopd .= "+G".($baris_akhir);
                        $ijmlopd .= "+I".($baris_akhir);
                        $kjmlopd .= "+K".($baris_akhir);
                        $mjmlopd .= "+M".($baris_akhir);
                        $ojmlopd .= "+O".($baris_akhir);
                        $qjmlopd .= "+Q".($baris_akhir);
                        $sjmlopd .= "+S".($baris_akhir);
                        
                        $vjmlopd .= "+V".($baris_akhir);
                        $zjmlopd .= "+Z".($baris_akhir);
                        $jmlurusanopd++;
                       //  $baris_akhir++;
                       //  $event->sheet->getDelegate()->setCellValue('B'.$baris_akhir,$du->kdunit.''.$opd->id);
                       //  $event->sheet->getDelegate()->setCellValue('C'.$baris_akhir,$opd->nm_instansi);
                  	    // $event->sheet->getDelegate()->getStyle('A'.$baris_akhir.':'.$kolom_akhir.''.$baris_akhir)->applyFromArray($style_opd);
                  
                  // program urusan
                  $rpjmd_prog_urusan = $rpjmd_prog->where('unitkey','=',$value);
                  // $jum=count($rpjmd_prog_urusan);
                  $kp2=0;

                  //start jml prog urusan
                  $gjmlprog="=G".($baris_akhir+1);
                  $ijmlprog="=I".($baris_akhir+1);
                  $kjmlprog="=K".($baris_akhir+1);
                  
                  $mjmlprog="=M".($baris_akhir+1);
                  $ojmlprog="=O".($baris_akhir+1);
                  $qjmlprog="=Q".($baris_akhir+1);
                  $sjmlprog="=S".($baris_akhir+1);
                  $baris_urusan=$baris_akhir;

                  $vjmlprog="0";
                  $zjmlprog="0";
                  $jml_brs_indprog=0;
                  foreach($rpjmd_prog_urusan as $kp=>$vp){
                    if($kp2>0){$gjmlprog .= "+G".($baris_akhir+1);}
                    if($kp2>0){$ijmlprog .= "+I".($baris_akhir+1);}
                    if($kp2>0){$kjmlprog .= "+K".($baris_akhir+1);}
                    if($kp2>0){$mjmlprog .= "+M".($baris_akhir+1);}
                    if($kp2>0){$ojmlprog .= "+O".($baris_akhir+1);}
                    if($kp2>0){$qjmlprog .= "+Q".($baris_akhir+1);}
                    if($kp2>0){$sjmlprog .= "+S".($baris_akhir+1);}

                    $kp2++;
                  $nm_prog=$vp->nmprgrm;
                  $idprgrm=$du->kdunit.$kp2;
                  // $idprgrm=$jum;
                  $jml_ind_prog = count($vp->indikator_program());
	                  // for($a=0;$a<$jml_ind_prog;$a++){
                  	// 		if($a>0){$nm_prog="";}else{$baris_prog=$baris_akhir+1;}
                  	// 		$indikator=$vp->indikator_program();
                  	// 		if($periode==2016){
                  	// 		    $v7k=$indikator[$a]['t1'];
                  	// 		}elseif($periode==2017){
                  	// 		    $v7k=$indikator[$a]['t2'];
                  	// 		}elseif($periode==2018){
                  	// 		    $v7k=$indikator[$a]['t3'];
                  	// 		}elseif($periode==2019){
                  	// 		    $v7k=$indikator[$a]['t4'];
                  	// 		}elseif($periode==2020){
                  	// 		    $v7k=$indikator[$a]['t5'];
                  	// 		}elseif($periode==2021){
                  	// 		    $v7k=$indikator[$a]['t6'];
                  	// 		}
                  	// 		$baris_akhir++;
                  	// 		$event->sheet->getDelegate()->getStyle('A'.$baris_akhir.':'.$kolom_akhir.''.$baris_akhir)->applyFromArray($style_program);
                  	// 		$event->sheet->getDelegate()->setCellValue('C'.$baris_akhir,$nm_prog);	
                  	// 		$event->sheet->getDelegate()->setCellValue('D'.$baris_akhir,$indikator[$a]['indikator']);	
                  	// 		$event->sheet->getDelegate()->setCellValue('E'.$baris_akhir,$indikator[$a]['satuan']);	
                  	// 		$event->sheet->getDelegate()->setCellValue('F'.$baris_akhir,$indikator[$a]['t6']);	
                  	// 		$event->sheet->getDelegate()->setCellValue('J'.$baris_akhir,$v7k);
                  	// }
                        $a=0;
                        foreach($vp->indikator_program() as $pi2){
                              if($a>0){$nm_prog="";$idprgrm="";}else{$baris_prog=$baris_akhir+1;}
                                 if($a>0){$nm_prog="";$idprgrm="";}else{$baris_prog=$baris_akhir+1;}
                                 
                                 if($periode==2016){
                                     $v7k=$pi2->t1;
                                 }elseif($periode==2017){
                                     $v7k=$pi2->t2;
                                 }elseif($periode==2018){
                                     $v7k=$pi2->t3;
                                 }elseif($periode==2019){
                                     $v7k=$pi2->t4;
                                 }elseif($periode==2020){
                                     $v7k=$pi2->t5;
                                 }elseif($periode==2021){
                                     $v7k=$pi2->t6;
                                 }

                                 //capaian kinerja non urusan
                                 $vjmlprog .= "+V".($baris_akhir+1);
                                 $zjmlprog .= "+Z".($baris_akhir+1);
                                 $jml_brs_indprog++;

                                 $tahun_1=$pi2->t1 ? $pi2->t1 : null;
                                 $tahun_2=$pi2->t2 ? $pi2->t2 : null;
                                 $tahun_3=$pi2->t3 ? $pi2->t3 : null;
                                 $tahun_4=$pi2->t4 ? $pi2->t4 : null;
                                 $tahun_5=$pi2->t5 ? $pi2->t5 : null;
                                 $tahun_6=$pi2->t6 ? $pi2->t6 : null;
                                 $tkrpjmd2=($tahun_1)+($tahun_2)+($tahun_3)+($tahun_4)+($tahun_5)+($tahun_6);

                          // cek jml keg prog
                          if($vp->jml_keg($this->periode,$data_renja)>0){
                           $baris_akhir++;
                           $event->sheet->getDelegate()->getStyle('A'.$baris_akhir.':'.$kolom_akhir.''.$baris_akhir)->applyFromArray($style_program);

                           $event->sheet->getDelegate()->setCellValue('B'.$baris_akhir,$idprgrm);  
                           $event->sheet->getDelegate()->setCellValue('C'.$baris_akhir,$nm_prog);  
                           $event->sheet->getDelegate()->setCellValue('D'.$baris_akhir,$pi2->indikator); 
                           $event->sheet->getDelegate()->setCellValue('E'.$baris_akhir,$pi2->satuan);    
                           $event->sheet->getDelegate()->setCellValue('F'.$baris_akhir,$tkrpjmd2);  
                           $event->sheet->getDelegate()->setCellValue('J'.$baris_akhir,$v7k);
                          }

                           if($pi2->realisasi_tprog!=""){
                              $event->sheet->getDelegate()->setCellValue('H'.$baris_akhir,$pi2->realisasi_tprog->p_re); 
                              $event->sheet->getDelegate()->setCellValue('L'.$baris_akhir,$pi2->realisasi_tprog->p_t1); 
                              $event->sheet->getDelegate()->setCellValue('N'.$baris_akhir,$pi2->realisasi_tprog->p_t2); 
                              $event->sheet->getDelegate()->setCellValue('P'.$baris_akhir,$pi2->realisasi_tprog->p_t3); 
                              $event->sheet->getDelegate()->setCellValue('R'.$baris_akhir,$pi2->realisasi_tprog->p_t4); 
                              $event->sheet->getDelegate()->setCellValue('AC'.$baris_akhir,$pi2->realisasi_tprog->ket_prog); 
                           }

                             // rumus K program
                            $event->sheet->getDelegate()->setCellValue('T'.$baris_akhir,'=L'.$baris_akhir.'+N'.$baris_akhir.'+P'.$baris_akhir.'+R'.$baris_akhir);
                            $event->sheet->getDelegate()->setCellValue('V'.$baris_akhir,'=T'.$baris_akhir.'/J'.$baris_akhir.'*100');
                            $event->sheet->getDelegate()->setCellValue('X'.$baris_akhir,'=H'.$baris_akhir.'+T'.$baris_akhir);
                            $event->sheet->getDelegate()->setCellValue('Z'.$baris_akhir,'=X'.$baris_akhir.'/F'.$baris_akhir.'*100');
                            
                              $a++;
                        }

                  	// kegiatan
                    if($data_renja=="awal"){
                    	$renja1=Renja::where('periode',$this->periode)->where('id_instansi',$this->id_instansi)->where('idprgrm',$vp->idprgrm)->where('bappeda',1)->get();
                    }elseif($data_renja=="perubahan"){
                      $renja1=Renja_Per::where('periode',$this->periode)->where('id_instansi',$this->id_instansi)->where('idprgrm',$vp->idprgrm)->where('bappeda',1)->get();
                    }

                  	$no=0;
                  	$baris_keg_mulai=$baris_akhir+1;
                  	foreach($renja1 as $kk=>$vr){
                    $kdkeg=$du->kdunit.$kp2.".".($kk+1);
                  	$no++;
                  	$no_keg=$no;
                  	$nm_keg=$vr->master_kegiatan->nmkegunit;
                  	$dana=$vr->belanja_p_now+$vr->belanja_bj_now+$vr->belanja_m_now;

                  	$jml_ind_keg = count($vr->indikator_kegiatan_target());
                  	
                  		$rp5="";
                  		$rp6="";
                  		$rpt1="";
                  		$rpt2="";
                  		$rpt3="";
                  		$rpt4="";
                  		if($vr->realisasi_renja != ""){
                  		    $rp5 = $vr->realisasi_renja->rp5+0;
                  		    $rp6 = $vr->realisasi_renja->rp6+0;
                  		    $rpt1 = $vr->realisasi_renja->rpt1+0;
                  		    $rpt2 = $vr->realisasi_renja->rpt2+0;
                  		    $rpt3 = $vr->realisasi_renja->rpt3+0;
                  		    $rpt4 = $vr->realisasi_renja->rpt4+0;
                  		}

                  		$isi=$vr->indikator_kegiatan_target();
                  		$tolokur="";$tolokur2="";

                  		for($k=0;$k<$jml_ind_keg;$k++){

                  		if($k>0){
                        $nm_keg="";$dana="";$no_keg="";$kdkeg="";
                        $rp5="";$rp6="";
                        $rpt1="";$rpt2="";$rpt3="";$rpt4="";
                      }
                      if($data_renja=="awal"){
                        $target_det=$isi[$k]['target_det'];                        
                      }elseif($data_renja=="perubahan"){
                        $target_det=$isi[$k]['target_det_per'];
                      }


                  		$tolokur=$isi[$k]['tolokur'];
                  		if($tolokur==$tolokur2){$tolokur="";}else{$tolokur=$isi[$k]['tolokur'];$tolokur2=$isi[$k]['tolokur'];}
                  		
                  		$baris_akhir++;
                  		$event->sheet->getDelegate()->setCellValue('A'.$baris_akhir,$no_keg);
                  		$event->sheet->getDelegate()->setCellValue('B'.$baris_akhir,$kdkeg);
                  		$event->sheet->getDelegate()->setCellValue('C'.$baris_akhir,$nm_keg);
                  		$event->sheet->getDelegate()->setCellValue('D'.$baris_akhir,$tolokur);
                  		$event->sheet->getDelegate()->setCellValue('E'.$baris_akhir,$isi[$k]['sat_det']);

                  		$event->sheet->getDelegate()->setCellValue('F'.$baris_akhir,$isi[$k]['k5']);
                  		$event->sheet->getDelegate()->setCellValue('G'.$baris_akhir,$rp5);

                  		$event->sheet->getDelegate()->setCellValue('H'.$baris_akhir,$isi[$k]['k6']);
                  		$event->sheet->getDelegate()->setCellValue('I'.$baris_akhir,$rp6);

                  		$event->sheet->getDelegate()->setCellValue('J'.$baris_akhir,$target_det);
                  		$event->sheet->getDelegate()->setCellValue('K'.$baris_akhir,$dana);

                  		$event->sheet->getDelegate()->setCellValue('L'.$baris_akhir,$isi[$k]['kt1']);
                  		$event->sheet->getDelegate()->setCellValue('M'.$baris_akhir,$rpt1);

                  		$triwulan=$this->triwulan;
                  		if($triwulan=="II" or $triwulan=="III" or $triwulan=="IV"){
                  		$event->sheet->getDelegate()->setCellValue('N'.$baris_akhir,$isi[$k]['kt2']);
                  		$event->sheet->getDelegate()->setCellValue('O'.$baris_akhir,$rpt2);
                  		}
                  		
                  		if($triwulan=="III" or $triwulan=="IV"){
                  		$event->sheet->getDelegate()->setCellValue('P'.$baris_akhir,$isi[$k]['kt3']);
                  		$event->sheet->getDelegate()->setCellValue('Q'.$baris_akhir,$rpt3);
                  		}
                  		
                  		if($triwulan=="IV"){
                  		$event->sheet->getDelegate()->setCellValue('R'.$baris_akhir,$isi[$k]['kt4']);
                  		$event->sheet->getDelegate()->setCellValue('S'.$baris_akhir,$rpt4);
                  		}

                  		//rumus ...
            //(12)
                  		$event->sheet->getDelegate()->setCellValue('T'.$baris_akhir,'=L'.$baris_akhir.'+N'.$baris_akhir.'+P'.$baris_akhir.'+R'.$baris_akhir);
                      if($k<1){
                  		$event->sheet->getDelegate()->setCellValue('U'.$baris_akhir,'=M'.$baris_akhir.'+O'.$baris_akhir.'+Q'.$baris_akhir.'+S'.$baris_akhir);
                      }

						//(13)
              			$event->sheet->getDelegate()->setCellValue('V'.$baris_akhir,'=T'.$baris_akhir.'/J'.$baris_akhir.'*100');
                    if($k<1){
              			$event->sheet->getDelegate()->setCellValue('W'.$baris_akhir,'=U'.$baris_akhir.'/K'.$baris_akhir.'*100');
                    }

						//(14)
              			$event->sheet->getDelegate()->setCellValue('X'.$baris_akhir,'=H'.$baris_akhir.'+T'.$baris_akhir);
                    if($k<1){
              			$event->sheet->getDelegate()->setCellValue('Y'.$baris_akhir,'=I'.$baris_akhir.'+U'.$baris_akhir);
                    }

						//(15)
              			$event->sheet->getDelegate()->setCellValue('Z'.$baris_akhir,'=X'.$baris_akhir.'/F'.$baris_akhir.'*100');
                    if($k<1){
              			$event->sheet->getDelegate()->setCellValue('AA'.$baris_akhir,'=Y'.$baris_akhir.'/G'.$baris_akhir.'*100');
                    }



                  		$event->sheet->getDelegate()->setCellValue('AB'.$baris_akhir,$opd->singkatan);
                              if($vr->lokasi!="" and $isi[$k]['ket_keg']!=""){$sep="/";}else{$sep="";}
                  		$event->sheet->getDelegate()->setCellValue('AC'.$baris_akhir,$vr->lokasi.' '.$sep.' '.$isi[$k]['ket_keg']);

						}
                  	}

                  	//sum program
                  	$event->sheet->getDelegate()->setCellValue('G'.$baris_prog,'=sum(G'.$baris_keg_mulai.':G'.$baris_akhir.')');
                  	$event->sheet->getDelegate()->setCellValue('I'.$baris_prog,'=sum(I'.$baris_keg_mulai.':I'.$baris_akhir.')');
                  	$event->sheet->getDelegate()->setCellValue('K'.$baris_prog,'=sum(K'.$baris_keg_mulai.':K'.$baris_akhir.')');
                  	
                  	$event->sheet->getDelegate()->setCellValue('M'.$baris_prog,'=sum(M'.$baris_keg_mulai.':M'.$baris_akhir.')');
                  	$event->sheet->getDelegate()->setCellValue('O'.$baris_prog,'=sum(O'.$baris_keg_mulai.':O'.$baris_akhir.')');
                  	$event->sheet->getDelegate()->setCellValue('Q'.$baris_prog,'=sum(Q'.$baris_keg_mulai.':Q'.$baris_akhir.')');
                  	$event->sheet->getDelegate()->setCellValue('S'.$baris_prog,'=sum(S'.$baris_keg_mulai.':S'.$baris_akhir.')');
                  	

                  	$event->sheet->getDelegate()->setCellValue('U'.$baris_prog,'=M'.$baris_prog.'+O'.$baris_prog.'+Q'.$baris_prog.'+S'.$baris_prog);
                  	$event->sheet->getDelegate()->setCellValue('W'.$baris_prog,'=U'.$baris_prog.'/K'.$baris_prog.'*100');
                  	$event->sheet->getDelegate()->setCellValue('Y'.$baris_prog,'=I'.$baris_prog.'+U'.$baris_prog);
                  	$event->sheet->getDelegate()->setCellValue('AA'.$baris_prog,'=Y'.$baris_prog.'/G'.$baris_prog.'*100');


                  	// end kegiatan

                  	$baris_akhir++;
                  	$event->sheet->getDelegate()->setCellValue('A'.$baris_akhir,'Rata-rata Capaian Kinerja (%)');
                  	$event->sheet->getDelegate()->mergeCells('A'.$baris_akhir.':Y'.$baris_akhir);
                  	$event->sheet->getDelegate()->setCellValue('Z'.$baris_akhir,'=sum(Z'.$baris_keg_mulai.':Z'.($baris_akhir-1).')/'.($baris_akhir-$baris_keg_mulai));
                  	$event->sheet->getDelegate()->setCellValue('AA'.$baris_akhir,'=sum(AA'.$baris_keg_mulai.':AA'.($baris_akhir-1).')/'.$no);

                  	// v
                  	$baris_akhir++;
                  	$event->sheet->getDelegate()->setCellValue('A'.$baris_akhir,'Predikat Kinerja');
                  	$event->sheet->getDelegate()->mergeCells('A'.$baris_akhir.':Y'.$baris_akhir);
                  	$event->sheet->getDelegate()->setCellValue('Z'.$baris_akhir,'=IF(Z'.($baris_akhir-1).'>90,"ST",IF(Z'.($baris_akhir-1).'>=76,"T",IF(Z'.($baris_akhir-1).'>=66,"S",IF(Z'.($baris_akhir-1).'>=51,"R","SR"))))');
                  	$event->sheet->getDelegate()->setCellValue('AA'.$baris_akhir,'=IF(AA'.($baris_akhir-1).'>90,"ST",IF(AA'.($baris_akhir-1).'>=76,"T",IF(AA'.($baris_akhir-1).'>=66,"S",IF(AA'.($baris_akhir-1).'>=51,"R","SR"))))');

                    //hidden  kegiatan
                    if($rekap!="Detail"){
                        for ($b_hidden=$baris_keg_mulai; $b_hidden <= $baris_akhir; $b_hidden++) { 
                          $event->sheet->getDelegate()->getRowDimension($b_hidden)->setCollapsed(true);
                          $event->sheet->getDelegate()->getRowDimension($b_hidden)->setVisible(false);
                        }
                    }else{
                  	$baris_akhir++;
                    }
                  }
                  // end program urusan
                    // sum urusan
                    $event->sheet->getDelegate()->setCellValue('G'.$baris_urusan,$gjmlprog);
                    $event->sheet->getDelegate()->setCellValue('I'.$baris_urusan,$ijmlprog);
                    $event->sheet->getDelegate()->setCellValue('K'.$baris_urusan,$kjmlprog);

                    $event->sheet->getDelegate()->setCellValue('M'.$baris_urusan,$mjmlprog);
                    $event->sheet->getDelegate()->setCellValue('O'.$baris_urusan,$ojmlprog);
                    $event->sheet->getDelegate()->setCellValue('Q'.$baris_urusan,$qjmlprog);
                    $event->sheet->getDelegate()->setCellValue('S'.$baris_urusan,$sjmlprog);

                    $event->sheet->getDelegate()->setCellValue('U'.$baris_urusan,'=M'.$baris_urusan.'+O'.$baris_urusan.'+Q'.$baris_urusan.'+S'.$baris_urusan);
                    $event->sheet->getDelegate()->setCellValue('W'.$baris_urusan,'=U'.$baris_urusan.'/K'.$baris_urusan.'*100');
                    $event->sheet->getDelegate()->setCellValue('Y'.$baris_urusan,'=I'.$baris_urusan.'+U'.$baris_urusan);
                    $event->sheet->getDelegate()->setCellValue('AA'.$baris_urusan,'=Y'.$baris_urusan.'/G'.$baris_urusan.'*100');

                    $event->sheet->getDelegate()->setCellValue('V'.$baris_urusan,'=('.$vjmlprog.')/'.$jml_brs_indprog);
                    $event->sheet->getDelegate()->setCellValue('Z'.$baris_urusan,'=('.$zjmlprog.')/'.$jml_brs_indprog);
                  }
                  //end urusan
                  
                  // sum opd
                  $event->sheet->getDelegate()->setCellValue('G'.$baris_opd,$gjmlopd);
                  $event->sheet->getDelegate()->setCellValue('I'.$baris_opd,$ijmlopd);
                  $event->sheet->getDelegate()->setCellValue('K'.$baris_opd,$kjmlopd);

                  $event->sheet->getDelegate()->setCellValue('M'.$baris_opd,$mjmlopd);
                  $event->sheet->getDelegate()->setCellValue('O'.$baris_opd,$ojmlopd);
                  $event->sheet->getDelegate()->setCellValue('Q'.$baris_opd,$qjmlopd);
                  $event->sheet->getDelegate()->setCellValue('S'.$baris_opd,$sjmlopd);

                  $event->sheet->getDelegate()->setCellValue('U'.$baris_opd,'=M'.$baris_opd.'+O'.$baris_opd.'+Q'.$baris_opd.'+S'.$baris_opd);
                  $event->sheet->getDelegate()->setCellValue('W'.$baris_opd,'=U'.$baris_opd.'/K'.$baris_opd.'*100');
                  $event->sheet->getDelegate()->setCellValue('Y'.$baris_opd,'=I'.$baris_opd.'+U'.$baris_opd);
                  $event->sheet->getDelegate()->setCellValue('AA'.$baris_opd,'=Y'.$baris_opd.'/G'.$baris_opd.'*100');
                  
                  $event->sheet->getDelegate()->setCellValue('V'.$baris_opd,'=('.$vjmlopd.')/'.$jmlurusanopd);
                  $event->sheet->getDelegate()->setCellValue('Z'.$baris_opd,'=('.$zjmlopd.')/'.$jmlurusanopd);
                  
                  //capaian kinerja seluruh program
                  $baris_akhir++;
                  $event->sheet->getDelegate()->setCellValue('A'.$baris_akhir,'Rata-rata Capaian Kinerja Keseluruhan Program(%)');
                  $event->sheet->getDelegate()->mergeCells('A'.$baris_akhir.':U'.$baris_akhir);
                  $event->sheet->getDelegate()->setCellValue('V'.$baris_akhir,'=V'.$baris_opd);
                  $event->sheet->getDelegate()->setCellValue('W'.$baris_akhir,'=W'.$baris_opd);
                  $event->sheet->getDelegate()->setCellValue('Z'.$baris_akhir,'=Z'.$baris_opd);
                  $event->sheet->getDelegate()->setCellValue('AA'.$baris_akhir,'=AA'.$baris_opd);

                  // v
                  $baris_akhir++;
                  $event->sheet->getDelegate()->setCellValue('A'.$baris_akhir,'Predikat Kinerja Keseluruhan Program');
                  $event->sheet->getDelegate()->mergeCells('A'.$baris_akhir.':U'.$baris_akhir);
                  $event->sheet->getDelegate()->setCellValue('V'.$baris_akhir,'=IF(V'.($baris_akhir-1).'>90,"ST",IF(V'.($baris_akhir-1).'>=76,"T",IF(V'.($baris_akhir-1).'>=66,"S",IF(V'.($baris_akhir-1).'>=51,"R","SR"))))');
                  $event->sheet->getDelegate()->setCellValue('W'.$baris_akhir,'=IF(W'.($baris_akhir-1).'>90,"ST",IF(W'.($baris_akhir-1).'>=76,"T",IF(W'.($baris_akhir-1).'>=66,"S",IF(W'.($baris_akhir-1).'>=51,"R","SR"))))');
                  $event->sheet->getDelegate()->setCellValue('Z'.$baris_akhir,'=IF(Z'.($baris_akhir-1).'>90,"ST",IF(Z'.($baris_akhir-1).'>=76,"T",IF(Z'.($baris_akhir-1).'>=66,"S",IF(Z'.($baris_akhir-1).'>=51,"R","SR"))))');
                  $event->sheet->getDelegate()->setCellValue('AA'.$baris_akhir,'=IF(AA'.($baris_akhir-1).'>90,"ST",IF(AA'.($baris_akhir-1).'>=76,"T",IF(AA'.($baris_akhir-1).'>=66,"S",IF(AA'.($baris_akhir-1).'>=51,"R","SR"))))');


                  //bagian bawah
                  $baris_akhir++;
                  $event->sheet->getDelegate()->setCellValue('A'.$baris_akhir,'Faktor Pendorong Keberhasilan Kinerja:');
                  $event->sheet->getDelegate()->mergeCells('A'.$baris_akhir.':'.$kolom_akhir.''.$baris_akhir);
                  $baris_akhir++;

                  $event->sheet->getDelegate()->setCellValue('A'.$baris_akhir,'Faktor Penghambat Pencapaian Kinerja:');
                  $event->sheet->getDelegate()->mergeCells('A'.$baris_akhir.':'.$kolom_akhir.''.$baris_akhir);
                  $baris_akhir++;

                  $event->sheet->getDelegate()->setCellValue('A'.$baris_akhir,'Tindak Lanjut yang Diperlukan dalam triwulan berikutnya *)');
                  $event->sheet->getDelegate()->mergeCells('A'.$baris_akhir.':'.$kolom_akhir.''.$baris_akhir);
                  $baris_akhir++;

                  $event->sheet->getDelegate()->setCellValue('A'.$baris_akhir,'Tindak Lanjut yang Diperlukan dalam Renja Perangkat Daerah berikutnya *)');
                  $event->sheet->getDelegate()->mergeCells('A'.$baris_akhir.':'.$kolom_akhir.''.$baris_akhir);
                  
                  
                  //border
                  $styleArray = [
                      'borders' => [
                          'allBorders' => [
                              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                              'color' => ['argb' => '000'],
                          ],
                      ],
                  ];

                  //Delete col AC
                  if($jenis=="RKPD"){
                    // $event->sheet->getDelegate()->removeColumn('AC');
                    $event->sheet->getDelegate()->removeColumnByIndex(32);
                    $event->sheet->getDelegate()->getStyle('A8:AB'.$baris_akhir)->applyFromArray($styleArray);
                    $event->sheet->getDelegate()->getStyle('A8:AB'.$baris_akhir)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
                  }else{
                    $event->sheet->getDelegate()->getStyle('A8:'.$kolom_akhir.''.$baris_akhir)->applyFromArray($styleArray);
                    $event->sheet->getDelegate()->getStyle('A8:'.$kolom_akhir.''.$baris_akhir)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
                  }

                  $baris_akhir++;
                  //ket dan ttd
                  $event->sheet->getDelegate()->setCellValue('A'.$baris_akhir,'*) Diisi oleh Kepala BAPPEDA');
                  $baris_akhir++;

                  $event->sheet->getDelegate()->setCellValue('N'.$baris_akhir,'Disusun');
                  $event->sheet->getDelegate()->mergeCells('N'.$baris_akhir.':V'.$baris_akhir);
                  
                  if($jenis=="RKPD"){
                    $event->sheet->getDelegate()->setCellValue('Z'.$baris_akhir,'Disetujui');
                  }else{
                    $event->sheet->getDelegate()->setCellValue('Z'.$baris_akhir,'Dievaluasi');
                  }
                  $event->sheet->getDelegate()->mergeCells('Z'.$baris_akhir.':'.$kolom_akhir.''.$baris_akhir);
                  $baris_akhir++;

                  if($jenis=="RKPD"){
                    $event->sheet->getDelegate()->setCellValue('N'.$baris_akhir,'Padang, tanggal '.date('d-m-Y'));
                  }else{
                    $event->sheet->getDelegate()->setCellValue('N'.$baris_akhir,'..............................., tanggal '.date('d-m-Y'));
                  }

                  $event->sheet->getDelegate()->mergeCells('N'.$baris_akhir.':V'.$baris_akhir);
                  $event->sheet->getDelegate()->setCellValue('Z'.$baris_akhir,'Padang, tanggal '.date('d-m-Y'));
                  $event->sheet->getDelegate()->mergeCells('Z'.$baris_akhir.':'.$kolom_akhir.''.$baris_akhir);
                  $baris_akhir++;

                  $baris_akhir++;
                  if($jenis=="RKPD"){
                    $event->sheet->getDelegate()->setCellValue('N'.$baris_akhir,'BADAN PERENCANAAN PEMBANGUNAN DAERAH');
                  }else{
                    $event->sheet->getDelegate()->setCellValue('N'.$baris_akhir,$opd->nm_instansi);
                  }
                  $event->sheet->getDelegate()->getStyle('N'.$baris_akhir)->getAlignment()->setWrapText(true);
                  $event->sheet->getDelegate()->getRowDimension($baris_akhir)->setRowHeight(40);
                  $event->sheet->getDelegate()->mergeCells('N'.$baris_akhir.':V'.$baris_akhir);
                  if($jenis=="RKPD"){
                    $event->sheet->getDelegate()->setCellValue('Z'.$baris_akhir,'GUBERNUR SUMATERA BARAT');
                  }else{
                    $event->sheet->getDelegate()->setCellValue('Z'.$baris_akhir,'BADAN PERENCANAAN PEMBANGUNAN DAERAH');
                  }
                  $event->sheet->getDelegate()->mergeCells('Z'.$baris_akhir.':'.$kolom_akhir.''.$baris_akhir);
                  $baris_akhir++;

                  $event->sheet->getDelegate()->setCellValue('N'.$baris_akhir,'PROVINSI SUMATERA BARAT');
                  $event->sheet->getDelegate()->mergeCells('N'.$baris_akhir.':V'.$baris_akhir);
                  
                  if($jenis!="RKPD"){
                  $event->sheet->getDelegate()->setCellValue('Z'.$baris_akhir,'PROVINSI SUMATERA BARAT');
                  $event->sheet->getDelegate()->mergeCells('Z'.$baris_akhir.':'.$kolom_akhir.''.$baris_akhir);
                  }

                  $baris_akhir++;
                  if($jenis!="RKPD"){
                  $event->sheet->getDelegate()->setCellValue('N'.$baris_akhir,$opd->pimpinan.',');
                  $event->sheet->getDelegate()->mergeCells('N'.$baris_akhir.':V'.$baris_akhir);
                  $event->sheet->getDelegate()->setCellValue('Z'.$baris_akhir,'Kepala,');
                  $event->sheet->getDelegate()->mergeCells('Z'.$baris_akhir.':'.$kolom_akhir.''.$baris_akhir);
                  $baris_akhir++;
                  }else{
                    $event->sheet->getDelegate()->setCellValue('N'.$baris_akhir,'Kepala,');
                    $event->sheet->getDelegate()->mergeCells('N'.$baris_akhir.':V'.$baris_akhir);
                    $baris_akhir++;
                  }

                  $baris_akhir++;
                  $baris_akhir++;
                  $baris_akhir++;
                  $baris_akhir++;
                  if($jenis=="RKPD"){
                    $event->sheet->getDelegate()->setCellValue('N'.$baris_akhir,'HANSASTRI, SE.Ak.MM, CFrA');
                  }else{
                    $event->sheet->getDelegate()->setCellValue('N'.$baris_akhir,$opd->kepala);
                  }
                  $event->sheet->getDelegate()->mergeCells('N'.$baris_akhir.':V'.$baris_akhir);
                  if($jenis=="RKPD"){
                    $event->sheet->getDelegate()->setCellValue('Z'.$baris_akhir,'IRWAN PRAYITNO');
                  }else{
                    $event->sheet->getDelegate()->setCellValue('Z'.$baris_akhir,'HANSASTRI, SE.Ak.MM, CFrA');
                  }
                  
                  $event->sheet->getDelegate()->mergeCells('Z'.$baris_akhir.':'.$kolom_akhir.''.$baris_akhir);
                  $baris_akhir++;
                  if($jenis=="RKPD"){
                    $event->sheet->getDelegate()->setCellValue('N'.$baris_akhir,'Pembina Utama Madya NIP.19641013 199103 1 001');
                  }else{
                    $event->sheet->getDelegate()->setCellValue('N'.$baris_akhir,'NIP : '.$opd->nip);
                  }

                  $event->sheet->getDelegate()->mergeCells('N'.$baris_akhir.':V'.$baris_akhir);
                  if($jenis=="RKPD"){
                    $event->sheet->getDelegate()->setCellValue('Z'.$baris_akhir,' ');
                  }else{
                    $event->sheet->getDelegate()->setCellValue('Z'.$baris_akhir,'Pembina Utama Madya NIP.19641013 199103 1 001');
                  }
                  $event->sheet->getDelegate()->mergeCells('Z'.$baris_akhir.':'.$kolom_akhir.''.$baris_akhir);
                  //style center ttd
                  $event->sheet->getStyle('A'.($baris_akhir-11).':'.$kolom_akhir.''.$baris_akhir)->getAlignment()->setHorizontal('center');
                  // bold & underline TTD
                  $event->sheet->getDelegate()->getStyle('N'.($baris_akhir-8).':'.$kolom_akhir.''.($baris_akhir-1))->getFont()->setBold(true);
                  $event->sheet->getDelegate()->getStyle('N'.($baris_akhir-1).':'.$kolom_akhir.''.($baris_akhir-1))->getFont()->setUnderline(true);
                  //style header
                  $event->sheet->getDelegate()->getStyle('A1:'.$kolom_akhir.'4')->getAlignment()->setWrapText(true);
                  // $event->sheet->getDelegate()->setHeight(1,50);
                  // $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(11);
                 
                  //wrap text
                  $event->sheet->getDelegate()->getStyle('C8:E'.$baris_akhir)->getAlignment()->setWrapText(true);
                  // $event->sheet->getDelegate()->getStyle('D8:D'.$baris_akhir)->getAlignment()->setWrapText(true);
                  $event->sheet->getDelegate()->getStyle('AC8:'.$kolom_akhir.''.$baris_akhir)->getAlignment()->setWrapText(true);
                  // SHEETVIEW_PAGE_BREAK_PREVIEW

                  //format cells
					$event->sheet->getDelegate()->getStyle('F1:F'.$baris_akhir)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);	
					$event->sheet->getDelegate()->getStyle('G1:G'.$baris_akhir)->getNumberFormat()->setFormatCode('#,##0');

					$event->sheet->getDelegate()->getStyle('H1:H'.$baris_akhir)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);	
					$event->sheet->getDelegate()->getStyle('I1:I'.$baris_akhir)->getNumberFormat()->setFormatCode('#,##0');

					$event->sheet->getDelegate()->getStyle('J1:J'.$baris_akhir)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);	
					$event->sheet->getDelegate()->getStyle('K1:K'.$baris_akhir)->getNumberFormat()->setFormatCode('#,##0');

					$event->sheet->getDelegate()->getStyle('L1:L'.$baris_akhir)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);	
					$event->sheet->getDelegate()->getStyle('M1:M'.$baris_akhir)->getNumberFormat()->setFormatCode('#,##0');

					$event->sheet->getDelegate()->getStyle('N1:N'.$baris_akhir)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);	
					$event->sheet->getDelegate()->getStyle('O1:O'.$baris_akhir)->getNumberFormat()->setFormatCode('#,##0');

					$event->sheet->getDelegate()->getStyle('P1:P'.$baris_akhir)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);	
					$event->sheet->getDelegate()->getStyle('Q1:Q'.$baris_akhir)->getNumberFormat()->setFormatCode('#,##0');

					$event->sheet->getDelegate()->getStyle('R1:R'.$baris_akhir)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);	
					$event->sheet->getDelegate()->getStyle('S1:S'.$baris_akhir)->getNumberFormat()->setFormatCode('#,##0');

					$event->sheet->getDelegate()->getStyle('T1:T'.$baris_akhir)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);	
					$event->sheet->getDelegate()->getStyle('U1:U'.$baris_akhir)->getNumberFormat()->setFormatCode('#,##0');

					$event->sheet->getDelegate()->getStyle('X1:X'.$baris_akhir)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);	
					$event->sheet->getDelegate()->getStyle('Y1:Y'.$baris_akhir)->getNumberFormat()->setFormatCode('#,##0');

					$event->sheet->getDelegate()->getStyle('V1:V'.$baris_akhir)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);	
					$event->sheet->getDelegate()->getStyle('W1:W'.$baris_akhir)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);	

					$event->sheet->getDelegate()->getStyle('Z1:Z'.$baris_akhir)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);	
					$event->sheet->getDelegate()->getStyle('AA1:AA'.$baris_akhir)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);	

                  

                  //set coloum width
                  // $event->sheet->getDelegate()->setHeight(8,5);
                  $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(5);
                  $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(16);
                  $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(50);
                  $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(50);
                  $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(15);
                  $event->sheet->getDelegate()->getColumnDimension('F')->setAutoSize(true);
                  $event->sheet->getDelegate()->getColumnDimension('G')->setAutoSize(true);
                  $event->sheet->getDelegate()->getColumnDimension('H')->setAutoSize(true);
                  $event->sheet->getDelegate()->getColumnDimension('I')->setAutoSize(true);
                  $event->sheet->getDelegate()->getColumnDimension('J')->setAutoSize(true);
                  $event->sheet->getDelegate()->getColumnDimension('K')->setAutoSize(true);
                  $event->sheet->getDelegate()->getColumnDimension('L')->setAutoSize(true);
                  $event->sheet->getDelegate()->getColumnDimension('M')->setAutoSize(true);
                  $event->sheet->getDelegate()->getColumnDimension('N')->setAutoSize(true);
                  $event->sheet->getDelegate()->getColumnDimension('O')->setAutoSize(true);
                  $event->sheet->getDelegate()->getColumnDimension('P')->setAutoSize(true);
                  $event->sheet->getDelegate()->getColumnDimension('Q')->setAutoSize(true);
                  $event->sheet->getDelegate()->getColumnDimension('R')->setAutoSize(true);
                  $event->sheet->getDelegate()->getColumnDimension('S')->setAutoSize(true);
                  $event->sheet->getDelegate()->getColumnDimension('T')->setAutoSize(true);
                  $event->sheet->getDelegate()->getColumnDimension('U')->setAutoSize(true);
                  $event->sheet->getDelegate()->getColumnDimension('V')->setAutoSize(true);
                  $event->sheet->getDelegate()->getColumnDimension('W')->setAutoSize(true);
                  $event->sheet->getDelegate()->getColumnDimension('X')->setAutoSize(true);
                  $event->sheet->getDelegate()->getColumnDimension('Y')->setAutoSize(true);
                  $event->sheet->getDelegate()->getColumnDimension('Z')->setAutoSize(true);
                  $event->sheet->getDelegate()->getColumnDimension('AA')->setAutoSize(true);
                  $event->sheet->getDelegate()->getColumnDimension('AB')->setWidth(22);
                  $event->sheet->getDelegate()->getColumnDimension('AC')->setWidth(25);

                  $event->sheet->getDelegate()->getRowDimension('8')->setRowHeight(100);
                  // if($jenis=="RKPD"){
                  // // set print area
                  // $event->sheet->getDelegate()->getPageSetup()->setPrintArea('A1:AB'.$baris_akhir);
                  // }
            },
        ];
    }
    */
}
