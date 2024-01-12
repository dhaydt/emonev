<?php
  
namespace App\Imports;
use DB;
use App\Renja_per;
use App\Periode_Renja;
use Maatwebsite\Excel\Concerns\ToModel;
Use Maatwebsite\Excel\Concerns\WithStartRow;  
class Renja_PerImport implements ToModel,WithStartRow
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
        $id_periode_renja=$this->id_periode_renja;
        $pr=Periode_Renja::find($id_periode_renja);
        return new Renja_Per([
            'id_instansi'=> $row[0],
            'unitkey'=> $row[1],
            'induk_key'=> 0,
            'urusan_key'=> $row[1],
            'idprgrm'=> $row[2],
            'kdkegunit'=> $row[3],
            'nmkegunit'=> $row[4],
            'id_prioritas'=> $row[5],
            'belanja_p_now'=> $row[6],
            'belanja_bj_now'=> $row[7],
            'belanja_m_now'=>  $row[8],
            'lokasi'=>  $row[9],
            'sasaran'=>  $row[10],
            'id_jenis_belanja'=>  2,
            'periode'=>  $pr->id,
            'rpjmd_st'=>  1,
            'rkpd_st'=>  1,
            'apbd_st'=>  1,
            'bappeda'=>  1,
        ]);

    }
    /**
         * @return int
         */
        public function startRow(): int
        {
            DB::table('renja_per')->where('periode',$this->id_periode_renja)->delete();
            return 2;
        }
}