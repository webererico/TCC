<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class modelo implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        // foreach($rows as $row)
        // {
        //     'Amostra'     => $row[0],
        //     'Temperatura'    => $row[1], 
        //     'Umidade' => $row[2],
        //  ]);
        // }
    }
}
