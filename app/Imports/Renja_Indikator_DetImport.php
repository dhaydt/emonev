<?php
  
namespace App\Imports;
use DB;
use App\Renja;
use App\Renja_Indikator;
use App\Renja_Indikator_Det;
use App\Periode_Renja;
use Maatwebsite\Excel\Concerns\ToModel;
Use Maatwebsite\Excel\Concerns\WithStartRow;  
class Renja_Indikator_DetImport implements ToModel,WithStartRow
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

           $renja_indikator = DB::table('renja')
                                ->where('kdjkk','02')
                                ->where('renja.id_instansi',$row[1])
                                ->where('renja.kdkegunit',$row[2])
                                ->join('renja_indikator', 'renja.id', '=', 'renja_indikator.id_renja')
                                ->select('renja_indikator.id')
                                ->first();

        $id_periode_renja=$this->id_periode_renja;
        $pr=Periode_Renja::find($id_periode_renja);
        
        if($renja_indikator!=""){
            $id=$renja_indikator->id;
        }else{
            $id=0;
        }
        
        if($row[3]==""){$sat="";}else{$sat=$row[3];}
        return new Renja_Indikator_Det([
            'id_kegindikator'=> $id,
            'sat_det'=> $sat,
            'target_det'=> $row[4],
            'id_instansi'=> $row[1],
            'kdkegunit'=>  $row[2],
            'periode'=>  $id_periode_renja,
            'perubahan'=>  2,
        ]);

    }
    /**
         * @return int
         */
        public function startRow(): int
        {
            DB::table('renja_indikator_det')->where('periode',$this->id_periode_renja)->delete();
            return 2;
        }
}