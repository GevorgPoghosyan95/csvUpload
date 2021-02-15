<?php

namespace App;

use App\Jobs\UploadCsv;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;
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
            Doc::create(['title'=>$row]);
        }
        return 'success';
    }
}
