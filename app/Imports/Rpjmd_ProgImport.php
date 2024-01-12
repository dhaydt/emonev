<?php
  
namespace App\Imports;
use DB;
use App\Rpjmd_Prog;
use App\Periode_Rpjmd;
use Maatwebsite\Excel\Concerns\ToModel;
Use Maatwebsite\Excel\Concerns\WithStartRow;  
class Rpjmd_ProgImport implements ToModel,WithStartRow
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
        return new Rpjmd_Prog([
            'idprgrm'=> $row[0],
            'unitkey'=> $row[1],
            'nmprgrm'=> $row[2],
            'id_instansi'=> $row[3],
            'id_status'=> $row[4],
            'prioritas'=> $row[5],
            'tahun_awal_rpjmd'=> $pr->thn_awal,
            'tahun_akhir_rpjmd'=> $pr->thn_akhir,
            'id_indikator_rpjmd'=> 0,
            'programindikator'=> '-',
            'nuprgrm'=> 0,
            'id_periode_rpjmd'=> $id_periode_rpjmd,
        ]);

    }
    /**
         * @return int
         */
        public function startRow(): int
        {
            DB::table('rpjmd_prog')->where('id_periode_rpjmd',$this->id_periode_rpjmd)->delete();
            return 2;
        }
}