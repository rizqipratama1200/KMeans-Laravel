<?php

namespace App\Exports;

use App\Dataset;
use Maatwebsite\Excel\Concerns\FromCollection;

class DatasetExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Dataset::all();
    }
}
