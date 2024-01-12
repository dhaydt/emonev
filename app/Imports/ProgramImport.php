<?php
  
namespace App\Imports;
  
use App\Program;
use Maatwebsite\Excel\Concerns\ToModel;
Use Maatwebsite\Excel\Concerns\WithStartRow;  
class ProgramImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Program([
            'id'=> $row[0],
            'nmprgrm'=> $row[1],
            'nomor'=> $row[2],
            'id_status'=> $row[3],
            'non_urusan'=> $row[4],
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