<?php

namespace App\Exports;

use App\Sample;
use Maatwebsite\Excel\Concerns\FromCollection;

class SampleExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Sample::all();
    }
}
