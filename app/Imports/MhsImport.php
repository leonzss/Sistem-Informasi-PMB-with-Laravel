<?php

namespace App\Imports;

use App\Models\Mhs;
use Maatwebsite\Excel\Concerns\ToModel;

class MhsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Mhs([
            'npm' => $row[0],
            'nama' => $row[1],
            'jurusan' => $row[2],
            'alamat' => $row[3],
        ]);
    }
}
