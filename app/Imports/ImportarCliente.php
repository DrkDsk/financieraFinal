<?php

namespace App\Imports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportarCliente implements ToModel
{
    public function model(array $row)
    {
        return new Client([
            'name' => $row[0],
            'phone' => $row[1],
            'address' => $row[2]
        ]);
    }
}
