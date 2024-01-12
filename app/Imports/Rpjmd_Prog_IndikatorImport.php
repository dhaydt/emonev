<?php
  
namespace App\Imports;
use DB;
// use App\Rpjmd_Prog;
use App\Rpjmd_Prog_Indikator;
use App\Periode_Rpjmd;
use Maatwebsite\Excel\Concerns\ToModel;
Use Maatwebsite\Excel\Concerns\WithStartRow;  
class Rpjmd_Prog_IndikatorImport implements ToModel,WithStartRow
{
    public function __construct($id_periode_rpjmd)
    {
        $this->id_periode_rpjmd = $id_periode_rpjmd;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $id_periode_rpjmd=$this->id_periode_rpjmd;
        $pr=Periode_Rpjmd::find($id_periode_rpjmd);
        return new Rpjmd_Prog_Indikator([
            'idprgrm'=> $row[0],
            'unitkey'=> $row[1],
            'id_instansi'=> $row[2],
            'indikator'=> $row[3],
            'satuan'=> $row[4],
            't1'=> $row[5],
            't2'=> $row[6],
            't3'=> $row[7],
            't4'=> $row[8],
            't5'=> $row[9],
            't6'=> $row[10],
            'id_periode_rpjmd'=> $id_periode_rpjmd,
        ]);

    }
    /**
         * @return int
         */
        public function startRow(): int
        {
            DB::table('rpjmd_prog_indikator')->where('id_periode_rpjmd',$this->id_periode_rpjmd)->delete();
            return 2;
        }
}