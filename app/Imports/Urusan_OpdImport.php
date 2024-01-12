<?php
  
namespace App\Imports;
  
use App\Urusan_Opd;
use Maatwebsite\Excel\Concerns\ToModel;
Use Maatwebsite\Excel\Concerns\WithStartRow;  
use DB;
class Urusan_OpdImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $urusan_opd=Urusan_Opd::where('id_instansi',$row[0])->first();
        if($urusan_opd!=""){
            $arr=$row[1];

            $urusan_opd->arr_urusan=$urusan_opd->arr_urusan.','.$arr;
            $urusan_opd->save();
        }else{
            if($row[0]=="0"){
                return new Urusan_Opd([
                    'id'=> 1,
                    'id_instansi'=> $row[0],
                    'arr_urusan'=> $row[1],
                    'th_awal'=> 2016,
                    'th_akhir'=> 2021,
                ]);
            }else{
                return new Urusan_Opd([
                    'id_instansi'=> $row[0],
                    'arr_urusan'=> $row[1],
                    'th_awal'=> 2016,
                    'th_akhir'=> 2021,
                ]);
            }

        }
    }
    /**
         * @return int
         */
        public function startRow(): int
        {
            DB::table('urusan_opd')->delete();
            return 2;
        }
}