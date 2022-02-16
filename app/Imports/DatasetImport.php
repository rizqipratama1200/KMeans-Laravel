<?php

namespace App\Imports;

use App\Dataset;
use Maatwebsite\Excel\Concerns\ToModel;

class DatasetImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Dataset([
            'kode_siswa'=> $row[0],
            'jk'=> $row[1],
            'a1'=> $row[2],
            'a2'=> $row[3],
            'a3'=> $row[4],
            'a4'=> $row[5],
            'a5'=> $row[6],
            'a6'=> $row[7],
            'a7'=> $row[8],
            'a8'=> $row[9],
            'a9'=> $row[10],
        ]);
    }
}
