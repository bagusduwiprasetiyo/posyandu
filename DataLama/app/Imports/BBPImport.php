<?php

namespace App\Imports;

use App\Models\BBP;
use Maatwebsite\Excel\Concerns\ToModel;

class BBPImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new BBP([
             'umur' => $row[0],
                'min3' => $row[1],
                    'min2' => $row[2],
                    'min1' => $row[3],
                    'median' => $row[4],
                    'plus1' => $row[5],
                    'plus2' => $row[6],
                'plus3' => $row[7]
        ]);
    }
}
