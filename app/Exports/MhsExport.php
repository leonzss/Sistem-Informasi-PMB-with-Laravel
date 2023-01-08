<?php

namespace App\Exports;

use App\Models\Mhs;
use Maatwebsite\Excel\Concerns\FromCollection;

class MhsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Mhs::all();
    }
}
