<?php
  
namespace App\Imports;
use DB;
use App\Renja;
use App\Renja_Per;
use App\Realisasi;
use App\Periode_Renja;
use Maatwebsite\Excel\Concerns\ToModel;
Use Maatwebsite\Excel\Concerns\WithStartRow;  
class RealisasiImport implements ToModel,WithStartRow
{
    public function __construct($id_periode_renja)
    {
        $this->id_periode_renja = $id_periode_renja;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {


           // $renja_indikator = DB::table('renja')
           //                      // ->where('kdjkk','02')
           //                      ->where('renja.id_instansi',$row[1])
           //                      ->where('renja.kdkegunit',$row[2])
           //                      ->join('renja_indikator', 'renja.id', '=', 'renja_indikator.id_renja')
           //                      ->select('renja_indikator.id')
           //                      ->first();

        $id_periode_renja=$this->id_periode_renja;
        $pr=Periode_Renja::find($id_periode_renja);
        
        $renja=Renja::where('periode',$row[0])->where('id_instansi',$row[1])->where('kdkegunit',$row[2])->first();
        if($renja!=""){
            $id_renja=$renja->id;
        }else{
            $id_renja=0;
        }

        $renja_per=Renja_Per::where('periode',$row[0])->where('id_instansi',$row[1])->where('kdkegunit',$row[2])->first();
        if($renja_per!=""){
            $id_renja_per=$renja_per->id;
        }else{
            $id_renja_per=0;
        }
        
        return new Realisasi([
            'id_renja'=> $id_renja,
            'id_renja_per'=> $id_renja_per,
            'periode_renja'=> $row[0],
            'id_instansi_renja'=> $row[1],
            'kdkegunit_renja'=> $row[2],
            'rpt1'=> $row[3],
            'rpt2'=>  $row[4],
            'rpt3'=>  $row[5],
            'rpt4'=>  $row[6],
        ]);

    }
    /**
         * @return int
         */
        public function startRow(): int
        {
            DB::table('realisasi')->where('periode_renja',$this->id_periode_renja)->delete();
            return 2;
        }
}