<?php

namespace App\Exports;
use App\Dafunit;
use App\Data_Opd;
use App\Urusan_Opd;
use App\Rpjmd_Prog;
use App\Renja;
use DB;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
/**
* 
*/
class EvaluasiRkpd_Report implements FromView, WithEvents
{
  public function __construct($periode,$triwulan,$rekap)
    {
        $this->periode = $periode;
        $this->jenis = "RKPD";
        $this->triwulan = $triwulan;
        $this->rekap = $rekap;
    }

  use Exportable;
  
  public function view(): View
  {
    // $dafunit= dafunit::all();

    $periode=$this->periode;
    $jenis="RKPD";
    $triwulan=$this->triwulan;
    $rekap=$this->rekap;
      return view('excel.evaluasi_rkpd',compact('periode','jenis','triwulan'));
  }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
              $jenis=$this->jenis;
              $periode=$this->periode;
              $triwulan=$this->triwulan;
              $rekap=$this->rekap;
              $type="Program Prioritas";
              //set kolom akhir
                $kolom_akhir="AC";
                
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

                  $style_toturusan = [
                      'font' => 
                        [
                              'bold' => true,
                              // 'color' => ['argb' => 'ffffff'],
                       ],
                       'fill' => [
                               'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                               'startColor' => [
                                   'argb' => '00FF00',
                               ],
                           ],
                  ];
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
                                   'argb' => '98FB98',
                               ],
                           ],
                  ];
                  $style_program_pn = [
                      'font' => 
                        [
                              'bold' => true,
                              // 'color' => ['argb' => 'ffffff'],
                       ],
                       'fill' => [
                               'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                               'startColor' => [
                                   'argb' => 'FFB6C1',
                               ],
                           ],
                  ];
                  // $style_kegiatan = [
                  //     'font' => 
                  //       [
                  //             'bold' => true,
                  //             // 'color' => ['argb' => 'ffffff'],
                  //      ],
                  //      'fill' => [
                  //              'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                  //              'startColor' => [
                  //                  'argb' => 'FAF0E6',
                  //              ],
                  //          ],
                  // ];
                  
                  $urusan=Dafunit::
                  where('kdlevel',2)
                  ->where('id',18)
                  // where('id','!=',84)
                  // ->where('id',84)
                  // ->where('id',21)
                  // ->orwhere('id',67)
                  ->get();
                  $opd=Data_Opd::all();
                  $prog_rpjmd=Rpjmd_Prog::all();
                  $renja=Renja::where('periode',$periode)->where('bappeda',1)->get();
                  // $renja=Renja::all();

                  $hjmlurusan="=H".($baris_akhir+2);
                  $jjmlurusan="=J".($baris_akhir+2);
                  $ljmlurusan="=L".($baris_akhir+2);
                  
                  $njmlurusan="=N".($baris_akhir+2);
                  $pjmlurusan="=P".($baris_akhir+2);
                  $rjmlurusan="=R".($baris_akhir+2);
                  $tjmlurusan="=T".($baris_akhir+2);
                  $baristot_urusan=$baris_akhir;
                  foreach ($urusan as $keyurusan => $vurusan) {
                    if($vurusan->unitkey!="225_"){
                        $du = Dafunit::where('unitkey','=',$vurusan->unitkey)->first();
                        $urusan = $du->nm_unit;
                        $unitkey=$vurusan->unitkey;
                    }else{
                        $du = Dafunit::where('unitkey','=','212_')->first();
                        $sekda = $opd->where('unit_key','=','80_')->first();
                        $urusan = $du->nm_unit.' : '.$sekda->nm_instansi;   
                        $unitkey='80_';           
                    }

                    //start urusan
                    if($du->parent!=null){
                    $baris_akhir++;
                    $event->sheet->getDelegate()->setCellValue('C'.$baris_akhir,$du->parent->kdunit);
                    $event->sheet->getDelegate()->setCellValue('D'.$baris_akhir,$du->parent->nm_unit);
                    $event->sheet->getDelegate()->getStyle('A'.$baris_akhir.':'.$kolom_akhir.''.$baris_akhir)->applyFromArray($style_urusan);
                    }
                    $baris_akhir++;

                    if($keyurusan>0){$hjmlurusan .= "+H".$baris_akhir;}
                    if($keyurusan>0){$jjmlurusan .= "+J".$baris_akhir;}
                    if($keyurusan>0){$ljmlurusan .= "+L".$baris_akhir;}
                    if($keyurusan>0){$njmlurusan .= "+N".$baris_akhir;}
                    if($keyurusan>0){$pjmlurusan .= "+P".$baris_akhir;}
                    if($keyurusan>0){$rjmlurusan .= "+R".$baris_akhir;}
                    if($keyurusan>0){$tjmlurusan .= "+T".$baris_akhir;}

                    $event->sheet->getDelegate()->setCellValue('C'.$baris_akhir,$vurusan->kdunit);
                      $event->sheet->getDelegate()->setCellValue('D'.$baris_akhir,$urusan);

                    $event->sheet->getDelegate()->getStyle('A'.$baris_akhir.':'.$kolom_akhir.''.$baris_akhir)->applyFromArray($style_urusan);

                      // start opd
                    $hjmlopd="=H".($baris_akhir+1);
                    $jjmlopd="=J".($baris_akhir+1);
                    $ljmlopd="=L".($baris_akhir+1);
                    
                    $njmlopd="=N".($baris_akhir+1);
                    $pjmlopd="=P".($baris_akhir+1);
                    $rjmlopd="=R".($baris_akhir+1);
                    $tjmlopd="=T".($baris_akhir+1);

                    $baris_urusan=$baris_akhir;
                      foreach ($vurusan->opd_rkpd($periode,$unitkey) as $keyopd => $vopd) {
                        $baris_akhir++;

                        if($keyopd>0){$hjmlopd .= "+H".$baris_akhir;}
                        if($keyopd>0){$jjmlopd .= "+J".$baris_akhir;}
                        if($keyopd>0){$ljmlopd .= "+L".$baris_akhir;}
                        if($keyopd>0){$njmlopd .= "+N".$baris_akhir;}
                        if($keyopd>0){$pjmlopd .= "+P".$baris_akhir;}
                        if($keyopd>0){$rjmlopd .= "+R".$baris_akhir;}
                        if($keyopd>0){$tjmlopd .= "+T".$baris_akhir;}

                        $nm_opd=$opd->find($vopd->id_instansi);
                        $event->sheet->getDelegate()->setCellValue('C'.$baris_akhir,$vurusan->kdunit.($keyopd+1));
                        $event->sheet->getDelegate()->setCellValue('D'.$baris_akhir,$nm_opd->nm_instansi);
                        $event->sheet->getDelegate()->getStyle('A'.$baris_akhir.':'.$kolom_akhir.''.$baris_akhir)->applyFromArray($style_opd);

                          $baris_opd=$baris_akhir;
                          // start program
                          $hjmlprog="=H".($baris_akhir+1);
                          $jjmlprog="=J".($baris_akhir+1);
                          $ljmlprog="=L".($baris_akhir+1);
                          
                          $njmlprog="=N".($baris_akhir+1);
                          $pjmlprog="=P".($baris_akhir+1);
                          $rjmlprog="=R".($baris_akhir+1);
                          $tjmlprog="=T".($baris_akhir+1);
                          foreach ($vopd->program_rkpd($periode,$unitkey,$vopd->id_instansi) as $keyprog => $vprog) {
                            $no_keg=0;
                            $baris_akhir++;

                            if($keyprog>0){$hjmlprog .= "+H".$baris_akhir;}
                            if($keyprog>0){$jjmlprog .= "+J".$baris_akhir;}
                            if($keyprog>0){$ljmlprog .= "+L".$baris_akhir;}
                            if($keyprog>0){$njmlprog .= "+N".$baris_akhir;}
                            if($keyprog>0){$pjmlprog .= "+P".$baris_akhir;}
                            if($keyprog>0){$rjmlprog .= "+R".$baris_akhir;}
                            if($keyprog>0){$tjmlprog .= "+T".$baris_akhir;}
                            
                            $nm_prog_opd=$prog_rpjmd->where('unit_key',$vurusan->unit_key)->where('id_instansi',$vopd->id_instansi)->where('idprgrm',$vprog->idprgrm)->first();
                            $event->sheet->getDelegate()->setCellValue('C'.$baris_akhir,$vurusan->kdunit.($keyopd+1).'.'.($keyprog+1));
                            $event->sheet->getDelegate()->setCellValue('D'.$baris_akhir,'Program '.$nm_prog_opd->nmprgrm);

                            if($nm_prog_opd->prioritas=="PD"){$styleprogram=$style_program;}else{$styleprogram=$style_program_pn;}
                            $event->sheet->getDelegate()->getStyle('A'.$baris_akhir.':'.$kolom_akhir.''.$baris_akhir)->applyFromArray($styleprogram);
                                  // start indikator program
                                $baris_prog=$baris_akhir;
                                  foreach ($nm_prog_opd->indikator_program() as $pi) {
                                    $event->sheet->getDelegate()->setCellValue('E'.$baris_akhir,$pi->indikator);
                                    $event->sheet->getDelegate()->setCellValue('F'.$baris_akhir,$pi->satuan);
                                    $event->sheet->getDelegate()->getStyle('A'.$baris_akhir.':'.$kolom_akhir.''.$baris_akhir)->applyFromArray($styleprogram);
                                    

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

                                     $tahun_1=$pi->t1 ? $pi->t1 : null;
                                     $tahun_2=$pi->t2 ? $pi->t2 : null;
                                     $tahun_3=$pi->t3 ? $pi->t3 : null;
                                     $tahun_4=$pi->t4 ? $pi->t4 : null;
                                     $tahun_5=$pi->t5 ? $pi->t5 : null;
                                     $tahun_6=$pi->t6 ? $pi->t6 : null;
                                     
                                     $tkrpjmd=($tahun_1)+($tahun_2)+($tahun_3)+($tahun_4)+($tahun_5)+($tahun_6);
                                         
                                    $event->sheet->getDelegate()->setCellValue('G'.$baris_akhir,$tkrpjmd);  
                                    $event->sheet->getDelegate()->setCellValue('K'.$baris_akhir,$v7k);

                                    if($pi->realisasi_tprog!=""){
                                       $event->sheet->getDelegate()->setCellValue('I'.$baris_akhir,$pi->realisasi_tprog->p_re); 
                                       $event->sheet->getDelegate()->setCellValue('M'.$baris_akhir,$pi->realisasi_tprog->p_t1); 
                                       
                                       if($triwulan=="II" or $triwulan=="III" or $triwulan=="IV"){
                                       $event->sheet->getDelegate()->setCellValue('O'.$baris_akhir,$pi->realisasi_tprog->p_t2); 
                                       }
                                       
                                       if($triwulan=="III" or $triwulan=="IV"){
                                       $event->sheet->getDelegate()->setCellValue('Q'.$baris_akhir,$pi->realisasi_tprog->p_t3); 
                                       }

                                       if($triwulan=="IV"){
                                       $event->sheet->getDelegate()->setCellValue('S'.$baris_akhir,$pi->realisasi_tprog->p_t4); 
                                       }
                                       
                                       // $event->sheet->getDelegate()->setCellValue('AD'.$baris_akhir,$pi->realisasi_tprog->ket_prog); 
                                    }

                                     // rumus K program
                                    $event->sheet->getDelegate()->setCellValue('U'.$baris_akhir,'=M'.$baris_akhir.'+O'.$baris_akhir.'+Q'.$baris_akhir.'+S'.$baris_akhir);
                                    $event->sheet->getDelegate()->setCellValue('W'.$baris_akhir,'=U'.$baris_akhir.'/K'.$baris_akhir.'*100');
                                    $event->sheet->getDelegate()->setCellValue('Y'.$baris_akhir,'=I'.$baris_akhir.'+U'.$baris_akhir);
                                    $event->sheet->getDelegate()->setCellValue('AA'.$baris_akhir,'=Y'.$baris_akhir.'/G'.$baris_akhir.'*100');

                                    $baris_akhir++;
                                  }
                                  // end indikator program

                                  // start kegiatan
                                  $kegiatan=$renja->where('urusan_key',$unitkey)->where('id_instansi',$vopd->id_instansi)->where('idprgrm',$vprog->idprgrm);
                                  $no=0;

                                  $baris_keg_mulai=$baris_akhir;
                                  foreach ($kegiatan as $kk => $vr) {
                                    $no++;
                                    $no_keg++;
                                    $event->sheet->getDelegate()->setCellValue('C'.$baris_akhir,$vurusan->kdunit.($keyopd+1).'.'.($keyprog+1).'.'.$no);
                                    $nmkeg=null;
                                    $nmsasaran=null;
                                    if($vr->master_kegiatan!=null){
                                      $nmkeg=$vr->master_kegiatan->nmkegunit;
                                    }
                                    if($vr->sasaran_pembangunan!=null){
                                     $nmsasaran=$vr->sasaran_pembangunan->sasaran;
                                    }
                                    $dana=$vr->belanja_p_now+$vr->belanja_bj_now+$vr->belanja_m_now;
                                    $event->sheet->getDelegate()->setCellValue('B'.$baris_akhir,$nmsasaran);
                                    $event->sheet->getDelegate()->setCellValue('D'.$baris_akhir,$nmkeg);

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
                                        $nmkeg="";$dana="";$no_keg=0;
                                        $rp5="";$rp6="";
                                        $rpt1="";$rpt2="";$rpt3="";$rpt4="";
                                      }
                                      $target_det=$isi[$k]['target_det'];
                                      $tolokur=$isi[$k]['tolokur'];
                                      if($tolokur==$tolokur2){$tolokur="";}else{$tolokur=$isi[$k]['tolokur'];$tolokur2=$isi[$k]['tolokur'];}
                                      

                                      $event->sheet->getDelegate()->setCellValue('E'.$baris_akhir,$tolokur);
                                      $event->sheet->getDelegate()->setCellValue('F'.$baris_akhir,$isi[$k]['sat_det']);

                                      // if($isi[$k]['k5']!=""){
                                      //   $event->sheet->getDelegate()->getStyle('A'.$baris_akhir.':'.$kolom_akhir.''.$baris_akhir)->applyFromArray($style_kegiatan);
                                      // }
                                      $event->sheet->getDelegate()->setCellValue('G'.$baris_akhir,$isi[$k]['k5']);
                                      $event->sheet->getDelegate()->setCellValue('H'.$baris_akhir,$rp5);

                                      $event->sheet->getDelegate()->setCellValue('I'.$baris_akhir,$isi[$k]['k6']);
                                      $event->sheet->getDelegate()->setCellValue('J'.$baris_akhir,$rp6);

                                      $event->sheet->getDelegate()->setCellValue('K'.$baris_akhir,$target_det);
                                      $event->sheet->getDelegate()->setCellValue('L'.$baris_akhir,$dana);

                                      $event->sheet->getDelegate()->setCellValue('M'.$baris_akhir,$isi[$k]['kt1']);
                                      $event->sheet->getDelegate()->setCellValue('N'.$baris_akhir,$rpt1);

                                      $triwulan=$this->triwulan;
                                      if($triwulan=="II" or $triwulan=="III" or $triwulan=="IV"){
                                      $event->sheet->getDelegate()->setCellValue('O'.$baris_akhir,$isi[$k]['kt2']);
                                      $event->sheet->getDelegate()->setCellValue('P'.$baris_akhir,$rpt2);
                                      }
                                      
                                      if($triwulan=="III" or $triwulan=="IV"){
                                      $event->sheet->getDelegate()->setCellValue('Q'.$baris_akhir,$isi[$k]['kt3']);
                                      $event->sheet->getDelegate()->setCellValue('R'.$baris_akhir,$rpt3);
                                      }
                                      
                                      if($triwulan=="IV"){
                                      $event->sheet->getDelegate()->setCellValue('S'.$baris_akhir,$isi[$k]['kt4']);
                                      $event->sheet->getDelegate()->setCellValue('T'.$baris_akhir,$rpt4);
                                      }
                                      
                                      //rumus ...
                            //(12)
                                      $event->sheet->getDelegate()->setCellValue('U'.$baris_akhir,'=M'.$baris_akhir.'+O'.$baris_akhir.'+Q'.$baris_akhir.'+S'.$baris_akhir);
                                      if($k<1){
                                      $event->sheet->getDelegate()->setCellValue('V'.$baris_akhir,'=N'.$baris_akhir.'+P'.$baris_akhir.'+R'.$baris_akhir.'+T'.$baris_akhir);
                                      }

                            //(13)
                                      $event->sheet->getDelegate()->setCellValue('W'.$baris_akhir,'=U'.$baris_akhir.'/K'.$baris_akhir.'*100');
                                      if($k<1){
                                      $event->sheet->getDelegate()->setCellValue('X'.$baris_akhir,'=V'.$baris_akhir.'/L'.$baris_akhir.'*100');
                                      }

                            //(14)
                                      $event->sheet->getDelegate()->setCellValue('Y'.$baris_akhir,'=I'.$baris_akhir.'+U'.$baris_akhir);
                                      if($k<1){
                                      $event->sheet->getDelegate()->setCellValue('Z'.$baris_akhir,'=J'.$baris_akhir.'+V'.$baris_akhir);
                                      }

                            //(15)
                                      $event->sheet->getDelegate()->setCellValue('AA'.$baris_akhir,'=Y'.$baris_akhir.'/G'.$baris_akhir.'*100');
                                      if($k<1){
                                      $event->sheet->getDelegate()->setCellValue('AB'.$baris_akhir,'=Z'.$baris_akhir.'/H'.$baris_akhir.'*100');
                                      }


                                      $event->sheet->getDelegate()->setCellValue('AC'.$baris_akhir,$nm_opd->singkatan);
                                                  if($vr->lokasi!="" and $isi[$k]['ket_keg']!=""){$sep="/";}else{$sep="";}
                                      // $event->sheet->getDelegate()->setCellValue('AD'.$baris_akhir,$vr->lokasi.' '.$sep.' '.$isi[$k]['ket_keg']);
                                      
                                      $baris_akhir++;
                                      }
                                  }
                                  // end kegiatan

                                  //sum program
                                  $event->sheet->getDelegate()->setCellValue('H'.$baris_prog,'=sum(H'.$baris_keg_mulai.':H'.($baris_akhir-1).')');
                                  $event->sheet->getDelegate()->setCellValue('J'.$baris_prog,'=sum(J'.$baris_keg_mulai.':J'.($baris_akhir-1).')');
                                  $event->sheet->getDelegate()->setCellValue('L'.$baris_prog,'=sum(L'.$baris_keg_mulai.':L'.($baris_akhir-1).')');
                                  
                                  $event->sheet->getDelegate()->setCellValue('N'.$baris_prog,'=sum(N'.$baris_keg_mulai.':N'.($baris_akhir-1).')');
                                  $event->sheet->getDelegate()->setCellValue('P'.$baris_prog,'=sum(P'.$baris_keg_mulai.':P'.($baris_akhir-1).')');
                                  $event->sheet->getDelegate()->setCellValue('R'.$baris_prog,'=sum(R'.$baris_keg_mulai.':R'.($baris_akhir-1).')');
                                  $event->sheet->getDelegate()->setCellValue('T'.$baris_prog,'=sum(T'.$baris_keg_mulai.':T'.($baris_akhir-1).')');
                                  

                                  $event->sheet->getDelegate()->setCellValue('V'.$baris_prog,'=N'.$baris_prog.'+P'.$baris_prog.'+R'.$baris_prog.'+T'.$baris_prog);
                                  $event->sheet->getDelegate()->setCellValue('X'.$baris_prog,'=V'.$baris_prog.'/L'.$baris_prog.'*100');
                                  $event->sheet->getDelegate()->setCellValue('Z'.$baris_prog,'=J'.$baris_prog.'+V'.$baris_prog);
                                  $event->sheet->getDelegate()->setCellValue('AB'.$baris_prog,'=Z'.$baris_prog.'/H'.$baris_prog.'*100');

                                  // end kegiatan
                                  // $baris_akhir++;
                                  $event->sheet->getDelegate()->setCellValue('A'.$baris_akhir,'Rata-rata Capaian Kinerja (%)');
                                  $event->sheet->getDelegate()->mergeCells('A'.$baris_akhir.':Z'.$baris_akhir);
                                  $event->sheet->getDelegate()->setCellValue('AA'.$baris_akhir,'=sum(AA'.$baris_keg_mulai.':AA'.($baris_akhir-1).')/'.($baris_akhir-$baris_keg_mulai));
                                  $event->sheet->getDelegate()->setCellValue('AB'.$baris_akhir,'=sum(AB'.$baris_keg_mulai.':AB'.($baris_akhir-1).')/'.$no);

                                  // v
                                  $baris_akhir++;
                                  $event->sheet->getDelegate()->setCellValue('A'.$baris_akhir,'Predikat Kinerja');
                                  $event->sheet->getDelegate()->mergeCells('A'.$baris_akhir.':Z'.$baris_akhir);
                                  $event->sheet->getDelegate()->setCellValue('AA'.$baris_akhir,'=IF(AA'.($baris_akhir-1).'>90,"ST",IF(AA'.($baris_akhir-1).'>=76,"T",IF(AA'.($baris_akhir-1).'>=66,"S",IF(AA'.($baris_akhir-1).'>=51,"R","SR"))))');
                                  $event->sheet->getDelegate()->setCellValue('AB'.$baris_akhir,'=IF(AB'.($baris_akhir-1).'>90,"ST",IF(AB'.($baris_akhir-1).'>=76,"T",IF(AB'.($baris_akhir-1).'>=66,"S",IF(AB'.($baris_akhir-1).'>=51,"R","SR"))))');

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
                          // end program

                          // sum opd
                          $event->sheet->getDelegate()->setCellValue('H'.$baris_opd,$hjmlprog);
                          $event->sheet->getDelegate()->setCellValue('J'.$baris_opd,$jjmlprog);
                          $event->sheet->getDelegate()->setCellValue('L'.$baris_opd,$ljmlprog);

                          $event->sheet->getDelegate()->setCellValue('N'.$baris_opd,$njmlprog);
                          $event->sheet->getDelegate()->setCellValue('P'.$baris_opd,$pjmlprog);
                          $event->sheet->getDelegate()->setCellValue('R'.$baris_opd,$rjmlprog);
                          $event->sheet->getDelegate()->setCellValue('T'.$baris_opd,$tjmlprog);

                          $event->sheet->getDelegate()->setCellValue('V'.$baris_opd,'=N'.$baris_opd.'+P'.$baris_opd.'+R'.$baris_opd.'+T'.$baris_opd);
                          $event->sheet->getDelegate()->setCellValue('X'.$baris_opd,'=V'.$baris_opd.'/L'.$baris_opd.'*100');
                          $event->sheet->getDelegate()->setCellValue('Z'.$baris_opd,'=J'.$baris_opd.'+V'.$baris_opd);
                          $event->sheet->getDelegate()->setCellValue('AB'.$baris_opd,'=Z'.$baris_opd.'/H'.$baris_opd.'*100');
                        $baris_akhir++;
                      }
                      // end opd

                      // sum urusan
                      $event->sheet->getDelegate()->setCellValue('H'.$baris_urusan,$hjmlopd);
                      $event->sheet->getDelegate()->setCellValue('J'.$baris_urusan,$jjmlopd);
                      $event->sheet->getDelegate()->setCellValue('L'.$baris_urusan,$ljmlopd);

                      $event->sheet->getDelegate()->setCellValue('N'.$baris_urusan,$njmlopd);
                      $event->sheet->getDelegate()->setCellValue('P'.$baris_urusan,$pjmlopd);
                      $event->sheet->getDelegate()->setCellValue('R'.$baris_urusan,$rjmlopd);
                      $event->sheet->getDelegate()->setCellValue('T'.$baris_urusan,$tjmlopd);

                      $event->sheet->getDelegate()->setCellValue('V'.$baris_urusan,'=N'.$baris_urusan.'+P'.$baris_urusan.'+R'.$baris_urusan.'+T'.$baris_urusan);
                      $event->sheet->getDelegate()->setCellValue('X'.$baris_urusan,'=V'.$baris_urusan.'/L'.$baris_urusan.'*100');
                      $event->sheet->getDelegate()->setCellValue('Z'.$baris_urusan,'=J'.$baris_urusan.'+V'.$baris_urusan);
                      $event->sheet->getDelegate()->setCellValue('AB'.$baris_urusan,'=Z'.$baris_urusan.'/H'.$baris_urusan.'*100');
                    // endurusan
                    // $baris_akhir++;
                  }

                  // sum toturusan
                  $event->sheet->getDelegate()->setCellValue('D'.$baristot_urusan,'TOTAL KESELURUHAN');
                  $event->sheet->getDelegate()->getStyle('A'.$baristot_urusan.':'.$kolom_akhir.''.$baristot_urusan)->applyFromArray($style_toturusan);
                  $event->sheet->getDelegate()->setCellValue('H'.$baristot_urusan,$hjmlurusan);
                  $event->sheet->getDelegate()->setCellValue('J'.$baristot_urusan,$jjmlurusan);
                  $event->sheet->getDelegate()->setCellValue('L'.$baristot_urusan,$ljmlurusan);

                  $event->sheet->getDelegate()->setCellValue('N'.$baristot_urusan,$njmlurusan);
                  $event->sheet->getDelegate()->setCellValue('P'.$baristot_urusan,$pjmlurusan);
                  $event->sheet->getDelegate()->setCellValue('R'.$baristot_urusan,$rjmlurusan);
                  $event->sheet->getDelegate()->setCellValue('T'.$baristot_urusan,$tjmlurusan);

                  $event->sheet->getDelegate()->setCellValue('V'.$baristot_urusan,'=N'.$baristot_urusan.'+P'.$baristot_urusan.'+R'.$baristot_urusan.'+T'.$baristot_urusan);
                  $event->sheet->getDelegate()->setCellValue('X'.$baristot_urusan,'=V'.$baristot_urusan.'/L'.$baristot_urusan.'*100');
                  $event->sheet->getDelegate()->setCellValue('Z'.$baristot_urusan,'=J'.$baristot_urusan.'+V'.$baristot_urusan);
                  $event->sheet->getDelegate()->setCellValue('AB'.$baristot_urusan,'=Z'.$baristot_urusan.'/H'.$baristot_urusan.'*100');

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

                  // Delete col AC
                    // $event->sheet->getDelegate()->removeColumn('AC');
                    // $event->sheet->getDelegate()->removeColumnByIndex(32);
                    $event->sheet->getDelegate()->getStyle('A8:AC'.$baris_akhir)->applyFromArray($styleArray);
                    $event->sheet->getDelegate()->getStyle('A8:AC'.$baris_akhir)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
                  

                  $baris_akhir++;
                  //ket dan ttd
                  $event->sheet->getDelegate()->setCellValue('A'.$baris_akhir,'*) Diisi oleh Kepala BAPPEDA');
                  $baris_akhir++;

                  $event->sheet->getDelegate()->setCellValue('N'.$baris_akhir,'Disusun');
                  $event->sheet->getDelegate()->mergeCells('N'.$baris_akhir.':V'.$baris_akhir);
                  
                  $event->sheet->getDelegate()->setCellValue('Z'.$baris_akhir,'Disetujui');
                  
                  $event->sheet->getDelegate()->mergeCells('Z'.$baris_akhir.':'.$kolom_akhir.''.$baris_akhir);
                  $baris_akhir++;

                  $event->sheet->getDelegate()->setCellValue('N'.$baris_akhir,'Padang, tanggal '.date('d-m-Y'));
                  

                  $event->sheet->getDelegate()->mergeCells('N'.$baris_akhir.':V'.$baris_akhir);
                  $event->sheet->getDelegate()->setCellValue('Z'.$baris_akhir,'Padang, tanggal '.date('d-m-Y'));
                  $event->sheet->getDelegate()->mergeCells('Z'.$baris_akhir.':'.$kolom_akhir.''.$baris_akhir);
                  $baris_akhir++;

                  $baris_akhir++;
                  $event->sheet->getDelegate()->setCellValue('N'.$baris_akhir,'BADAN PERENCANAAN PEMBANGUNAN DAERAH');
                  
                  $event->sheet->getDelegate()->getStyle('N'.$baris_akhir)->getAlignment()->setWrapText(true);
                  $event->sheet->getDelegate()->getRowDimension($baris_akhir)->setRowHeight(40);
                  $event->sheet->getDelegate()->mergeCells('N'.$baris_akhir.':V'.$baris_akhir);
                  
                  $event->sheet->getDelegate()->setCellValue('Z'.$baris_akhir,'GUBERNUR SUMATERA BARAT');
                  
                  $event->sheet->getDelegate()->mergeCells('Z'.$baris_akhir.':'.$kolom_akhir.''.$baris_akhir);
                  $baris_akhir++;

                  $event->sheet->getDelegate()->setCellValue('N'.$baris_akhir,'PROVINSI SUMATERA BARAT');
                  $event->sheet->getDelegate()->mergeCells('N'.$baris_akhir.':V'.$baris_akhir);
                  

                  $baris_akhir++;
                  
                    $event->sheet->getDelegate()->setCellValue('N'.$baris_akhir,'Kepala,');
                    $event->sheet->getDelegate()->mergeCells('N'.$baris_akhir.':V'.$baris_akhir);
                    $baris_akhir++;
                  

                  $baris_akhir++;
                  $baris_akhir++;
                  $baris_akhir++;
                  $baris_akhir++;
                  $event->sheet->getDelegate()->setCellValue('N'.$baris_akhir,'HANSASTRI, SE.Ak.MM, CFrA');
                  
                  $event->sheet->getDelegate()->mergeCells('N'.$baris_akhir.':V'.$baris_akhir);
                  $event->sheet->getDelegate()->setCellValue('Z'.$baris_akhir,'IRWAN PRAYITNO');
                  
                  
                  $event->sheet->getDelegate()->mergeCells('Z'.$baris_akhir.':'.$kolom_akhir.''.$baris_akhir);
                  $baris_akhir++;
                  $event->sheet->getDelegate()->setCellValue('N'.$baris_akhir,'Pembina Utama Madya NIP.19641013 199103 1 001');
                  

                  $event->sheet->getDelegate()->mergeCells('N'.$baris_akhir.':V'.$baris_akhir);
                  $event->sheet->getDelegate()->setCellValue('Z'.$baris_akhir,' ');
                  
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
                  $event->sheet->getDelegate()->getStyle('C8:F'.$baris_akhir)->getAlignment()->setWrapText(true);
                  // $event->sheet->getDelegate()->getStyle('D8:D'.$baris_akhir)->getAlignment()->setWrapText(true);
                  $event->sheet->getDelegate()->getStyle('AC8:'.$kolom_akhir.''.$baris_akhir)->getAlignment()->setWrapText(true);
                  // SHEETVIEW_PAGE_BREAK_PREVIEW
                  
                  //format cells
          $event->sheet->getDelegate()->getStyle('G1:G'.$baris_akhir)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
          $event->sheet->getDelegate()->getStyle('H1:H'.$baris_akhir)->getNumberFormat()->setFormatCode('#,##0');  
          
          $event->sheet->getDelegate()->getStyle('I1:I'.$baris_akhir)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);  
          $event->sheet->getDelegate()->getStyle('J1:J'.$baris_akhir)->getNumberFormat()->setFormatCode('#,##0');

          $event->sheet->getDelegate()->getStyle('K1:K'.$baris_akhir)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
          $event->sheet->getDelegate()->getStyle('L1:L'.$baris_akhir)->getNumberFormat()->setFormatCode('#,##0'); 

          $event->sheet->getDelegate()->getStyle('M1:M'.$baris_akhir)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);  
          $event->sheet->getDelegate()->getStyle('N1:N'.$baris_akhir)->getNumberFormat()->setFormatCode('#,##0'); 

          $event->sheet->getDelegate()->getStyle('O1:O'.$baris_akhir)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
          $event->sheet->getDelegate()->getStyle('P1:P'.$baris_akhir)->getNumberFormat()->setFormatCode('#,##0'); 

          $event->sheet->getDelegate()->getStyle('Q1:Q'.$baris_akhir)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
          $event->sheet->getDelegate()->getStyle('R1:R'.$baris_akhir)->getNumberFormat()->setFormatCode('#,##0'); 

          $event->sheet->getDelegate()->getStyle('S1:S'.$baris_akhir)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);  
          $event->sheet->getDelegate()->getStyle('T1:T'.$baris_akhir)->getNumberFormat()->setFormatCode('#,##0');  

          $event->sheet->getDelegate()->getStyle('U1:U'.$baris_akhir)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
          $event->sheet->getDelegate()->getStyle('V1:V'.$baris_akhir)->getNumberFormat()->setFormatCode('#,##0'); 

          $event->sheet->getDelegate()->getStyle('W1:W'.$baris_akhir)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);  
          $event->sheet->getDelegate()->getStyle('X1:X'.$baris_akhir)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);  

          $event->sheet->getDelegate()->getStyle('Y1:Y'.$baris_akhir)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
           $event->sheet->getDelegate()->getStyle('Z1:Z'.$baris_akhir)->getNumberFormat()->setFormatCode('#,##0'); 

          $event->sheet->getDelegate()->getStyle('AA1:AA'.$baris_akhir)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);  
          $event->sheet->getDelegate()->getStyle('AB1:AB'.$baris_akhir)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);  

                  

                  //set coloum width
                  // $event->sheet->getDelegate()->setHeight(8,5);
                  $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(5);
                  $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(40);
                  $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(16);
                  $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(50);
                  $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(50);
                  $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(15);
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
                  $event->sheet->getDelegate()->getColumnDimension('AB')->setAutoSize(true);
                  $event->sheet->getDelegate()->getColumnDimension('AC')->setWidth(22);

                  $event->sheet->getDelegate()->getRowDimension('8')->setRowHeight(100);
                  // if($jenis=="RKPD"){
                  // // set print area
                  // $event->sheet->getDelegate()->getPageSetup()->setPrintArea('A1:AB'.$baris_akhir);
                  // }
            },
        ];
    }

}
