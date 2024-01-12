<?php
  
namespace App\Imports;
  
use App\Renstra_Keg;
use Maatwebsite\Excel\Concerns\ToModel;
Use Maatwebsite\Excel\Concerns\WithStartRow;  
class KegiatanImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Renstra_Keg([
            'id'=> $row[0],
            'idprgrm'=> $row[1],
            'kdperspektif'=> $row[2],
            'nmkegunit'=> $row[3],
            'levelkeg'=> $row[4],
            'type'=> $row[5],
            'kode'=> $row[6],
            'id_status'=> $row[7],
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