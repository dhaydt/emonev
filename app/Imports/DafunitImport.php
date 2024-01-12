<?php
  
namespace App\Imports;
  
use App\Dafunit;
use Maatwebsite\Excel\Concerns\ToModel;
Use Maatwebsite\Excel\Concerns\WithStartRow;  
class DafunitImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Dafunit([
            'id'     => $row[0],
            'parent_id'    => $row[1], 
            'id_status'    => $row[2], 
            'order_no'    => $row[3], 
            'kdlevel'    => $row[4], 
            'unitkey'    => $row[5], 
            'kdunit'    => $row[6], 
            'nm_unit'    => $row[7], 
            'type'    => $row[8], 
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