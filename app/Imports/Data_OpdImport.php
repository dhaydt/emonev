<?php
  
namespace App\Imports;
  
use App\Data_Opd;
use Maatwebsite\Excel\Concerns\ToModel;
Use Maatwebsite\Excel\Concerns\WithStartRow;  
class Data_OpdImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Data_Opd([
            'id'=> $row[0],
            'unit_key'=> $row[1],
            'kdunit'=> $row[2],
            'kdlevel'=> $row[3],
            'tipe'=> $row[4],
            'nm_instansi'=> $row[5],
            'nip'=> $row[6],
            'kepala'=> $row[7],
            'singkatan'=> $row[8],
            'akrounit'=> $row[9],
            'telp'=> $row[10],
            'alamat'=> $row[11],
            'pimpinan'=> $row[12],
            'non_urusan'=> $row[13],
        ]);
    }
    /**
         * @return int
         */
        public function startRow(): int
        {
            return 2;
        }
}