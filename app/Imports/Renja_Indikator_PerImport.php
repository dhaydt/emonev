<?php
  
namespace App\Imports;
use DB;
use App\Renja_Per;
use App\Renja_Indikator_Per;
use App\Periode_Renja;
use Maatwebsite\Excel\Concerns\ToModel;
Use Maatwebsite\Excel\Concerns\WithStartRow;  
class Renja_IndikatorImport implements ToModel,WithStartRow
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
        $renja=Renja_Per::where('id_instansi',$row[0])->where('kdkegunit',$row[1])->where('periode',$this->id_periode_renja)->first();
        if($renja!=""){
            $renja_indikator=Renja_Indikator_Per::where('id_renja',$renja->id);
            $id_renja=$renja->id;
            $kdkegunit=$renja->kdkegunit;
            $unitkey=$renja->unitkey;
            $renja_indikator->delete();
        }else{
            $id_renja=0;
            $kdkegunit=0;
            $unitkey=0;
        }


        $id_periode_renja=$this->id_periode_renja;
        $pr=Periode_Renja::find($id_periode_renja);
        return new Renja_Indikator_Per([
            'id_renja'=> $id_renja,
            'kdjkk'=> '02',
            'kdkegunit'=> $kdkegunit,
            'tolokur'=>  $row[2],
            'kdtahap'=>  1,
            'unitkey'=>  $unitkey,
            'ind_st'=>  1,
        ]);

    }
    /**
         * @return int
         */
        public function startRow(): int
        {
            // $renja=DB::table('renja')->where('periode',$this->id_periode_renja)->get();
            // foreach ($renja as $v) {
            //     DB::table('renja_indikator')->where('kdjkk','02')->where('id_renja',$v->id)->delete();
            // }

            return 2;
        }
}