<?php

namespace App;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class CsvImport implements ToCollection
{
    function __construct()
    {
        ini_set('max_execution_time', 300000);
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            dd($row);
        }
    }
}
